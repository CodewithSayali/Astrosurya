<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>
            <div class="row dash-box">
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-user') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-user') ?>">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i><span> Manage User </span></a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-pages') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-pages') ?>">
                                    <i class="fa fa-file" aria-hidden="true"></i><span> Manage Pages </span></a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/mail-templates') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/mail-templates') ?>">
                                    <i class="fa fa-envelope" aria-hidden="true"></i> <span>Mail Templates</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-queries') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-queries') ?>">
                                    <i class="fa fa-question" aria-hidden="true"></i> <span>Manage Queries</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-services') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-services') ?>">
                                    <i class="fa fa-cogs" aria-hidden="true"></i> <span>Manage Services</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-seo') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-seo') ?>">
                                    <i class="fa fa-search" aria-hidden="true"></i> <span>Manage SEO</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-setting') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-setting') ?>">
                                    <i class="fa fa-cog" aria-hidden="true"></i> <span>Manage Setting</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-reports') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-reports') ?>">
                                    <i class="fa fa-files-o" aria-hidden="true"></i> <span>Manage Reports</span></a>
                            </div>
                        </a>
                    </div>
                </div>
                 <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <a href="<?php echo base_url('admin/manage-teams') ?>">
                            <div class="widget-dashicons">
                                <a href="<?php echo base_url('admin/manage-teams') ?>">
                                    <i class="fa fa-group" aria-hidden="true"></i> <span>Manage Teams</span></a>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">User Details</h4>
                    </div>
                </div>
                <table id="datatable" class="table table-bordered custom-table">
                    <thead class="thead-bg">
                        <tr>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>DOB</th>
                            <th>gender</th>
                        </tr>
                    </thead>
                    <tbody class="tr-bg">
                        <?php
                        if (!empty($users)) {
                            $x = 1;
                            foreach ($users as $user) {
                                if ($user['status'] == 1) {
                                    $dob = date("d M Y", strtotime($user['dob']));

                                    if ($user['gender'] == 1) {
                                        $gender = "Male";
                                    } elseif ($user['gender'] == 2) {
                                        $gender = "Female";
                                    } elseif ($user['gender'] == 3) {
                                        $gender = "Not to disclose";
                                    } else {
                                        $gender = "";
                                    }
                                    ?>
                                    <tr>
                                        <td style="text-align:center;"><?= $x; ?></td> 
                                        <td style="text-align:center;"><?= $user['first_name']['last_name'] ?></td>
                                        <td style="text-align:center;"><?= $user['email'] ?></td>
                                        <td style="text-align:center;"><?= $user['phone'] ?></td>
                                        <td style="text-align:center;"><?= $dob ?></td>
                                        <td style="text-align:center;"><?= $user['gender'] ?></td>   
                                    </tr>
                                    <?php
                                    $x++;
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>








