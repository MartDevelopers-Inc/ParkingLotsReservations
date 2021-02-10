<?php
session_start();
require_once("../config/config.php");

if (isset($_POST['ChangePassword'])) {
    /* Confirm Password */
    $error = 0;
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
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM  admin  WHERE email = '$email'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if ($new_password != $confirm_password) {
                $err = "Password Does Not Match";
            } else {
                $email = $_SESSION['email'];
                $query = "UPDATE admin SET  password =? WHERE email =?";
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('ss', $new_password, $email);
                $stmt->execute();
                if ($stmt) {
                    $success = "Password Changed" && header("refresh:1; url=index.php");
                } else {
                    $err = "Please Try Again Or Try Later";
                }
            }
        }
    }
}

require_once('../partials/head.php');
?>

<body>

    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">

        <div class="account-bg">
            <div class="card-box mb-0">
                <div class="text-center m-t-20">
                    <a href="" class="logo">
                        <span>Parking Lots Reservations </span>
                    </a>
                </div>
                <div class="m-t-10 p-20">
                    <div class="row">
                        <?php
                        $email  = $_SESSION['email'];
                        $ret = "SELECT * FROM  admin  WHERE email = '$email'";
                        $stmt = $mysqli->prepare($ret);
                        $stmt->execute(); //ok
                        $res = $stmt->get_result();
                        while ($row = $res->fetch_object()) {
                        ?>
                            <div class="col-12 text-center">
                                <h6 class="text-muted m-b-0 m-t-0">Hey <?php echo $row->username; ?> Please Confirm Your New Password</h6>
                                <span class="badge bg-success">Token: <?php echo $row->password; ?></span>
                            </div>

                        <?php } ?>
                    </div>
                    <form method="POST" class="m-t-20">

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="new_password" required="required" placeholder="New Password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="confirm_password" required="required" placeholder="Confirm New Password">
                            </div>
                        </div>


                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" name="ChangePassword" type="submit">Confirm Password</button>
                            </div>
                        </div>

                    </form>

                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- end wrapper page -->


    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>