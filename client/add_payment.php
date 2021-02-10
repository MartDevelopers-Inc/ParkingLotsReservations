<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
client();
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
                $success = 'Client Account Parking Reservation Paid' && header('refresh:1; url=add_payment.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

require_once("../partials/head.php");
?>

<body>

    <!-- Navigation Bar-->
    <?php require_once('../partials/client_nav.php'); ?>
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
                        <h4 class="page-title">My Unpaid Reservations</h4>
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
                                    <th>Code</th>
                                    <th>Client Name</th>
                                    <th>Phone No</th>
                                    <th>Car Regno</th>
                                    <th>Lot No</th>
                                    <th>Fee</th>
                                    <th>Parking Duration</th>
                                    <th>Date Reserved</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $phone = $_SESSION['phone'];
                                $ret = "SELECT * FROM `reservations` WHERE status !='Paid' AND client_phone = '$phone' ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($reserv = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $reserv->code; ?></td>
                                        <td><?php echo $reserv->client_name; ?></td>
                                        <td><?php echo $reserv->client_phone; ?></td>
                                        <td><?php echo $reserv->car_regno; ?></td>
                                        <td><?php echo $reserv->lot_number; ?></td>
                                        <td>Ksh <?php echo $reserv->amt; ?></td>
                                        <td><?php echo $reserv->parking_duration; ?> Hours</td>
                                        <td><?php echo $reserv->parking_date; ?></td>
                                        <td>
                                            <a href="#pay-<?php echo $reserv->id; ?>" data-toggle="modal" class="badge bg-warning">Add Payment</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="pay-<?php echo $reserv->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Pay <?php echo $reserv->client_name ?> Reservation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" required name="id" value="<?php echo $ID; ?>" class="form-control">
                                                                        <input type="hidden" required name="r_id" value="<?php echo $reserv->id; ?>" class="form-control">
                                                                        <input type="hidden" required name="status" value="Paid" class="form-control">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Phone Number</label>
                                                                            <input type="text" value="<?php echo $reserv->client_phone; ?>" required name="client_phone" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Name</label>
                                                                            <input type="text" value="<?php echo $reserv->client_name; ?>" required name="client_name" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Fee</label>
                                                                            <input type="text" required name="amt" value="<?php echo $reserv->amt; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Payment Code</label>
                                                                            <input type="text" required value="<?php echo $paycode; ?>" name="code" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="pay_reservations" class="btn btn-primary">Submit</button>
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