<?php


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>Placeholder Instructions</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.6;
            color: #555;
        }
        .placeholder {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Placeholder Instructions</h1>
        <p>Use the following placeholders in any of the input fields (e.g., Subject, From, Message Body, Custom Headers, etc.) to generate specific types of data:</p>
        
        <h2>Alphanumeric</h2>
        <p class="placeholder">[an_20]</p>
        <p>Generates a 20-character alphanumeric string.</p>
        
        <h2>Numbers</h2>
        <p class="placeholder">[[num(10)]]</p>
        <p>Generates a 10-digit number.</p>
        
        <h2>Small Characters</h2>
        <p class="placeholder">[[smallchar(10)]]</p>
        <p>Generates a 10-character string of lowercase letters.</p>
        
        <h2>Big Characters</h2>
        <p class="placeholder">[[bigchar(10)]]</p>
        <p>Generates a 10-character string of uppercase letters.</p>
        
        <h2>Mixed Small and Big Characters</h2>
        <p class="placeholder">[[mixsmallbigchar(10)]]</p>
        <p>Generates a 10-character string of mixed lowercase and uppercase letters.</p>
        
        <h2>Mixed Small Alphanumeric</h2>
        <p class="placeholder">[[mixsmallalphanum(10)]]</p>
        <p>Generates a 10-character string of mixed numbers and lowercase letters.</p>
        
        <h2>Mixed Big Alphanumeric</h2>
        <p class="placeholder">[[mixbigalphanum(10)]]</p>
        <p>Generates a 10-character string of mixed numbers and uppercase letters.</p>
        
        <h2>Mixed All</h2>
        <p class="placeholder">[[mixall(10)]]</p>
        <p>Generates a 10-character string of mixed numbers, lowercase, and uppercase letters.</p>
        
        <h2>Hex Digit</h2>
        <p class="placeholder">[[hexdigit(10)]]</p>
        <p>Generates a 10-character string of hexadecimal digits.</p>
        
        <h2>ASCII to Hex</h2>
        <p class="placeholder">[[ascii2hex(Your Text)]]</p>
        <p>Converts "Your Text" to its hexadecimal representation.</p>
        
        <h2>RFC Date Formats</h2>
        <p class="placeholder">[[RFC_Date_EST()]]</p>
        <p>Generates the current EST date in RFC format.</p>
        <p class="placeholder">[[RFC_Date_UTC()]]</p>
        <p>Generates the current UTC date in RFC format.</p>
        <p class="placeholder">[[RFC_Date_EDT()]]</p>
        <p>Generates the current EDT date in RFC format.</p>
        <p class="placeholder">[[RFC_Date_IST()]]</p>
        <p>Generates the current IST date in RFC format.</p>
    </div>
</body>
</html>

