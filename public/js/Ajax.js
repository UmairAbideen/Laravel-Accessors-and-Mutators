$(document).ready(function () {
   
    $('#example').DataTable({

        //search  placehoder
        language: {
            searchPlaceholder: "Search Records....",
            search: "",
        },

        // length of of pagination
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5 + " per page ", 10 + " per page ", 25 + " per page ", 50 + " per page ", 'All Enteries']
        ],

        // fetch_data.php
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
            'url': 'indexQuery.php',
            'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [6]
        },
        ],
        
    });


    // insert data=========================================================================
    // show modal
    $("#open-modal").on("click", function () {
        $("#add-modal").modal('show');
    });

    //hide edit modal and error status
    $("#close-add-modal").on("click", function () {
        $("#add-modal").modal('hide');
        $('.error-status').css('display', 'none');
    });

    $('#save').on('click', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var age = $('#age').val();
        var gender = $('#gender').val();
        var contact = $('#contact').val();
        var email = $('#email').val();

        if (name == "" || age == "" || gender == "" || contact == "" || email == "") {
            // error message hide when model open without filling input fields
            $('.error-status').css('display', 'block');
            $('.error-status').html('<div class="alert alert-danger d-flex align-items-center rounded-0 mb-1 p-1"> <i class="fas fa-circle-exclamation fs-3 me-2"></i>All fields are required...</div>');
        }
        else {
            $.ajax({
                url: "addQuery.php",
                type: "post",
                data: { name: name, age: age, gender: gender, contact: contact, email: email },
                success: function (data) {
                    if (data == 1) {
                        // data table calling start
                            mytable = $('#example').DataTable();
                            mytable.draw();
                        // data table calling end
                        $("#add-modal").modal("hide");
                        $('#form1').trigger('reset');
                        $('.success-status').html('<div class="alert alert-success d-flex align-items-center rounded-0 mb-1 p-1"> <i class="fas fa-circle-check fs-3 me-2"></i>It has been successfully added...</div>');
                        $('.error-status').css('display', 'none');
                    }
                    else {
                        alert('failed...');
                    }
                }
            });
        }
    });








    // delete data and this method for calling a function used when a dynamic data com from database============
    $(document).on("click", "#Delete", function () {
        var sid = $(this).data("id");
        // alert(sid);
        var element = $(this);//accessing the tr for delte animation // this is optional

        if (confirm('Are you sure want to delete this data ?')) {
            $.ajax({
                url: 'deleteQuery.php',
                type: "post",
                data: { id: sid },
                success: function (data) {
                    if (data == 1) {
                        // data table calling start
                            mytable = $('#example').DataTable();
                            mytable.draw();
                        // data table calling end
                        $('.success-status').html('<div class="alert alert-success d-flex align-items-center rounded-0 mb-1 p-1"> <i class="fas fa-circle-check fs-3 me-2"></i>It has been successfully deleted...</div>');
                        // for animated delete out for everyone row // this is optional
                        $(element).closest("tr").fadeOut();
                    }
                    else {
                        alert('failed');
                    }
                }
            });
        }
    });








    // edit data==========================================================================================================
    // show edit modal
    $(document).on("click", "#Edit", function () {
        $("#edit-modal").modal("show");
        var sid = $(this).data("id");

        //hide edit modal and error status
        $("#close-edit-modal").on("click", function () {
            $("#edit-modal").modal('hide');
            $('.error-status').css('display', 'none');
        });

        // alert(sid) for testing ids
        $.ajax({
            url: "editQuery.php",
            type: "post",
            data: { id: sid },
            success: function (data) {
                $("#form2").html(data);
            }
        });
    });








    // update data==========================================================================================================
    $(document).on("click", "#update", function (e) {
        e.preventDefault();
        var sid = $('#id').val();
        var name = $('#update-name').val();
        var age = $('#update-age').val();
        var gender = $('#update-gender').val();
        var contact = $('#update-contact').val();
        var email = $('#update-email').val();

        if (name == "" || age == "" || gender == "" || contact == "" || email == "") {
            // error message hide when model open without filling input fields
            $('.error-status').css('display', 'block');
            $('.error-status').html('<div class="alert alert-danger d-flex align-items-center rounded-0 mb-1 p-1"> <i class="fas fa-circle-exclamation fs-3 me-2"></i>All fields are required...</div>');
        }
        else {
            $.ajax({
                url: "updateQuery.php",
                type: "post",
                data: { id: sid, name: name, age: age, gender: gender, contact: contact, email: email },
                success: function (data) {
                    if (data == 1) {
                        // data table calling start
                        mytable = $('#example').DataTable();
                        mytable.draw();
                        // data table calling end
                        $("#edit-modal").modal("hide");
                        $('.success-status').html('<div class="alert alert-success d-flex align-items-center rounded-0 mb-1 p-1"> <i class="fas fa-circle-check fs-3 me-2"></i>It has been successfully updated...</div>');
                        $('.error-status').css('display', 'none');
                    }
                    else {
                        alert('failed...');
                    }
                }
            });
        }
    });







    // fetch single data==========================================================================================================
    // show edit modal
    $(document).on("click", "#singleView", function () {
        $("#single-modal").modal("show");
        var sid = $(this).data("id");

        //hide edit modal and error status
        $("#close-single-modal").on("click", function () {
            $("#single-modal").modal('hide');
        });

        //  alert(sid) //for testing ids
        $.ajax({
            url: "singleQuery.php",
            type: "post",
            data: { id: sid },
            success: function (data) {
                $("#singleRecord").html(data);
            }
        });
    });


});