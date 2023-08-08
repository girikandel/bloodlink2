<html>

<head>
    <title>Login</title>
    <?php
    session_start();
    if (isset($_SESSION["isUserlogin"]))
        if ($_SESSION["isUserlogin"] == '1') {
            header("location:index.php");
        }
    include 'header.html';
    ?>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom bg">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 bg-color1 rounded-3">

                    <!-- Login form...... -->
                    <form class="p-lg-3" name="loginform" action="auth.php" onsubmit="" method="POST">
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0"><span class="text-red h4 font-weight-bold">Welcome
                                </span><span class="text-blue h4 font-weight-bold">Back,</span></p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" required />

                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" required />

                        </div>

                        <!-- Forget Password-->
                        <a type="button" class="text text-danger" data-toggle="modal" data-target="#forgetPassword">
                            Forget Password?
                        </a>
                        <br>

                        <div class="text-center text-lg-start mt-4 row ">
                            <input type="submit" id="submit" name="submit" class="btn btn-danger btn-lg text-white"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Login"></input>

                        </div>
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="register.php"
                                class="link-danger">Register</a></p>
                    </form>
                </div>
            </div>
        </div>

    </section>


    <!-- Modal -->
    <form name="" action="send_password_reset.php" onsubmit="" method="POST">
        <div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="forgetPasswordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgetPasswordLabel">Forget Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <p>Please enter your valid email address. Password reset link will be sent to your email
                                address.</p>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-lg"
                                placeholder="Enter a valid email address" required />

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" id="passwordReset" name="passwordReset" class="btn btn-primary"
                            value="Send Link">
                        </input>
                    </div>
                </div>
            </div>
        </div>
    </form>




    <!-- Show wrong email and password alert -->
    <script>
        $(document).ready(function () {
            if (window.location.href.indexOf("invalid") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You have entered wrong email or password!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("Emailnotfound") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'This email is not registered!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("resetSent") > -1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Password reset link has been sent to your email!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("somethingWrong") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again later!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("passwordUpdated") > -1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Hurray..',
                    text: 'Password has been updated successfully! Please login with your new password!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("registerSuccess") > -1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Hurray..',
                    text: 'You have registered successfully! Please login with your credentials!',
                }).then(function () {
                    window.location = "login.php";
                })
            }
            if (window.location.href.indexOf("registerFailed") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops..',
                    text: 'Registration failed! Please try again later!',
                }).then(function () {
                    window.location = "register.php";
                })
            }
        });

    </script>

</body>

</html>