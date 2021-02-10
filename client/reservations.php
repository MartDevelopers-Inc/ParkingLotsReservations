<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
client();
include('../config/codeGen.php');

/* Update Client Reservations */
if (isset($_POST['update_reservation'])) {
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
        $err = 'Reservation Code Cannot Be Empty';
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

    if (isset($_POST['car_regno']) && !empty($_POST['car_regno'])) {
        $car_regno = mysqli_real_escape_string($mysqli, trim($_POST['car_regno']));
    } else {
        $error = 1;
        $err = 'Client Car Reg Number Cannot Be Empty';
    }

    if (isset($_POST['lot_number']) && !empty($_POST['lot_number'])) {
        $lot_number = mysqli_real_escape_string($mysqli, trim($_POST['lot_number']));
    } else {
        $error = 1;
        $err = 'Parking Lot Number Be Empty';
    }

    if (isset($_POST['parking_duration']) && !empty($_POST['parking_duration'])) {
        $parking_duration = mysqli_real_escape_string($mysqli, trim($_POST['parking_duration']));
    } else {
        $error = 1;
        $err = 'Parking Duration Cannot  Be Empty';
    }

    if (isset($_POST['parking_date']) && !empty($_POST['parking_date'])) {
        $parking_date = mysqli_real_escape_string($mysqli, trim($_POST['parking_date']));
    } else {
        $error = 1;
        $err = 'Parking Date Number Be Empty';
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


    $query = 'UPDATE reservations SET  code =?, client_name =?, client_phone =?, car_regno=?, lot_number =?, parking_duration =?, parking_date =?, amt =?, status =? WHERE id = ?';
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param(
        'ssssssssss',
        $code,
        $client_name,
        $client_phone,
        $car_regno,
        $lot_number,
        $parking_duration,
        $parking_date,
        $amt,
        $status,
        $id
    );
    $stmt->execute();
    if ($stmt) {
        $success =
            'Client Account Parking Reservation Updated' && header('refresh:1; url=reservations.php');
    } else {
        $info = 'Please Try Again Or Try Later';
    }
}

/* Delete Reservations */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM reservations WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=reservations.php');
        //inject alert that task failed
        $info = 'Deleted';
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
                            <a href="parking_lots.php" class="btn btn-primary waves-effect waves-light m-r-5 m-t-10" >Add Parking Lot Reservation</a>
                        </div>
                        <h4 class="page-title">My Reservations</h4>
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
                                    <th>My Name</th>
                                    <th>My Phone No</th>
                                    <th>Car Regno</th>
                                    <th>Lot No</th>
                                    <th>Fee</th>
                                    <th>Parking Duration</th>
                                    <th>Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $phone = $_SESSION['phone'];
                                $ret = "SELECT * FROM `reservations` WHERE client_phone = '$phone' ";
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($reserv = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $reserv->client_name; ?></td>
                                        <td><?php echo $reserv->client_phone; ?></td>
                                        <td><?php echo $reserv->car_regno; ?></td>
                                        <td><?php echo $reserv->lot_number; ?></td>
                                        <td>Ksh <?php echo $reserv->amt; ?></td>
                                        <td><?php echo $reserv->parking_duration; ?> Hours</td>
                                        <td><?php echo $reserv->parking_date; ?></td>
                                        <td>
                                            <!-- Only Give Ticket When Reservation Is Paid -->
                                            <?php
                                            if ($reserv->status == 'Paid') {
                                                echo "<a href='#receipt-$reserv->id' data-toggle='modal' class='badge bg-success'>Receipt</a>
                                                ";
                                            } else {
                                                //Nothing
                                            }
                                            ?>
                                            <div class="modal fade" id="receipt-<?php echo $reserv->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="exampleModalLabel"><?php echo $reserv->client_name ?> Parking Receipt</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card" id="Print">
                                                                <div class="card-header text-center">
                                                                    Parking Receipt
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5 class="card-title text-center"><?php echo $reserv->client_name; ?> - <?php echo $reserv->client_phone; ?></h5>
                                                                    <p class="card-text">
                                                                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Reservation Code</th>
                                                                                <th>Car Regno</th>
                                                                                <th>Parking Lot No</th>
                                                                                <th>Paid Parking Fee</th>
                                                                                <th>Parking Duration</th>
                                                                                <th>Date Reserved</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?php echo $reserv->code; ?></td>
                                                                                <td><?php echo $reserv->car_regno; ?></td>
                                                                                <td><?php echo $reserv->lot_number; ?></td>
                                                                                <td>Ksh <?php echo $reserv->amt; ?></td>
                                                                                <td><?php echo $reserv->parking_duration; ?> Hours</td>
                                                                                <td><?php echo $reserv->parking_date; ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    </p>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <small class="text-muted">Generated On <?php echo date('d M Y g:ia'); ?></small>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button id="print" onclick="printContent('Print');" type="button" class="btn btn-primary">Print</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a href="#update-<?php echo $reserv->id; ?>" data-toggle="modal" class="badge bg-warning">Update</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="update-<?php echo $reserv->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update <?php echo $reserv->client_name ?> Reservation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" required name="id" value="<?php echo $reserv->id; ?>" class="form-control">
                                                                        <input type="hidden" required name="status" value="Pending" class="form-control">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Phone Number</label>
                                                                            <input type="text" value="<?php echo $reserv->client_phone; ?>" required name="client_phone" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Name</label>
                                                                            <input type="text" value="<?php echo $reserv->client_name; ?>" required name="client_name" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Client Car Reg Number</label>
                                                                            <input type="text" required value="<?php echo $reserv->car_regno; ?>" name="car_regno" class="form-control">
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Reservation Code</label>
                                                                            <input type="text" required  readonly name="code" value="<?php echo $a?>-<?php echo $b;?>" class="form-control">
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Lot Number</label>
                                                                            <input type="text" required name="lot_number" readonly value="<?php echo $reserv->lot_number; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Fee</label>
                                                                            <input type="text" required name="amt" readonly value="<?php echo $reserv->amt; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Duration (Hours)</label>
                                                                            <input type="text" required value="<?php echo $reserv->parking_duration; ?>" name="parking_duration" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Date And Time</label>
                                                                            <input type="text" value="<?php echo date('d M Y g:ia'); ?>" required name="parking_date" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_reservation" class="btn btn-primary">Submit</button>
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

                                            <a href="#delete-<?php echo $reserv->id; ?>" class="badge bg-danger" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100">Delete</a>
                                            <!-- Delete Modal -->
                                            <div id="delete-<?php echo $reserv->id; ?>" class="modal-demo">
                                                <button type="button" class="close" onclick="Custombox.modal.close();">
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="custom-modal-title">Confirm Deletion</h4>
                                                <div class="text-center">
                                                    <h4>Delete <?php echo $reserv->client_name; ?> Parking Reservation ? </h4>
                                                    <br>
                                                    <button type="button" class="text-center btn btn-success" onclick="Custombox.modal.close();">No</button>
                                                    <a href="reservations.php?delete=<?php echo $reserv->id; ?>" class="text-center btn btn-danger"> Delete </a>
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