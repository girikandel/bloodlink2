<?php
session_start();
include '..\connection.php';
if (isset($_REQUEST['updateRequest'])) {
    $id = $_GET['id'];
    $status = $_REQUEST['status'];


    $sql = "UPDATE `requests` SET `status`='$status' WHERE `id`= '" . $id . "'";


    if (mysqli_query($conn, $sql)) {
        header("location:manage_requests.php");
    } else {
        echo "Unable to update data";
    }
}
?>