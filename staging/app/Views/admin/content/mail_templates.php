<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Mail Templates</h4>
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
                                    <th>Subject</th>
                                    <th>Attachment</th>
                                    <th>Active/Inactive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tr-bg">
                                <?php
                                $mail_id = "";
                                if (!empty($mails)) {
                                    $id = 1;
                                    foreach ($mails as $mail) {
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td> 
                                            <td style="text-align:center;"><?= $mail['subject'] ?></td>
                                            <td style="text-align:center;"><?= $mail['attachment'] ?></td>
                                            <td style="text-align:center;">
                                                <input type="checkbox" class="switch active-inactive" id="pageStatus" data-id="<?= $mail['id'] ?>" data-status="<?= $mail['is_active'] ?>" <?= $mail['is_active'] == '1' ? 'checked' : '' ?>>
                                            </td> 
                                            <td style="text-align:center;" class="edit-icons">
                                                <a href="<?= base_url('admin/edit-mail/' . base64_encode($mail['id'])) ?>" class="icon-btn btn-view" rel="tooltip" title="Edit Page">
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
</div> 
<script>
         $(document).ready(function () { 
             $('.active-inactive').on('click', function () {
                var mail_id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
//                        alert(status);
//                        console.log(bond_id);
                $.ajax({
                    url: "<?php echo base_url('AdminController/mailActiveInactive'); ?>",
                    type: "post",
                    data: {mail_id: mail_id, status: status},

                    success: function (response) {
                        if (response == 1) {
                            toastr.success("Mail Templates status changed successfully");
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

