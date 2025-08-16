<B><U>Results:</U></B><BR><BR>
<?php
//include_once "../Swift-5.0.3/lib/swift_required.php";
ini_set("memory_limit","1520M");
$sub = $_REQUEST['sub'];
$ofrom = $_REQUEST['from'];
$msg = $_REQUEST['message'];
$limit = $_REQUEST['limit'];
$emails = $_REQUEST['emails'];
$offer = $_REQUEST['offer'];
$userid = $_REQUEST['userid'];
$domain = $_REQUEST['domain'];
$type = $_REQUEST['type'];
$datax = $_REQUEST['data'];
$mode = $_REQUEST['mode'];
$head= $_REQUEST['head'];
$ot=$_REQUEST['ot'];
$ct=$_REQUEST['ct'];
if($head==1)
 {
 	$ep="https://api.sparkpost.com/api/v1/transmissions";
 }
else
{
	$ep="https://api.eu.sparkpost.com/api/v1/transmissions";
}
$ip_pair=trim($_REQUEST['ip']);
$d = @date("YmdHis");
$url="$offer#$id";
$url = base64_encode($url);
echo $msg."</br>";
$url="$offer#$id";
$url = base64_encode($url);
$message_html=str_replace("{domain}",$domain,$msg);
$message_html=str_replace("{url}",$url,$message_html);
$message_html=str_replace("{email}",$email,$message_html);
$from = array();
$from[$ip_pair] = $ofrom; 
$ch = curl_init();
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = "Authorization: $offer";
curl_setopt($ch, CURLOPT_HTTPHEADER,$headr);
curl_setopt($ch,CURLOPT_URL,$ep);
$data = array();
//ip_pool

if($type=='html')
{
$data['content'] = array('from'=>array('name' => $ofrom, 'email' => $ip_pair),'subject' => $sub, 'text' => '', 'html' => $message_html);
}
else if($type=='plain')
{
$data['content'] = array('from'=>array('name' => $ofrom, 'email' => $ip_pair),'subject' => $sub, 'text' => $message_html, 'html' => '');
}
else
{
$data['content'] = array('from'=>array('name' => $ofrom, 'email' => $ip_pair),'subject' => $sub, 'text' => $textm, 'html' => $message_html);
}

if($ot==1 && $ct==1)
{
$data['options'] = array('open_tracking' => true,'click_tracking' => true); }
if($ot==1 && $ct==0)
{
$data['options'] = array('open_tracking' => true,'click_tracking' => false); }
if($ot==0 && $ct==1)
{
$data['options'] = array('open_tracking' => false,'click_tracking' => true); }
if($ot==0 && $ct==0)
{
$data['options'] = array('open_tracking' => false,'click_tracking' => false); }
$data['options']['ip_pool'] = $domain;
//array_push($data['options'], "'ip_pool' => $domain");
//print_r($data);
//exit;
if($mode=='test')
{
	$lines=explode("\n",$emails);
	$st = date("Y-m-d G:i:s");
	foreach ($lines as $key=>$email)
	{
	echo $email;
	$data['recipients'][$key] = array('address' => array('email' => $email));
	}
//echo "..........done";	
}
elseif($mode == "bulk") // Bulk mailing 
{
$count=0;
$datafile="/var/www/data/$datax";
$fp = fopen($datafile,"r");
while(!feof($fp))
        {
               $buffer = fgets($fp, 4096);
			   $email =trim($buffer);
               if($limit > 1)
                {
				//echo $buffer;
			$data['recipients'][$count] = array('address' => array('email' => $email));
		  }
		$count++;
       if($count%$limit==0)
                { 
					if($limit > 1)
					{
						del_lines($datax,$limit);
					}
					$lines=explode("\n",$emails);
				foreach ($lines as $key => $email)
					{
					$data['recipients'][$count + $key] = array('address' => array('email' => $email));
					}		
# exec ("wget -b -O /dev/null -o /dev/null 'http://aps-ui.com/sent.php?oid=$offer&c=$count'");
					break;   
                }
        }//echo"............done";	
}
curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($data));
$result=curl_exec($ch);
//print_r($result);
function del_lines($files,$X)
{
#       @chmod($files,0777);
	$files="/var/www/data/$files";
        $start=count(file($files));
        $lines = file($files);
        $first_line = $lines[0];
        $lines = array_slice($lines, $X);
		// Write to file
        $file = fopen($files, 'w');
        fwrite($file, implode('', $lines));
        fclose($file);
        $end=count(file($files));
        $diff=$start-$end;

        echo "<br><br> No of ids in the file Before: <B>$start</B>  After: <B>$end</B> Difference is <b>$diff</b><br>";
		if($diff==0){echo "<blink> <b> Change the Mode of the File or Data file is finished </b></blink>"; }
}

?>
