<?php
session_start();
include('../config/config.php');
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
                                    <th>Proce Per Slot</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td><?php echo $parking->code;?></td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>

                                    </td>
                                </tr>

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