<?php
session_start();

include '..\connection.php';

if (isset($_REQUEST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE `email`='$email' AND `password` ='$password'";
    $res = mysqli_query($conn, $sql);

    $result = mysqli_fetch_array($res);

    if ($result) {
        $_SESSION["isAdminValid"] = 1;
        $_SESSION["adminId"] = $result["id"];
        header("location:index.php");
    } else {
        header("location:login.php?err=invalid");
    }
}
// if ($result) {
// // if (isset($_REQUEST["remember"]) && $_REQUEST["remember"] == 1) {
// // setcookie("login", "1", time() + 60); // second on page time
// header("location:31_index.php");
// // }
// }


// } else {
// header("location:29_login.php?err=invalid");
// }
