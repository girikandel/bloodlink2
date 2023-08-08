<!DOCTYPE html>
<html>
<?php
session_start();
include 'connection.php';
?>

<head>
    <title>Manage Requests</title>
    <?php include "header.html" ?>
    <!-- From admin -->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

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
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/profiles/<?php echo $result['profile'] ?>"
                                    class="rounded-circle small round" alt="" height="40" width="40">
                                <span class="ml-2 d-none d-lg-inline text-black">
                                    <?php echo $result['name'] ?>
                                </span>
                            </button>
                            <!-- <ul class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
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
                            </ul> -->
                        </div>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <!-- Manage Requests -->
        <!-- Manage Incoming Requests -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Manage Incoming Requests</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="incomingRequestTable">
                    <thead class="thead-light">
                        <tr>
                            <th>S.N.</th>
                            <th>Requested By</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Requested By</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `requests` WHERE requested_to=" . $_SESSION['userId'];
                        // $sql = "SELECT users.name, requests.requested_date,requests.status
                        // FROM users
                        // RIGHT JOIN requests
                        // ON users.id = requests.requested_by";
                        $res = $conn->query($sql);
                        $counter = 0;
                        // $result = mySqli_fetch_assoc($res);                                                
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
                            $sql1 = "SELECT * FROM `users` WHERE id=" . $row['requested_by'];
                            $res1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_array($res1);
                            $name = $result1['name'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo ++$counter ?>
                                </td>
                                <td>
                                    <?php echo $name ?>
                                </td>
                                <td>
                                    <?php echo $row['requested_date'] ?>
                                </td>
                                <td>
                                    <?php echo $badge ?>
                                </td>
                                <td>
                                    <a class="edit_item" href="" data-bs-toggle="tooltip" title=""
                                        data-bs-original-title="Edit" data-toggle="modal"
                                        data-target="#editRequest_<?= $row['id'] ?>"><i class="fa-regular fa-pen-to-square"
                                            style="color: #2B4A9D;"></i></a>
                                </td>
                            </tr>
                            <!-- Edit Request Modal -->
                            <div class="modal fade" id="editRequest_<?= $row['id'] ?>" tabindex="-1" role="dialog"
                                aria-labelledby="editRequestsModal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <form action="update_request.php?id=<?= $row['id'] ?>" method="post"
                                        enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    Edit Request</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Requested By</label>
                                                        <input type="text" class="form-control" name="requestedTo"
                                                            id="requestedTo" aria-describedby="nameHelp"
                                                            value="<?php echo $name ?>" readonly />
                                                    </div>
                                                    <div class="col">
                                                        <label>Requested Date</label>
                                                        <input type="text" class="form-control" name="requestedDate"
                                                            id="requestedDate" aria-describedby="phoneHelp"
                                                            value="<?php echo $row['requested_date'] ?>" readonly />
                                                    </div>
                                                    <div class="col">
                                                        <label>Status</label>
                                                        <select name="status" id="status" class="form-select form-control"
                                                            required>
                                                            <option value="">---------</option>
                                                            <option value="Pending" <?php if ($row['status'] == "Pending")
                                                                echo 'selected="selected"' ?>>Pending
                                                                </option>
                                                                <option value="Accepted by Donor" <?php if ($row['status'] == "Accepted by Donor")
                                                                echo 'selected="selected"' ?>>
                                                                    Accept</option>
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
                                                    <input type="submit" id="updateRequest" name="updateRequest"
                                                        class="btn btn-primary" value="Update"> </button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                </form>
                                <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>


        <!-- Manage Outgoing Requests -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Manage Your Requests</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="yourRequestTable">
                    <thead class="thead-light">
                        <tr>
                            <th>S.N.</th>
                            <th>Requested To</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Requested To</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `requests` WHERE requested_by=" . $_SESSION['userId'];
                        $res = $conn->query($sql);
                        $counter = 0;
                        // $result = mySqli_fetch_assoc($res);                                                
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
                            $sql1 = "SELECT * FROM `users` WHERE id=" . $row['requested_to'];
                            $res1 = mysqli_query($conn, $sql1);
                            $result1 = mysqli_fetch_array($res1);
                            $name = $result1['name'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo ++$counter ?>
                                </td>
                                <td>
                                    <?php echo $name ?>
                                </td>
                                <td>
                                    <?php echo $row['requested_date'] ?>
                                </td>
                                <td>
                                    <?php echo $badge ?>
                                </td>
                                <td>
                                    <a class="delete_item" onclick="confirmDelete(<?= $row['id'] ?>)"><i
                                            class="fa-sharp fa-solid fa-trash"
                                            style="color: #e93030;padding-left:15px;"></i></a>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- Page level plugins -->
    <script src="admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#incomingRequestTable').DataTable(); // ID From dataTable 
            $('#incomingRequestTableHover').DataTable(); // ID From dataTable with Hover
        });
        $(document).ready(function () {
            $('#yourRequestTable').DataTable(); // ID From dataTable 
            $('#yourRequestTableHover').DataTable(); // ID From dataTable with Hover
        });
        if (window.location.href.indexOf("request_updated") > -1) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Request Status Updated Successfully.',
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                window.location = "manage_requests.php";
            })
        }
        if (window.location.href.indexOf("request_deleted") > -1) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Request deleted successfully.',
                showConfirmButton: false,
                timer: 2000
            }).then(function () {
                window.location = "manage_requests.php";
            })
        }
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
                    window.location = "delete_request.php?id=" + id;
                }
            })
        }
    </script>
</body>

</html>