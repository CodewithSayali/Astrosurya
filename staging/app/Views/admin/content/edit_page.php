<div class="content-page">
    <div class="content">
        <!-- Page-Title --> 
        <div class="row">
            <div class="col-sm-12">
                <a href="<?= $back ?>" class="admin-back">< Back</a>
                <h4 class="page-title">Edit Page</h4>
            </div>
        </div>
        <div class="page container">
            <form id="frmEditPage" name="frmEditPage" class="page-form">
                <div class="borders">
                    <div class="profiles_detials">
                        <div class="details_area">
                            <div class="labeling">
                                <label>Title</label>
                            </div>
                            <input type="hidden" name="pg_id" id="pg_id" value="<?= base64_encode($page['id']) ?>">

                            <input type="text" name="title" id="title" value="<?= $page['title'] ?>">
                        </div>
                        <div class="details_area dob-tag">
                            <div class="labeling">
                                <label>Content</label>
                            </div>
                            <!--<input type="longtext" name="content" id="content" value="<?= $page['content'] ?>">-->
                            <textarea cols="80" id="content" class="ckeditor-classic" name="content" rows="10" data-sample-short><?= $page['content'] ?></textarea>
                        </div>
                        <div class="details_area">
                            <div class="labeling">
                                <label>SEO Keywords</label>
                            </div>
                            <input type="text" name="seo_keywords" id="seo_keywords" value="<?= $page['seo_keywords'] ?>">
                        </div>

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

                    </div>
                    <div class="details_area">
                        <div class="labeling">
                            <label> Image </label>
                        </div>
                        <div class="dly-sht">
                            <label for="before_crop_image" class="choose-btn4 form-control" id="chooseBtn4">Select Image</label>
                            <input class="form-control" type="file" id="before_crop_image"  accept="image/*">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </div>
                        <?php
                        if ($page['id']) {
                            $image_path = base_url() . "/admin-assets/uploads/page/" . $page['id'];
                            ?>    
                            <input type="hidden" value="<?= $page['id'] ?>" name="page_image" id="page_image">
                            <img src="<?= $image_path; ?>" id="image_preview">
                            <?php
                        }
                        ?>
                        <input type='hidden' name='image' id="image" value=""/>
                    </div>

                    <div>
                        <label id="valid-error" class="error"></label>

                    </div>
                </div>
                <div class="butt update-profile">
                    <input type="submit" value="Submit" class="sign_details_Up" id="save_page">
                    <a href='https://wordpress.betadelivery.com/astrosurya-dev/admin/manage-pages'>
                        <input type="cancel" value="Cancel" class="sign_details_Up ml-2 text-center" id="cancel_page">
                    </a>                                                  

                </div>
        </div>
        </form>
    </div>

</div>
<div id="imageModel" class="modal fade bd-example-modal-lg" role="dialog"  data-backdrop="false">
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
                        <button class="btn btn-success crop_image">Save</button>
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

    var before_crop_image = document.getElementById('before_crop_image');
    var chooseBtn4 = document.getElementById('chooseBtn4');

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

        $('.crop_image').click(function (event) {
            //var bond_id = $('#txtBrandId').val();
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $('#image').val(response);
                $('#imageModel').modal('hide');
                $('#image_preview').attr('src', response);
                $('#image_preview').css('display', 'block');
            });
        });

    });
</script>

