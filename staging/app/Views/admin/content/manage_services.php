<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage Services</h4>
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
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Price</th>
                                    <th>Active/Inactive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tr-bg">
                                <?php
                                if (!empty($services)) {
                                    $id = 1;
                                    foreach ($services as $service) {
                                         if ($service['icon'] != '') {
                                            $image_url = base_url() . "/admin-assets/uploads/service/" . $service['id'] . "/" . $service['icon'];
                                        } else {
                                            $image_url = base_url() . "/admin-assets/uploads/service/";
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td>  
                                            <td style="text-align:center;"><?= $service['name'] ?></td>
                                            <td style="text-align:center;"id="divLogo<?= $service['id'] ?>"><img src="<?= $image_url ?>" width="50px" height="50px"></td>
                                            <td style="text-align:center;"><?= $service['price'] ?></td>
                                            <td style="text-align:center;">
                                                <input type="checkbox" class="switch active-inactive" id="pageStatus" data-id="<?= $service['id'] ?>" data-status="<?= $service['is_active'] ?>" <?= $service['is_active'] == '1' ? 'checked' : '' ?>>
                                            </td>
                                            <td style="text-align:center;" class="edit-icons">
<!--                                                <a href="" class="icon-btn btn-view" data-toggle="modal" data-target="#view" rel="tooltip" data-name="<?= $service['name'] ?>" data-id="<?= $service['id'] ?>" title="View User Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>-->
                                                <a href="<?= base_url('admin/edit-services/' . base64_encode($service['id'])) ?>" class="icon-btn btn-view" rel="tooltip" title="Edit Service">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>                                                  
                                                <a href="" class="icon-btn btn-delete" data-toggle="modal" data-target="#servicedelete" rel="tooltip" data-name="<?= $service['name'] ?>" data-id="<?= $service['id'] ?>" title="Delete Service Details">
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

    <!--    <div class="modal fade custom-modal" id="view">
            <div class="modal-dialog">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>User Details</h2>
                </div>
                <div class="modal-content">
                     Modal body 
                    <div class="modal-body">
                        <table class="table table-bordered custom-table">
                            <tr><td>First Name</td><td><p id="first_name"></td></tr>
                            <tr><td>Last Name</td><td><p id="last_name"></td></tr>
                            <tr><td>Email</td><td><p id="email"></td></tr>
                            <tr><td>Password</td><td><p id="password"></td></tr>
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
    
    --> 

      <div class="modal fade custom-modal" id="servicedelete">
            <div class="modal-dialog modal-sm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2>Delete Service</h2>
                </div>
                <div class="modal-content">
                     Modal body 
                    <div class="modal-body">
                        <form id="frmServiceDelete" data-parsley-validate novalidate>
                            <div class="form-group" id="delConfirmService">
                            </div>
                            <input type="hidden" name="serviceid" id="serviceid">
                            <input type="submit" name="btnDelSubmit" id="btnDelSubmit" value="Ok" class="form-control popup-but">
                        </form>
                    </div>
                </div>
            </div>
        </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {

        //show delete modal 
        $('.btn-delete').on('click', function () {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $('#delConfirmService').html('Are you sure you want to delete "' + name + '" user?');
            $('#serviceid').val(id);
        });

    });

</script>

<script>
    $(document).ready(function () {
        $('.active-inactive').on('click', function () {
            var service_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
//                        alert(status);
//                        console.log(bond_id);
            $.ajax({
                url: "<?php echo base_url('AdminController/serviceActiveInactive'); ?>",
                type: "post",
                data: { service_id: service_id, status: status},

                success: function (response) {
                    if (response == 1) {
                        toastr.success("Service status changed successfully");
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);

                    } else {
                        toastr.error("Something went wrong");
                    }
                }
            });
        });
    });
</script>