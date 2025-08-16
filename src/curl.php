<?php
$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: 687f9916b3d128aa7db8e7c9c0f93066c73ba879';
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,"https://api.sparkpost.com/api/v1/transmissions");
$data = array();
$data['options'] = array('open_tracking' => true,'click_tracking' => true);
$data['recipients'][0] = array('address' => array('email' => 'ask4priyesh888@gmail.com'));
$data['recipients'][1] = array('address' => array('email' => 'rebeccafinch889@gmail.com'));
$data['recipients'][2] = array('address' => array('email' => 'elenahunt264@gmail.com'));
$data['recipients'][3] = array('address' => array('email' => 'ericgilbert89632@gmail.com'));
$data['content'] = array('from'=>array('name' => 'From Name', 'email' => 'jacob@thewatnwhere16.info'),'subject' => 'Subject','text' => 'Message Text', 'html' => 'Message Html');
curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($data));
$result=curl_exec($ch);
print_r($result);
//$b = json_decode($a);
//print_r(json_encode($data));

//$a = '{"options":{"open_tracking":true,"click_tracking":true},"metadata":{"some_useful_metadata":"testing_sparkpost"},"substitution_data":{"signature":"<REPLACE_WITH_YOUR_FIRST_AND_LAST_NAME>"},"recipients":[{"address":{"email":"<REPLACE_WITH_YOUR_EMAIL_ADDRESS>"},"tags":["learning"],"substitution_data":{"customer_type":"Platinum","first_name":"<REPLACE_WITH_YOUR_FIRST_NAME>"}}],"content":{"from":{"name":"Awesome Company","email":"testing@<REPLACE_WITH_YOUR_SENDING_DOMAIN>"},"subject":"My first SparkPost Transmission","text":"Hi {{first_name}}\r\nYou have just sent your first email through SparkPost!\r\nCongratulations,\r\n{{signature}}","html":"<strong>Hi {{first_name}},</strong><p>You have just sent your first email through SparkPost!</p><p>Congratulations!</p>{{signature}}"}}';
?>