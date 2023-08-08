<?php
session_start();
include 'connection.php';
if (isset($_POST['passwordReset'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT `email` FROM `users` WHERE email = '$email'";
    $check_email_run = mysqli_query($conn, $check_email);

    if (mysqli_num_rows($check_email_run) == 0) {
        header("Location: login.php?error=Emailnotfound");
    } else {
        $res = mysqli_fetch_array($check_email_run);
        $get_name = $res['name'];
        $email = $res['email'];
        $_SESSION['resetName'] = $name;
        $_SESSION['resetEmail'] = $email;
        $_SESSION['resetToken'] = $token;

        $update_token = "UPDATE `users` SET `token`='$token' WHERE `email`='$email'";
        $update_token_run = mysqli_query($conn, $update_token);

        if ($update_token_run) {
            header("Location: mail.php?mailFor=resetPassword");
        } else {
            header("Location: mail.php?msg=somethingWrong");
        }

    }
}

if (isset($_POST['resetPasswordUpdate'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $token = mysqli_real_escape_string($conn, $_POST['resetToken']);

    if (!empty($token)) {
        if (!empty($token) && !empty($newPassword) && !empty($confirmPassword) && !empty($email)) {
            //Check token is valid or not
            $check_token = "SELECT `token` FROM `users` WHERE `token`='$token' AND `email`='$email'";
            $check_token_run = mysqli_query($conn, $check_token);

            if (mysqli_num_rows($check_token_run)) {
                if ($newPassword == $confirmPassword) {
                    $enc_password = password_hash($newPassword, PASSWORD_DEFAULT);
                    $update_password = "UPDATE `users` SET `password`='$enc_password' WHERE `email`='$email'";
                    $update_password_run = mysqli_query($conn, $update_password);
                    if ($update_password_run) {
                        $update_token = "UPDATE `users` SET `token`='' WHERE `email`='$email'";
                        $update_token_run = mysqli_query($conn, $update_token);
                        header("Location: login.php?msg=passwordUpdated");
                    } else {
                        header("Location: reset_password.php?token=$token&email=$email&msg=somethingWrong");
                    }
                } else {
                    header("Location: reset_password.php?token=$token&email=$email&msg=passwordNotMatch");
                }

            } else {
                header("Location: reset_password.php?token=$token&email=$email&msg=tokenInvalid");
            }
        } else {
            header("Location: reset_password.php?token=$token&email=$email&msg=emptyFields");
        }
    } else {
        header("Location: reset_password.php?msg=tokenNotFound");
    }
}
?>