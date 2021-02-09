<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');
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
                        </div>
                        <h4 class="page-title">Parking Lots Reports</h4>
                    </div>
                </div>
            </div>


            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Code Number</th>
                                    <th>Parking Lot Location</th>
                                    <th>Parking Slots</th>
                                    <th>Price Per Slot</th>
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