<?php
include "include.php";
include "placeholder_replacer.php"; // Include the placeholder replacer script
ini_set("memory_limit", "1520M");

function log_message($message) {
    file_put_contents('log.txt', date('Y-m-d H:i:s') . " - " . $message . PHP_EOL, FILE_APPEND);
}

log_message("Starting email send...");

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
    $from_email = replace_placeholders($_REQUEST['ip']);
    log_message("Subject: $sub");
    log_message("From: $ofrom");
    log_message("Message: $msg");
    log_message("Emails: $emails");
    log_message("Offer: $offer");
    log_message("Domain: $domain");
    log_message("Type: $type");
    log_message("Mode: $mode");
    log_message("Custom Headers: $custom_headers");
    log_message("Message ID: $message_id");

    $ep = "https://api.elasticemail.com/v2/email/send";

    $ip_pair = trim($_REQUEST['ip']);
    $message_html = str_replace("{domain}", $domain, $msg);
    $message_html = str_replace("{email}", $emails, $message_html);

    $from = array();
    $from[$ip_pair] = $ofrom;

    $ch = curl_init();
    $headr = array();
    $headr[] = 'Content-type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($ch, CURLOPT_URL, $ep);

    $data = array(
        'from' => $from_email,
        'fromName' => $ofrom,
        'apikey' => $offer,
        'subject' => $sub,
        'bodyHtml' => $message_html,
        'to' => $emails,
        'isTransactional' => false
    );

    if (!empty($custom_headers)) {
        $headers = array();
        $lines = explode("\n", $custom_headers);
        foreach ($lines as $line) {
            list($key, $value) = explode(":", $line, 2);
            $headers[trim($key)] = trim($value);
        }
        $data['headers'] = json_encode($headers);
    }

    if (!empty($message_id)) {
        $data['MessageID'] = $message_id;
    }

    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        $error = curl_error($ch);
        log_message("Curl error: $error");
        echo "Curl error: $error";
    } else {
        log_message("Response code: $http_code");
        log_message("Response: $result");
        echo "Response code: $http_code<br>";
        echo "Response: $result<br>";
    }

    curl_close($ch);
}

mysql_query("insert into from_email(`femail`) values ('$ip_pair')");

send_email();

?>

