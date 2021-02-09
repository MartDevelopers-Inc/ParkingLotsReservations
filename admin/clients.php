<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');
/* Add Clients */
if (isset($_POST['add_client'])) {
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
                    'Client Account Created' && header('refresh:1; url=clients.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Clients */
if (isset($_POST['update_client'])) {
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
        $query = 'UPDATE clients SET  name =?, phone =?, email =?, password =?, car_regno =? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssssss',
            $name,
            $phone,
            $email,
            $password,
            $car_regno,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Client Account Updated' && header('refresh:1; url=clients.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}


/* Delete Clients */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM clients WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=clients.php');
        //inject alert that task failed
        $info = 'Deleted';
    }
}

require_once("../partials/head.php");
?>

<body>

    <!-- Navigation Bar-->
    <?php require_once('../partials/admin_nav.php'); ?>
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
                            <a href="#add_modal" class="btn btn-primary waves-effect waves-light m-r-5 m-t-10" data-animation="door" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">Add Client</a>
                        </div>
                        <h4 class="page-title">Clients</h4>
                    </div>
                </div>
            </div>
            <!-- Add
              Modal -->
            <div id="add_modal" class="modal-demo">
                <button type="button" class="close" onclick="Custombox.modal.close();">
                    <span>&times;</span><span class="sr-only">Close</span>
                </button>
                <h4 class="custom-modal-title">Fill All Required Fields</h4>
                <div class="custom-modal-text">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <!-- Hide This -->
                                <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                <div class="form-group col-md-12">
                                    <label for="">Name</label>
                                    <input type="text" required name="name" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="text" required name="phone" value="" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" required name="email" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Password</label>
                                    <input type="text" required name="password" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Car Registration Number</label>
                                    <input type="text" required name="car_regno" class="form-control">
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="submit" name="add_client" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Modal -->

            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email Address</th>
                                    <th>Car Reg No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM `clients` ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($client = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $client->name; ?></td>
                                        <td><?php echo $client->phone; ?></td>
                                        <td><?php echo $client->email; ?></td>
                                        <td><?php echo $client->car_regno; ?></td>
                                        <td>
                                            <a href="#update-<?php echo $client->id; ?>" data-toggle="modal" class="badge bg-warning">Update</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="update-<?php echo $client->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update <?php echo $client->name; ?> Account</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" required name="id" value="<?php echo $client->id; ?>" class="form-control">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">Name</label>
                                                                            <input type="text" required name="name" value="<?php echo $client->name; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="">Phone Number</label>
                                                                            <input type="text" required value="<?php echo $client->phone; ?>" name="phone" value="" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="">Email</label>
                                                                            <input type="text" required value="<?php echo $client->email; ?>" name="email" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label for="">Password</label>
                                                                            <input type="text" required name="password" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">Car Registration Number</label>
                                                                            <input type="text" value="<?php echo $client->car_regno; ?>" required name="car_regno" class="form-control">
                                                                        </div>

                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_client" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#delete-<?php echo $client->id; ?>" class="badge bg-danger" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100">Delete</a>
                                            <!-- Delete Modal -->
                                            <div id="delete-<?php echo $client->id; ?>" class="modal-demo">
                                                <button type="button" class="close" onclick="Custombox.modal.close();">
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="custom-modal-title">Confirm Deletion</h4>
                                                <div class="text-center">
                                                    <h4>Delete <?php echo $client->name; ?> Account ? </h4>
                                                    <br>
                                                    <button type="button" class="text-center btn btn-success" onclick="Custombox.modal.close();">No</button>
                                                    <a href="clients.php?delete=<?php echo $client->id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container -->


        <!-- Footer -->
        <?php require_once("../partials/footer.php"); ?>
        <!-- End Footer -->


    </div>
    <!-- End wrapper -->
    <?php require_once("../partials/scripts.php"); ?>

</body>

</html>