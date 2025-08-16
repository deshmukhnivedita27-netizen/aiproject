<?php
$key = $_REQUEST['offer'];
//$key = "a5b37c26ccef2c071eb960b452c0115ba3d84351";
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


echo "$domain";

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