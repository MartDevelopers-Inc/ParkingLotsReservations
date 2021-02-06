<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="MartDevelopers Inc">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App title -->
    <title>Parking Lots Reseration System - Instilling Innovation And Automation In Car Parking Lots Reservations</title>

    <!-- Bootstrap CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- App CSS -->
    <link href="../public/css/style.css" rel="stylesheet" type="text/css" />

    <!-- Modernizr js -->
    <script src="../public/js/modernizr.min.js"></script>

    <!-- DataTables -->
    <link href="../public/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="../puclic/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="../public/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Multi Item Selection examples -->
    <link href="../public/plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom box css -->
    <link href="../public/plugins/custombox/css/custombox.min.css" rel="stylesheet">

    <!-- Sweet Alerts -->
    <link href="../public/plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="../public/plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
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