<?php


$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "quak";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo("please report this bug to the developer");
}
?>