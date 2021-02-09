<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');

/* Pay Reservations */
if (isset($_POST['pay_reservations'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = 'Payment Code Cannot Be Empty';
    }

    if (isset($_POST['client_name']) && !empty($_POST['client_name'])) {
        $client_name = mysqli_real_escape_string($mysqli, trim($_POST['client_name']));
    } else {
        $error = 1;
        $err = 'Client Name Cannot Be Empty';
    }

    if (isset($_POST['client_phone']) && !empty($_POST['client_phone'])) {
        $client_phone = mysqli_real_escape_string($mysqli, trim((($_POST['client_phone']))));
    } else {
        $error = 1;
        $err = 'Client Phone  Cannot Be Empty';
    }


    if (isset($_POST['r_id']) && !empty($_POST['r_id'])) {
        $r_id  = mysqli_real_escape_string($mysqli, trim($_POST['r_id']));
    } else {
        $error = 1;
        $err = 'Parking Reservation ID Cannot  Be Empty';
    }


    if (isset($_POST['amt']) && !empty($_POST['amt'])) {
        $amt = mysqli_real_escape_string($mysqli, trim($_POST['amt']));
    } else {
        $error = 1;
        $err = 'Parking Amount Number Be Empty';
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = 'Reservation Status Number Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  payments WHERE  code='$code' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $code = $row['code']
            ) {
                $err =  "Payment With That Code Number Already Exists ";
            } else {
            }
        } else {


            $query = 'INSERT INTO payments (id, code, client_name, client_phone, amt, r_id) VALUES(?,?,?,?,?,?)';
            /* Update Reservation Status Set To Paid */
            $reservationqry = "UPDATE reservations SET status = 'Paid' WHERE id = '$r_id'";
            $stmt = $mysqli->prepare($query);
            $reservationstmt = $mysqli->prepare(($reservationqry));
            $rc = $stmt->bind_param(
                'ssssss',
                $id,
                $code,
                $client_name,
                $client_phone,
                $amt,
                $r_id
            );
            $stmt->execute();
            $reservationstmt->execute();
            if ($stmt) {
                $success = 'Client Account Parking Reservation Paid' && header('refresh:1; url=reservations.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Paid Reservations */
if (isset($_POST['update_payment'])) {
    //Error Handling and prevention of posting double entries
    $error = 0;

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = mysqli_real_escape_string($mysqli, trim($_POST['id']));
    } else {
        $error = 1;
        $err = 'ID Cannot Be Empty';
    }

    if (isset($_POST['code']) && !empty($_POST['code'])) {
        $code = mysqli_real_escape_string($mysqli, trim($_POST['code']));
    } else {
        $error = 1;
        $err = 'Payment Code Cannot Be Empty';
    }

    if (isset($_POST['client_name']) && !empty($_POST['client_name'])) {
        $client_name = mysqli_real_escape_string($mysqli, trim($_POST['client_name']));
    } else {
        $error = 1;
        $err = 'Client Name Cannot Be Empty';
    }

    if (isset($_POST['client_phone']) && !empty($_POST['client_phone'])) {
        $client_phone = mysqli_real_escape_string($mysqli, trim((($_POST['client_phone']))));
    } else {
        $error = 1;
        $err = 'Client Phone  Cannot Be Empty';
    }


    if (isset($_POST['r_id']) && !empty($_POST['r_id'])) {
        $r_id  = mysqli_real_escape_string($mysqli, trim($_POST['r_id']));
    } else {
        $error = 1;
        $err = 'Parking Reservation ID Cannot  Be Empty';
    }


    if (isset($_POST['amt']) && !empty($_POST['amt'])) {
        $amt = mysqli_real_escape_string($mysqli, trim($_POST['amt']));
    } else {
        $error = 1;
        $err = 'Parking Amount Number Be Empty';
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = mysqli_real_escape_string($mysqli, trim($_POST['status']));
    } else {
        $error = 1;
        $err = 'Reservation Status Number Be Empty';
    }


    if (!$error) {

        $query = 'UPDATE  payments SET  code =?, client_name =?, client_phone =?, amt =?, r_id =? WHERE id =?';
        /* Update Reservation Status Set To Paid */
        $reservationqry = "UPDATE reservations SET status = 'Paid' WHERE id = '$r_id'";
        $stmt = $mysqli->prepare($query);
        $reservationstmt = $mysqli->prepare(($reservationqry));
        $rc = $stmt->bind_param(
            'ssssss',
            $code,
            $client_name,
            $client_phone,
            $amt,
            $r_id,
            $id
        );
        $stmt->execute();
        $reservationstmt->execute();
        if ($stmt) {
            $success = 'Client Account Parking Reservation Payment Updated' && header('refresh:1; url=payments.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}


/* Delete Payment */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM payments WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=payments.php');
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
                            <a href="add_payment.php" class="btn btn-primary waves-effect waves-light m-r-5 m-t-10">Add Parking Lot Payment</a>
                        </div>
                        <h4 class="page-title">Reservations Payments</h4>
                    </div>
                </div>
            </div>

            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Payment Code</th>
                                    <th>Parking Fee</th>
                                    <th>Client Name</th>
                                    <th>Phone No</th>
                                    <th>Date Paid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM `payments` ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($pay = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $pay->code; ?></td>
                                        <td>Ksh <?php echo $pay->amt; ?></td>
                                        <td><?php echo $pay->client_name; ?></td>
                                        <td><?php echo $pay->client_phone; ?></td>
                                        <td><?php echo date('d M Y g:ia', strtotime($pay->created_at)); ?></td>
                                        <td>
                                            
                                            <a href="#update-<?php echo $pay->id; ?>" data-toggle="modal" class="badge bg-warning">Update</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="update-<?php echo $pay->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update <?php echo $pay->client_name ?> Reservation Payment</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" required name="id" value="<?php echo $pay->id; ?>" class="form-control">
                                                                        <input type="hidden" required name="r_id" value="<?php echo $pay->r_id; ?>" class="form-control">
                                                                        <input type="hidden" required name="status" value="Paid" class="form-control">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Phone Number</label>
                                                                            <input type="text" value="<?php echo $pay->client_phone; ?>" required name="client_phone" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Name</label>
                                                                            <input type="text" value="<?php echo $pay->client_name; ?>" required name="client_name" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Fee</label>
                                                                            <input type="text" required name="amt" value="<?php echo $pay->amt; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Payment Code</label>
                                                                            <input type="text" required value="<?php echo $pay->code; ?>" name="code" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_payment" class="btn btn-primary">Submit</button>
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

                                            <a href="#delete-<?php echo $pay->id; ?>" class="badge bg-danger" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100">Delete</a>
                                            <!-- Delete Modal -->
                                            <div id="delete-<?php echo $pay->id; ?>" class="modal-demo">
                                                <button type="button" class="close" onclick="Custombox.modal.close();">
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="custom-modal-title">Confirm Deletion</h4>
                                                <div class="text-center">
                                                    <h4>Delete <?php echo $pay->client_name; ?> Parking Reservation Payment ? </h4>
                                                    <br>
                                                    <button type="button" class="text-center btn btn-success" onclick="Custombox.modal.close();">No</button>
                                                    <a href="payments.php?delete=<?php echo $pay->id; ?>" class="text-center btn btn-danger"> Delete </a>
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