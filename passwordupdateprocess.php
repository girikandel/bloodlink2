<?php
session_start();
include 'connection.php';
if (isset($_REQUEST['changePassword'])) {
    $oldPassword = $_REQUEST['oldPassword'];
    $newPassword = $_REQUEST['newPassword'];
    $confirmPassword = $_REQUEST['confirmPassword'];
    $updatePassword = password_hash($newPassword, PASSWORD_DEFAULT);

    if ($newPassword == $confirmPassword) {
        $sql = "UPDATE `users` SET `password`='$updatePassword' WHERE `id`= '" . $_SESSION['userId'] . "'";
        if (mysqli_query($conn, $sql)) {
            echo "Password Updated Successfully";
            header("location:index.php?passwordChanged");
        } else {
            echo "Password not Updated";
            header("location:index.php?passwordNotChanged");
        }

    }
}
?>