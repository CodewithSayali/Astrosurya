<div class="left-side-menu">
    <div class="slimscroll-menu">
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li><a href="<?php echo base_url('admin/dashboard')?>" <?php if ($spgname == 'index.php') {echo 'active';} ?>>
                        <i class="fa fa-home" aria-hidden="true"></i><span> Home </span></a>
                </li>
                <li><a href="<?php echo base_url('admin/manage-user')?>" <?php if ($spgname == 'manage-user') {echo 'active';} ?>>
                        <i class="fa fa-user-circle" aria-hidden="true"></i><span> Manage User </span></a>
                </li>
                 <li><a href="<?php echo base_url('admin/manage-pages')?>" <?php if ($spgname == 'manage-pages') {echo 'active';} ?>>
                        <i class="fa fa-file" aria-hidden="true"></i><span>Manage Pages</span></a>
                </li>
                <li><a href="<?php echo base_url('admin/mail-templates')?>" <?php if ($spgname == 'mail-templates') {echo 'active';} ?>>
                        <i class="fa fa-envelope" aria-hidden="true"></i><span>Mail Templates</span></a>
                </li>
                <li><a href="<?php echo base_url('admin/manage-queries')?>" <?php if ($spgname == 'manage-queries') {echo 'active';} ?>>
                        <i class="fa fa-question" aria-hidden="true"></i><span>Manage Queries</span></a>
                </li>
                <li><a href="<?php echo base_url('admin/manage-services')?>" <?php if ($spgname == 'manage-services') {echo 'active';} ?>>
                        <i class="fa fa-cogs" aria-hidden="true"></i><span>Manage Services</span></a>
                </li>
                <li><a href="<?php echo base_url('admin/manage-seo')?>" <?php if ($spgname == 'manage-seo') {echo 'active';} ?>>
                        <i class="fa fa-search" aria-hidden="true"></i><span>Manage SEO</span></a>
                </li>
                <li><a href="<?php echo base_url('admin/manage-setting')?>" <?php if ($spgname == 'manage-setting') {echo 'active';} ?>>
                        <i class="fa fa-cog" aria-hidden="true"></i><span>Manage Setting</span></a>
                </li>
                 <li><a href="<?php echo base_url('admin/manage-reports')?>" <?php if ($spgname == 'manage-reports') {echo 'active';} ?>>
                        <i class="fa fa-files-o" aria-hidden="true"></i><span>Manage Reports</span></a>
                </li>
                  <li><a href="<?php echo base_url('admin/manage-teams')?>" <?php if ($spgname == 'manage-teams') {echo 'active';} ?>>
                        <i class="fa fa-group" aria-hidden="true"></i><span>Manage Teams</span></a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>