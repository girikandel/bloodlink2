<?php
session_start();
include '..\connection.php';
if (isset($_REQUEST['changePassword'])) {
    $oldPassword = $_REQUEST['oldPassword'];
    $newPassword = $_REQUEST['newPassword'];
    $confirmPassword = $_REQUEST['confirmPassword'];

    if ($newPassword == $confirmPassword) {
        $sql = "UPDATE `admin` SET `password`='$newPassword' WHERE `id`= '" . $_SESSION['adminId'] . "'";
        if (mysqli_query($conn, $sql)) {
            header("location:index.php?passwordUpdated");
        } else {
            header("location:index.php");
        }

    } else {
        header("location:index.php?passwordNotMatch");
    }
}
?>