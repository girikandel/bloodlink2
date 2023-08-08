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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js\bootstrap.bundle.min.js"></script>


</head>

<body>
    <!-- Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a href="index.php"><img src="image/bloodlink.svg" class="img-thumbnail border-0" alt="..."></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

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
                                data-bs-toggle="dropdown" aria-expanded="false"><img
                                    src="uploads/profiles/<?php echo $result['profile'] ?>"
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
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Search Result</h1>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Blood Group</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Last Donation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'connection.php';
                    if (isset($_REQUEST['searchdonors'])) {
                        $province = $_REQUEST['province'];
                        $district = $_REQUEST['district'];
                        $municipality = $_REQUEST['municipality'];
                        $ward = $_REQUEST['ward'];
                        $blood = $_REQUEST['bloodgroup'];
                    }
                    if (isset($_SESSION['userId'])) {
                        $requesterId = $_SESSION['userId'];
                    } else {
                        $requesterId = -1;
                    }
                    ;
                    $sql = "SELECT * FROM `users` WHERE `province` like '%$province%' AND `district` like '%$district%'  AND `municipality` like '%$municipality%' AND `ward` like '%$ward%' AND `blood`='$blood' AND `status`='Active' AND `id` != '" . $requesterId . "'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $province = $row['province'];
                        $district = $row['district'];
                        $mun = $row['municipality'];
                        $ward = $row['ward'];
                        $address = $province . ", " . $district . ", " . $mun . ", " . $ward;
                        $profile = $row['profile'];
                        $lastDonation = date_create($row['lastdonation']);
                        $dob = date_create($row['dob']);
                        $nowDate = date_create(date("Y-m-d"));

                        $ldt = date_diff($lastDonation, $nowDate);
                        $age = date_diff($dob, $nowDate);
                        if ($ldt->m >= 3) {

                            ?>
                            <tr>
                                <td><img src="uploads/profiles/<?php echo $profile ?>" style="height:40px;width:40px"
                                        class="donor-profile" alt="" height="20" width="20"></td>
                                <td>
                                    <?php echo $row['name'] . $row['id'] ?>
                                </td>
                                <td>
                                    <?php echo $age->y ?>
                                </td>
                                <td>
                                    <?php echo $row['blood'] ?>
                                </td>
                                <td>
                                    <?php echo $address ?>
                                </td>
                                <td>
                                    <?php echo $row['phone'] ?>
                                </td>
                                <td>
                                    <?php echo $ldt->m . " Months ago" ?>
                                </td>
                                <?php
                                if (isset($_SESSION['userId'])) {
                                    ?>
                                    <td><a href="request_donors.php?id=<?php echo $row['id']; ?>&ty=ind" id="requestIndividual"
                                            name="requestIndividual" type="button" class="btn btn-sm btn-danger" value="Request">
                                            Request</a></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><a href="login.php" type="button" class="btn login-button" value="Login">
                                            Login</a>
                                    </td>
                                    <?php
                                } ?>

                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>