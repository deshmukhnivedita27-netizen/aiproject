<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<style type="text/css">
.style1 {
	font-size: 12px;
	font-weight: bold;
}
.style2 {font-size: 10px; font-weight: bold; font-family: tahoma; text-align:center;}
</style>
<script language=javascript>
checked=false;
function checkedAll (frm1) {
	var aa= document.getElementById('frm1');
	 if (checked == false)
          {
           checked = true
          }
        else
          {
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
	 aa.elements[i].checked = checked;
	}
      }
</script>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
<script src="scriptaculous.shrunk.js" type="text/javascript" charset="ISO-8859-1">
</script>
<script>
function displayHTML(form) {
  var inf = form.message.value;
  win = window.open(", ", 'popup', 'toolbar = no, status = no');
  win.document.write("" + inf + "");
}
</script>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" href="style.css" type="text/css" media="all">
<style>
input[type="radio"].rad{padding:0;vertical-align:middle;}
</style>
<title>SparkPost</title>
</head>

<body id="root" style="margin: 0px; padding: 0px; font-family: 'Trebuchet MS',verdana;">


<fieldset style="border: 1px solid #000000; border: 2px dotted #000000; left:5px">
<legend></legend>
	<form name="form1" id ="frm1">


	<table width="90%" align="center" style="height: 100%;" cellpadding="10" cellspacing="0" border="2">




<!-- ============ NAV ============== -->
	<tr>
	<td style="background-color:#000033; color:#fff"><h2>Mandrill-rosstanner0@gmail.com</h2></td>
		<td colspan="2" valign="middle" align="center" height="30" style="border:1px dotted #999">
--- From Email Address<br>

		<input style="border:1px dotted #999; font-weight:500" type="text" name="ip" size="40" id="ip" />

		</td>
	</tr>

	<tr>
<!-- ============ LEFT COLUMN (MENU) ============== -->
	<td width="30%" valign="top" style=" border:1px solid #666; font-size:13.5px; padding:10px; line-height:28px; text-align:inherit;">

	<p style="border-bottom:1px dotted #666">--- Redirection Selection</p>

    &nbsp;H1: <input type="radio" name="head" value="h1">http://{domain}/get.php?{url}<br>
   <!-- &nbsp;H2: <input type="radio" name="head" value="h2">http://{domain}/xyznjnanything.do?r/{url}<br>
    &nbsp;H3: <input type="radio" name="head" value="h3">http://{domain}/stats_r/{url}<br>
    &nbsp;H4: <input type="radio" name="head" value="h4">	http://{domain}/{url}/r_link<br>
    &nbsp;H5: <input type="radio" name="head" value="h5">	http://{domain}/Anything.jsp_r/{url}<br>
    &nbsp;H6: <input type="radio" name="head" value="h6">http://{domain}/redirectionid.php?{url}-r<br>
    &nbsp;H7: <input type="radio" name="head" value="h7">http://{domain}/{url}/r<br>
    &nbsp;H8: <input type="radio" name="head" value="h8">http://{domain}/{url}/r.htm<br>
    &nbsp;H9: <input type="radio" name="head" value="h9">http://{domain}/a.aspx/{url}<br>
    H10: <input type="radio" name="head" value="h10">http://{domain}/trans_r/{url}<br>
    H11: <input type="radio" name="head" value="h11">http://{domain}/connect_a/{url}<br>
    H12: <input type="radio" name="head" value="h12">http://{domain}/{url}/pass_a<br>
    H13: <input type="radio" name="head" value="h13">http://{domain}/{url}/a<br>
    H14: <input type="radio" name="head" value="h14">http://{domain}/click-r/{url}<br> -->
    
    </td>
	
<!-- ============ MIDDLE COLUMN (CONTENT) ============== -->

	<td width="70%" valign="top" >
        <div align="center"  >
        
        <input name="mode" type="radio" value="test">
                           Test
        <input name="mode" type="radio" value="bulk"> 
                    Bulk </div>

		<div align="center" style="padding-top:10px; text-align:left">
        <table align="center" cellpadding="0" border="0" cellspacing="0" style="font-size:12px;">
        <tbody >
        
        <tr >
        
        <td align="left" style="padding-right:20px;"><strong>Subject</strong></td>
        
        
        <td align="left" style="padding-bottom:10px;"><input type="text" name="sub" id="sub2" size="60">



		</tr>


        <tr>
        <td align="left" style="padding-right:20px;"><strong>From</strong></td>
        <td align="left" style="padding-bottom:10px;"><input type="text" name="from" id="from2" size="60"></td>
        
        </tr>


        <tr>
        <td align="left" style="padding-right:20px;"><strong>Test Email</strong></td>
        <td align="left" style="padding-bottom:10px;"><textarea name="emails" cols="0" rows="0" style="width:374px; height:100px;" id="emails"></textarea></td>
        
        </tr>
		</tbody></table>

