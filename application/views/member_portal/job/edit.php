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


                <form id="form1" class="" action="<?php echo base_url().MEMBERPATH . 'job/edit'; ?>" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <!-- <div class="col-sm-12"> -->

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <h2 class="box-header-single txt-color-white bg-color-teal">Service Request </h2>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Location Info</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <div class="form-group">
                                                <label>Location/Address *</label>
                                                <select name="location"  class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <?php foreach($request_location as $location){ ?>
                                                        <option value="<?php echo $location; ?>" <?php if($form_data['location'] == $location){ echo "selected"; } ?> ><?php echo $location; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="use_phone_or_not" value="" <?php //if($form_data['use_phone_or_not'] == "Y"){ echo "checked"; } ?>>
                                                    Will we be using phone number on file? 
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label>Notification Preference *</label>
                                                <select name="notification_preference" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <?php foreach($notification_preference_list as $np){ ?>
                                                        <option value="<?php echo $np; ?>" <?php //if($form_data['notification_preference'] == $np){ echo "selected"; } ?> ><?php echo $np; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Pick which vehicle is being washed today *</label>
                                                <br/>
                                                <?php foreach($vehicles as $val){ ?>
                                                    <label>
                                                        <input type="radio" name="vehicle" value="<?php echo $val['member_vehicle_id']; ?>" <?php //if($form_data['use_phone_or_not'] == "Y"){ echo "checked"; } ?>">
                                                        <?php echo $val['year'].' '.$val['name']; ?>
                                                    </label>
                                                    <br/>
                                                <?php } ?>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label>Longitude *</label>
                                                <input type="text" name="longitude" placeholder="Longitude" value="<?php echo $form_data['longitude']; ?>" class="form-control">
                                            </div> -->

                                            <div class="form-group">
                                                <label>Zip *</label>
                                                <input type="text" name="zipcode" placeholder="Zip Code" value="<?php echo $form_data['zipcode']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Service</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">

                                            <div class="form-group">
                                                <label>Service *</label>
                                                <select name="service_id" id="service_id" class="form-control">
                                                    <option value=""></option>
                                                    <?php foreach($services as $service){ ?>
                                                        <option value="<?php echo $service['service_id']; ?>" <?php if($service['service_id'] == $form_data['service_id']){ echo "selected"; } ?>>
                                                            <?php echo $service['title']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Service Provider *</label>
                                                <?php $sps = $this->job->get_sp_byServiceId($form_data['service_id']); ?>
                                                <select name="sp_id" id="sp_id" class="form-control">
                                                    <option value=""></option>
                                                    <?php foreach($sps as $sp){ ?>
                                                        <option value="<?php echo $sp['sp_id']; ?>" <?php if($sp['sp_id'] == $form_data['sp_id']){ echo "selected"; } ?>>
                                                            <?php echo $sp['company_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Service Date *</label>
                                                <input type="text" name="service_date" id="service_date" placeholder="Service Date" value="<?php echo date('Y-m-d',strtotime($form_data['service_date'])); ?>" class="form-control" />
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box with-shadow">
                                <div class="box-footer text-right bg-color-white">
                                    <input type="hidden" name="id" id="job_id" value="<?php echo $form_data['job_id']; ?>" />
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

        <?php $this->load->view(MEMBERPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(MEMBERPATH . 'common_js'); ?>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
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

            })

            $("#service_id").change(function() {
                val = $(this).val();

                request = $.ajax({
                    url: "<?php echo base_url().MEMBERPATH; ?>job/get_sp_byServiceId/"+val,
                    type: "post",
                    // data: {"service_id":val},
                    dataType: 'JSON'
                });
                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    // console.log(response);
                    html = '<option val=""></option>';
                    $.each(response, function(key ,val){
                        html += '<option value="'+val.sp_id+'">'+val.company_name+'</option>';
                        // console.log(val.sp_id);
                    });
                    $("#sp_id").html(html);
                });
            })

            var errorClass = 'invalid';
            var errorElement = 'em';

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
                    amount: {
                        required: true,
                        number: true
                    },
                    latitude:{
                        required: true,
                        number:true,
                    },
                    longitude:{
                        required: true,
                        number:true,
                    },
                    zipcode:{
                        required: true,
                        number:true
                    },
                    service_id:{
                        required: true,
                    },
                    sp_id:{
                        required: true,
                    },
                    service_date:{
                        required: true,
                    },
                },
                // Messages for form validation
                messages: {
                    latitude:{
                        number: 'Please enter valid latitude'
                    },
                    longitude:{
                        number: 'Please enter valid longitude'
                    },
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                }
            });
        </script>

    </body>
</html>