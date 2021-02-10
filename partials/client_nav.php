<?php
$id  = $_SESSION['id'];
$ret = "SELECT * FROM  clients  WHERE id = '$id'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($logged_in_user = $res->fetch_object()) {
?>
    <header id="topnav">
        <div class="topbar-main">
            <div class="container">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="dashboard.php" class="logo">
                        <i class="fa fa-car icon-c-logo"></i>
                        <span>CPRS</span>
                    </a>
                </div>
                <!-- End Logo container-->


                <div class="menu-extras navbar-topbar">

                    <ul class="list-inline float-right mb-0">

                        <li class="list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>


                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="../public/uploads/sys_logo/admin.svg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! <?php echo $logged_in_user->name; ?></small> </h5>
                                </div>

                                <!-- item-->
                                <a href="profile.php" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                </div> <!-- end menu-extras -->
                <div class="clearfix"></div>

            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->


        <div class="navbar-custom">
            <div class="container">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li>
                            <a href="dashboard.php"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                        </li>

                        <li>
                            <a href="parking_lots.php"><i class="zmdi zmdi-traffic"></i> <span> Parking Lots </span> </a>
                        </li>

                        

                        <li>
                            <a href="reservations.php"><i class="zmdi zmdi-calendar-check"></i> <span> Reservations </span> </a>
                        </li>

                        <li>
                            <a href="payments.php"><i class="zmdi zmdi-money-box"></i> <span> Payments </span> </a>
                        </li>

                    
                        <li class="has-submenu">
                            <a href="#"><i class="zmdi zmdi-collection-item"></i> <span> Advanced Reporting </span> </a>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="reports_parking_reservations.php">My Parking Reservations</a></li>
                                        <li><a href="reports_payments.php">My Payments</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                    </ul>
                    <!-- End navigation menu  -->
                </div>
            </div>
        </div>
    </header>

<?php
} ?>