<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage Pages</h4>
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
                                    <th>Title</th>
                                    <th>SEO keyword</th>
                                    <th>Image</th>
                                    <th>Active/Inactive</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tr-bg">
                                <?php
                                $image_id = "";
                                if (!empty($pages)) {
                                    $id = 1;
                                    foreach ($pages as $page) {
                                         if ($page['page_image'] != '') {
                                            $image_url = base_url() . "/admin-assets/uploads/page/". $page['page_image'];
                                        } else {
                                            $image_url = base_url() . "/admin-assets/uploads/page/";
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td> 
                                            <td style="text-align:center;"><?= $page['title'] ?></td>
                                            <td style="text-align:center;"><?= $page['seo_keywords'] ?></td>
                                            <td style="text-align:center;" id="divLogo<?= $page['page_image'] ?>"><img src="<?= $image_url ?>" width="50px" height="50px"></td>
                                            <td style="text-align:center;">
                                                <input type="checkbox" class="switch active-inactive" id="pageStatus" data-id="<?= $page['id'] ?>" data-status="<?= $page['is_active'] ?>" <?= $page['is_active'] == '1' ? 'checked' : '' ?>>
                                            </td> 
                                            <td style="text-align:center;" class="edit-icons">
                                                <a href="<?= base_url('admin/edit-page/' . base64_encode($page['id'])) ?>" class="icon-btn btn-view" rel="tooltip" title="Edit Page">
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
            var pg_id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
//                        alert(status);
//                        console.log(bond_id);
            $.ajax({
                url: "<?php echo base_url('AdminController/pageActiveInactive'); ?>",
                type: "post",
                data: {pg_id: pg_id, status: status},

                success: function (response) {
                    if (response == 1) {
                        toastr.success("Pages status changed successfully");
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

