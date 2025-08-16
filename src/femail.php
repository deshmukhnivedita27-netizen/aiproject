<?php
include "include.php";


$a=mysql_query("select femail from from_email");
while($row=mysql_fetch_array($a))
{
$femail= $row[0];
echo "$femail<br>";
}