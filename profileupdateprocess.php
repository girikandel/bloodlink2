<?php
session_start();
include 'connection.php';
if (isset($_REQUEST['updateProfile'])) {
    $name = $_REQUEST['name'];
    $province = $_REQUEST['province'];
    $district = $_REQUEST['district'];
    $municipality = $_REQUEST['municipality'];
    $ward = $_REQUEST['ward'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $blood = $_REQUEST['blood'];
    $phone = $_REQUEST['phone'];
    $lastdonation = $_REQUEST['lastdonation'];
    $profile = $_FILES['profile'];
    $role = $_REQUEST['role'];
    $status = $_REQUEST['status'];

    $profileName = time() . $profile['name'];

    $path = "uploads/profiles/" . $profileName;

    //for storing profile name in database to delete later
    $data = mysqli_query($conn, "SELECT `profile` FROM `users` WHERE `id` = '" . $_SESSION['userId'] . "'");
    $row = mysqli_fetch_array($data);
    $dbprofileName = $row['profile'];



    // Move succeed.
    if (file_exists($profile['tmp_name'])) {

        if (move_uploaded_file($profile['tmp_name'], $path)) {
            $sql = "UPDATE `users` SET `name`='$name',`province`='$province',`district`='$district',`municipality`='$municipality',`ward`='$ward',`dob`='$dob',`gender`='$gender',`email`='$email',`blood`='$blood',`phone`='$phone',`lastdonation`='$lastdonation',`profile`='$profileName',`status`='$status',`role`='$role' WHERE `id`= '" . $_SESSION['userId'] . "'";
            unlink("uploads/profiles/" . $dbprofileName);
        }
    } else {
        $sql = "UPDATE `users` SET `name`='$name',`province`='$province',`district`='$district',`municipality`='$municipality',`ward`='$ward',`dob`='$dob',`gender`='$gender',`email`='$email',`blood`='$blood',`phone`='$phone',`lastdonation`='$lastdonation',`status`='$status',`role`='$role' WHERE `id`= '" . $_SESSION['userId'] . "'";
    }

    if (mysqli_query($conn, $sql)) {
        header("location:index.php?profileupdatesuccess");
    } else {
        header("location:index.php?profileupdatefailed");
    }



}
?>