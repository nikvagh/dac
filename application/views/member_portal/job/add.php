<!DOCTYPE html>
<html lang="en-us">
    <head>
        <?php $this->load->view(MEMBERPATH . 'head'); ?>
        <?php $this->load->view(MEMBERPATH . 'common_css'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css" integrity="sha512-eOKbnuWqH2HMqH9nXcm95KXitbj8k7P49YYzpk7J4lw1zl+h4uCjkCfV7RaY4XETtTZnNhgsa+/7x29fH6ffjg==" crossorigin="anonymous" />
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


                <form id="form1" class="" action="<?php echo base_url().MEMBERPATH . 'job/payment'; ?>" method="post" enctype="multipart/form-data">

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
                                                <label class="control-label">Location/Address *</label>
                                                <select name="location" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <?php foreach($request_location as $location){ ?>
                                                        <option value="<?php echo $location; ?>" <?php if(isset($form_data['location']) && $form_data['location'] == $location){ echo "selected"; } ?>><?php echo $location; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">
                                                    <input type="checkbox" name="use_phone_or_not" value="" <?php if(isset($form_data['use_phone_or_not'])){ echo "checked"; } ?>>
                                                    Will we be using phone number on file? 
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Notification Preference *</label>
                                                <select name="notification_preference" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <?php foreach($notification_preference_list as $np){ ?>
                                                        <option value="<?php echo $np; ?>" <?php if(isset($form_data['notification_preference']) && $form_data['notification_preference'] == $np){ echo "selected"; } ?> ><?php echo $np; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Pick which vehicle is being washed today *</label>
                                                <br/>
                                                <div class="vehicle_box">
                                                    <?php foreach($vehicles as $val){ ?>
                                                        <label>
                                                            <input type="radio" name="vehicle" value="<?php echo $val['member_vehicle_id']; ?>" <?php if(isset($form_data['vehicle']) && $form_data['vehicle'] == $val['member_vehicle_id']){ echo "checked"; } ?> >
                                                            <?php echo $val['year'].' '.$val['name']; ?>
                                                        </label>
                                                        <br/>
                                                    <?php } ?>
                                                    <div class="radio_err"></div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#addVehicle_Modal"><i class="fa fa-plus"></i> Vehicle</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Time *</label>
                                                <div class="form-group">
                                                    <input type="text" name="time" id="time" class="form-control" value="<?php if(isset($form_data['time'])){ echo  $form_data['time']; } ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">will you be with vehicle when detailer arrives? *</label>
                                                <br/>
                                                <label><input type="radio" name="with_vehicle_or_not" class="with_vehicle_or_not" value="Y" <?php if(isset($form_data['with_vehicle_or_not']) && $form_data['with_vehicle_or_not'] == "Y"){ echo "checked"; } ?>/> Yes</label>
                                                <label><input type="radio" name="with_vehicle_or_not" class="with_vehicle_or_not" value="N" <?php if(isset($form_data['with_vehicle_or_not']) && $form_data['with_vehicle_or_not'] == "N"){ echo "checked"; } ?>/> No</label>
                                                <br/>
                                                <div class="radio_err"></div>
                                            </div>

                                            <div class="form-group not_with_vehicle_note_box">
                                                <label>Note</label>
                                                <textarea name="not_with_vehicle_note" class="form-control"><?php if(isset($form_data['not_with_vehicle_note'])){ echo $form_data['not_with_vehicle_note']; } ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Additional Notes ?</label>
                                                <textarea name="additional_note" class="form-control"><?php if(isset($form_data['additional_note'])){ echo $form_data['additional_note']; } ?></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <br/>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
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
                                </div>

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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js" integrity="sha512-RLw8xx+jXrPhT6aXAFiYMXhFtwZFJ0O3qJH1TwK6/F02RSdeasBTTYWJ+twHLCk9+TU8OCQOYToEeYyF/B1q2g==" crossorigin="anonymous"></script>
        <!-- <script src="<?php echo $this->assets; ?>js/plugin/bootstrap-timepicker"></script> -->
        

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            var errorClass = 'invalid';
            var errorElement = 'em';

            $(document).ready(function() {
                pageSetUp();

                $('#service_date').datepicker({
                    dateFormat: 'yy-mm-dd',
                    prevText: '<i class="fa fa-chevron-left"></i>',
                    nextText: '<i class="fa fa-chevron-right"></i>',
                    minDate: 0,
                    changeMonth: true, 
                    changeYear: true,
                });

                // $("#time").timepicker(function(){

                // });

                $('#time').timepicker({
                    // timeFormat: 'hh:mm:ss',
                    timeFormat: 'H:i',
                    // minTime: '13:00',
                    minTime: new Date(((new Date).getTime() + 1 * 60 * 60 * 1000) ),
                    maxTime: '18:00',
                    step: 15,
                    // dynamic: false,
                    // dropdown: true,
                    // scrollbar: true,
                    // change: function (time) {
                    //     var time = $(this).val();
                    //     var picker = $(".endTP");
                    //     picker.timepicker('option', 'minTime', time);
                    // }
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
                    location: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    notification_preference: {
                        required: true,
                    },
                    vehicle:{
                        required: true,
                    },
                    with_vehicle_or_not:{
                        required: true,
                    },
                    // "services_need[]":{
                    //     required: true,
                    // },
                    // "featured_services_upgrades[]":{
                    //     required: true,
                    // },
                },
                // Messages for form validation
                messages: {
                    // latitude:{
                    //     number: 'Please enter valid latitude'
                    // },
                    // longitude:{
                    //     number: 'Please enter valid longitude'
                    // },
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