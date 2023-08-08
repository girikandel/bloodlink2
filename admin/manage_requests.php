<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if ($_SESSION["isAdminValid"] == 0) {
    header("location:login.php?err=sessionexpired");
}
?>

<head>

    <title>BloodLink - Manage Requests</title>
    <?php include "header.html" ?>

</head>

<body id="page-top">
    <?php
    include "..\connection.php";
    ?>
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="img/logo/bl.png">
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Manage
            </div>

            <!-- Manage Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="manage_users.php">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <!-- Manage Requests -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Manage Requests</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="manage_inquiries.php">
                    <i class="far fa-fw fa-window-maximize"></i>
                    <span>Manage Inquiries</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block">
                        </div>

                        <!-- Profile start here -->
                        <?php
                        $sql = "SELECT * FROM `admin` WHERE id=" . $_SESSION['adminId'];
                        $res = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($res);
                        ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">
                                    <?php echo $result['username'] ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#profileModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#passwordChangeModal">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Requests</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Requests</li>
                        </ol>
                    </div>

                    <div class="row mb-3">
                        <!-- Manage Requests -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Requests Status</h6>
                                </div>
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush" id="dataTable">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Requested By</th>
                                                <th>Requested To</th>
                                                <th>Requested Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S.N.</th>
                                                <th>Requested By</th>
                                                <th>Requested To</th>
                                                <th>Requested Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM `requests` LIMIT 10";
                                            $res = $conn->query($sql);
                                            $counter = 0;

                                            while ($row = $res->fetch_assoc()) {
                                                $status = $row['status'];
                                                if ($status == 'Pending') {
                                                    $badge = '<span class="badge badge-warning">Pending</span>';
                                                } else if ($status == 'Accepted by Donor') {
                                                    $badge = '<span class="badge badge-success">Accepted</span>';
                                                } else if ($status == 'Rejected') {
                                                    $badge = '<span class="badge badge-danger">Rejected</span>';
                                                } elseif ($status == 'Donated') {
                                                    $badge = '<span class="badge badge-success">Completed</span>';
                                                }
                                                //Get name of request by
                                                $sql1 = "SELECT * FROM `users` WHERE id=" . $row['requested_by'];
                                                $res1 = $conn->query($sql1);
                                                $row1 = $res1->fetch_assoc();

                                                //Get name of request to
                                                $sql2 = "SELECT * FROM `users` WHERE id=" . $row['requested_to'];
                                                $res2 = $conn->query($sql2);
                                                $row2 = $res2->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><a href="#">
                                                            <?php echo ++$counter ?>
                                                        </a></td>
                                                    <td>
                                                        <?php echo $row1['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row2['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['requested_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $badge ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="edit_item" href="" data-bs-toggle="tooltip" title=""
                                                            data-bs-original-title="Edit" data-toggle="modal"
                                                            data-target="#editRequest_<?= $row['id'] ?>"><i
                                                                class="fa-regular fa-pen-to-square"
                                                                style="color: #2B4A9D;"></i></a>
                                                        <a class="delete_item" onclick="confirmDelete(<?= $row['id'] ?>)"><i
                                                                class="fa-sharp fa-solid fa-trash"
                                                                style="color: #e93030;padding-left:15px;"></i></a>
                                                    </td>
                                                </tr>

                                                <!-- Edit Requests -->
                                                <div class="modal fade" id="editRequest_<?= $row['id'] ?>" tabindex="-1"
                                                    role="dialog" aria-labelledby="editRequestsModal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <form action="request_update.php?id=<?= $row['id'] ?>" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                                        Requests</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <label>Requested By</label>
                                                                            <input type="text" class="form-control"
                                                                                name="requestedBy" id="requestedBy"
                                                                                aria-describedby="nameHelp"
                                                                                value="<?php echo $row1['name'] ?>"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>Requested To</label>
                                                                            <input type="text" class="form-control"
                                                                                name="requestedTo" id="requestedTo"
                                                                                aria-describedby="emailHelp"
                                                                                value="<?php echo $row2['name'] ?>"
                                                                                readonly />
                                                                        </div>
                                                                        <div class="col">
                                                                            <label>Requested Date</label>
                                                                            <input type="text" class="form-control"
                                                                                name="requestedDate" id="requestedDate"
                                                                                aria-describedby="phoneHelp"
                                                                                value="<?php echo $row['requested_date'] ?>"
                                                                                readonly />
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <label>Status</label>
                                                                            <select name="status" id="status"
                                                                                class="form-select form-control" required>
                                                                                <option value="">---------</option>
                                                                                <option value="Pending" <?php if ($row['status'] == "Pending")
                                                                                    echo 'selected="selected"' ?>>Pending
                                                                                    </option>
                                                                                    <option value="Accepted by Donor" <?php if ($row['status'] == "Accepted by Donor")
                                                                                    echo 'selected="selected"' ?>>
                                                                                        Accepted by Donor</option>
                                                                                    <option value="Donated" <?php if ($row['status'] == "Donated")
                                                                                    echo 'selected="selected"' ?>>Donated
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <input type="submit" id="updateRequest"
                                                                            name="updateRequest" class="btn btn-primary"
                                                                            value="Update"> </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Logout -->
                        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
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
                                        <button type="button" class="btn btn-outline-primary"
                                            data-dismiss="modal">Cancel</button>
                                        <a href="login.php" class="btn btn-primary">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile View and edit -->
                        <?php
                        $sql = "SELECT * FROM `admin` WHERE id=" . $_SESSION['adminId'];
                        $res = mysqli_query($conn, $sql);
                        $result = mysqli_fetch_array($res);
                        ?>
                        <div class="modal fade" id="profileModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabelLogout">Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-login">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        aria-describedby="nameHelp"
                                                        value="<?php echo $result['fullname'] ?>" readonly />
                                                </div>
                                                <div class="col">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username"
                                                        id="username" aria-describedby="phoneHelp"
                                                        value="<?php echo $result['username'] ?>" readonly />
                                                </div>
                                                <div class="col">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        aria-describedby="emailHelp"
                                                        value="<?php echo $result['email'] ?>" readonly />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal change password -->
                <form action="passwordupdateprocess.php" method="post">
                    <div class="modal fade" id="passwordChangeModal" tabindex="-1" role="dialog"
                        aria-labelledby="passwordChangeModalLabel" aria-hidden="true">
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
                                            aria-describedby="oldPasswordHelp" placeholder="Enter old Password"
                                            required />
                                    </div>
                                    <br>
                                    <div class="col">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="newPassword" id="newPassword"
                                            aria-describedby="newPasswordHelp" placeholder="Enter new password"
                                            required />
                                    </div>
                                    <br>
                                    <div class="col">
                                        <label>Confirm New Password</label>
                                        <input type="password" class="form-control" name="confirmPassword"
                                            id="confirmPassword" aria-describedby="confirmPasswordHelp"
                                            placeholder="Re-enter you new Password" required />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-danger"
                                        data-dismiss="modal">Cancel</button>
                                    <input type="submit" name="changePassword" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
    </div>


    <!-- Footer -->
    <?php include('footer.html') ?>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "delete_requests.php?id=" + id;
                }
            })
        }
    </script>
</body>

</html>