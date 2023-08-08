<!DOCTYPE html>
<html>
<?php
session_start();
include 'connection.php';
include 'header.html';
?>

<head>
    <title>BloodLink</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                    <li class="nav-item active">
                        <a class="nav-link text-danger" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg-danger px-3 text-white rounded " href="donors.html">Donor</a>
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
                                <!-- <img src="uploads/profiles/<?php echo $result['profile'] ?>"
                                    class="rounded-circle small round" alt="" height="40" width="40"> -->
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

    <!-- Get Involved in Donors -->
    <div class="row h-100 embed-responsive">
        <div class="col-7 mt-lg-5 ml-lg-5">
            <p class="font-weight-bold h3">Get involved in Blood Donation.</p>
            <p class="text-justify mt-4 font-weight-light font-weight-normal">
                Getting involved in blood donation is a noble and life-saving endeavor that can have a significant
                impact on the lives of others. One of the most direct ways to make a difference is by becoming a blood
                donor yourself. Contact your local blood donation center or hospital to find out about their donation
                process and eligibility criteria. By donating blood regularly, you can actively contribute to saving
                lives and supporting those in need of blood transfusions.
                <br><br>
                Another way to get involved is by organizing blood drives in your community or workplace. Collaborate
                with local blood banks, hospitals, or organizations specializing in blood donation to set up a blood
                drive event. This allows you to mobilize a larger group of potential donors and create a positive impact
                on a larger scale. By organizing blood drives, you can help ensure a stable and consistent blood supply,
                particularly during emergencies or times when blood demand is high.
                <br><br>
                Furthermore, you can promote blood donation awareness through advocacy and education. Share information
                about the importance of blood donation with your family, friends, and colleagues. Utilize social media
                platforms, community bulletin boards, or local events to spread the word and encourage others to donate
                blood. By raising awareness about the need for blood and the impact of blood donation, you can inspire
                more individuals to become active participants in this life-saving cause.
            </p>
            <a href="register.php" class="btn btn-danger rounded text-white">Join Now</a>
        </div>
        <div class="col mt-lg-5 ml-lg-5">
            <img src="image/donateblood.png" class="img-thumbnail border-0" alt="">
        </div>
    </div>

    <!-- Latest Donors -->
    <div class="container">
        <p class="h1 center-content text-blue">Latest Donors</p>
        <div class="row">
            <?php
            include 'connection.php';
            $topDonorsSql = "SELECT * FROM `users` INNER JOIN `requests` ON users.id=requests.requested_by AND requests.status= 'Donated' LIMIT 2";
            $topDonors = $conn->query($topDonorsSql);

            while ($donor = $topDonors->fetch_assoc()) {
                ?>
                <div class="container col-4">
                    <div class="container p-3 rounded donor-container p-4">
                        <img src="uploads/profiles/<?php echo $donor['profile'] ?>" class="donor-profile" alt="">
                        <hr>
                        <table>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Name</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['name'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Age</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['dob'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Blood Group</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['blood'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Address</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['district'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Contact</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['phone'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-weight-bold">Last Donation</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold pl-lg-3 pr-lg-3">:</p>
                                </td>
                                <td>
                                    <p class="font-weight-bold">
                                        <?php echo $donor['lastdonation'] ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <br><br>
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