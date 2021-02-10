<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body>

    <!-- Navigation Bar-->
    <?php require_once("../partials/admin_nav.php"); ?>
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
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card-box tilebox-one">
                        <i class="zmdi zmdi-traffic float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Parking Lots</h6>
                        <h2 class="m-b-20" data-plugin="counterup"><?php echo $parking_lots; ?></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card-box tilebox-one">
                        <i class="zmdi zmdi-money-box float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Reservations Revenue</h6>
                        <h2 class="m-b-20">Ksh <span data-plugin="counterup"><?php echo $reservations_revenue; ?></span></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card-box tilebox-one">
                        <i class="zmdi zmdi-accounts-alt float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Clients</h6>
                        <h2 class="m-b-20"><span data-plugin="counterup"><?php echo $clients; ?></span></h2>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-xl-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Recent Reservations</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Client Name</th>
                                        <th>Car RegNo</th>
                                        <th>Parking Lot No</th>
                                        <th>Parking Duration</th>
                                        <th>Reservation Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = 'SELECT * FROM `reservations` ';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($resev = $res->fetch_object()) { ?>
                                        <tr>
                                            <th class="text-muted"><?php echo $resev->code; ?></th>
                                            <td><?php echo $resev->client_name; ?></td>
                                            <td><?php echo $resev->car_regno; ?></td>
                                            <td><?php echo $resev->lot_number; ?></td>
                                            <td><?php echo $resev->parking_duration; ?> Hours</td>
                                            <td><?php echo $resev->parking_date; ?></td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">Recent Reservation Payment</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Amt Paid</th>
                                        <th>Client Name</th>
                                        <th>Client Phone No</th>
                                        <th>Paid On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ret = 'SELECT * FROM `payments`';
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    while ($pay = $res->fetch_object()) { ?>
                                        <tr>
                                            <th><span class="badge bg-success"> <?php echo $pay->code; ?> </span></th>
                                            <td><?php echo $pay->amt; ?></td>
                                            <td><?php echo $pay->client_name; ?></td>
                                            <td><?php echo $pay->client_phone; ?></td>
                                            <td><span class="badge badge-success"><?php echo date('d M Y g:ia', strtotime($pay->created_at)); ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php require_once("../partials/footer.php"); ?>
        <!-- End Footer -->
    </div> <!-- End wrapper -->
    <?php require_once("../partials/scripts.php"); ?>
</body>

</html>