<html>
<?php include "header.html" ?>

<head>
    <title>Password Reset</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js\bootstrap.bundle.min.js"></script>
</head>

<body style="background-image: url('');">
    <!-- <div class="container h-100" style="background-image: url(image/donation.jpg); background-size: 100% 100%;"></div> -->
    <section class="vh-100">
        <div class="container-fluid h-custom bg">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 bg-color1 rounded-3">

                    <!-- Login form...... -->
                    <form class="p-lg-3" action="send_password_reset.php" method="POST">
                        <input type="hidden" id="resetToken" name="resetToken" value="<?php if (isset($_GET['token'])) {
                            echo $_GET['token'];
                        } ?>" class="form-control form-control-lg" readonly />

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0"><span class="text-red h4 font-weight-bold">Reset
                                </span><span class="text-blue h4 font-weight-bold">Password,</span></p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" value="<?php if (isset($_GET['email'])) {
                                echo $_GET['email'];
                            } ?>" class="form-control form-control-lg" readonly />

                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="New password" />

                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="confirmPassword" name="confirmPassword"
                                class="form-control form-control-lg" placeholder="Re-enter new password" />

                        </div>

                        <div class="text-center text-lg-start mt-4 row ">
                            <input type="submit" id="resetPasswordUpdate" name="resetPasswordUpdate"
                                class="btn btn-danger btn-lg text-white"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Update Password"></input>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <script>
        if (window.location.href.indexOf("somethingWrong") > -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Token not found!',
            })
        }
        if (window.location.href.indexOf("emptyFields") > -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields are required!',
            })
        }
        if (window.location.href.indexOf("tokenInvalid") > -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Token is invalid!',
            })
        }
        if (window.location.href.indexOf("passwordNotMatch") > -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'New password and confirm password does not match!',
            })
        }
        if (window.location.href.indexOf("somethingWrong") > -1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again later.',
            })
        }

    </script>
</body>

</html>