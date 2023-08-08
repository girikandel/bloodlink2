<?php
session_start();
include 'connection.php';
if (isset($_REQUEST['contactsubmit'])) {
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $message = $_REQUEST['message'];
    $status = "Pending";

    // echo $name . "<br>";
    // echo $phone . "<br>";
    // echo $email . "<br>";
    // echo $message . "<br>";


    $sql = "INSERT INTO `inquiries` (`name`, `email`, `phone`, `message`,`status`) VALUES ('$name','$email','$phone','$message','$status')";



    if (mysqli_query($conn, $sql)) {
        header("location:contact.php?msg=success");
    } else {
        header("location:contact.php?msg=unsuccess");
    }
}
?>