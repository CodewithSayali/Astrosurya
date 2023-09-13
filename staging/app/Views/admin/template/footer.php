<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                Copyright © Website Developers India. All rights reserved
            </div>
        </div>
    </div>
</footer>
</div>
</div>
 <script src="<?php echo base_url('admin-assets/js/vendor.min.js')?>"></script>
<!-- Plugins Js -->
<script src="<?php // echo base_url('admin-assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/multiselect/jquery.multi-select.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/jquery-quicksearch/jquery.quicksearch.min.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/select2/select2.min.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/jquery-mask-plugin/jquery.mask.min.js')?>"></script>
<script src="<?php // echo base_url('admin-assets/plugin/moment/moment.js')?>"></script>
<script src="<?php echo base_url('admin-assets/js/switchery.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('admin-assets/js/jquery.knob.js')?>"></script>
<script src="<?php echo base_url('admin-assets/js/morris.min.js')?>"></script>
<script src="<?php echo base_url('admin-assets/js/raphael-min.js')?>"></script>
<script src="<?php echo base_url('admin-assets/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('admin-assets/js/dataTables.bootstrap4.min.js')?>"></script>
<!-- Init js-->
<script src="<?php echo base_url('admin-assets/js/dashboard.init.js')?>"></script>   
<script src="<?php echo base_url('admin-assets/js/jquery.core.js')?>"></script>
<script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Init js-->
<script src="<?php echo base_url('admin-assets/js/form-advanced.init.js')?>"></script>

<!-- App js -->
<script src="<?php echo base_url('admin-assets/js/app.min.js')?>"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<script src="<?php echo base_url('admin-assets/js/toastr.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url('admin-assets/js/form_validation.js') ?>"></script>

<script>
    
//        $('.multipleDropDown').multiselect({
//          includeSelectAllOption: false
//        });

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
        
    $(function () {
        $(".subcon-icon").hide();
        $(document).on("change", '.inputGender1', function (e) {
            e.preventDefault();
            var thisid = $(this).attr("id");
            var thisval = $("#" + thisid + " option:selected").html();
            if (thisval == "Sub contract") {
                $("." + thisid).show();
            } else {
                $("." + thisid).hide();
            }
        });
        $(".subcon-icon-d").show();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('form').parsley();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("[rel=tooltip]").tooltip({placement: 'top'});
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        // Default Datatable
        $('#datatable').DataTable({"ordering": false,stateSave: true});
        $('#datatable1').DataTable({"ordering": false,stateSave: true});
        $('#datatable2').DataTable({"ordering": false,stateSave: true});
        $('#datatable3').DataTable({"ordering": false,stateSave: true});
        $('#datatable4').DataTable({"ordering": false,stateSave: true});
        $('#datatable5').DataTable({"ordering": false,stateSave: true});
        $('#datatable6').DataTable({"ordering": false,stateSave: true});
        //Buttons examples
        var table = $('#datatable-buttons').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf']
        });

        // Key Tables

        $('#key-table').DataTable({
            keys: true
        });

        // Responsive Datatable
        $('#responsive-datatable').DataTable();

        // Multi Selection Datatable
        $('#selection-datatable').DataTable({
            select: {
                style: 'multi'
            }
        });

        table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
    });

</script>

</body>
</html>