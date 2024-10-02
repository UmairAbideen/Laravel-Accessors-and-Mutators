<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- datatable file -->
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css">

</head>
<body>

    {{-- design start ====================================================================================--}}
        <div class="container mt-4">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Laravel AJAX CRUD Operation</h4>
                </div>
                <div class="col-lg-12 mb-2">
                    <a onclick="OpenModal()" href="javascript:void(0)" class="btn btn-primary">Create An Employee Record </a>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered" id="ajax-crud-datable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{-- design close =================================================================================== --}}


    {{-- modal start===================================================================================== --}}
        <div id="employee-modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">Add A New Record</h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        {{-- form start from here --}}
                        <form id="myForm">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-2">
                                <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                                <span id="nameError" class="text-danger error"></span>
                            </div>
                            <div class="mb-2">
                                <input type="number" class="form-control" id="age" name="age" placeholder="Age">
                                <span id="ageError" class="text-danger error"></span>
                            </div>
                            <div class="mb-2">
                                <select class="form-select" id="gender" name="gender">
                                    <option selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span id="genderError" class="text-danger error"></span>
                            </div>
                            <div class="mb-2">
                                <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact">
                                <span id="contactError" class="text-danger error"></span>
                            </div>
                            <div class="mb-2">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                <span id="emailError" class="text-danger error"></span>
                            </div>
                            <div class="mb-2">
                                <button type="submit" class="btn btn-primary" id="save-btn"></button>
                            </div>
                        </form>
                        {{-- form close from here --}}
                    </div>
                    <div class="modal-footer"></div>
                </div>

            </div>
        </div>
    {{-- modal end======================================================================================= --}}




    {{-- single view modal start========================================================================= --}}
        <div id="viewModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between">
                        <h4 class="modal-title">Single View Of An Employee</h4>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                User Details
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="view-id" class="col-sm-3 col-form-label">Id:</label>
                                    <div class="col-sm-9">
                                        <span id="view-id"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="view-name" class="col-sm-3 col-form-label">Name:</label>
                                    <div class="col-sm-9">
                                        <span id="view-name"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="view-age" class="col-sm-3 col-form-label">Age:</label>
                                    <div class="col-sm-9">
                                        <span id="view-age"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="view-gender" class="col-sm-3 col-form-label">Gender:</label>
                                    <div class="col-sm-9">
                                        <span id="view-gender"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="view-contact" class="col-sm-3 col-form-label">Contact:</label>
                                    <div class="col-sm-9">
                                        <span id="view-contact"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="view-email" class="col-sm-3 col-form-label">Email:</label>
                                    <div class="col-sm-9">
                                        <span id="view-email"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="modal-footer"></div> --}}
                </div>

            </div>
        </div>
    {{-- single view modal end=========================================================================== --}}



    {{-- js cdn's start================================================================================== --}}
    <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- js cdn's close================================================================================== --}}

    <script>

        //add the csrf token code==========================================================================
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        // fetch the data===================================================================================
        var table =  $("#ajax-crud-datable").DataTable({
            // processing: true,
            // serverSide: true,
            ajax: {
                url: "{{route('employee.fetch')}}",
                type: "GET"
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'age' },
                { data: 'gender' },
                { data: 'contact' },
                { data: 'email' },
                { data: 'created_at' },
                { data: 'action', orderable:false,  searchable: false },
            ],
            order:[[0,'desc']],
        });




        // open the employee modal==========================================================================
        function OpenModal()
        {
            $('#EmployeeForm').trigger('reset');
            $('.modal-title').text('Add A New Employee');
            $('#save-btn').text('Add Employee');
            $('#employee-modal').modal('show');
            $('#id').val('');
            $(".error").html('');
        }



        // add an employee==================================================================================
        $('#save-btn').on('click', function()
        {
            $('#save-btn').html(' <span class="spinner-border spinner-border-sm"></span> ' + ' Saving... ');
            $('#save-btn').attr('disabled', true)
            $(".error").html('');

            let formData = $("#myForm").serialize();
            $.ajax({
                url: "{{route('employee.create')}}",
                method: "POST",
                data: formData,
                // cache: false,
                // contentType: false,
                // processData: false,
                // dataType: "json",
                success: function(response)
                {
                    table.ajax.reload();
                    $('#save-btn').text('Add Employee');
                    $('#save-btn').attr('disabled', false);
                    $('#employee-modal').modal('hide');
                    // $('#save-btn').html('Submit');
                    // alert(response.success);
                    if (response)
                    {
                        Swal.fire({
                            title: "Good Work",
                            text: response.success,
                            icon: "success",
                        });
                    }
                },
                error: function(error)
                {
                    $('#save-btn').text('Add Employee');
                    $('#save-btn').attr('disabled', false);
                    if (error)
                    {
                        $("#nameError").html(error.responseJSON.errors.name);
                        $("#ageError").html(error.responseJSON.errors.age);
                        $("#genderError").html(error.responseJSON.errors.gender);
                        $("#contactError").html(error.responseJSON.errors.contact);
                        $("#emailError").html(error.responseJSON.errors.email);
                    }
                }
            });

        });




        // edit an employee=================================================================================

        function edit(id)
        {
            $(".error").html('');

            $.ajax({
                url: "{{route('employee.edit')}}",
                method: "GET",
                data: {id:id},
                // dataType: "json",
                beforeSend: function()
                {
                    $('button[edit-id="' + id + '"]').html('<span class="spinner-border spinner-border-sm"></span>');
                    $('button[edit-id="' + id + '"]').attr('disabled', true);
                },
                success: function(response)
                {
                    // $('#EmployeeForm').trigger('reset');
                    $('button[edit-id="' + id + '"]').html('Edit');
                    $('button[edit-id="' + id + '"]').attr('disabled', false);

                    $('.modal-title').text('Update An Employee');
                    $('#save-btn').text('Update Employee');
                    $('#employee-modal').modal('show');
                    $('#id').val(response.id);
                    $('#name').val(response.name);
                    $('#age').val(response.age);
                    $('#gender').val(response.gender);
                    $('#contact').val(response.contact);
                    $('#email').val(response.email);
                },
                error: function(response)
                {
                    console.log(response);
                }
            });
        }



        // delete an employee===============================================================================
        function destroy(id)
        {
            if(confirm("Are you sure you want to delete this employee?"))
            {
                $.ajax({
                    url: "{{route('employee.delete')}}",
                    method: "DELETE",
                    data: {id: id},
                    // dataType: "json",
                    beforeSend: function()
                    {
                        $('button[delete-id="' + id + '"]').html('<span class="spinner-border spinner-border-sm"></span>');
                        $('button[delete-id="' + id + '"]').attr('disabled', true);
                    },
                    success: function(response)
                    {
                        $('button[delete-id="' + id + '"]').html('Delete');
                        $('button[delete-id="' + id + '"]').attr('disabled', false);
                        // alert(response.success);
                        table.ajax.reload();
                        if (response)
                        {
                            Swal.fire({
                                title: "Good Work",
                                text: response.success,
                                icon: "success",
                            });
                        }
                    },
                    error: function(response)
                    {
                        console.log(response);
                    }
                });
            }
        }


        // view a single employee===========================================================================
        function view(id)
        {
            $.ajax({
                url: "{{route('employee.view')}}",
                method: "GET",
                data: {id: id},
                // dataType: "json",
                beforeSend: function()
                {
                    $('button[view-id="' + id + '"]').html('<span class="spinner-border spinner-border-sm"></span>');
                    $('button[view-id="' + id + '"]').attr('disabled', true);
                },
                success: function(response)
                {

                    $('button[view-id="' + id + '"]').html('View');
                    $('button[view-id="' + id + '"]').attr('disabled', false);

                    $('#viewModal').modal('show');
                    $('#view-id').text(response.id);
                    $('#view-name').text(response.name);
                    $('#view-age').text(response.age);
                    $('#view-gender').text(response.gender);
                    $('#view-contact').text(response.contact);
                    $('#view-email').text(response.email);
                    $('#view-created_at').text(response.created_at);
                },
                error: function(response)
                {
                    console.log(response);
                }
            });
        }

    </script>

</body>
</html>
