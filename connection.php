<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bloodlink";

$conn = mySqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Couldnot connect" . mysqli_connect_error());
}
?>