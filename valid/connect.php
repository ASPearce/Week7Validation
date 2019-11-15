<?php
$servername = "localhost";
$username = "student";
$password = "website";
$dbasename = "testDB";

$mysqli = new mysqli($servername, $username, $password, $dbasename);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
