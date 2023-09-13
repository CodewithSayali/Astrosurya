<?php echo $this->include('admin/template/header.php'); ?>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.php" class="log-logo">
            <img src="<?php echo base_url('admin-assets/img/logo/logoham.png') ?>">
        </a>
    </div>
    <div class="m-t-20 card-box log-body">
        <div class="text-center">
            <h3 class="text-uppercase mb-0">Welcome To Astrosurya</h3>
        </div>
        <div class="p-2">
            <form class="form-horizontal m-t-20" id="frmAdminLogin">

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email ID">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" id="txtPassword" name="txtPassword" type="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" id="txtPin" name="txtPin" type="number" placeholder="Pin">
                    </div>
                </div>

                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-custom">
                            <input id="chkRemember" name="chkRemember" type="checkbox">
                            <label for="chkRemember">
                                Remember me
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <input type="submit" class="btn-add btn-rounded waves-effect waves-light w-100" value="Log In">
                        <!--                                <button class="btn-add btn-rounded waves-effect waves-light w-100" type="submit">Log In</button>-->
                    </div>
                    <!--                            <div class="col-sm-12 text-right mt-2">
                                                    <a href="send-mail.php" class=""> Forgot password?</a>
                                                </div>-->
                </div>

            </form>

        </div>
    </div>
    <!-- end card-box-->

    <!-- <div class="row">
        <div class="col-sm-12 text-center">
            <p class="">Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a></p>
        </div>
    </div> -->

</div>
<!-- end wrapper page -->



<!-- jQuery  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url('admin-assets/js/form_validation.js') ?>"></script>

<script src="<?php echo base_url('admin-assets/js/bootstrap.min.js') ?>"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>   
<script src="<?php echo base_url('admin-assets/js/waves.js') ?>"></script>   
<script src="<?php echo base_url('admin-assets/js/jquery.slimscroll.js') ?>"></script>   

<!-- App js -->
<script src="<?php echo base_url('admin-assets/js/jquery.core.js') ?>"></script>   
<script src="<?php echo base_url('admin-assets/js/jquery.app.js') ?>"></script>   
<script src="<?php echo base_url('admin-assets/js/toastr.js')?>"></script>

</body>
</html>