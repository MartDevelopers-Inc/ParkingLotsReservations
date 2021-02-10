<?php
session_start();
include('../config/config.php');
include('../config/codeGen.php');

if (isset($_POST['create_account'])) {
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

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = mysqli_real_escape_string($mysqli, trim(sha1(md5($_POST['password']))));
    } else {
        $error = 1;
        $err = 'Client Password  Cannot Be Empty';
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
        //prevent Double entries
        $sql = "SELECT * FROM  clients WHERE  email='$email' || phone = '$phone'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $email = $row['email'] ||
                $phone = $row['phone']
            ) {
                $err =  "Client Account With That Email Or Phone Number Already Exists ";
            } else {
            }
        } else {

            $query = 'INSERT INTO clients (id, name, phone, email, password, car_regno) VALUES(?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssss',
                $id,
                $name,
                $phone,
                $email,
                $password,
                $car_regno
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Client Account Created' && header('refresh:1; url=index.php');
            } else {
                $info = 'Please Try Again Or Try Later';
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
                    <a href="index.php" class="logo">
                        <span>Parking Lots Reservations </span>
                    </a>
                </div>
                <div class="m-t-10 p-20">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Create Account</h6>
                        </div>
                    </div>
                    <form method="POST" class="m-t-20">
                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="name" required="required" placeholder="Full Name">
                                <input class="form-control" type="hidden" name="id" value="<?php echo $ID; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="phone" required="required" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <input class="form-control" type="text" name="car_regno" required="required" placeholder="Car Reg Number">
                            </div>
                        </div>

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

                        <div class="form-group text-center row m-t-10">
                            <div class="col-12">
                                <button class="btn btn-success btn-block waves-effect waves-light" name="create_account" type="submit">Create Account</button>
                            </div>
                        </div>

                        <div class="form-group row m-t-30 mb-0">
                            <div class="col-6">
                                <a href="signup.php" class="text-muted"><i class="fa fa-sign-in m-r-5"></i>Log In</a>
                            </div>

                            <div class="col-6">
                                <a href="reset_password.php" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
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