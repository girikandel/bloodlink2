<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if ($_SESSION["isAdminValid"] == 0) {
  header("location:login.php?err=sessionexpired");
}
?>

<head>

  <title>BloodLink - Dashboard</title>
  <?php include "header.html" ?>

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
      <li class="nav-item active">
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
      <li class="nav-item">
        <a class="nav-link collapsed" href="manage_requests.php">
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
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Profile start here -->
            <?php
            $sql = "SELECT * FROM `admin` WHERE id=" . $_SESSION['adminId'];
            $res = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($res);
            ?>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">
                  <?php echo $result['username'] ?>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#profileModal">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#passwordChangeModal">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
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
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Total donors card -->
            <?php
            $sql = "SELECT COUNT(*) as total_donor FROM users WHERE `role`='donor' OR `role`='both'";
            $res = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($res);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Donors</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $result["total_donor"] ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tint fa-2x text-danger"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Total Receivers Card -->
            <?php
            $sql = "SELECT COUNT(*) as total_user FROM users WHERE `role`='receiver' OR `role`='both'";
            $res = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($res);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Receivers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $result["total_user"] ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Users -->
            <?php
            $sql = "SELECT COUNT(*) as total_user FROM users";
            $res = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($res);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $result["total_user"] ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card -->
            <?php
            $sql = "SELECT COUNT(*) as pending_request FROM `requests` WHERE status='Pending'";
            $res = mysqli_query($conn, $sql);
            $result = mysqli_fetch_array($res);
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo $result["pending_request"] ?>
                      </div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Request Status Details -->
            <div class="col-xl-12 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Request Status</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Request By</th>
                        <th class="text-center">Request To</th>
                        <th class="text-center">Request Date</th>
                        <th class="text-center">Status</th>
                        <!-- <th class="text-center">Action</th> -->
                      </tr>
                    </thead>
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
                          $badge = '<span class="badge badge-success">Accepted</span>';
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
                          <td class="text-center"><a href="#">
                              <!-- <?php echo $row['id'] ?> -->
                              <?php echo ++$counter ?>
                            </a></td>
                          <td class="text-center">
                            <?php echo $row1['name'] ?>
                          </td>
                          <td class="text-center">
                            <?php echo $row2['name'] ?>
                          </td>
                          <td class="text-center">
                            <?php echo $row['requested_date'] ?>
                          </td>
                          <td class="text-center">
                            <?php echo $badge ?>
                          </td>

                        </tr>
                        <?php
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
                <div class=" card-footer">
                </div>
              </div>
            </div>

          </div>

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
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
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
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
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp"
                          value="<?php echo $result['fullname'] ?>" readonly />
                      </div>
                      <div class="col">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                          aria-describedby="phoneHelp" value="<?php echo $result['username'] ?>" readonly />
                      </div>
                      <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
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
                    aria-describedby="confirmPasswordHelp" placeholder="Re-enter you new Password" required />
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
      <?php include('footer.html') ?>
      <script>
        if (window.location.href.indexOf("passwordUpdated") > -1) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Password Updated Successfully',
            showConfirmButton: false,
            timer: 800
          }).then(function () {
            window.location = "index.php";
          })
        }
        if (window.location.href.indexOf("passwordNotMatch") > -1) {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'New password and confirm password does not match',
            showConfirmButton: false,
            timer: 1000
          }).then(function () {
            window.location = "index.php";
          })
        }
      </script>
</body>

</html>