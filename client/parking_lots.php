<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
client();
include('../config/codeGen.php');

/* Add Reservations */
if (isset($_POST['add_reservation'])) {
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


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  reservations WHERE  code='$code' ";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $code = $row['code']
            ) {
                $err =  "Client Parking Reservation With That Code Number Already Exists ";
            } else {
            }
        } else {

            $query = 'INSERT INTO reservations (id, code, client_name, client_phone, car_regno, lot_number, parking_duration, parking_date, amt, status) VALUES(?,?,?,?,?,?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'ssssssssss',
                $id,
                $code,
                $client_name,
                $client_phone,
                $car_regno,
                $lot_number,
                $parking_duration,
                $parking_date,
                $amt,
                $status
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Client Account Parking Reservation Added' && header('refresh:1; url=parking_lots.php');
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
    <?php
    require_once('../partials/client_nav.php');
    /* 
        Load Logged In User Details Here To Avoid 
        Re entering them on reservations
     */
    $id  = $_SESSION['id'];
    $ret = "SELECT * FROM  clients  WHERE id = '$id'";
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
                            <h4 class="page-title">Parking Lots</h4>
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
                                        <th>Code Number</th>
                                        <th>Parking Lot Location</th>
                                        <th>Parking Slots</th>
                                        <th>Price Per Slot</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $ret = 'SELECT * FROM `parking_lots` ';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($parking = $res->fetch_object()) { ?>
                                        <tr>
                                            <td><?php echo $parking->code; ?></td>
                                            <td><?php echo $parking->location; ?></td>
                                            <td><?php echo $parking->parking_slots; ?></td>
                                            <td>Ksh <?php echo $parking->price_per_slot; ?></td>
                                            <td>
                                                <a href="#reserve-<?php echo $parking->id; ?>" data-toggle="modal" class="badge bg-warning">Reserve Parking Lot</a>
                                                <!-- Update Modal -->
                                                <div class="modal fade" id="reserve-<?php echo $parking->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Reserve A Parking Slot On <?php echo $parking->code; ?></h5>
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
                                                                            <input type="hidden" required name="status" value="Pending" class="form-control">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Client Name</label>
                                                                                <input type="text" required name="client_name" value="<?php echo $client->name; ?>" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Client Phone Number</label>
                                                                                <input type="text" required name="client_phone" value="<?php echo $client->phone; ?>" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Client Car Reg Number</label>
                                                                                <input type="text" required value="<?php echo $client->car_regno; ?>" name="car_regno" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="">Parking Duration (Hours)</label>
                                                                                <input type="text" required name="parking_duration" class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-4">
                                                                                <input type="hidden" required name="code" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-4">
                                                                                <input type="hidden" required name="lot_number" value="<?php echo $parking->code; ?>" class="form-control">
                                                                            </div>
                                                                            <div class="form-group col-md-4">
                                                                                <input type="hidden" required name="amt" value="<?php echo $parking->price_per_slot; ?>" class="form-control">
                                                                            </div>

                                                                            <div class="form-group col-md-12">
                                                                                <label for="">Parking Date And Time</label>
                                                                                <input type="text" value="<?php echo date('d M Y g:ia'); ?>" required name="parking_date" class="form-control">
                                                                            </div>

                                                                        </div>
                                                                        <div class="text-right">
                                                                            <button type="submit" name="add_reservation" class="btn btn-primary">Submit</button>
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
    <?php require_once("../partials/scripts.php");
    } ?>

</body>

</html>