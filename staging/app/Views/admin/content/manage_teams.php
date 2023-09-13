<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage Teams</h4>
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
                                    <th>Full Name</th>
                                    <th>Designation</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Active/Inactive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="tr-bg">
                                <?php
                                if (!empty($teams)) {
                                    $id = 1;
                                    foreach ($teams as $team) {
                                        if ($team['image'] != '') {
                                            $image_url = base_url() . "/admin-assets/uploads/team/" . $team['id'] . "/" . $team['image'];
                                        } else {
                                            $image_url = base_url() . "/admin-assets/uploads/team/";
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td> 
                                            <td style="text-align:center;"><?= $team['fullname'] ?></td>
                                            <td style="text-align:center;"><?= $team['designation'] ?></td>
                                            <td style="text-align:center;" id="divLogo<?= $team['id'] ?>"><img src="<?= $image_url ?>" width="50px" height="50px"></td>
                                            <td style="text-align:center;"><?= $team['content'] ?></td>
                                            <td style="text-align:center;">
                                                <input type="checkbox" class="switch active-inactive" id="pageStatus" data-id="<?= $team['id'] ?>" data-status="<?= $team['is_active'] ?>" <?= $team['is_active'] == '1' ? 'checked' : '' ?>>
                                            </td> 
                                            <td style="text-align:center;" class="edit-icons">
                                                <a href="<?= base_url('admin/edit-team/' . base64_encode($team['id'])) ?>" class="icon-btn btn-view" rel="tooltip" title="Edit Team">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>                                                  
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
<!--    <div class="modal fade custom-modal" id="edit">
        <div class="modal-dialog modal-sm">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>Edit Settings</h2>
            </div>
            <div class="modal-content">
                 Modal body 
                <div class="modal-body">
                    <form id="frmLogoUpload" data-parsley-validate novalidate>
                        <div class="form-group">
                            <input type="hidden" name="settingId" id="settingId">
                            <input type="text" name="settingName" id="settingName" class="form-control" value="">
                            <input type="text" name="nick" parsley-trigger="change" required
                                   placeholder="Enter Brand Name" class="form-control" id="userName" name="userName">
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 dly-sht">
                                <label for="before_crop_image" class="choose-btn4 form-control" id="chooseBtn5">Select Logo</label>
                                <input class="form-control" type="file" id="before_crop_image"  accept="image/*">
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </div>
                        </div>
                        <input type="submit" name="btnSubmit" value="Submit" class="form-control popup-but">
                    </form>
                </div>
            </div>
        </div>
    </div>-->

    <div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog"  data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Upload & crop logo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div id="image_demo" ></div>
                        </div>
                        <div class="col-md-4 img-btn">
                            <button class="btn btn-success crop_image">Save</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="image-preview"
                             style=""></div>
                    </div>
                </div>
                <!--            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>-->

            </div>
        </div>
    </div>
</div>
<script>
//    var hiddenBtn3 = document.getElementById('hiddenBtn3');
//    var chooseBtn3 = document.getElementById('chooseBtn3');
//
//    hiddenBtn3.addEventListener('change', function () {
//        if (hiddenBtn3.files.length > 0) {
//            chooseBtn3.innerText = hiddenBtn3.files[0].name;
//        } else {
//            chooseBtn3.innerText = 'Select Logo';
//        }
//    });

//    var before_crop_image = document.getElementById('before_crop_image');
//    var chooseBtn5 = document.getElementById('chooseBtn5');

//    before_crop_image.addEventListener('change', function () {
//        if (before_crop_image.files.length > 0) {
//            chooseBtn5.innerText = before_crop_image.files[0].name;
//        } else {
//            chooseBtn5.innerText = 'Select Logo';
//        }
//    });
    $(document).ready(function () {

//        $('.btn-edit').on('click', function (e) {
//            e.preventDefault();
////                 alert("btn-edit");
//            var setting_id = $(this).attr('data-id');
//            var setting_name = $(this).attr('data-name');
//            var url = "<?php // echo base_url('update-setting-logo') ?>";
//            $('#settingName').val(setting_name);
//            $('#settingId').val(setting_id);
//            $("#chooseBtn5").html = "Select Logo";
//        });


        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            enableResize: true,
            viewport: {
                width: 300,
                height: 76,
                type: 'rectangle' //circle
            },
            boundary: {
                width: 40,
                height: 40
            }
        });
        $('#before_crop_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {

                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#imageModel').modal('show');
        });
    });


</script>

<script>
    $(document).ready(function () {
        $('.active-inactive').on('click', function () {
            var team_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
//                        alert(status);
//                        console.log(team_id);
            $.ajax({
                url: "<?php echo base_url('AdminController/teamActiveInactive'); ?>",
                type: "post",
                data: { team_id: team_id, status: status},

                success: function (response) {
                    if (response == 1) {
                        toastr.success("Team status changed successfully");
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

