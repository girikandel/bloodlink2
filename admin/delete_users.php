<?php
session_start();

include '..\connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM `users` WHERE `id`='$id'";

if ($conn->query($sql) === TRUE) {
    header("location:manage_users.php");
} else {
    echo "Unable to delete user";
}