<!-- Content -->
        <table align="center" style="font-size:12px;" cellpadding="0" border="0" cellspacing="0" width="50%">
        <tbody align="center"> 
        
        <tr>
         <td align="left" style="padding-right:20px;"><strong>Body</strong></td>
        
        <td><p>Type: 
                  <input name="type" type="radio" value="plain" onClick="document.getElementById('mime').style.display = 'none'" class="rad"> 
                  Plain
                  <input name="type" type="radio" value="html" onClick="document.getElementById('mime').style.display = 'none'" class="rad"> 
                  Html
                  <input type="button" value=" Preview " onClick="displayHTML(this.form)">
                  </p>
                  <table cellpadding="5" cellspacing="0" border="0" style="padding:0px;">
                  <tr>
                  <td >
                  
                  <textarea style="width:375px; margin-left:54px; height:300px;" name="message" cols="55" rows="25">put html here</textarea> </td>
				 
                 
                  </tr>
				   <tr>
                  <td >
                  
                  <textarea style="width:375px; margin-left:54px; height:150px;" name="textm" cols="55" rows="25">put text here</textarea> </td>
				 
                 
                  </tr></table>
                  
                  
                  <table style="font-size:12px;" width="450" border="0">
					<tr>
                <td width="101" id="mlimit"><div align="right"><strong>Limit</strong>
                </div>
                <td width="193">
                  <input name="limit" type="text"></td>
                <td width="69" id="msleep"><div align="right"><strong>Api Key</strong>
                </div>
                <td width="144"><input type="text" name="offer" id="offer4"></td>
                </tr>
                <tr>
                    <td id="mdata"><div align="right"><strong>DataFile</strong>
                </div>
                <td>
                  <input type="text" name="data" id="data3"></td>
                <td id="sleepid"><div align="right"><strong>Domain</strong>
                </div>
                <td><input type="text" name="domain" id="sleep4"></td></tr>
                <center><tr><td><input type="radio" name="ot" value="1" checked="checked"><strong>Open Tracking ON</strong></td>
	<td><input type="radio" name="ot" value="0"><strong>Open Tracking OFF</strong></td></tr>
               
			   <tr><td><input type="radio" name="ct" value="1"><strong>Click Tracking ON</strong></td>
	<td><input type="radio" name="ct" value="0" checked="checked"><strong>Click Tracking OFF</strong></td></tr><center>
				
            
                </table>
<table >
<tr>
<td style="padding-top:10px; padding-bottom:10px;">
				<div  align="center" style=" width:148px; height:18px; z-index:1 ; background-color: #0479C0; layer-background-color: #0479C0; border: 1px none #000000;display:none;" id='loadingreport123'>
  <div align="center" class="style2"><font color="#FFFFFF"><strong><font size="2">Sending .. </font></strong></font></div>
</div>

</td>
</tr>
</table>
                <table cellpadding="0" cellspacing="0" width="500" align="center" border="1">
                            <tr>
                                <td width="150" align="center">-- HEADERS --</td>
                                
               
 <td width="0" align="center"><input type="button" name="button" value="Send" onClick="new Ajax.Updater('mailing1', 'mail3.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
 <td width="0" align="center"><input type="button" name="button" value="Dedicated ip" onClick="new Ajax.Updater('mailing1', 'mail2.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td width="0" align="center"><input type="button" name="button" value="Stats" onClick="new Ajax.Updater('mailing2', 'limitfetch2.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
 
                                
                            </tr>
							

							</table>


 			</td>
         </tr>
		 
		 
		 
		 
        </tbody></table>
		</div>
		<tr>
		<td align="center">
<div id='mailing2'></div>
</td>
<td align="center" style="border:1px dotted #666666; font-size:9px; padding:5px;">
<div id='mailing1'></div>
</td>
</tr>    
<!-- End Content -->
</td>

                

</tbody>
</table>



<!-- ============ FOOTER SECTION ============== -->

<table align="center">

<tr><td colspan="10" align="center" height="20" ><font size="-2"></font></td></tr>
</table>
</table>

</form></fieldset>

</body>


</html>
