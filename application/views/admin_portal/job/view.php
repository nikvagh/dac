<!DOCTYPE html>
<html lang="en-us">
    <head>
        <?php $this->load->view(ADMINPATH . 'head'); ?>
        <?php $this->load->view(ADMINPATH . 'common_css'); ?>
    </head>

    <body class="smart-style-1">

        <?php $this->load->view(ADMINPATH . 'header'); ?>

        <!-- #NAVIGATION -->
        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <?php $this->load->view(ADMINPATH . 'sidebar'); ?>
        <!-- END NAVIGATION -->

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <?php $this->load->view(ADMINPATH . 'breadcrumb'); ?>

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


                    <div class="row">
                        <!-- <div class="col-sm-12"> -->

                        <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                            <h2 class="box-header-single txt-color-white bg-color-teal">Service Request </h2>
                        </div> -->
                        <?php 
                            // echo "<pre>";
                            // print_r($form_data);
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">General </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <div class="form-group">
                                                <label class="control-label">Location/Address </label>
                                                <p><?php echo $form_data['location']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Service Provider can be using phone number on file? </label>
                                                <p><?php if(isset($form_data['use_phone_or_not'])){ echo "Yes"; }else{ echo "No"; } ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Notification Preference </label> <br/>
                                                <p><?php echo $form_data['notification_preference']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Vehicle </label> <br/>
                                                <p><?php echo $form_data['year'].' '.$form_data['name']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Member will be with vehicle when detailer arrives ? </label>
                                                <p><?php if($form_data['with_vehicle_or_not'] == "Y"){ echo 'Yes'; }else if($form_data['with_vehicle_or_not'] == "N"){ echo 'No'; } ?></p>
                                            </div>

                                            <?php if($form_data['with_vehicle_or_not'] == "N"){ ?>
                                                <div class="form-group">
                                                    <label class="control-label">Note</label>
                                                    <p><?php echo $form_data['not_with_vehicle_note']; ?></p>
                                                </div>
                                            <?php } ?>
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
                                                <label class="control-label">Services</label>
                                                <?php if($form_data['service_need_str'] != ""){ ?>
                                                    <p><?php echo $form_data['service_need_str']; ?></p>
                                                <?php }else{ ?>
                                                    <p>Not Any Service Selected</p>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">featured services upgrades</label>
                                                <?php if($form_data['featured_services_upgrades_str'] != ""){ ?>
                                                    <p><?php echo $form_data['featured_services_upgrades_str']; ?></p>
                                                <?php }else{ ?>
                                                    <p>Not Any Service Selected</p>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Current Status</label>
                                                <p><?php echo $form_data['status_txt']; ?></p>
                                            </div>

                                        </div>
                                    </div>
                                    <br/>   

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Assign Request To Service Providder</h5>
                                        </div>
                                        <?php if($form_data['sp_id'] == 0){ ?>
                                            <form id="form1" class="" action="<?php echo base_url().ADMINPATH . 'job/view'; ?>" method="post" enctype="multipart/form-data">
                                                
                                                <div class="box-body bg-color-gray">
                                                    <label class="control-label">Service Providers </label>
                                                    <select name="sp_id" id="sp_id" class="form-control select2">
                                                        <option value="">Select</option>
                                                        <?php foreach($sproviders as $sp){ ?>
                                                            <option value="<?php echo $sp['sp_id']; ?>"><?php echo $sp['company_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="box-footer text-right bg-color-white">
                                                    <input type="hidden" name="id" value="<?php echo $form_data['job_request_id']; ?>" />
                                                    <a href="<?php echo base_url().ADMINPATH . 'job'; ?>" name="cancel" class="btn btn-default">Cancel</a>
                                                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        <?php }else{ ?>
                                            <div class="box-body bg-color-gray">
                                                <div class="form-group">
                                                <label class="control-label">Assigned To</label>
                                                <p><?php echo $form_data['company_name']; ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <?php $this->load->view(ADMINPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(ADMINPATH . 'common_js'); ?>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!

            var errorClass = 'invalid';
            var errorElement = 'em';

            $(document).ready(function() {
                pageSetUp();
            });

            $("#form1").validate({
                // errorClass: errorClass,
                // errorElement: errorElement,
                // highlight: function(element) {
                //     $(element).removeClass('state-success').addClass("state-error");
                //     $(element).removeClass('valid');
                // },
                // unhighlight: function(element) {
                //     $(element).removeClass("state-error").addClass('state-success');
                //     $(element).addClass('valid');
                // },

                // // Rules for form validation
                // rules: {
                //     sp_id: {
                //         required: true,
                //     },
                // },
                // // Messages for form validation
                // messages: {
                //     // latitude:{
                //     //     number: 'Please enter valid latitude'
                //     // },
                // },
                // // Do not change code below
                // errorPlacement: function(error, element) {
                //     if(element.attr("type") == "checkbox") {
                //         error.insertAfter(element.parent().parent().children('.checkbox_err'));    
                //     }else if(element.attr("type") == "radio") {
                //         error.insertAfter(element.parent().parent().children('.radio_err'));    
                //     }else{
                //         error.insertAfter(element.parent());
                //     }
                // },
                submitHandler: function() {
                    if($('#sp_id').val() == ""){
                        alert('Please Select Service Provider');
                        return false;
                    }else{
                        return true;
                    }
                    
                }
            });
        </script>

    </body>
</html>