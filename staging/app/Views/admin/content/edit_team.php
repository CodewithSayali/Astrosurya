<div class="content-page">
    <div class="content">
        <!-- Page-Title --> 
        <div class="row">
            <div class="col-sm-12">
                <a href="<?= $back ?>" class="admin-back">< Back</a>
                <h4 class="page-title">Edit Team</h4>
            </div>
        </div>
        <div class="page container">
            <form id="frmTeam" name="frmTeam" class="page-form">
                <div class="borders">
                    <div class="profiles_detials">
                        <div class="details_area">
                            <div class="labeling">
                                <label>Full Name</label>
                            </div>
                            <input type="hidden" name="team_id" id="team_id" value="<?= base64_encode($teams['id']) ?>">
                            <input type="text" name="fullname" id="fullname" value="<?= $teams['fullname'] ?>">
                        </div>
                        <div class="details_area">
                            <div class="labeling">
                                <label>Designation</label>
                            </div>
                            <input type="text" name="designation" id="designation" value="<?= $teams['designation'] ?>">
                        </div>
                        <div class="details_area">
                            <div class="labeling">
                                <label> Image </label>
                            </div>
                            <div class="dly-sht">
                                <label for="before_cropteam_image" class="choose-btn4 form-control" id="chooseBtn6">Select Image</label>
                                <input class="form-control" type="file" id="before_cropteam_image"  accept="image/*">
                               <!--<input type='hidden' name='icon' id="icon" value="">-->
                                <i class="fa fa-upload" aria-hidden="true"></i>
                            </div>
                            <?php
                            if ($teams['image']) {
                                $image_path = base_url() . "/admin-assets/uploads/team/" . $teams['id'] . "/" . $teams['image'];
                                ?>    
                                <input type="hidden" value="<?= $teams['image'] ?>" name="image" id="image">
                                <img src="<?= $image_path; ?>" id="image_team">
                                <?php
                            }
                            ?>
                            <input type='hidden' name='team_image' id="team_image" value=""/> 
                        </div>
                        <div class="details_area dob-tag">
                            <div class="labeling">
                                <label>Content</label>
                            </div>
                            <!--<input type="longtext" name="description" class="ckeditor-classic"  id="description" value="<?= $teams['content'] ?>">-->
                            <textarea cols="80" id="content" class="ckeditor-classic" name="content" rows="10" data-sample-short><?= $teams['content'] ?></textarea>
                        </div>
                    </div>
                    <div>
                        <label id="valid-error" class="error"></label>

                    </div>
                </div>
                <div class="butt update-profile">
                    <input type="submit" value="Submit" class="sign_details_Up" id="save_team">
                    <a href='https://wordpress.betadelivery.com/astrosurya-dev/admin/manage-teams'><input type="cancel" value="Cancel" class="sign_details_Up" id="cancel_page">
                    </a>                                                  

                </div>
        </div>
        </form>
    </div>

</div>
<div id="imageTeamModel" class="modal fade bd-example-modal-lg" role="dialog"  data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Upload & crop image</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <br />
                        <br />
                        <br/>
                        <button class="btn btn-success team_image">Save</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="image-preview"
                         style=""></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
</div>
<!--<script type="text/javascript" src="/admin-assets/ckeditor/ckeditor.js"></script>-->
<script>
//                            CKEDITOR.replace('content', {
//                                height: 260,
//                                /* Default CKEditor styles are included as well to avoid copying default styles. */
//                                contentsCss: [
//                                    'http://cdn.ckeditor.com/4.12.1/full-all/contents.css',
//                                    'https://ckeditor.com/docs/vendors/4.12.1/ckeditor/assets/css/classic.css'
//                                ]
//                            });
    var ckClassicEditor = document.querySelectorAll(".ckeditor-classic")
    ckClassicEditor.forEach(function () {
        ClassicEditor
                .create(document.querySelector('.ckeditor-classic'))
                .then(function (editor) {
                    editor.ui.view.editable.element.style.height = '200px';
                })
                .catch(function (error) {
                    console.error(error);
                });
    });

</script>
<script>

    var before_cropteam_image = document.getElementById('before_cropteam_image');
    var chooseBtn6 = document.getElementById('chooseBtn6');

    $(document).ready(function () {
        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            enableResize: true,
            viewport: {
                width: 635,
                height: 342,
                type: 'rectangle' //circle
            },
            boundary: {
                width: 700,
                height: 500
            }
        });
        $('#before_cropteam_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {

                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
            $('#imageTeamModel').modal('show');
        });

        $('.team_image').click(function (event) {
            //var bond_id = $('#txtBrandId').val();
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
//                alert(response);
//                $('#image').val(response);
                $('#team_image').val(response);
                $('#imageTeamModel').modal('hide');
                $('#image_team').attr('src', response);
                $('#image_team').css('display', 'block');
            });
        });

    });
</script>
