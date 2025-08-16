<?php
$key = $_REQUEST['offer'];
$head= $_REQUEST['head'];
//$key = "b7dc10a79d47f9ee83a60b09040b43197aab76a3";
if($head==1)
 {
 	$ep1="https://api.sparkpost.com/api/v1/metrics/deliverability?from=2016-02-11T08:00&metrics=count_injected,count_bounce,count_rejected,count_delivered,count_delivered_first,count_delivered_subsequent,total_delivery_time_first,total_delivery_time_subsequent,total_msg_volume,count_policy_rejection,count_generation_rejection,count_generation_failed,count_inband_bounce,count_outofband_bounce,count_soft_bounce,count_hard_bounce,count_block_bounce,count_admin_bounce,count_undetermined_bounce,count_delayed,count_delayed_first,count_rendered,count_unique_rendered,count_unique_confirmed_opened,count_clicked,count_unique_clicked,count_targeted,count_sent,count_accepted,count_spam_complaint";
 	$ep2="https://api.sparkpost.com/api/v1/account?include=usage";
 }
else
{
$ep1="https://api.eu.sparkpost.com/api/v1/metrics/deliverability?from=2016-02-11T08:00&metrics=count_injected,count_bounce,count_rejected,count_delivered,count_delivered_first,count_delivered_subsequent,total_delivery_time_first,total_delivery_time_subsequent,total_msg_volume,count_policy_rejection,count_generation_rejection,count_generation_failed,count_inband_bounce,count_outofband_bounce,count_soft_bounce,count_hard_bounce,count_block_bounce,count_admin_bounce,count_undetermined_bounce,count_delayed,count_delayed_first,count_rendered,count_unique_rendered,count_unique_confirmed_opened,count_clicked,count_unique_clicked,count_targeted,count_sent,count_accepted,count_spam_complaint";
 	$ep2="https://api.eu.sparkpost.com/api/v1/account?include=usage";
}
$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = "Authorization: $key";
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,$ep1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
$a = objectToArray( json_decode($result) );

$count_targeted = $a['results']['0']['count_targeted'];
$count_injected = $a['results']['0']['count_injected'];
$count_bounce = $a['results']['0']['count_bounce'];
$count_rejected = $a['results']['0']['count_rejected'];
$count_delivered = $a['results']['0']['count_delivered'];
$count_soft_bounce = $a['results']['0']['count_soft_bounce'];
$count_hard_bounce = $a['results']['0']['count_hard_bounce'];
$count_block_bounce = $a['results']['0']['count_block_bounce'];
$count_delayed = $a['results']['0']['count_delayed'];
$count_delayed_first = $a['results']['0']['count_delayed_first'];
$count_sent = $a['results']['0']['count_sent'];
$count_unique_confirmed_opened = $a['results']['0']['count_unique_confirmed_opened'];
$count_accepted = $a['results']['0']['count_accepted'];
$count_spam_complaint = $a['results']['0']['count_spam_complaint'];


echo "Count Targeted : $count_targeted<br>";
echo "Count Injected : $count_injected<br>";
echo "Count Bounce : $count_bounce<br>";
echo "Count Rejected : $count_rejected<br>";
echo "Count Delivered : $count_delivered<br>";
echo "Count Soft Bounce : $count_soft_bounce<br>";
echo "Count Hard Bounce : $count_hard_bounce<br>";
echo "Count Block Bounce : $count_block_bounce<br>";
echo "Count Delayed : $count_delayed<br>";
echo "Count Delayed First : $count_delayed_first<br>";
echo "Count Sent : $count_sent<br>";
echo "Count Unique Opens : $count_unique_confirmed_opened<br>";
echo "Count Accepted : $count_accepted<br>";
echo "Count Spam Complaint : $count_spam_complaint<br>";


curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,$ep2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result=curl_exec($ch);
$a = objectToArray( json_decode($result) );
$dailylimit = $a['results']['usage']['day']['limit'];
$monthlylimit = $a['results']['usage']['month']['limit'];
$dailyused = $a['results']['usage']['day']['used'];
$montlyused = $a['results']['usage']['month']['used'];

echo "Used Today : $dailyused<br>";
echo "Limit Today : $dailylimit<br>";
echo "Used This Month : $montlyused<br>";
echo "Limit This month : $monthlylimit<br>";




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