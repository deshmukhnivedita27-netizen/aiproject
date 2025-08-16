<?php
date_default_timezone_set('America/Los_Angeles');
$json = file_get_contents('php://input');
$obj = json_decode($json, true);
//$x = implode("|",$obj);
//file_put_contents('opener.txt', $x, FILE_APPEND | LOCK_EX);
$event = $obj[0]['msys']['track_event'];
$opener = $event['rcpt_to'];
$ip = $event['ip_address'];
$country = $event['geo_ip']['country'];
$region = $event['geo_ip']['region'];
$city = $event['geo_ip']['city'];
$timestamp = $event['timestamp'];
$date = date('Y-m-d H:i:s');
$file = 'o-'.date('Ymd');
$paths='open/';

//print_r($event);
$string = "$opener|$ip|$country|$region|$city|$timestamp|$date\n";
file_put_contents($paths.$file, $string, FILE_APPEND | LOCK_EX);
?>