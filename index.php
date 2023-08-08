<!DOCTYPE html>
<html>
<?php
session_start();
include 'connection.php';
include 'header.html';
?>

<head>
    <title>BloodLink</title>


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
                    <li class="nav-item active">
                        <a class="nav-link bg-danger px-3 text-white rounded" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger " href="donors.php">Donor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="contact.php">Contact</a>
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
                        <li class="nav-item rounded" style="padding-left: 5px;">
                            <a class="nav-link text-white login-button rounded" href="login.php">Login/Register</a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Why doate -->
    <div class="row h-100 embed-responsive">
        <div class="col-7 mt-lg-5 ml-lg-5">
            <p class="font-weight-bold h3">Why Should we donate Blood?</p>
            <p class="text-justify mt-4 font-weight-light font-weight-normal">Donating blood is a selfless act that can
                have a profound impact on the lives of others. One of the primary reasons to donate blood is to save
                lives. Blood transfusions are crucial in various medical situations, including emergencies, surgeries,
                and treatments for serious illnesses like cancer. By donating blood, you can directly contribute to
                providing life-saving support to individuals in need.</p>
            <p class="text-justify mt-4 font-weight-light font-weight-normal">
                During emergencies, such as accidents or natural disasters, the demand for blood can surge rapidly. By
                donating blood regularly or in advance, you help maintain an adequate supply to meet these urgent
                requirements. Your contribution can make a significant difference in providing timely assistance and
                critical care to those affected by such situations.</p>
            <p class="text-justify mt-4 font-weight-light font-weight-normal">
                Furthermore, by donating blood, you play a crucial role in ensuring a stable blood supply for medical
                treatments and procedures. Organ transplants, chemotherapy, and other medical interventions rely on a
                constant and reliable supply of blood and blood products. Your donation helps meet this ongoing demand
                and contributes to the overall healthcare system.</p>
            <p class="text-justify mt-4 font-weight-light font-weight-normal">
                Ultimately, donating blood is a simple yet powerful way to give back to the community and make a
                positive impact on the lives of others. Your generosity can save lives, support critical medical
                treatments, and promote the well-being of both recipients and donors alike.</p>
            <p class="btn btn-danger rounded text-white">Donate Now</p>
        </div>
        <div class="col mt-lg-5 ml-lg-5">
            <img src="image/donateblood.png" class="img-thumbnail border-0" alt="">
        </div>
    </div>

    <!-- Blood Search -->
    <div class="container blood-search">
        <div class="row col-md-4">
            <img src="image/BloodDonation.svg" alt="">
        </div>
        <div class="row col-md-6">
            <form action="donors_search_page.php" method="POST">
                <!-- Address input -->
                <div class="row">
                    <div class="form-outline mb-4 col-5">
                        <input type="text" id="province" name="province" class="form-control form-control-lg"
                            placeholder="Province" required />

                    </div>
                    <div class="form-outline mb-4 col-5">
                        <input type="text" id="district" name="district" class="form-control form-control-lg"
                            placeholder="District" />

                    </div>
                </div>
                <div class="row">
                    <div class="form-outline mb-4 col-5">
                        <input type="text" id="municipality" name="municipality" class="form-control form-control-lg"
                            placeholder="Municipality/Rural Municipality" />

                    </div>
                    <div class="form-outline mb-4 col-5">
                        <input type="text" id="ward" name="ward" class="form-control form-control-lg"
                            placeholder="Ward No." />


                    </div>
                </div>
                <div class="row">
                    <div class="form-outline mb-4 col-5">
                        <select id="bloodgroup" name="bloodgroup" class="form-select form-control form-control-lg"
                            aria-label="Default select example" required>
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
                </div>
                <br>
                <input name="searchdonors" class="btn btn-danger" type="submit" value="Search">
            </form>
        </div>
    </div>

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

    <!-- Show request success message -->
    <script>
        $(document).ready(function () {
            if (window.location.href.indexOf("reqSuccess") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Your Request has been sent. Please wait for the donor to accept your request.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("reqFailed") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Your Request has not sent. Please try again later.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("alreadyRequested") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You have already requested this donor. Please wait for the donor to accept your request or delete the previous request to send new request.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("profileupdatesuccess") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Profile Updated Successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("profileupdatefailed") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Profile Update Failed',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("passwordChanged") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Password Changed Successfully',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    window.location = "index.php";
                })
            }
            if (window.location.href.indexOf("passwordNotChanged") > -1) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Password didnot changed!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function () {
                    window.location = "index.php";
                })
            }
        });
    </script>
</body>

</html>