<?php

$servername = "sql7.freemysqlhosting.net";
$dBUsername = "sql7357893";
$dBPassword = "BMPNVIqcBP";
$dBName = "sql7357893";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}