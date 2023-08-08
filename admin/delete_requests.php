<?php
session_start();

include '..\connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM `requests` WHERE `id`='$id'";

if ($conn->query($sql) === TRUE) {
    header("location:manage_requests.php");
} else {
    echo "Unable to delete user";
}