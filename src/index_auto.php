<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <style type="text/css">
        .style1 {
            font-size: 12px;
            font-weight: bold;
        }
        .style2 {
            font-size: 10px; 
            font-weight: bold; 
            font-family: tahoma; 
            text-align: center;
        }
        .progress {
            display: none;
            width: 100%;
            background-color: #f3f3f3;
            border: 1px solid #ccc;
        }
        .progress-bar {
            width: 0%;
            height: 30px;
            background-color: #4CAF50;
            text-align: center;
            line-height: 30px;
            color: white;
        }
    </style>
    <script language="javascript">
        checked = false;
        function checkedAll(frm1) {
            var aa = document.getElementById('frm1');
            if (checked == false) {
                checked = true;
            } else {
                checked = false;
            }
            for (var i = 0; i < aa.elements.length; i++) {
                aa.elements[i].checked = checked;
            }
        }
    </script>
    <script language="JavaScript" type="text/JavaScript">
        function MM_reloadPage(init) {  
            if (init == true) with (navigator) {
                if ((appName == "Netscape") && (parseInt(appVersion) == 4)) {
                    document.MM_pgW = innerWidth; 
                    document.MM_pgH = innerHeight; 
                    onresize = MM_reloadPage;
                }
            } else if (innerWidth != document.MM_pgW || innerHeight != document.MM_pgH) location.reload();
        }
        MM_reloadPage(true);
    </script>
    <script src="scriptaculous.shrunk.js" type="text/javascript" charset="ISO-8859-1"></script>
    <script>
        function displayHTML(form) {
            var inf = form.message.value;
            win = window.open(", ", 'popup', 'toolbar = no, status = no');
            win.document.write("" + inf + "");
        }

        var intervalId;
        var totalSent = 0;
        var totalEmails = 0;

        function startAuto() {
            totalEmails = document.getElementById('tcount').value;
            document.getElementById('progress-bar').style.width = '0%';
            document.getElementById('progress-bar').innerText = '0%';
            document.getElementById('progress').style.display = 'block';
            var speed = document.getElementById('speed').value * 1000;
            intervalId = setInterval(function() {
                var form = document.getElementById('frm1');
                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_auto.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        console.log('Email sent successfully');
                        totalSent++;
                        var progress = Math.round((totalSent / totalEmails) * 100);
                        document.getElementById('progress-bar').style.width = progress + '%';
                        document.getElementById('progress-bar').innerText = progress + '%';
                        document.getElementById('mailing1').innerHTML = xhr.responseText + "<br>";
                        if (totalSent >= totalEmails) {
                            stopAuto();
                        }
                    } else {
                        console.log('An error occurred');
                    }
                };
                xhr.send(formData);
            }, speed);
        }

        function stopAuto() {
            clearInterval(intervalId);
            document.getElementById('progress').style.display = 'none';
        }
    </script>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" href="style.css" type="text/css" media="all">
    <style>
        input[type="radio"].rad {
            padding: 0;
            vertical-align: middle;
        }
    </style>
    <title>SparkPost</title>
</head>

