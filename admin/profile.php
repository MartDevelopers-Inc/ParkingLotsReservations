<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');

/* Update Profile */
if (isset($_POST['update_profile'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_SESSION['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $username = mysqli_real_escape_string($mysqli, trim($_POST['username']));
    } else {
        $error = 1;
        $err = 'UserName Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Email  Cannot Be Empty';
    }

    if (!$error) {
        $query = 'UPDATE admin  SET username =?, email =? WHERE id =?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sss',
            $username,
            $email,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Profile Updated' && header('refresh:1; url=profile.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}


/* Change Password */
if (isset($_POST['change_password'])) {
    //Change Password
    $error = 0;
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim((($_SESSION['id']))));
    } else {
        $error = 1;
        $err = "ID Cannot Be Empty";
    }
    if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
        $old_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['old_password']))));
    } else {
        $error = 1;
        $err = "Old Password Cannot Be Empty";
    }
    if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
        $new_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['new_password']))));
    } else {
        $error = 1;
        $err = "New Password Cannot Be Empty";
    }
    if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
        $confirm_password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['confirm_password']))));
    } else {
        $error = 1;
        $err = "Confirmation Password Cannot Be Empty";
    }

    if (!$error) {
        $sql = "SELECT * FROM  admin  WHERE id = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['password']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $query = "UPDATE admin SET  password =? WHERE id =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $id);
                $stmt->execute();
                if ($stmt) {
                    $success = "Profile Updated" && header("refresh:1; url=profile.php");
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
        }
    }
}
require_once("../partials/head.php");
?>

<body>

    <!-- Navigation Bar-->
    <?php
    require_once('../partials/admin_nav.php');
    $id = $_SESSION['id'];
    $ret = "SELECT * FROM `admin` WHERE id ='$id' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($admin = $res->fetch_object()) {
    ?>
        <!-- End Navigation Bar-->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group float-right m-t-15">
                            </div>
                            <h4 class="page-title">Profile Settings</h4>
                        </div>
                    </div>
                </div>

                <!-- end row -->
                <div class="row">
                    <div class="col-6">
                        <div class="card-box">
                            <form method="POST">
                                <div class="info">
                                    <h5 class="">Update Profile</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="address">Username</label>
                                                        <input type="text" value="<?php echo $admin->username; ?>" name="username" class="form-control mb-4">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="address">Email</label>
                                                        <input type="email" value="<?php echo $admin->email; ?>" name="email" class="form-control mb-4">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group text-right">
                                                <input type="submit" value="Update Profile" name="update_profile" class="btn btn-outline-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card-box">
                            <form method="POST">
                                <div class="info">
                                    <h5 class="">Update Password</h5>
                                    <div class="row">
                                        <div class="col-md-11 mx-auto">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="location">Old Password</label>
                                                        <input type="password" name="old_password" class="form-control mb-4">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="phone">New Password</label>
                                                        <input type="password" name="new_password" class="form-control mb-4">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="phone">Confirm New Password</label>
                                                        <input type="password" name="confirm_password" class="form-control mb-4">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group text-right">
                                                <input type="submit" value="Update Password" name="change_password" class="btn btn-outline-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- container -->

            <!-- Footer -->
            <?php require_once("../partials/footer.php"); ?>
            <!-- End Footer -->


        </div>
        <!-- End wrapper -->
    <?php require_once("../partials/scripts.php");
    } ?>

</body>

</html>