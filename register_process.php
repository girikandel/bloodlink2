<?php
session_start();
include 'connection.php';
if (isset($_REQUEST['register'])) {
    $name = $_REQUEST['name'];
    $province = $_REQUEST['province'];
    $district = $_REQUEST['district'];
    $municipality = $_REQUEST['municipality'];
    $ward = $_REQUEST['ward'];
    $dob = $_REQUEST['dob'];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $blood = $_REQUEST['bloodgroup'];
    $phone = $_REQUEST['phone'];
    $lastdonation = $_REQUEST['lastdonation'];
    $profile = $_FILES['profile'];
    $role = $_REQUEST['role'];
    $status = "active";

    $profileName = time() . $profile['name'];
    $path = "uploads/profiles/" . $profileName;

    $emailCheck = "SELECT * FROM `users` WHERE `email`='$email'";
    $emailCheckResult = mysqli_query($conn, $emailCheck);
    $emailCount = mysqli_num_rows($emailCheckResult);

    $nowDate = date_create(date("Y-m-d"));
    $age = date_diff($dob, $nowDate);
    if ($age < 18) {
        if (!empty($name) && !empty($province) && !empty($district) && !empty($municipality) && !empty($ward) && !empty($dob) && !empty($gender) && !empty($email) && !empty($password) && !empty($blood) && !empty($phone) && !empty($profile) && !empty($role) && !empty($status)) {
            if (file_exists($profile['tmp_name'])) {
                if (move_uploaded_file($profile['tmp_name'], $path)) {
                    $enc_password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO `users` (`name`, `province`, `district`, `municipality`, `ward`, `dob`, `gender`, `email`, `password`, `blood`, `phone`, `lastdonation`, `profile`, `status`, `role`) VALUES ('$name','$province','$district','$municipality','$ward','$dob','$gender','$email','$enc_password','$blood','$phone','$lastdonation','$profileName','$status','$role')";
                }
            } else {
                header("location:register.php?msg=imageNotUploaded");
            }

            if ($emailCount > 0) {
                header("location:register.php?msg=emailAlreadyExists");
            } else {
                if (mysqli_query($conn, $sql)) {
                    header("location:login.php?msg=registerSuccess");
                } else {
                    header("location:register.php?msg=registerFailed");

                }
            }
        } else {
            header("location:register.php?msg=allfieldsrequired");
        }
    } else {
        header("location:register.php?msg=ageNotValid");
    }
}
?>