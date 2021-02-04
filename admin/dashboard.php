<?php
session_start();
include('../config/config.php');
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
                        <h2 class="m-b-20">Ksh <span data-plugin="counterup"><?php echo $redervations_revenue; ?></span></h2>
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
                <div class="col-xl-6">
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
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="col-xl-6">
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
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                        <th></th>
                                    </tr>
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