<?php
include "include.php";
include "placeholder_replacer.php"; // Include the placeholder replacer script
ini_set("memory_limit", "1520M");

$sub = replace_placeholders($_REQUEST['sub']);
$ofrom = replace_placeholders($_REQUEST['from']);
$msg = replace_placeholders($_REQUEST['message']);
$limit = $_REQUEST['limit'];
$emails = replace_placeholders($_REQUEST['emails']);
$offer = $_REQUEST['offer'];
$userid = $_REQUEST['userid'];
$domain = replace_placeholders($_REQUEST['domain']);
$type = $_REQUEST['type'];
$datax = $_REQUEST['data'];
$mode = $_REQUEST['mode'];
$head = $_REQUEST['head'];
$ot = $_REQUEST['ot'];
$ct = $_REQUEST['ct'];
$textm = replace_placeholders($_REQUEST['textm']);
$custom_headers = replace_placeholders($_REQUEST['custom_headers']);
$message_id = replace_placeholders($_REQUEST['message_id']);

if ($head == 1) {
    $ep = "https://api.sparkpost.com/api/v1/transmissions";
} else {
    $ep = "https://api.eu.sparkpost.com/api/v1/transmissions";
}

$ip_pair = trim($_REQUEST['ip']);
$d = @date("YmdHis");
$url = "$offer#$id";
$url = base64_encode($url);
$message_html = str_replace("{domain}", $domain, $msg);
$message_html = str_replace("{url}", $url, $message_html);
$message_html = str_replace("{email}", $email, $message_html);
$from = array();
$from[$ip_pair] = $ofrom;

$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = "Authorization: $offer";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
curl_setopt($ch, CURLOPT_URL, $ep);

$data = array();

if ($type == 'html') {
    $data['content'] = array('from' => array('name' => $ofrom, 'email' => $ip_pair), 'subject' => $sub, 'text' => '', 'html' => $message_html);
} else if ($type == 'plain') {
    $data['content'] = array('from' => array('name' => $ofrom, 'email' => $ip_pair), 'subject' => $sub, 'text' => $message_html, 'html' => '');
} else {
    $data['content'] = array('from' => array('name' => $ofrom, 'email' => $ip_pair), 'subject' => $sub, 'text' => $textm, 'html' => $message_html);
}

if ($ot == 1 && $ct == 1) {
    $data['options'] = array('open_tracking' => true, 'click_tracking' => true);
} else if ($ot == 1 && $ct == 0) {
    $data['options'] = array('open_tracking' => true, 'click_tracking' => false);
} else if ($ot == 0 && $ct == 1) {
    $data['options'] = array('open_tracking' => false, 'click_tracking' => true);
} else {
    $data['options'] = array('open_tracking' => false, 'click_tracking' => false);
}

// Add custom headers if provided
if (!empty($custom_headers)) {
    $headers = array();
    $lines = explode("\n", $custom_headers);
    foreach ($lines as $line) {
        list($key, $value) = explode(":", $line, 2);
        $headers[trim($key)] = trim($value);
    }
    $data['content']['headers'] = $headers;
}

// Add message ID if provided
if (!empty($message_id)) {
    $data['options']['transactional'] = true;
    $data['metadata'] = array('message_id' => $message_id);
}

if ($mode == 'test') {
    $lines = explode("\n", $emails);
    $st = date("Y-m-d G:i:s");
    foreach ($lines as $key => $email) {
        $data['recipients'][$key] = array('address' => array('email' => $email));
    }
} elseif ($mode == "bulk") {
    $count = 0;
    $datafile = "/var/www/data/$datax";
    $fp = fopen($datafile, "r");
    while (!feof($fp)) {
        $buffer = fgets($fp, 4096);
        $email = trim($buffer);
        if ($limit > 1) {
            $data['recipients'][$count] = array('address' => array('email' => $email));
        }
        $count++;
        if ($count % $limit == 0) {
            if ($limit > 1) {
                del_lines($datax, $limit);
            }
            $lines = explode("\n", $emails);
            foreach ($lines as $key => $email) {
                $data['recipients'][$count + $key] = array('address' => array('email' => $email));
            }
            break;
        }
    }
    fclose($fp);
}

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);

function del_lines($files, $X)
{
    $files = "/var/www/data/$files";
    $start = count(file($files));
    $lines = file($files);
    $lines = array_slice($lines, $X);
    $file = fopen($files, 'w');
    fwrite($file, implode('', $lines));
    fclose($file);
    $end = count(file($files));
    $diff = $start - $end;
    echo "<br><br> No of ids in the file Before: <B>$start</B> After: <B>$end</B> Difference is <b>$diff</b><br>";
    if ($diff == 0) {
        echo "<blink> <b> Change the Mode of the File or Data file is finished </b></blink>";
    }
}

mysql_query("insert into from_email(`femail`) values ('$ip_pair')");
?>

