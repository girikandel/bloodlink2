<?php
session_start();

include 'connection.php';

if (isset($_REQUEST['submit'])) {

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $sql = "SELECT * FROM `users` where email='$email'";
    $res = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($res);
    $serverPassword = $result['password'];

    if (password_verify($password, $serverPassword)) {
        $_SESSION['isUserlogin'] = '1';
        $_SESSION['userId'] = $result['id'];
        $_SESSION['userName'] = $result['name'];
        header("location:index.php");
    } else {
        $_SESSION['isUserlogin'] = '0';
        header("location:login.php?err=invalid");
    }


}
?>