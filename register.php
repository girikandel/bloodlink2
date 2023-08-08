<html>
<?php include "header.html" ?>

<head>
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css\style.css">
    <script src="js\bootstrap.bundle.min.js"></script>
</head>

<body>

    <section class="vh-100">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <form name="registerform" method="POST" action='register_process.php' onsubmit="return formValidation()"
                    enctype="multipart/form-data">

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0"><span class="text-red h4 font-weight-bold">Register
                            </span><span class="text-blue h4 font-weight-bold">Here,</span></p>
                    </div>

                    <!-- Name, email and password input -->
                    <div class="row">
                        <div class="col-4">
                            <label>Full Name<span class="text-red" style="color:#e93030;">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" />
                            <span id="name_err" style="color:red"></span>
                        </div>
                        <div class="col-4">
                            <label>Email<span class="text-red">*</span></label>
                            <input type="email" class="form-control form-control-lg" name="email" id="email" />
                        </div>
                        <div class="col-4">
                            <label>Password<span class="text-red">*</span></label>
                            <input type="password" class="form-control form-control-lg" name="password" id="password" />
                        </div>

                    </div>
                    <br>

                    <!-- Province,District,Municipality -->
                    <div class="row">
                        <div class="col-4">
                            <label>Province<span class="text-red">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="province" id="province" />
                        </div>
                        <div class="col-4">
                            <label>District<span class="text-red">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="district" id="district" />
                        </div>
                        <div class="col-4">
                            <label>Municipality/Rural Municipality<span class="text-red">*</span></label>
                            <input type="text" class="form-control form-control-lg" name="municipality"
                                id="municipality" />
                        </div>
                    </div>
                    <br>

                    <!-- Ward,Phone number,date of Birth -->
                    <div class="row">
                        <div class="col-4">
                            <label>Ward<span class="text-red">*</span></label>
                            <input type="number" class="form-control form-control-lg" name="ward" id="ward" />
                        </div>
                        <div class="col-4">
                            <label>Phone Number<span class="text-red">*</span></label>
                            <input type="number" class="form-control form-control-lg" name="phone" id="phone" />
                        </div>
                        <div class="col-4">
                            <label>Date of Birth<span class="text-red">*</span></label>
                            <input type="date" class="form-control form-control-lg" name="dob" id="dob" />
                        </div>
                    </div>
                    <br>

                    <!-- Gender,Blood Group,Last Donation,profile -->
                    <div class="row">
                        <div class="col-4">
                            <label>Gender<span class="text-red">*</span></label>
                            <select id="gender" name="gender" class="form-select form-control-lg">
                                <option selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Blood Group<span class="text-red">*</span></label>
                            <select id="bloodgroup" name="bloodgroup" class="form-select form-control-lg">
                                <option selected>Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Last Donation</label>
                            <input type="date" class="form-control form-control-lg" name="lastdonation"
                                id="lastdonation" />
                        </div>
                    </div>
                    <br>

                    <!-- Profile, ROle -->
                    <div class="row">
                        <div class="col-4">
                            <label>Profile<span class="text-red">*</span></label>
                            <input type="file" id="profile" name="profile" class="form-control form-control-lg" />
                        </div>
                        <div class="col-4">
                            <label>Role<span class="text-red">*</span></label>
                            <select id="role" name="role" class="form-select form-control-lg">
                                <option selected>Select Role</option>
                                <option value="Donor">Donor</option>
                                <option value="Receiver">Receiver</option>
                                <option value="Both">Both</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <input type="submit" id="register" name="register" class="btn btn-danger btn-lg" value="Submit">
                        <!-- <button type="submit" id="register" name="register" class="btn btn-danger btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button> -->
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="login.php"
                                class="link-danger">Login</a></p>
                    </div><br><br><br>

                </form>
            </div>
        </div>

    </section>

    <script>
        $(document).ready(function () {
            if (window.location.href.indexOf("imageNotUploaded") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please upload your profile picture!',
                }).then(function () {
                    window.location = "register.php";
                })
            }
            if (window.location.href.indexOf("allfieldsrequired") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'All fields are required!',
                }).then(function () {
                    window.location = "register.php";
                })
            }
            if (window.location.href.indexOf("emailAlreadyExists") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Email already exist.',
                }).then(function () {
                    window.location = "register.php";
                })
            }
            if (window.location.href.indexOf("ageNotValid") > -1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You must be 18 years old to be registered!',
                }).then(function () {
                    window.location = "register.php";
                })
            }
        })

        function formValidation() {
            var flag = true;
            $('#name_err').html('');
            let name = document.forms["registerform"]["name"].value;
            let email = document.forms["registerform"]["email"].value;
            let password = document.forms["registerform"]["password"].value;
            let province = document.forms["registerform"]["province"].value;
            let district = document.forms["registerform"]["district"].value;
            let Municipality = document.forms["registerform"]["municipality"].value;
            let ward = document.forms["registerform"]["ward"].value;
            let phone = document.forms["registerform"]["phone"].value;
            let dob = document.forms["registerform"]["dob"].value;
            let gender = document.forms["registerform"]["gender"].value;
            let blood = document.forms["registerform"]["bloodgroup"].value;
            let lastdonation = document.forms["registerform"]["lastdonation"].value;
            let profile = document.forms["registerform"]["profile"].value;
            let role = document.forms["registerform"]["role"].value;

            if (name == "") {
                // document.getElementById("name_err").innerHTML = "Name is required";
                $('#name_err').html('Name is required');
                flag = false;
            }


            return flag;
        }

    </script>

</body>

</html>