<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>iCollege Information Management System</title>
    <link rel="icon" type="image/x-icon" href="../public/img/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="../public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Plugis -->
    <link href="../public/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- Auth Forms -->
    <link href="../public/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../public/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="../public/css/forms/switches.css">
    <!-- Dashboard  -->
    <link href="../public/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <!-- Loaders -->
    <link href="../public/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="../public/js/loader.js"></script>
    <!-- Apex Charts -->
    <link href="../public/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <!-- Account Settings -->
    <link href="../public/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="../public/plugins/table/datatable/dt-global_style.css">
    <!-- Animate -->
    <link href="../public/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- CustomModals -->
    <link href="../public/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="../public/css/components/custom-modal.css" rel="stylesheet" type="text/css" />
    <!-- Select -->
    <link rel="stylesheet" type="text/css" href="../public/plugins/select2/select2.min.css">
    <!-- Sweet Alerts -->
    <script src="../public/plugins/sweetalerts/promise-polyfill.js"></script>
    <link href="../public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="../public/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- Init Swal -->
    <?php if (isset($success)) { ?>
        <!--This code for injecting success alert-->
        <script>
            setTimeout(function() {
                    swal(
                        "Success", "<?php echo $success; ?>", "success",
                    );
                },
                100);
        </script>

    <?php } ?>

    <?php if (isset($err)) { ?>
        <!--This code for injecting error alert-->
        <script>
            setTimeout(function() {
                    swal("Failed", "<?php echo $err; ?>", "error", );
                },
                100);
        </script>

    <?php } ?>
    <?php if (isset($info)) { ?>
        <!--This code for injecting info alert-->
        <script>
            setTimeout(function() {
                    swal("Success", "<?php echo $info; ?>", "warning");
                },
                100);
        </script>

    <?php }
    ?>
</head>