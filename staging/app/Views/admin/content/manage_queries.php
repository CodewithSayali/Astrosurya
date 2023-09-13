<div class="content-page">
    <div class="content">
        <div class="">
            <!-- Page-Title --> 
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Manage Queries</h4>
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
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Read/Unread</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tr-bg">
                                <?php
                                if (!empty($queries)) {
                                    $id = 1;
                                    foreach ($queries as $querie) {

                                       ?>
                                        <tr>
                                            <td style="text-align:center;"><?= $id; ?></td>  
                                            <td style="text-align:center;"><?= $querie['name'] ?></td>
                                            <td style="text-align:center;"><?= $querie['email'] ?></td>
                                            <td style="text-align:center;"><?= $querie['mobile'] ?></td>
                                            <td style="text-align:center;">
                                                <input type="checkbox" class="switch active-inactive" id="readStatus" data-id="<?= $querie['id'] ?>" data-status="<?= $querie['is_read'] ?>" <?= $querie['is_read'] == '1' ? 'checked' : '' ?>>
                                            </td> 
                                            <td style="text-align:center;" class="edit-icons">
                                                <a href="" class="icon-btn btn-view" data-toggle="modal" data-target="#view" rel="tooltip" data-name="<?= $querie['name'] ?>" data-id="<?= $querie['id'] ?>" title="View User Details">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>
<!--                                                <a href="" class="icon-btn btn-edit" data-toggle="modal" data-target="#edit" rel="tooltip" data-mobile="<?= $querie['mobile'] ?>" data-email="<?= $querie['email'] ?>" data-name="<?= $querie['name'] ?>" data-id="<?= $querie['id'] ?>" title="Edit User Details">
                                                    <i class="fa fa-edit" aria-hidden="true"></i></a>
                                                <a href="" class="icon-btn btn-delete" data-toggle="modal" data-target="#delete" rel="tooltip" data-name="<?= $querie['name'] ?>" data-id="<?= $querie['id'] ?>" title="Delete User Details">
                                                    <i class="fa fa-trash" aria-hidden="true"></i></a>-->
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
<!--
-->    <div class="modal fade custom-modal" id="view">
        <div class="modal-dialog">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2>User Details</h2>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <table class="table table-bordered custom-table">
                        <tr><td>Name</td><td><p id="query_name"></td></tr>
                        <tr><td>Email</td><td><p id="query_email"></td></tr>
                        <tr><td>Mobile</td><td><p id="query_mobile"></td></tr>
                        <tr><td>Message</td><td><p id="query_message"></td></tr>
                     </table> 
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {

        //view modal
        $('.btn-view').click(function () {

            var querie_id = $(this).attr('data-id'); //get the attribute value
            $.ajax({
                url: "<?php echo base_url('admin/get-query-data'); ?>",
                data: {querie_id: querie_id},
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    $('#query_name').html(response.name); //hold the response in id and show on popup
                    $('#query_email').html(response.email);
                    $('#query_mobile').html(response.mobile);
                    $('#query_message').html(response.message);
                   
                    
                }
            });
        });

   });

</script>

<script>
         $(document).ready(function () { 
             $('.active-inactive').on('click', function () {
                var querie_id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
//                        alert(status);
//                        console.log(bond_id);
                $.ajax({
                    url: "<?php echo base_url('AdminController/querieActiveInactive'); ?>",
                    type: "post",
                    data: {querie_id: querie_id, status: status},

                    success: function (response) {
                        if (response == 1) {
                            toastr.success("Querie status changed successfully");
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