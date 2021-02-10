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

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = mysqli_real_escape_string($mysqli, trim($_POST['name']));
    } else {
        $error = 1;
        $err = 'Client Name Cannot Be Empty';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = mysqli_real_escape_string($mysqli, trim($_POST['phone']));
    } else {
        $error = 1;
        $err = 'Phone Number Cannot Be Empty';
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    } else {
        $error = 1;
        $err = 'Email  Cannot Be Empty';
    }

    if (isset($_POST['car_regno']) && !empty($_POST['car_regno'])) {
        $car_regno = mysqli_real_escape_string($mysqli, trim($_POST['car_regno']));
    } else {
        $error = 1;
        $err = 'Car Registration Number Be Empty';
    }


    if (!$error) {
        $query = 'UPDATE clients SET  name =?, phone =?, email =?,  car_regno =? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssss',
            $name,
            $phone,
            $email,
            $car_regno,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Client Account Updated' && header('refresh:1; url=profile.php');
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
        $sql = "SELECT * FROM  clients  WHERE id = '$id'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($old_password != $row['password']) {
                $err =  "Please Enter Correct Old Password";
            } elseif ($new_password != $confirm_password) {
                $err = "Confirmation Password Does Not Match";
            } else {
                $query = "UPDATE client SET  password =? WHERE id =?";
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
    require_once('../partials/client_nav.php');
    $id = $_SESSION['id'];
    $ret = "SELECT * FROM `clients` WHERE id ='$id' ";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($client = $res->fetch_object()) {
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
                                                <!-- Hide This -->
                                                <input type="hidden" required name="id" value="<?php echo $client->id; ?>" class="form-control">
                                                <div class="form-group col-md-12">
                                                    <label for="">Name</label>
                                                    <input type="text" required name="name" value="<?php echo $client->name; ?>" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Phone Number</label>
                                                    <input type="text" required value="<?php echo $client->phone; ?>" name="phone" value="" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Email</label>
                                                    <input type="text" required value="<?php echo $client->email; ?>" name="email" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="">Car Registration Number</label>
                                                    <input type="text" value="<?php echo $client->car_regno; ?>" required name="car_regno" class="form-control">
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
                                    <h5 class="">Change Password</h5>
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