<?php
$key = $_REQUEST['key'];
//$key = "71da9fcf4dbdf529523b6a3fe0cfe5fcc62b698f";
$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = "Authorization: $key";
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,"https://api.sparkpost.com/api/v1/account?include=usage");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
$a = objectToArray( json_decode($result) );
$dailylimit = $a['results']['usage']['day']['limit'];
$monthlylimit = $a['results']['usage']['month']['limit'];
$dailyused = $a['results']['usage']['day']['used'];
$montlyused = $a['results']['usage']['month']['used'];


$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = "Authorization: $key";
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,"https://api.sparkpost.com/api/v1/sending-domains");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);

$a = objectToArray(json_decode($result) );

$domain = $a['results']['0']['domain'];

echo "$dailyused|$dailylimit|$montlyused|$monthlylimit|$domain";

function objectToArray( $object )
   {
       if( !is_object( $object ) && !is_array( $object ) )
       {
           return $object;
       }
       if( is_object( $object ) )
       {
           $object = get_object_vars( $object );
       }
       return array_map( 'objectToArray', $object );
   }
?>