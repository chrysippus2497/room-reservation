<?php
$dBServername = "localhost";
$dBUsername = "id12292815_root";
$dBPassword = "password";
$dBName = "id12292815_loginsystem";

// Create connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
