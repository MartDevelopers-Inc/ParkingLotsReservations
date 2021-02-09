<?php
session_start();
include('../config/config.php');
require_once('../config/checklogin.php');
admin();
include('../config/codeGen.php');

if (isset($_POST['add_ipcam'])) {
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
        $err = 'IP  Code Cannot Be Empty';
    }

    if (isset($_POST['stream_url']) && !empty($_POST['stream_url'])) {
        $stream_url = mysqli_real_escape_string($mysqli, trim($_POST['stream_url']));
    } else {
        $error = 1;
        $err = 'Stream URL  Cannot Be Empty';
    }


    if (!$error) {
        //prevent Double entries
        $sql = "SELECT * FROM  ip_cameras WHERE  code='$code'";
        $res = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            if (
                $code = $row['code']
            ) {
                $err =  "IP Camera With That  Code Already Exists ";
            } else {
            }
        } else {

            $query = 'INSERT INTO ip_cameras (id, code, stream_url) VALUES(?,?,?)';
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param(
                'sss',
                $id,
                $code,
                $stream_url
            );
            $stmt->execute();
            if ($stmt) {
                $success =
                    'IP Camera Added' && header('refresh:1; url=cctv.php');
            } else {
                $info = 'Please Try Again Or Try Later';
            }
        }
    }
}

/* Update Slots */
if (isset($_POST['update_ipcam'])) {
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
        $err = 'IP  Code Cannot Be Empty';
    }

    if (isset($_POST['stream_url']) && !empty($_POST['stream_url'])) {
        $stream_url = mysqli_real_escape_string($mysqli, trim($_POST['stream_url']));
    } else {
        $error = 1;
        $err = 'Stream URL  Cannot Be Empty';
    }


    if (!$error) {


        $query = 'UPDATE ip_cameras SET  code =?, stream_url =? WHERE id =?';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sss',
            $code,
            $stream_url,
            $id
        );
        $stmt->execute();
        if ($stmt) {
            $success =
                'IP Camera Updated' && header('refresh:1; url=cctv.php');
        } else {
            $info = 'Please Try Again Or Try Later';
        }
    }
}

/* Delete Slots */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $adn = 'DELETE FROM ip_cameras WHERE id=?';
    $stmt = $mysqli->prepare($adn);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->close();
    if ($stmt) {
        $success = 'Deleted' && header('refresh:1; url=cctv.php');
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
                            <a href="#add_modal" class="btn btn-primary waves-effect waves-light m-r-5 m-t-10" data-animation="door" data-plugin="custommodal" data-overlaySpeed="100" data-overlayColor="#36404a">Add IP Camera</a>
                        </div>
                        <h4 class="page-title">Parking Lots IP Cameras</h4>
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
                                <div class="form-group col-md-12">
                                    <label for="">IP Camera Code</label>
                                    <input type="text" required name="code" value="<?php echo $a; ?>-<?php echo $b; ?>" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="">IP Camera Stream Url</label>
                                    <input type="text" required name="stream_url" value="" class="form-control">
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" name="add_ipcam" class="btn btn-primary">Submit</button>
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
                                    <th>IP Camera Code</th>
                                    <th>Streaming URL</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $ret = 'SELECT * FROM `ip_cameras` ';
                                $stmt = $mysqli->prepare($ret);
                                $stmt->execute(); //ok
                                $res = $stmt->get_result();
                                while ($ip = $res->fetch_object()) { ?>
                                    <tr>
                                        <td><?php echo $ip->code; ?></td>
                                        <td><?php echo $ip->stream_url; ?></td>
                                        <td>
                                            <a href="#stream-<?php echo $ip->id; ?>" data-toggle="modal" class="badge bg-success">Stream</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="stream-<?php echo $ip->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="embed-responsive embed-responsive-16by9">
                                                                <iframe width="560" height="315" src="<?php echo $ip->stream_url;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                                            </div>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <button type="button" class="pull-left btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#update-<?php echo $ip->id; ?>" data-toggle="modal" class="badge bg-warning">Update</a>
                                            <!-- Update Modal -->
                                            <div class="modal fade" id="update-<?php echo $ip->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                        <input type="hidden" required name="id" value="<?php echo $ip->id; ?>" class="form-control">
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">IP Camera Code</label>
                                                                            <input type="text" required name="code" value="<?php echo $ip->code; ?>" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label for="">IP Camera Stream Url</label>
                                                                            <input type="text" required name="stream_url" value="<?php echo $ip->stream_url; ?>" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-right">
                                                                        <button type="submit" name="update_ipcam" class="btn btn-primary">Submit</button>
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

                                            <a href="#delete-<?php echo $ip->id; ?>" class="badge bg-danger" data-animation="makeway" data-plugin="custommodal" data-overlaySpeed="100">Delete</a>
                                            <!-- Delete Modal -->
                                            <div id="delete-<?php echo $ip->id; ?>" class="modal-demo">
                                                <button type="button" class="close" onclick="Custombox.modal.close();">
                                                    <span>&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="custom-modal-title">Confirm Deletion</h4>
                                                <div class="text-center">
                                                    <h4>Delete <?php echo $ip->code; ?> ? </h4>
                                                    <br>
                                                    <button type="button" class="text-center btn btn-success" onclick="Custombox.modal.close();">No</button>
                                                    <a href="cctv.php?delete=<?php echo $ip->id; ?>" class="text-center btn btn-danger"> Delete </a>
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