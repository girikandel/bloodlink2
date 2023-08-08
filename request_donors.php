<?php
session_start();
include 'connection.php';
$id = $_GET['id'];
$type = $_GET['ty'];
if ($type == "ind") {
    $donorId = $id;
    $requesterId = $_SESSION['userId'];
    $status = "Pending";
    $requestedDate = date("Y-m-d");
    $sql = "INSERT INTO `requests`(`requested_by`, `requested_to`,`requested_date`, `status`) VALUES ('$requesterId','$donorId','$requestedDate','$status')";

    //check already exist or not
    $checkSql = "SELECT * FROM `requests` WHERE  `requested_to`='$donorId' AND `requested_by`='$requesterId' AND `status`='Pending'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        header("location:index.php?msg=alreadyRequested");
    } else {
        if (mysqli_query($conn, $sql)) {
            header("location:mail.php?id=$id&mailFor=bloodRequest");
        } else {
            header("location:index.php?msg=reqFailed");
        }
    }

}
// if ($_REQUEST['requestBulk']) {
//     $donorId = $_REQUEST['donorId'];
//     $requesterId = $_SESSION['userId'];
//     $status = "Pending";
//     $sql = "INSERT INTO `requests`(`donorId`, `requesterId`, `status`) VALUES ('$donorId','$requesterId','$status')";
//     if (mysqli_query($conn, $sql)) {
//         header("location:donors_search_page.php?msg=success");
//     } else {
//         header("location:donors_search_page.php?msg=unsuccess");
//     }
// }
?>