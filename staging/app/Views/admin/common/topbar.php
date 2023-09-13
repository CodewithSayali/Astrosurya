
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list"> 
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> 
                <img src="<?php echo base_url('admin-assets/img/images.png')?>" alt="user-image" class="rounded-circle"> 
                <span class="pro-user-name ml-1"> Welcome Shikha <i class="fa fa-sign-out" aria-hidden="true"></i> </span> 
            </a> 
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <a href="<?=base_url('admin/logout')?>" class="dropdown-item notify-item"> <i class="fe-log-out"></i> <span>Logout</span> </a> 
            </div>
        </li>

        <li class="dropdown notification-list"> <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect"> <i class="fe-settings noti-icon"></i> </a> </li>
    </ul>
    <div class="logo-box"> 
        <a href="<?php echo base_url('admin/dashboard')?>" class="logo text-center"> 
            <span class="logo-lg"> 
                <img src="<?php echo base_url('admin-assets/img/logo/menu-logo.png')?>" alt=""> 
            </span> 
            <span class="logo-sm"> 
                <img src="<?php echo base_url('admin-assets/img/logo/menu-logo.png')?>" alt=""> 
            </span> 
        </a> 
    </div>
    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li> <button class="button-menu-mobile disable-btn waves-effect"> <i class="fe-menu"></i> </button> </li>
    </ul>
</div>