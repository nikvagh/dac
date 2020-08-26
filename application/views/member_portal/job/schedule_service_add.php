<!DOCTYPE html>
<html lang="en-us">
    <head>
        <?php $this->load->view(MEMBERPATH . 'head'); ?>
        <?php $this->load->view(MEMBERPATH . 'common_css'); ?>
    </head>

    <body class="smart-style-1">

        <?php $this->load->view(MEMBERPATH . 'header'); ?>

        <!-- #NAVIGATION -->
        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <?php $this->load->view(MEMBERPATH . 'sidebar'); ?>
        <!-- END NAVIGATION -->

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <?php $this->load->view(MEMBERPATH . 'breadcrumb'); ?>

            <!-- MAIN CONTENT -->
            <div id="content">

                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                        <h1 class="page-title txt-color-blueDark">
                            <?php echo $title; ?>
                        </h1>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-check"></i>
                        <strong>Success</strong> <?php echo $this->session->flashdata('success');?>
                    </div>
                    <br/>
                <?php endif; ?>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('success');?>
                    </div>
                    <br/>
                <?php endif; ?>

                <?php
                    $form_data = array();
                    if(isset($_SESSION['service_request'])){
                        $form_data = $_SESSION['service_request'];
                    }
                ?>


                <form id="form1" class="" action="<?php echo base_url().MEMBERPATH . 'job/add_schedule'; ?>" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <!-- <div class="col-sm-12"> -->

                        <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                            <h2 class="box-header-single txt-color-white bg-color-teal">Service Request </h2>
                        </div> -->

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">General </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">

                                            <div class="form-group">
                                                <label> schedule Date*</label>
                                                <input type="text" name="schedule_datetime" id="schedule_datetime" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                </div>

                                <!-- <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Service</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">

                                            <div class="form-group">
                                                <label class="control-label">
                                                    Although your vehicle should be washed once every couple of weeks, some services you will
                                                    only need every so often. Drip allows you to pick an additional service every time you request a
                                                    detail service; these services are not needed with every detail but are crucial from time to time
                                                </label>
                                                <?php foreach($services as $val){ ?>
                                                    <label>
                                                        <input type="checkbox" name="services_need[]" value="<?php echo $val['service_id']; ?>" <?php if(isset($form_data['services_need']) && in_array($val['service_id'],$form_data['services_need'])){ echo "checked"; } ?>/> <?php echo $val['title']; ?>    
                                                    </label>
                                                    <br/>
                                                <?php } ?>
                                                <div class="checkbox_err"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">
                                                    featured services upgrades
                                                    (These services are only needed in special circumstances; an additional fee will be applied if one
                                                    of the services is requested)
                                                </label>
                                                <?php foreach($serviceupgrades as $val){ ?>
                                                    <label>
                                                        <input type="checkbox" name="featured_services_upgrades[]" value="<?php echo $val['service_upgrade_id']; ?>" <?php if(isset($form_data['featured_services_upgrades']) && in_array($val['service_upgrade_id'],$form_data['featured_services_upgrades'])){ echo "checked"; } ?>/> 
                                                        <?php echo $val['title'].' $'.number_format($val['amount'],2); ?>    
                                                    </label>
                                                    <br/>
                                                <?php } ?>
                                                <div class="checkbox_err"></div>
                                            </div>

                                        </div>
                                    </div>
                                    <br/>
                                </div> -->

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box with-shadow">
                                <div class="box-footer text-right bg-color-white">
                                    <a href="<?php echo base_url().MEMBERPATH . 'job'; ?>" name="cancel" class="btn btn-default">Cancel</a>
                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>


            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <!-- Modal -->
        <div class="modal fade" id="addVehicle_Modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">

                <form class="" method="post" id="add_vehicle_form" action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Add Vehicle </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <section class="col-sm-8">
                                    <div class="form-group">
                                        <input type="text" name="vehicle_name" placeholder="Vehicle Name" value="" class="form-control">
                                    </div>
                                </section>
                                <section class="col-sm-4">
                                    <div class="form-group">
                                        <select name="vehicle_year" class="form-control">
                                            <option value="">Select Year</option>
                                            <?php foreach($last_30_yr as $yr){ ?>
                                                <option value="<?php echo $yr; ?>"> <?php echo $yr; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <?php $this->load->view(MEMBERPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(MEMBERPATH . 'common_js'); ?>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            var errorClass = 'invalid';
            var errorElement = 'em';

            $(document).ready(function() {
                pageSetUp();

                $('#schedule_datetime').datepicker({
                    dateFormat: 'yy-mm-dd',
                    prevText: '<i class="fa fa-chevron-left"></i>',
                    nextText: '<i class="fa fa-chevron-right"></i>',
                    minDate: 0,
                    maxDate: +7,
                    changeMonth: true,
                    changeYear: true,
                });
            });

            with_vehicle();
            $("input[name='with_vehicle_or_not']").change(function(){
                with_vehicle();
            });

            function with_vehicle(){
                val1 = $("input[name='with_vehicle_or_not']:checked").val();
                // console.log(val1);
                if(val1 == "N"){
                    $('.not_with_vehicle_note_box').css('display','block');
                }else{
                    $('.not_with_vehicle_note_box').css('display','none');
                }
            }

            $("#add_vehicle_form").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function(element) {
                    $(element).removeClass('state-success').addClass("state-error");
                    $(element).removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass("state-error").addClass('state-success');
                    $(element).addClass('valid');
                },

                // Rules for form validation
                rules: {
                    vehicle_name: {
                        required: true,
                    },
                    vehicle_year: {
                        required: true,
                    },
                },
                // Messages for form validation
                messages: {
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    if(element.attr("type") == "checkbox") {
                        error.insertAfter(element.parent().parent().children('.checkbox_err'));    
                    }else if(element.attr("type") == "radio") {
                        error.insertAfter(element.parent().parent().children('.radio_err'));    
                    }else{
                        error.insertAfter(element);
                    }
                },
            });

            $("#add_vehicle_form").submit(function(e){
                e.preventDefault();

                $.ajax({
                    url:'<?php echo base_url().MEMBERPATH . 'job/addVehicle'; ?>',
                    type:'POST',
                    data:$(this).serialize(),
                    dataType : 'html',
                    success:function(result){
                        $(".vehicle_box").html(result);
                        $('#addVehicle_Modal').modal('hide');
                        // return false;
                    }
                });

            });

            // $("#service_id").change(function() {
            //     val = $(this).val();

            //     request = $.ajax({
            //         url: "<?php //echo base_url().MEMBERPATH; ?>job/get_sp_byServiceId/"+val,
            //         type: "post",
            //         // data: {"service_id":val},
            //         dataType: 'JSON'
            //     });
            //     // Callback handler that will be called on success
            //     request.done(function (response, textStatus, jqXHR){
            //         // Log a message to the console
            //         // console.log(response);
            //         html = '<option val=""></option>';
            //         $.each(response, function(key ,val){
            //             html += '<option value="'+val.sp_id+'">'+val.company_name+'</option>';
            //             // console.log(val.sp_id);
            //         });
            //         $("#sp_id").html(html);
            //     });
            // })

            $("#form1").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function(element) {
                    $(element).removeClass('state-success').addClass("state-error");
                    $(element).removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass("state-error").addClass('state-success');
                    $(element).addClass('valid');
                },

                // Rules for form validation
                rules: {
                    schedule_datetime: {
                        required: true,
                    },
                },
                // Messages for form validation
                messages: {
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    if(element.attr("type") == "checkbox") {
                        error.insertAfter(element.parent().parent().children('.checkbox_err'));    
                    }else if(element.attr("type") == "radio") {
                        error.insertAfter(element.parent().parent().children('.radio_err'));    
                    }else{
                        error.insertAfter(element);
                    }
                },

            });
        </script>

    </body>
</html>