<body id="root" style="margin: 0px; padding: 0px;">
    <fieldset style="border: 1px solid #000000; border: 2px dotted #000000; left: 5px;">
    <legend></legend>
    <form name="form1" id="frm1">
        <table width="90%" align="center" style="height: 100%;" cellpadding="10" cellspacing="0" border="2">
            <tr>
                <td style="background-color:#000033; color:#fff"><h2>Mandrill-rosstanner0@gmail.com</h2></td>
                <td colspan="2" valign="middle" align="center" height="30" style="border:1px dotted #999">
                    --- From Email Address<br>
                    <input style="border:1px dotted #999; font-weight:500" type="text" name="ip" size="40" id="ip" />
                </td>
            </tr>
            <tr>
                <td width="30%" valign="top" style="border:1px solid #666; font-size:13.5px; padding:10px; line-height:28px; text-align:inherit;">
                    <p style="border-bottom:1px dotted #666">List Of IPs</p>
                    <textarea style="width:325px; height:300px;" name="server" cols="55" rows="15" id="dom" placeholder="put ip here"></textarea>
                </td>
                <td width="70%" valign="top">
                    <div align="center">
                        <input name="mode" type="radio" value="test"> Test
                        <input name="mode" type="radio" value="bulk"> Bulk
                    </div>
                    <div align="center" style="padding-top:10px; text-align:left">
                        <table align="center" cellpadding="0" border="0" cellspacing="0" style="font-size:12px;">
                            <tbody>
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>Subject</strong></td>
                                    <td align="left" style="padding-bottom:10px;"><input type="text" name="sub" id="sub2" size="60"></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>From</strong></td>
                                    <td align="left" style="padding-bottom:10px;"><input type="text" name="from" id="from2" size="60"></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>Test Email</strong></td>
                                    <td align="left" style="padding-bottom:10px;"><textarea name="emails" style="width:374px; height:100px;" id="emails"></textarea></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>Custom Headers</strong></td>
                                    <td align="left" style="padding-bottom:10px;"><textarea name="custom_headers" style="width:374px; height:50px;" id="custom_headers" placeholder="key:value, one per line"></textarea></td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>Message ID</strong></td>
                                    <td align="left" style="padding-bottom:10px;"><input type="text" name="message_id" id="message_id" size="60"></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Content -->
                        <table align="center" style="font-size:12px;" cellpadding="0" border="0" cellspacing="0" width="50%">
                            <tbody align="center"> 
                                <tr>
                                    <td align="left" style="padding-right:20px;"><strong>Body</strong></td>
                                    <td>
                                        <p>Type: 
                                            <input name="type" type="radio" value="plain" onClick="document.getElementById('mime').style.display = 'none'" class="rad"> 
                                            Plain
                                            <input name="type" type="radio" value="html" onClick="document.getElementById('mime').style.display = 'none'" class="rad"> 
                                            Html
                                            <input name="type" type="radio" value="mime" onClick="document.getElementById('mime').style.display = 'none'" class="rad"> 
                                            Mime
                                            <input type="button" value=" Preview " onClick="displayHTML(this.form)">
                                        </p>
                                        <table cellpadding="5" cellspacing="0" border="0" style="padding:0px;">
                                            <tr>
                                                <td><textarea style="width:375px; margin-left:54px; height:300px;" name="message" cols="55" rows="25">put html here</textarea></td>
                                            </tr>
                                            <tr>
                                                <td><textarea style="width:375px; margin-left:54px; height:50px;" name="textm" cols="55" rows="25">put text here</textarea></td>
                                            </tr>
                                        </table>
                                        <table style="font-size:12px;" width="450" border="0">
                                            <tr>
                                                <td width="101" id="mlimit"><div align="right"><strong>Limit</strong></div></td>
                                                <td width="193"><input name="limit" type="text"></td>
                                                <td width="69" id="msleep"><div align="right"><strong>Api Key</strong></div></td>
                                                <td width="144"><input type="text" name="offer" id="offer4"></td>
                                            </tr>
                                            <tr>
                                                <td id="mdata"><div align="right"><strong>DataFile</strong></div></td>
                                                <td><input type="text" name="data" id="data3"></td>
                                                <td id="sleepid"><div align="right"><strong>Domain</strong></div></td>
                                                <td><input type="text" name="domain" id="sleep4"></td>
                                            </tr>
                                            <tr>
                                                <td id="mdata"><div align="right"><strong>Select Region</strong></div></td>
                                                <td>
                                                    <select name='head' id='head'>
                                                        <option value='1'>US (North America)</option>
                                                        <option value='2'>EU (Europe)</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="ot" value="1" checked="checked"><strong>Open Tracking ON</strong></td>
                                                <td><input type="radio" name="ot" value="0"><strong>Open Tracking OFF</strong></td>
                                            </tr>
                                            <tr>
                                                <td><input type="radio" name="ct" value="1"><strong>Click Tracking ON</strong></td>
                                                <td><input type="radio" name="ct" value="0" checked="checked"><strong>Click Tracking OFF</strong></td>
                                            </tr>
                                            <tr>
                                                <td><label for="speed">Speed (seconds)</label></td>
                                                <td><input type="text" name="speed" id="speed" /></td>
                                            </tr>

                                            <tr>
                                                <td><label for="speed">Total Send</label></td>
                                                <td><input type="text" name="tcount" id="tcount" /></td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td style="padding-top:10px; padding-bottom:10px;">
                                                    <div align="center" style="width:148px; height:18px; z-index:1; background-color: #0479C0; layer-background-color: #0479C0; border: 1px none #000000; display:none;" id='loadingreport123'>
                                                        <div align="center" class="style2"><font color="#FFFFFF"><strong><font size="2">Sending .. </font></strong></font></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding="0" cellspacing="0" width="500" align="center" border="1">
                                            <tr>
                                                <td width="150" align="center">-- HEADERS --</td>
                                                <td width="0" align="center"><input type="button" name="button" value="Send" onClick="new Ajax.Updater('mailing1', 'send_auto.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="0" align="center"><input type="button" name="button" value="Dedicated ip" onClick="new Ajax.Updater('mailing1', 'mail2.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="0" align="center"><input type="button" name="button" value="Stats" onClick="new Ajax.Updater('mailing2', 'limitfetch2.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="0" align="center"><input type="button" name="button" value="Send Ip" onClick="new Ajax.Updater('mailing1', 'global_send.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td width="0" align="center"><input type="button" name="button" value="FetchDomain" onClick="new Ajax.Updater('mailing2', 'domainfetch.php', {asynchronous:true, evalScripts:true, method:'post', onComplete:function(request){new Effect.Appear('mailing1');new Effect.Fade('loadingreport123');}, onLoading:function(request){new Element.show('loadingreport123')}, parameters:Form.serialize(this.form)})">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <div id='mailing2'></div>
                </td>
                <td align="center" style="border:1px dotted #666666; font-size:9px; padding:5px;">
                    <div id='mailing1'></div>
                </td>
            </tr>
        </table>
        <a href="http://38.242.152.77/spark_auto_V2/headers.php"><h3>Variables</h3></a>
        <div align="center">
            <input type="button" value="Start Auto" onclick="startAuto()" />
            <input type="button" value="Stop Auto" onclick="stopAuto()" />
        </div>
        <div id="progress" class="progress">
            <div id="progress-bar" class="progress-bar"></div>
        </div>
    </form>
    </fieldset>
</body>
</html>

