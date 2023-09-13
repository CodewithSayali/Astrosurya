<div class="content-page">
    <div class="content">
        <!-- Page-Title --> 
        <div class="row">
            <div class="col-sm-12">
                <a href="https://wordpress.betadelivery.com/astrosurya-dev/admin/mail-templates" class="admin-back">< Back</a>
                <h4 class="page-title">Edit Mail Templates</h4>
            </div>
        </div>
        <div class="page container">
            <form id="frmEditMail" name="frmEditMail" class="page-form">
                <div class="borders">
                    <div class="profiles_detials">
                        <div class="details_area">
                            <div class="labeling">
                                <label>Subject</label>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?= base64_encode($mails['id']) ?>">
                            <input type="text" name="subject" id="subject" value="<?= $mails['subject'] ?>">
                        </div>
                        <div class="details_area dob-tag">
                            <div class="labeling">
                                <label>Content</label>
                            </div>
                            <textarea cols="80" id="content" class="ckeditor-classic" name="content" rows="10" data-sample-short><?= $mails['content'] ?></textarea>
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
                            <label> Attachment </label>
                        </div>
                        <div class="dly-sht">
                            <label for="hiddenBtn" class="choose-btn form-control" id="chooseBtn">Select File</label>
                            <input class="form-control" type="file" id="hiddenBtn" >
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </div>
                        <?php
                        if ($mails['id']) {
                            $attach_path = base_url() . "/admin-assets/uploads/attachment/1" . $mails['id'];
                            ?>    
                            <input type="hidden" value="<?= $attach_path; ?>" name="page_image" id="page_image">

                            <?php
                        }
                        ?>
                        <input type='hidden' name='attach' id="attach" value=""/>
                    </div>

                </div>
                <div class="butt update-profile">
                    <input type="submit" value="Submit" class="sign_details_Up" id="update_mail">
                    <a href='https://wordpress.betadelivery.com/astrosurya-dev/admin/mail-templates'>
                        <input type="cancel" value="Cancel" class="sign_details_Up ml-2 text-center" id="cancel_page">
                    </a>                                                  

                </div>
        </div>
        </form>
    </div>

</div>
<script>
    var hiddenBtn = document.getElementById('attachment_files');
    var chooseBtn = document.getElementById('chooseBtn');

    hiddenBtn.addEventListener('change', function () {
        if (hiddenBtn.files.length > 0) {
            chooseBtn.innerText = hiddenBtn.files[0].name;
        } else {
            chooseBtn.innerText = 'Choose';
        }
    });
</script>