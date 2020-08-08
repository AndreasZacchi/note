<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "CwW1MP1010y81007";
$dBName = "note";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}