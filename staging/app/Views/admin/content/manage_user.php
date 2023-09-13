<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage User</h4>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-12">
                    <div class="card-box table-responsive">

                        <table id="datatable" class="table table-bordered custom-table">
                            <thead class="thead-bg">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>DOB</th>
                                    <th>gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tr-bg">
                                <?php
                                if (!empty($users)) {
                                    $id = 1;
                                    foreach ($users as $user) {
                                        $dob = date("d M Y", strtotime($user['dob']));

                                        if ($user['gender'] == '1') {
                                            $gender = "Male";
                                        } elseif ($user['gender'] == '2') {
                                            $gender = "Female";
                                        } elseif ($user['gender'] == '3') {
                                            $gender = "Not to disclose";
                                        } else {
                                            $gender = "";
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td>  
                                            <td style="text-align:center;"><?= $user['first_name'] ?></td>
                                            <td style="text-align:center;"><?= $user['last_name'] ?></td>
                                            <td style="text-align:center;"><?= $user['email'] ?></td>
                                            <td style="text-align:center;"><?= $user['phone'] ?></td>
                                            <td style="text-align:center;"><?= $user['dob'] ?></td>
                                            <td style="text-align:center;"><?= $gender ?></td>
                                            <td style="text-align:center;" class="edit-icons">
                                                <a href="" class="icon-btn btn-view" data-toggle="modal" data-target="#view" rel="tooltip" data-name="<?= $user['first_name'] ?>" data-id="<?= $user['id'] ?>" title="View User Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="" class="icon-btn btn-edit" data-toggle="modal" data-target="#edit" rel="tooltip" data-gender="<?= $user['gender'] ?>" data-timezone="<?= $user['timezone'] ?>" data-longitude="<?= $user['longitude'] ?>" data-latitude="<?= $user['latitude'] ?>"data-dob="<?= $user['dob'] ?>" data-phone="<?= $user['phone'] ?>" data-password="<?= $user['password'] ?>" data-email="<?= $user['email'] ?>" data-last="<?= $user['last_name'] ?>" data-name="<?= $user['first_name'] ?>" data-id="<?= $user['id'] ?>" title="Edit User Details">
                                                    <i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <a href="" class="icon-btn btn-delete" data-toggle="modal" data-target="#delete" rel="tooltip" data-name="<?= $user['first_name'] ?>" data-id="<?= $user['id'] ?>" title="Delete User Details">
                                                    <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $id++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="modal fade custom-modal" id="view">
        <div class="modal-dialog">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>User Details</h2>
            </div>
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-bordered custom-table">
                        <tr><td>First Name</td><td><p id="first_name"></td></tr>
                        <tr><td>Last Name</td><td><p id="last_name"></td></tr>
                        <tr><td>Email</td><td><p id="email"></td></tr>
<!--                        <tr><td>Password</td><td><p id="password"></td></tr>-->
                        <tr><td>Phone</td><td><p id="phone"></td></tr>
                        <tr><td>DOB</td><td><p id="dob"></td></tr>
                        <tr><td>Latitude</td><td><p id="latitude"></td></tr>
                        <tr><td>Longitude</td><td><p id="longitude"></td></tr>
                        <tr><td>Timezone</td><td><p id="timezone"></td></tr>
                        <tr><td>Gender</td><td><p id="gender"></td></tr>     
                    </table> 
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade custom-modal" id="edit">
        <div class="modal-dialog modal-sm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Details</h2>
            </div>
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="frmEditUser">
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id">
                            <label>First Name</label>
                            <input type="text" name="txtFirstName" id="txtFirstName" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="txtLastName" id="txtLastName" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="txtEmail" id="txtEmail" class="form-control" value="">
                        </div>
<!--                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="txtPassword" id="txtPassword" class="form-control" value="">
                        </div>-->
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="txtPhone" id="txtPhone" class="form-control validblack" value="">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="datetime-local" name="txtDob" id="txtDob" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="decimal" name="txtLatitude" id="txtLatitude" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="decimal" name="txtLongitude" id="txtLongitude" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Timezone</label>
                            <input type="text" name="txtTimezone" id="txtTimezone" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <div>Gender</div>
                            <input type="radio" id="gen1" name="radGender" value="1">
                            <label for="gender1">Male</label><br>
                            <input type="radio" id="gen2" name="radGender" value="2">
                            <label for="gender2">Female</label><br>  
                            <input type="radio" id="gen3" name="radGender" value="3">
                            <label for="gender3">Not to Disclose</label><br><br>
                        </div>
                        <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" class="form-control popup-but">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade custom-modal" id="delete">
        <div class="modal-dialog modal-sm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Delete User</h2>
            </div>
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="frmUserDelete" data-parsley-validate novalidate>
                        <div class="form-group" id="delConfirmText">
                        </div>
                        <input type="hidden" name="delid" id="delid">
                        <input type="submit" name="btnDelSubmit" id="btnDelSubmit" value="Ok" class="form-control popup-but">
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {

        //view modal
        $('.btn-view').click(function () {
            
            var user_id = $(this).attr('data-id'); //get the attribute value
            $.ajax({
                url: "<?php echo base_url('admin/get-user-data'); ?>",
                data: {user_id: user_id},
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#first_name').html(response.first_name); //hold the response in id and show on popup
                    $('#last_name').html(response.last_name);
                    $('#email').html(response.email);
                    //$('#password').html(response.password);
                    $('#dob').html(response.dob);
                    $('#phone').html(response.phone);
                    $('#latitude').html(response.latitude);
                    $('#longitude').html(response.longitude);
                    $('#timezone').html(response.timezone);
                    var gender = "";                   
                    if (response.gender === '1') {
                        gender = "Male";
                    } else if (response.gender === '2') {
                        gender = "Female";
                    } else if (response.gender === '3') {
                        gender = "Not to disclose";
                    } else {
                        gender = "N/A";
                    }

                    $('#gender').html(gender);
                }
            });
        });

        //show edit modal 

        $('.btn-edit').on('click', function () {
        $("#frmEditUser").trigger( "reset" );
        var validator = $( "#frmEditUser" ).validate();
        validator.resetForm();
        $( "#frmEditUser" ).find('.error').removeClass('error');
            var user_id = $(this).attr('data-id');
            var first_name = $(this).attr('data-name');
            var last_name = $(this).attr('data-last');
            var email = $(this).attr('data-email');
            //var password = $(this).attr('data-password');
            var phone = $(this).attr('data-phone');
            var dob = $(this).attr('data-dob');
            var latitude = $(this).attr('data-latitude');
            var longitude = $(this).attr('data-longitude');
            var timezone = $(this).attr('data-timezone');
            var gender = $(this).attr('data-gender');
//            var gender = 

//             alert(first_name);
            $('#user_id').val(user_id);
            $('#txtFirstName').val(first_name);
            $('#txtLastName').val(last_name);
            $('#txtEmail').val(email);
            //$('#txtPassword').val(password);
            $('#txtPhone').val(phone);
            $('#txtDob').val(dob);
            $('#txtLatitude').val(latitude);
            $('#txtLongitude').val(longitude);
            $('#txtTimezone').val(timezone);
            
            if(gender === '1')$("#gen1").prop("checked", true);
            else if(gender === '2')$("#gen2").prop("checked", true);
            else("#gen3").prop("checked", true);
        });
        
        
//        //show update modal 
//        $("#btnSubmit").on('click', function (e) {
//            e.preventDefault();
////                 alert("user_edit");
//            //console.log($("#editform").serialize());
//            $.ajax({
//                url: "<?php //echo base_url('admin/update-user'); ?>",
//                data: $("#editform").serialize(),
//                method: "post",
//                success: function (response) {
////                    console.log(response)
//                    $('#edit').modal('hide');
//                    $('#editform')[0].reset();
//                    if (response == 1) {
//                        toastr.success("User updated successfully");
////                        window.location.href = baseurl + "admin/manage-user";
//                    } else {
//                        toastr.error("Updation Failed !");
//                    }
//                },
//                error: function (response) {
//                    toastr.error("Something went wrong");
//                }
//            });
//        });

        //show delete modal 
        $('.btn-delete').on('click', function () {
            var id = $(this).attr('data-id');
            var first_name = $(this).attr('data-name');
            $('#delConfirmText').html('Are you sure you want to delete "' + first_name + '" user?');
            $('#delid').val(id);
        });

    });

</script>