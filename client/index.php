<?php
session_start();
include('../config/config.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1(md5($_POST['password'])); //double encrypt to increase security
    $stmt = $mysqli->prepare("SELECT email, password, id, phone  FROM clients  WHERE email =? AND password =?");
    $stmt->bind_param('ss', $email, $password); //bind fetched parameters
    $stmt->execute(); //execute bind 
    $stmt->bind_result($email, $password, $id, $phone); //bind result
    $rs = $stmt->fetch();
    $_SESSION['id'] = $id;
    $_SESSION['phone'] = $phone;
    if ($rs) {
        header("location:dashboard.php");
    } else {
        $err = "Access Denied Please Check Your Credentials";
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
                    <a href="index.php" class="logo">
                        <span>Car Parking Reservations System</span>
                    </a>
                </div>
                <div class="m-t-10 p-20">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                        </div>
                    </div>
                    <form method="POST" class="m-t-20">
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="email" name="email" required="required" placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="password" name="password" required="required" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="checkbox checkbox-custom">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" name="login" type="submit">Log In</button>
                            </div>
                        </div>

                        <div class="form-group row m-t-30 mb-0">
                            <div class="col-5">
                                <a href="signup.php" class="text-muted"><i class="fa fa-user-plus m-r-5"></i> Create Account</a>
                            </div>
                            <div class="col-4">
                                <a href="reset_password.php" class="text-muted"><i class="fa fa-lock m-r-5"></i> Reset Password?</a>
                            </div>
                            <div class="col-3">
                                <a href="../" class="text-muted"><i class="fa fa-home m-r-5"></i> Home</a>
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