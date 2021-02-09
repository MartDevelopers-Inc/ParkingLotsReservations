<!-- jQuery  -->
<script src="../public/js/jquery.min.js"></script>
<script src="../public/js/bootstrap.bundle.min.js"></script>
<script src="../public/js/detect.js"></script>
<script src="../public/js/waves.js"></script>
<script src="../public/js/jquery.nicescroll.js"></script>
<script src="../public/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="../public/js/jquery.core.js"></script>
<script src="../public/js/jquery.app.js"></script>

<!-- Sweet Alerts -->
<script src="../public/plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="../public/plugins/sweetalerts/custom-sweetalert.js"></script>

<!-- Counter Up  -->
<script src="../public/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="../public/plugins/counterup/jquery.counterup.js"></script>

<!-- Required datatable js -->
<script src="../public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../public/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="../public/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatables/buttons.bootstrap4.min.js"></script>
<script src="../public/plugins/datatables/jszip.min.js"></script>
<script src="../public/plugins/datatables/pdfmake.min.js"></script>
<script src="../public/plugins/datatables/vfs_fonts.js"></script>
<script src="../public/plugins/datatables/buttons.html5.min.js"></script>
<script src="../public/plugins/datatables/buttons.print.min.js"></script>

<!-- Key Tables -->
<script src="../public/plugins/datatables/dataTables.keyTable.min.js"></script>

<!-- Responsive examples -->
<script src="../public/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../public/plugins/datatables/responsive.bootstrap4.min.js"></script>

<!-- Selection table -->
<script src="../public/plugins/datatables/dataTables.select.min.js"></script>
<script>
    $(document).ready(function() {

        // Default Datatable
        $('#datatable').DataTable();

        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });

        // Responsive Datatable
        $('#responsive-datatable').DataTable();

        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });

        table.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Modal-Effect -->
<script src="../public/plugins/custombox/js/custombox.min.js"></script>
<script src="../public/plugins/custombox/js/custombox.legacy.min.js"></script>

<!-- Ajaxing -->
<script>
    /* Client Details Asyc */
    function getClientDetails(val) {
        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'Phone=' + val,
            success: function(data) {
                //alert(data);
                $('#Name').val(data);
            }
        });

        $.ajax({

            type: "POST",
            url: "../partials/ajax.php",
            data: 'Name=' + val,
            success: function(data) {
                //alert(data);
                $('#CarRegno').val(data);
            }
        });
    }


    /* Parking Lot Details */
    function getParkingDetails(val) {
        $.ajax({
            type: "POST",
            url: "../partials/ajax.php",
            data: 'ParkingLotNumber=' + val,
            success: function(data) {
                //alert(data);
                $('#ParkingFee').val(data);
            }
        });
    }
</script>
<!-- Print Inside Div -->
<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>