<?php
include "include.php";
include "placeholder_replacer.php"; // Include the placeholder replacer script
ini_set("memory_limit", "1520M");

//function log_message($message) {
    //file_put_contents('log.txt', date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
//}

//log_message("Starting email send...");

function send_email() {
    global $sub, $ofrom, $msg, $limit, $emails, $offer, $userid, $domain, $type, $datax, $mode, $head, $ot, $ct, $textm, $custom_headers, $message_id;
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

    //log_message("Subject: $sub");
    //log_message("From: $ofrom");
    //log_message("Message: $msg");
    //log_message("Emails: $emails");
    //log_message("Offer: $offer");
    //log_message("Domain: $domain");
    //log_message("Type: $type");
    //log_message("Mode: $mode");
    //log_message("Custom Headers: $custom_headers");
    //log_message("Message ID: $message_id");

    if ($head == 1) {
        $ep = "https://api.sparkpost.com/api/v1/transmissions";
    } else {
        $ep = "https://api.eu.sparkpost.com/api/v1/transmissions";
    }

    $ip_pair = trim($_REQUEST['ip']);
    $message_html = str_replace("{domain}", $domain, $msg);
    $message_html = str_replace("{email}", $emails, $message_html);

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
        $data['metadata'] = array('message_id' => $message_id);
    }


    if ($mode == 'test') {
        $lines = explode("\n", $emails);
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
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        $error = curl_error($ch);
        //log_message("Curl error: $error");
        echo "Curl error: $error";
    } else {
        //log_message("Response code: $http_code");
        //log_message("Response: $result");
        echo "Response code: $http_code<br>";
        echo "Response: $result<br>";
    }

    curl_close($ch);
}

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

send_email();

?>
