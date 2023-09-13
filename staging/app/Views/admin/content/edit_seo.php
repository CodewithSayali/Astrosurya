<div class="content-page">
    <div class="content">
        <!-- Page-Title --> 
        <div class="row">
            <div class="col-sm-12">
                <a href="<?= $back ?>" class="admin-back">< Back</a>
                <h4 class="page-title">Edit SEO</h4>
            </div>
        </div>
        <div class="page container">
            <form id="frmSeo" name="frmSeo" class="page-form">
                <div class="borders">
                    <div class="profiles_detials">
                        <div class="details_area">
                            <div class="labeling">
                                <label>title</label>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?= base64_encode($seo['id']) ?>">
                            <input type="text" name="title" id="title" value="<?= $seo['title'] ?>">
                        </div>
                        <div class="details_area dob-tag">
                            <div class="labeling">
                                <label>Description</label>
                            </div>
                            <!--<input type="longtext" name="description" class="ckeditor-classic"  id="description" value="<?= $seo['description'] ?>">-->
                            <textarea cols="80" id="description" class="ckeditor-classic" name="description" rows="10" data-sample-short><?= $seo['description'] ?></textarea>
                        </div>

                        <div class="details_area">
                            <div class="labeling">
                                <label>Keywords</label>
                            </div>
                            <input type="text" name="keywords" id="keywords" value="<?= $seo['keywords'] ?>">
                        </div>
                        <div class="details_area">
                            <div class="labeling">
                                <label>canonical</label>
                            </div>
                            <input type="text" name="canonical" id="canonical" value="<?= $seo['canonical_url'] ?>">
                        </div>
                        <div>
                            <label id="valid-error" class="error"></label>

                        </div>
                    </div>
                    <div class="butt update-profile butt2">
                        <input type="submit" value="Submit" class="sign_details_Up" id="save_seo">
                        <a href='https://wordpress.betadelivery.com/astrosurya-dev/admin/manage-seo'>
                            <input type="cancel" value="Cancel" class="sign_details_Up ml-2 text-center" id="cancel_page">
                        </a>                                                  

                    </div>
                </div>
            </form>
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

    var icon = document.getElementById('icon');
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
        $('#icon').on('change', function () {
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
<script>
    $(document).ready(function () {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            enableResize: true,
            viewport: {
                width: 300,
                height: 76,
                type: 'rectangle' //circle
            },
            boundary: {
                width: 400,
                height: 400
            }
        });
        $('#icon').on('change', function () {
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
            var bond_id = $('#txtBrandId').val();
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "<?php echo base_url('admin/logo-crop'); ?>",
                    type: 'POST',
                    dataType: "JSON",
                    data: {image: response, bond_id: bond_id},
                    success: function (data) {
                        //console.log(data);
                        if (data.success == true) {
                            $('#imageModel').modal('hide');
                            $('#edit').modal('hide');
                            var newhtml = '<img src="' + data.source + '" />';
                            $("#divLogo" + bond_id).html(newhtml);

                            toastr.success(data.msg);
                        } else
                        {
                            $('#imageModel').modal('hide');
                            $('#edit').modal('hide');
                            toastr.error(data.msg);
                        }
                        $("#icon").val('');
                        $("#chooseBtn4").html = "Select Logo";
                        chooseBtn4.innerText = 'Choose';
                        alert('Crop image has been uploaded');
                    }
                });
            });
        });

    });


</script>
