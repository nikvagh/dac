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

                <form id="form1" class="" action="<?php echo base_url().ADMINPATH . 'settings/update'; ?>" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Edit Setting</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <div class="form-group">
                                                <label class="control-label">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" value="<?=$this->system->company_name?>" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company Address</label>
                                                <textarea type="text" name="company_address" id="company_address" class="form-control"><?=$this->system->company_address?></textarea>
                                            </div> 
                                            <div class="form-group">
                                                <label class="control-label">Company Contact</label>
                                                <input type="text" name="company_mobile" id="company_mobile" value="<?=$this->system->company_mobile?>" class="form-control"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Company Email</label>
                                                <input type="text" name="company_email" id="company_email" value="<?=$this->system->company_email?>" class="form-control"/>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="site_name" class="control-label">Site Name</label>
                                                <input type="text" name="site_name" id="site_name" value="<?=$this->system->site_name?>" class="form-control"/>
                                            </div> -->
                                            <div class="form-group">
                                                <label class="control-label">Copyright Text</label>
                                                <textarea type="text" name="company_copyright" id="company_copyright" class="form-control"><?=$this->system->company_copyright?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Service Provider Content</label>
                                                <textarea type="text" name="service_provider_content" id="service_provider_content" class="form-control"><?=$this->system->service_provider_content?></textarea>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label class="control-label">Email Address</label>
                                                <input type="text" name="from_email_address" id="from_email_address" value="<?=$this->system->from_email_address?>" class="form-control"/>
                                            </div> -->
                                        </div>

                                        <div class="box-footer text-right bg-color-white">
                                            <!-- <a href="<?php echo base_url().ADMINPATH . 'serviceprovider'; ?>" name="cancel" class="btn btn-default">Cancel</a> -->
                                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>


            </div>
            <!-- END MAIN CONTENT -->

        </div>
        <!-- END MAIN PANEL -->

        <?php $this->load->view(ADMINPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(ADMINPATH . 'common_js'); ?>

        <script type="text/javascript">
            $(document).ready(function() {
                CKEDITOR.replace('service_provider_content', { height: '300px', startupFocus : true });
            });
        </script>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            $(document).ready(function() {
                pageSetUp();
            });

            // ===========

            var errorClass = 'invalid';
            var errorElement = 'em';

            $("#form1").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function(element) {
                    $(element).parent().removeClass('state-success').addClass("state-error");
                    $(element).removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).parent().removeClass("state-error").addClass('state-success');
                    $(element).addClass('valid');
                },

                // Rules for form validation
                rules: {
                    company_name: {
                        required: true,
                    },
                    company_email: {
                        email: true,
                    },
                },

                // Messages for form validation
                messages: {
                    // username: {
                    //     remote: 'Username Already Exist'
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
                ignore: 'input[type=hidden]'
            });
        </script>

    </body>
</html>
