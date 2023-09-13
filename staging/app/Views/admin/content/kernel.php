<?php echo $this->include('admin/template/header.php'); ?>
<div id="wrapper">
    <?php
    echo $this->include('admin/common/topbar.php');
    echo $this->include('admin/common/left_sidebar.php');
    ?> 
    <?php echo $this->include($load_page) ?>
    <?php echo $this->include('admin/template/footer.php'); ?>