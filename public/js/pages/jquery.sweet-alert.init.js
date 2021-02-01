/**
 * Template Name: Uplon bootstrap 4 Admin Template
 * Author: Coderthemes
 * SweetAlert
 */

!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples 
    SweetAlert.prototype.init = function () {

        //Basic
        $('#sa-basic').click(function () {
            Swal.fire("Here's a message!");
        });

        //A title with a text under
        $('#sa-title').click(function () {
            Swal.fire("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis")
        });

        //Success Message
        $('#sa-success').click(function () {
            Swal.fire("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat, tincidunt vitae ipsum et, pellentesque maximus enim. Mauris eleifend ex semper, lobortis purus sed, pharetra felis", "success")
        });

        //Warning Message
        $('#sa-warning').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });

        //Parameter
        $('#sa-params').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        });

        //Custom Image
        $('#sa-image').click(function () {
            Swal.fire({
                title: "Sweet!",
                text: "Here's a custom image.",
                imageUrl: "../plugins/sweetalert2/thumbs-up.jpg",
                imageHeight: 64,
            });
        });

        //Auto Close Timer
        $('#sa-close').click(function () {
            let timerInterval
                Swal.fire({
                title: 'Auto close alert!',
                html: 'I will close in <strong></strong> seconds.',
                timer: 2000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    timerInterval = setInterval(() => {
                    Swal.getContent().querySelector('strong')
                        .textContent = Swal.getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                if (
                    // Read more about handling dismissals
                    result.dismiss === Swal.DismissReason.timer
                ) {
                    console.log('I was closed by the timer')
                }
            })
        });

        //Primary
        $('#primary-alert').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "info",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect waves-light',
                confirmButtonClass: 'btn-primary waves-effect waves-light',
                confirmButtonText: 'Primary!'
            });
        });

        //Info
        $('#info-alert').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "info",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-info waves-effect waves-light',
                confirmButtonText: 'Info!'
            });
        });

        //Success
        $('#success-alert').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "success",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-success waves-effect waves-light',
                confirmButtonText: 'Success!'
            });
        });

        //Warning
        $('#warning-alert').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-warning waves-effect waves-light',
                confirmButtonText: 'Warning!'
            });
        });

        //Danger
        $('#danger-alert').click(function () {
            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "error",
                showCancelButton: true,
                cancelButtonClass: 'btn-secondary waves-effect',
                confirmButtonClass: 'btn-danger waves-effect waves-light',
                confirmButtonText: 'Danger!'
            });
        });


    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);