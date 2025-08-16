<?php
include "include.php";
include "placeholder_replacer.php";
ini_set("memory_limit", "1520M");

function send_alibaba_email() {
    global $sub, $ofrom, $msg, $limit, $emails, $access_key, $access_secret, $domain, $type, $datax, $mode, $head, $ot, $ct, $textm, $custom_headers, $message_id;
    
    // Get parameters from request
    $sub = replace_placeholders($_REQUEST['sub']);
    $ofrom = replace_placeholders($_REQUEST['ip']);
    $msg = replace_placeholders($_REQUEST['message']);
    $limit = $_REQUEST['limit'];
    $emails = replace_placeholders($_REQUEST['emails']);
    $access_key = $_REQUEST['access_key'];
    $access_secret = $_REQUEST['access_secret'];
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

    // Set API endpoint based on region
    // Set API endpoint based on region
    if ($head == 1) {
        $endpoint = "https://dm.ap-southeast-1.aliyuncs.com";  // US region
    } else if ($head == 2) {
        $endpoint = "https://dm.eu-central-1.aliyuncs.com";  // EU region
    } else if ($head == 3) {
        $endpoint = "https://dm.ap-southeast-1.aliyuncs.com";  // Singapore region
    }




    $message_html = str_replace("{domain}", $domain, $msg);
    $message_html = str_replace("{email}", $emails, $message_html);

    // Prepare the request parameters
    $params = array(
        'Action' => 'SingleSendMail',
        'Version' => '2016-08-25',
        'AccountName' => $ofrom,
        'FromAlias' => $ofrom,
        'AddressType' => 0,
        'Subject' => $sub,
        'ReplyToAddress' => 'false'
    );

    // Set message content based on type
    if ($type == 'html') {
        $params['HtmlBody'] = $message_html;
    } else if ($type == 'plain') {
        $params['TextBody'] = $message_html;
    } else {
        $params['HtmlBody'] = $message_html;
        $params['TextBody'] = $textm;
    }

    // Add custom headers if provided
    if (!empty($custom_headers)) {
        $headers = array();
        $lines = explode("\n", $custom_headers);
        foreach ($lines as $line) {
            list($key, $value) = explode(":", $line, 2);
            $params['Headers.' . trim($key)] = trim($value);
        }
    }

    // Add message ID if provided
    if (!empty($message_id)) {
        $params['TagName'] = $message_id;
    }

    // Handle recipients based on mode
    if ($mode == 'test') {
        $lines = explode("\n", $emails);
        foreach ($lines as $key => $email) {
            $params['ToAddress'] = $email;
            send_single_email($endpoint, $params, $access_key, $access_secret);
        }
    } elseif ($mode == "bulk") {
        $count = 0;
        $datafile = "/var/www/data/$datax";
        $fp = fopen($datafile, "r");
        while (!feof($fp)) {
            $buffer = fgets($fp, 4096);
            $email = trim($buffer);
            if ($limit > 1) {
                $params['ToAddress'] = $email;
                send_single_email($endpoint, $params, $access_key, $access_secret);
            }
            $count++;
            if ($count % $limit == 0) {
                if ($limit > 1) {
                    del_lines($datax, $limit);
                }
                $lines = explode("\n", $emails);
                foreach ($lines as $key => $email) {
                    $params['ToAddress'] = $email;
                    send_single_email($endpoint, $params, $access_key, $access_secret);
                }
                break;
            }
        }
        fclose($fp);
    }
}

function send_single_email($endpoint, $params, $access_key, $access_secret) {
    // Add required parameters for signature
    $params['AccessKeyId'] = $access_key;
    $params['SignatureMethod'] = 'HMAC-SHA1';
    $params['SignatureVersion'] = '1.0';
    $params['SignatureNonce'] = uniqid();
    $params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');

    // Generate signature
    $signature = generate_signature($params, $access_secret);
    $params['Signature'] = $signature;

    // Make API request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false) {
        $error = curl_error($ch);
        echo "Curl error: $error";
    } else {
        echo "Response code: $http_code<br>";
        echo "Response: $result<br>";
    }

    curl_close($ch);
}

function generate_signature($parameters, $access_secret) {
    // Sort parameters by key
    ksort($parameters);
    
    // Build the string to sign
    $stringToSign = '';
    foreach ($parameters as $key => $value) {
        $stringToSign .= '&' . rawurlencode($key) . '=' . rawurlencode($value);
    }
    $stringToSign = 'POST&%2F&' . rawurlencode(substr($stringToSign, 1));
    
    // Generate signature using HMAC-SHA1
    $signature = base64_encode(hash_hmac('sha1', $stringToSign, $access_secret . '&', true));
    
    return $signature;
}

function del_lines($files, $X) {
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

// Store the sender email in database
$ip_pair = trim($_REQUEST['ip']);
mysql_query("insert into from_email(`femail`) values ('$ip_pair')");

// Execute the email sending
send_alibaba_email();
?> 
