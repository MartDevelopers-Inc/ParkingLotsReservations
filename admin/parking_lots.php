<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');
/* Add Parking Slots */
if (isset($_POST['add_parkinglots'])) {
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
        $err = 'Parking Slot Code Cannot Be Empty';
    }

    if (isset($_POST['location']) && !empty($_POST['location'])) {
        $location = mysqli_real_escape_string($mysqli, trim($_POST['location']));
    } else {
        $error = 1;
        $err = 'Parking Lot Location Name Cannot Be Empty';
    }

    if (isset($_POST['parking_slots']) && !empty($_POST['parking_slots'])) {
        $parking_slots = mysqli_real_escape_string($mysqli, trim($_POST['parking_slots']));
    } else {
        $error = 1;
        $err = 'Parking Slots  Cannot Be Empty';
    }

    if (isset($_POST['price_per_slot']) && !empty($_POST['price_per_slot'])) {
        $price_per_slot = mysqli_real_escape_string($mysqli, trim($_POST['price_per_slot']));
    } else {
        $error = 1;
        $err = 'Price Per Slot  Cannot Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  parking_lots WHERE  code='$code'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $code = $row['code']
            ) {
                $err =  "Parking Lot With That Code Already Exists ";
            } else {
            }
        } else {

            $query = 'INSERT INTO parking_lots (id, code, location, parking_slots, price_per_slot) VALUES(?,?,?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'sssss',
                $id,
                $code,
                $location,
                $parking_slots,
                $price_per_slot
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'Parking Lot Added' && header('refresh:1; url=parking_lots.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Slots */
if (isset($_POST['update_parkinglots'])) {
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
        $err = 'Parking Slot Code Cannot Be Empty';
    }

    if (isset($_POST['location']) && !empty($_POST['location'])) {
        $location = mysqli_real_escape_string($mysqli, trim($_POST['location']));
    } else {
        $error = 1;
        $err = 'Parking Lot Location Name Cannot Be Empty';
    }

    if (isset($_POST['parking_slots']) && !empty($_POST['parking_slots'])) {
        $parking_slots = mysqli_real_escape_string($mysqli, trim($_POST['parking_slots']));
    } else {
        $error = 1;
        $err = 'Parking Slots  Cannot Be Empty';
    }

    if (isset($_POST['price_per_slot']) && !empty($_POST['price_per_slot'])) {
        $price_per_slot = mysqli_real_escape_string($mysqli, trim($_POST['price_per_slot']));
    } else {
        $error = 1;
        $err = 'Price Per Slot  Cannot Be Empty';
    }


    if (!$error) {

        $query = 'UPDATE parking_lots SET code =?, location =?, parking_slots =?, price_per_slot =? WHERE id = ?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssss',
            $code,
            $location,
            $parking_slots,
            $price_per_slot,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'Parking Lot Updated' && header('refresh:1; url=parking_lots.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}
/* Delete Slots */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM parking_lots WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=parking_lots.php');
    } else {
        //inject alert that task failed
        $info = 'Please Try Again Or Try Later';
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
                            <a href="#add_modal" class="btn btn-primary waves-effect waves-light m-r-5 m-t-10" data-animation="door" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">Add Parking Lots</a>
                        </div>
                        <h4 class="page-title">Parking Lots</h4>
                    </div>
                </div>
            </div>
            <!-- Add
             Parking Lot Modal -->
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
                                <div class="form-group col-md-6">
                                    <label for="">Parking Lot Code Number</label>
                                    <input type="text" required name="code" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Parking Lot Location</label>
                                    <input type="text" required name="location" value="" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Parking Slots Available</label>
                                    <input type="text" required name="parking_slots" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Parking Price Per Slot Per Hour</label>
                                    <input type="text" required name="price_per_slot" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" name="add_parkinglots" class="btn btn-primary">Submit</button>
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
                                            <a href="#update-<?php echo $parking->id; ?>" data-toggle="modal" class="badge bg-warning">Update</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="update-<?php echo $parking->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update <?php echo $parking->code; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" enctype="multipart/form-data">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <!-- Hide This -->
                                                                        <input type="hidden" required name="id" value="<?php echo $parking->id; ?>" class="form-control">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Lot Code Number</label>
                                                                            <input type="text" required name="code" value="<?php echo $parking->code; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Lot Location</label>
                                                                            <input type="text" required value="<?php echo $parking->location; ?>" name="location" value="" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Slots Available</label>
                                                                            <input type="text" required value="<?php echo $parking->parking_slots; ?>" name="parking_slots" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="">Parking Price Per Slot Per Hour</label>
                                                                            <input type="text" required value="<?php echo $parking->price_per_slot; ?>" name="price_per_slot" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_parkinglots" class="btn btn-primary">Submit</button>
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

                                            <a href="#delete-<?php echo $parking->id; ?>" class="badge bg-danger" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100">Delete</a>
                                            <!-- Delete Modal -->
                                            <div id="delete-<?php echo $parking->id; ?>" class="modal-demo">
                                                <button type="button" class="close" onclick="Custombox.modal.close();">
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="custom-modal-title">Confirm Deletion</h4>
                                                <div class="text-center">
                                                    <h4>Delete <?php echo $parking->code; ?> ? </h4>
                                                    <br>
                                                    <button type="button" class="text-center btn btn-success" onclick="Custombox.modal.close();">No</button>
                                                    <a href="parking_lots.php?delete=<?php echo $parking->id; ?>" class="text-center btn btn-danger"> Delete </a>
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