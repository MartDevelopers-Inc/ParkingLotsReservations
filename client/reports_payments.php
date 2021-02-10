<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
client();
include('../config/codeGen.php');

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
                        <h4 class="page-title">My Reservations Payments Reports</h4>
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
                                    <th>Payment Code</th>
                                    <th>Parking Fee</th>
                                    <th>Client Name</th>
                                    <th>Phone No</th>
                                    <th>Date Paid</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $phone = $_SESSION['phone'];
                                $ret = "SELECT * FROM `payments` WHERE client_phone = '$phone' ";
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