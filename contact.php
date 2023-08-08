<!DOCTYPE html>
<html>
<?php
session_start();
include 'connection.php';
?>

<head>
    <title>BloodLink</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <script src="js\bootstrap.bundle.min.js"></script>

</head>



<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <img src="image/bloodlink.svg" class="img-thumbnail border-0" alt="...">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger " href="donors.php">Donor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-danger px-3 text-white rounded" href="contact.php">Contact</a>
                    </li>
                    <?php
                    if (isset($_SESSION['isUserlogin']) && $_SESSION['isUserlogin'] == '1') {
                        $sql = "SELECT * FROM `users` WHERE id=" . $_SESSION['userId'];
                        $res = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($res);
                    }
                    if (isset($_SESSION['isUserlogin']) && $_SESSION['isUserlogin'] == '1') {
                        ?>
                        <div class="nav-item dropdown no-arrow">
                            <button class="nav-link dropdown-toggle text-black" type="button" id="dropDownUser"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/profiles/<?php echo $result['profile'] ?>"
                                    class="rounded-circle small round" alt="" height="40" width="40">
                                <span class="ml-2 d-none d-lg-inline text-black">
                                    <?php echo $result['name'] ?>
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="dropDownUser">
                                <a class="dropdown-item" data-toggle="modal" data-target="#userProfileModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="manage_requests.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Manage Requests
                                </a>
                                <div class="dropdown-divider" data-toggle="modal">
                                </div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#userPasswordChangeModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#userLogoutModel">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </ul>
                        </div>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item  rounded" style="padding-left: 5px;">
                            <a class="nav-link text-white login-button rounded" href="login.php">Login/Register</a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="container">
            <div class="row align-items-stretch no-gutters contact-wrap">
                <div class="col-md-8">
                    <div class="form h-100">
                        <h3><strong>Send us a message</strong></h3>

                        <form class="mb-5" id="contactForm" action="contactsubmit.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 form-group mb-5">
                                    <label for="name" class="col-form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Your name" required />
                                </div>
                                <div class="col-md-6 form-group mb-5">
                                    <label for="email" class="col-form-label">Email *</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        placeholder="Your email" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-5">
                                    <label for="phone" class="col-form-label">Phone *</label>
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="Phone #" required />
                                </div>
                                <!-- <div class="col-md-6 form-group mb-5">
                                    <label for="company" class="col-form-label">Company</label>
                                    <input type="text" class="form-control" id="company" placeholder="Company name">
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group mb-5">
                                    <label for="message" class="col-form-label">Message *</label>
                                    <textarea class="form-control" name="message" id="message" cols="30" rows="4"
                                        placeholder="Write your message" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <input type="submit" name="contactsubmit" value="Send Message"
                                        class="btn btn-primary rounded-0 py-2 px-4">
                                    <!-- showing submittion message -->
                                    <?php
                                    if (isset($_REQUEST['msg'])) {
                                        $err = $_GET['msg'];
                                        if ($err == "success") {
                                            $msg = "Message sent successfully";
                                        } else if ($err == "unsuccess") {
                                            $msg = "Message not sent";
                                        } else {
                                            $msg = "An unknown error occured. Please try again.";
                                        }
                                    }
                                    ?>

                                    <p style="color:red;">
                                        <?php
                                        if (isset($msg)) {
                                            echo $msg;
                                        }
                                        ?> <br>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info h-100">
                        <h3>Contact Information</h3>
                        <p class="mb-5"> You can reach us via our Address & Phone no </p>
                        <ul class="list-unstyled">
                            <li class="d-flex">
                                <span class="wrap-icon icon-room mr-3"></span>
                                <span class="text">Bharatpur-8, Chitwan , Nepal </span>
                            </li>
                            <li class="d-flex">
                                <span class="wrap-icon icon-phone mr-3"></span>
                                <span class="text">+977 9812345678</span>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <br><br>

    <!-- Modal Logout -->
    <div class="modal fade" id="userLogoutModel" tabindex="-1" role="dialog" aria-labelledby="userLogoutModelLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger " data-dismiss="modal">Cancel</button>
                    <a href="logoutprocess.php" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Profile Edit and view -->
    <form action="profileupdateprocess.php" method="post" enctype="multipart/form-data">
        <div class=" modal fade" id="userProfileModal" tabindex="-1" role="dialog"
            aria-labelledby="userProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userProfileModalLabel">Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $sql = "SELECT * FROM `users` WHERE id=" . $_SESSION['userId'];
                        $res = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($res);
                        $role = $result['role'];
                        $gender = $result['gender'];
                        $status = $result['status'];
                        $bg = $result['blood'];
                        $profile = $result['profile'];
                        ?>
                        <div class="container-fluid">
                            <!-- User Details -->
                            <div class="conatiner">
                                <center><img src="uploads/profiles/<?php echo $profile ?>"
                                        class="rounded-circle small round" alt="" height="80" width="80"></center>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        aria-describedby="nameHelp" value="<?php echo $result['name'] ?>" required />
                                </div>
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="emailHelp" value="<?php echo $result['email'] ?>" required />
                                </div>
                                <div class="col">
                                    <label>Phone</label>
                                    <input type="phone" class="form-control" name="phone" id="phone"
                                        aria-describedby="phoneHelp" value="<?php echo $result['phone'] ?>" required />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Profile</label>
                                    <input type="file" class="form-control" name="profile" id="profile"
                                        aria-describedby="profileHelp" />
                                </div>
                                <div class="col">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="dob" id="dob"
                                        aria-describedby="dobHelp" value="<?php echo $result['dob'] ?>"
                                        placeholder="2002-02-01" required />
                                </div>
                                <div class="col">
                                    <label>Last Donation</label>
                                    <input type="date" class="form-control" name="lastdonation" id="lastdonation"
                                        aria-describedby="lastDonationHelp"
                                        value="<?php echo $result['lastdonation'] ?>" required />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Role</label>
                                    <select name="role" id="role" class="form-select" required>
                                        <option value="">---------</option>
                                        <option value="User <?php if ($role == "User")
                                            echo 'selected="selected"' ?>">User
                                            </option>
                                            <option value="Donor" <?php if ($role == "Donor")
                                            echo 'selected="selected"' ?>>Donor
                                            </option>
                                            <option value="Both" <?php if ($role == "Both")
                                            echo 'selected="selected"' ?>>Both
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="">---------</option>
                                            <option value="Male" <?php if ($gender == "Male")
                                            echo 'selected="selected"' ?>>Male
                                            </option>
                                            <option value="Female" <?php if ($gender == "Female")
                                            echo 'selected="selected"' ?>>
                                                Female</option>
                                            <option value="Other" <?php if ($gender == "Other")
                                            echo 'selected="selected"' ?>>Other
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label>Status</label><br>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="">---------</option>
                                            <option value="Active" <?php if ($status == "Active")
                                            echo 'selected="selected"' ?>>
                                                Active
                                            </option>
                                            <option value="Inactive" <?php if ($status == "Inactive")
                                            echo 'selected="selected"' ?>>Inactive
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-4">
                                        <label>Blood Group</label>
                                        <select name="blood" id="blood" class="form-select" required>
                                            <option value="">---------</option>
                                            <option value="A+" <?php if ($bg == "A+")
                                            echo 'selected="selected"' ?>>A+</option>
                                            <option value="B+" <?php if ($bg == "B+")
                                            echo 'selected="selected"' ?>>B+</option>
                                            <option value="AB+" <?php if ($bg == "AB+")
                                            echo 'selected="selected"' ?>>AB+</option>
                                            <option value="O+" <?php if ($bg == "O+")
                                            echo 'selected="selected"' ?>>O+</option>
                                            <option value="A-" <?php if ($bg == "A-")
                                            echo 'selected="selected"' ?>>A-</option>
                                            <option value="B-" <?php if ($bg == "B-")
                                            echo 'selected="selected"' ?>>B-</option>
                                            <option value="AB-" <?php if ($bg == "AB-")
                                            echo 'selected="selected"' ?>>AB-</option>
                                            <option value="O-" <?php if ($bg == "O-")
                                            echo 'selected="selected"' ?>>O-</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Address Details -->
                                <br><br>
                                <div class="row">
                                    <div class="col">
                                        <label>Province</label>
                                        <input type="text" class="form-control" name="province" id="province"
                                            aria-describedby="provinceHelp" value="<?php echo $result['province'] ?>"
                                        placeholder="Bagmati" required />
                                </div>
                                <div class="col">
                                    <label>District</label>
                                    <input type="text" class="form-control" name="district" id="district"
                                        aria-describedby="districtHelp" value="<?php echo $result['district'] ?>"
                                        placeholder="Chitwan" required />
                                </div>
                                <div class="col">
                                    <label>Municipality</label>
                                    <input type="text" class="form-control" name="municipality" id="municipality"
                                        aria-describedby="emailHelp" value="<?php echo $result['municipality'] ?>"
                                        placeholder="Bharatpur" required />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <label>Ward No.</label>
                                    <input type="number" class="form-control" name="ward" id="ward"
                                        aria-describedby="nameHelp" value="<?php echo $result['ward'] ?>"
                                        placeholder="01" required />
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="updateProfile" id="updateProfile" class="btn btn-primary"
                            value="Update">
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!-- Modal change password -->
    <form action="passwordupdateprocess.php" method="post">
        <div class="modal fade" id="userPasswordChangeModal" tabindex="-1" role="dialog"
            aria-labelledby="userPasswordChangeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelLogout">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                                aria-describedby="oldPasswordHelp" placeholder="Enter old Password" required />
                        </div>
                        <br>
                        <div class="col">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="newPassword" id="newPassword"
                                aria-describedby="newPasswordHelp" placeholder="Enter new password" required />
                        </div>
                        <br>
                        <div class="col">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                                aria-describedby="confirmPasswordHelp" placeholder="Re-enter you new Password"
                                required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        <input type="submit" name="changePassword" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <footer class="bg-danger text-white py-3">
        <div class="container  text-center">
            <p>&copy; 2023 BloodLink. All Rights Reserved | Designed by Girija Kandel</p>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>