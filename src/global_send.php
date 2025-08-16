<?php
//include "include.php";
ini_set("memory_limit","1520M");
$ipda =$_REQUEST['server'];

$sub = $_REQUEST['sub'];
$lines=explode("\n",$ipda);
//print_r($_REQUEST);
foreach ($lines as $ip)
{
$ipca=str_replace(".","_",$ip);
//$sub2 = $sub.$ipca;
$sub2 = $sub;
$_REQUEST['sub']=$sub2;
$query = http_build_query($_REQUEST);
$url = "http://$ip/spark_auto/mail.php";
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch,CURLOPT_POST, count($query));
curl_setopt($ch,CURLOPT_POSTFIELDS, $query);
$result = curl_exec($ch);

curl_close($ch);

}
?>
