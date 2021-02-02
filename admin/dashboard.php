<?php
session_start();
include('../config/config.php');
require_once('../partials/head.php');
?>

<body>

    <!-- Navigation Bar-->
    <?php require_once("../partials/admin_nav.php");?>
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
                        <h2 class="m-b-20" data-plugin="counterup">1,587</h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card-box tilebox-one">
                        <i class="zmdi zmdi-money-box float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Reservations Revenue</h6>
                        <h2 class="m-b-20">$<span data-plugin="counterup">46,782</span></h2>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card-box tilebox-one">
                        <i class="zmdi zmdi-accounts-alt float-right text-muted"></i>
                        <h6 class="text-muted text-uppercase m-b-20">Clients</h6>
                        <h2 class="m-b-20">$<span data-plugin="counterup">15.9</span></h2>
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
                                        <th>Company</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Envato Pty Ltd.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-danger">Unpaid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Dribbble LLC.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Adobe Family</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-danger">Unpaid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Envato Pty Ltd.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
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
                                        <th>Company</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Envato Pty Ltd.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-danger">Unpaid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Dribbble LLC.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Adobe Family</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Apple Technology</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-danger">Unpaid</span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Envato Pty Ltd.</th>
                                        <td>20/02/2014</td>
                                        <td>19/02/2020</td>
                                        <td><span class="badge badge-success">Paid</span></td>
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


        <!-- Right Sidebar -->
        <div class="side-bar right-bar">
            <div class="nicescroll">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a href="#home-2" class="nav-link active" data-toggle="tab" aria-expanded="false">
                            Activity
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                            Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="home-2">
                        <div class="timeline-2">
                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 minutes ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">30 minutes ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">59 minutes ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">1 hour ago</small>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">3 hours ago</small>
                                    <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <small class="text-muted">5 hours ago</small>
                                    <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="messages-2">

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Notifications</h5>
                                <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">API Access</h5>
                                <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Auto Updates</h5>
                                <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small" />
                            </div>
                        </div>

                        <div class="row m-t-10">
                            <div class="col-8">
                                <h5 class="m-0">Online Status</h5>
                                <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                            </div>
                            <div class="col-4 text-right">
                                <input type="checkbox" checked data-plugin="switchery" data-color="#1bb99a" data-size="small" />
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end nicescroll -->
        </div>
        <!-- /Right-bar -->


    </div> <!-- End wrapper -->
    <?php require_once("../partials/scripts.php"); ?>
</body>

</html>