<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if ($_SESSION["isAdminValid"] == 0) {
  header("location:login.php?err=sessionexpired");
}
?>

<head>
  <title>BloodLink - Manage Users</title>
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
      <li class="nav-item active">
        <a class="nav-link collapsed" href="manage_users.php">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Manage Users</span>
        </a>
      </li>

      <!-- Manage Blood Banks -->
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Manage Blood Banks</span>
        </a>
      </li> -->

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
            <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
            </ol>
          </div>

          <!-- Manage Users -->
          <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Manage Users</h6>
              </div>
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                  <thead class="thead-light">
                    <tr>
                      <th>S.N.</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Blood Group</th>
                      <th>Phone</th>
                      <th>Last Donation</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S.N.</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>DOB</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Blood Group</th>
                      <th>Phone</th>
                      <th>Last Donation</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM `users`";
                    $res = $conn->query($sql);
                    $counter = 0;
                    while ($row = $res->fetch_assoc()) {
                      $province = $row['province'];
                      $district = $row['district'];
                      $mun = $row['municipality'];
                      $ward = $row['ward'];
                      $address = $province . ", " . $district . ", " . $mun . ", " . $ward;
                      ?>
                      <tr>
                        <td><a href="#">
                            <?php echo ++$counter ?>
                            <!-- <?php echo $row['id'] ?> -->
                          </a>
                        <td>
                          <?php echo $row['name'] ?>
                        </td>
                        <td>
                          <?php echo $address ?>
                        </td>
                        <td>
                          <?php echo $row['dob'] ?>
                        </td>
                        <td>
                          <?php echo $row['gender'] ?>
                        </td>
                        <td>
                          <?php echo $row['email'] ?>
                        </td>
                        <td>
                          <?php echo $row['blood'] ?>
                        </td>
                        <td>
                          <?php echo $row['phone'] ?>
                        </td>
                        <td>
                          <?php echo $row['lastdonation'] ?>
                        </td>
                        <td>
                          <?php echo $row['role'] ?>
                        </td>
                        <td>
                          <?php echo $row['status'] ?>
                        </td>
                        <td class="text-center">
                          <a class="edit_item" href="" data-bs-toggle="tooltip" title="" data-bs-original-title="Edit"
                            data-toggle="modal" data-target="#editProfile_<?= $row['id'] ?>"><i
                              class="fa-regular fa-pen-to-square" style="color: #2B4A9D;"></i></a>
                          <!-- <a class="delete_item" href="delete_users.php?id=<?php echo $row['id'] ?>"><i
                              class="fa-sharp fa-solid fa-trash" style="color: #e93030;padding-left:15px;"></i></a> -->
                        </td>
                      </tr>

                      <!-- User edit modal -->

                      <div class="modal fade" id="editProfile_<?= $row['id'] ?>" tabindex="-1" role="dialog"
                        aria-labelledby="editUserLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editUserLabel">Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="profile_update_process.php?id=<?= $row['id'] ?>" method="post"
                              enctype="multipart/form-data">
                              <div class="modal-body">
                                <div class="container-fluid">

                                  <!-- User Details -->
                                  <div class="conatiner">
                                    <center><img src="../uploads/profiles/<?php echo $row['profile'] ?>"
                                        class="rounded-circle small round" alt="" height="80" width="80"></center>
                                  </div>
                                  <br>

                                  <div class="row">
                                    <div class="col">
                                      <label>Name</label>
                                      <input type="text" class="form-control" name="name" id="name"
                                        aria-describedby="nameHelp" value="<?php echo $row['name'] ?>" required />
                                    </div>
                                    <div class="col">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" id="email"
                                        aria-describedby="emailHelp" value="<?php echo $row['email'] ?>" required />
                                    </div>
                                    <div class="col">
                                      <label>Phone</label>
                                      <input type="phone" class="form-control" name="phone" id="phone"
                                        aria-describedby="phoneHelp" value="<?php echo $row['phone'] ?>" required />
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
                                        aria-describedby="dobHelp" value="<?php echo $row['dob'] ?>"
                                        placeholder="2002-02-01" required />
                                    </div>
                                    <div class="col">
                                      <label>Last Donation</label>
                                      <input type="date" class="form-control" name="lastdonation" id="lastdonation"
                                        aria-describedby="lastDonationHelp" value="<?php echo $row['lastdonation'] ?>"
                                        required />
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col">
                                      <label>Role</label><br>
                                      <select name="role" id="role" class="form-select" required>
                                        <option value="">---------</option>
                                        <option value="User <?php if ($row['role'] == "User")
                                          echo 'selected="selected"' ?>">User
                                          </option>
                                          <option value="Donor" <?php if ($row['role'] == "Donor")
                                          echo 'selected="selected"' ?>>Donor
                                          </option>
                                          <option value="Both" <?php if ($row['role'] == "Both")
                                          echo 'selected="selected"' ?>>Both
                                          </option>
                                        </select>
                                      </div>
                                      <div class="col">
                                        <label>Gender</label><br>
                                        <select name="gender" id="gender" class="form-select" required>
                                          <option value="">---------</option>
                                          <option value="Male" <?php if ($row['gender'] == "Male")
                                          echo 'selected="selected"' ?>>Male
                                          </option>
                                          <option value="Female" <?php if ($row['gender'] == "Female")
                                          echo 'selected="selected"' ?>>
                                            Female</option>
                                          <option value="Other" <?php if ($row['gender'] == "Other")
                                          echo 'selected="selected"' ?>>Other
                                          </option>
                                        </select>
                                      </div>
                                      <div class="col">
                                        <label>Status</label><br>
                                        <select name="status" id="status" class="form-select" required>
                                          <option value="">---------</option>
                                          <option value="Active" <?php if ($row['status'] == "Active")
                                          echo 'selected="selected"' ?>>
                                            Active
                                          </option>
                                          <option value="Inactive" <?php if ($row['status'] == "Inactive")
                                          echo 'selected="selected"' ?>>Inactive
                                          </option>
                                        </select>
                                      </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                      <div class="col-4">
                                        <label>Blood Group</label><br>
                                        <select name="blood" id="blood" class="form-select" required>
                                          <option value="">---------</option>
                                          <option value="A+" <?php if ($row['blood'] == "A+")
                                          echo 'selected="selected"' ?>>A+</option>
                                          <option value="B+" <?php if ($row['blood'] == "B+")
                                          echo 'selected="selected"' ?>>B+</option>
                                          <option value="AB+" <?php if ($row['blood'] == "AB+")
                                          echo 'selected="selected"' ?>>AB+</option>
                                          <option value="O+" <?php if ($row['blood'] == "O+")
                                          echo 'selected="selected"' ?>>O+</option>
                                          <option value="A-" <?php if ($row['blood'] == "A-")
                                          echo 'selected="selected"' ?>>A-</option>
                                          <option value="B-" <?php if ($row['blood'] == "B-")
                                          echo 'selected="selected"' ?>>B-</option>
                                          <option value="AB-" <?php if ($row['blood'] == "AB-")
                                          echo 'selected="selected"' ?>>AB-</option>
                                          <option value="O-" <?php if ($row['blood'] == "O-")
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
                                          aria-describedby="provinceHelp" value="<?php echo $row['province'] ?>"
                                        placeholder="Bagmati" required />
                                    </div>
                                    <div class="col">
                                      <label>District</label>
                                      <input type="text" class="form-control" name="district" id="district"
                                        aria-describedby="districtHelp" value="<?php echo $row['district'] ?>"
                                        placeholder="Chitwan" required />
                                    </div>
                                    <div class="col">
                                      <label>Municipality</label>
                                      <input type="text" class="form-control" name="municipality" id="municipality"
                                        aria-describedby="emailHelp" value="<?php echo $row['municipality'] ?>"
                                        placeholder="Bharatpur" required />
                                    </div>
                                  </div>
                                  <br>
                                  <div class="row">
                                    <div class="col-4">
                                      <label>Ward No.</label>
                                      <input type="number" class="form-control" name="ward" id="ward"
                                        aria-describedby="nameHelp" value="<?php echo $row['ward'] ?>" placeholder="01"
                                        required />
                                    </div>

                                  </div>

                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <input type="submit" onsubmit="form_submit()" class=" btn btn-primary"
                                  value="Update"></input> -->
                                <input type="submit" name="updateProfile" id="updateProfile" class="btn btn-primary"
                                  value="Update">
                                <!-- <a href="profile_update_process.php" class="btn btn-primary">Update</a> -->
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

      <script type="text/javascript">
        function form_submit() {
          alert("Profile Updated");
          // document.getElementById("editProfile").submit();
        }    
      </script>
</body>

</html>