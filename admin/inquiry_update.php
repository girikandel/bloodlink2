<?php
session_start();
include '..\connection.php';
if (isset($_REQUEST['updateInquiry'])) {
    $id = $_GET['id'];
    $status = $_REQUEST['status'];

    $sql = "UPDATE `inquiries` SET `status`='$status' WHERE `id`= '" . $id . "'";


    if (mysqli_query($conn, $sql)) {
        header("location:manage_inquiries.php");
    } else {
        echo "Unable to update data";
    }
}
?>