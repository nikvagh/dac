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

                        <article class="col-sm-12 col-md-12 col-lg-6">

                            <!-- Widget ID (each widget will need unique ID)-->
                            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                                <!-- widget options:
                                            usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                                            
                                            data-widget-colorbutton="false"	
                                            data-widget-editbutton="false"
                                            data-widget-togglebutton="false"
                                            data-widget-deletebutton="false"
                                            data-widget-fullscreenbutton="false"
                                            data-widget-custombutton="false"
                                            data-widget-collapsed="true" 
                                            data-widget-sortable="false"
                                            
                                        -->

                                <header class="txt-color-white bg-color-teal">
                                    <!-- <span class="widget-icon"> <i class="fa fa-edit"></i> </span> -->
                                    <h2>Service Info </h2>
                                </header>

                                <!-- widget div-->
                                <div>

                                    <!-- widget edit box -->
                                    <div class="jarviswidget-editbox">
                                        <!-- This area used as dropdown edit box -->

                                    </div>
                                    <!-- end widget edit box -->

                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                                    <?php 
                                                    //  echo "<pre>";
                                                    //  print_r($profile);
                                                    ?>
                                        <form id="form1" class="smart-form" action="<?php echo base_url().ADMINPATH . 'service/edit'; ?>" method="post" enctype="multipart/form-data">
                                            <!-- <header>Edit Profile</header> -->

                                            <fieldset>
                                                <section>
                                                    <label class="input">
                                                        <label>Title *</label>
                                                        <input type="text" name="title" placeholder="Title" value="<?php echo $form_data['title']; ?>">
                                                    </label>
                                                </section>

                                                <section class="">
                                                    <label class="textarea">
                                                        <label>Description </label>
                                                        <textarea rows="3" name="description" placeholder="Description"><?php echo $form_data['description']; ?></textarea>
                                                    </label>
                                                </section>
                                               
                                                <!-- <section>
                                                    <label class="input">
                                                        <label>Amount *</label>
                                                        <input type="text" name="amount" placeholder="Service Price" value="<?php //echo $form_data['amount']; ?>">
                                                    </label>
                                                </section> -->

                                                <section>
                                                    <label class="select">
                                                        <label>Status *</label>
                                                        <select name="status">
                                                            <option value="">-- Select --</option>
                                                            <option value="Enable" <?php if($form_data['status'] == "Enable"){ echo "selected"; } ?>>Enable</option>
                                                            <option value="Disable" <?php if($form_data['status'] == "Disable"){ echo "selected"; } ?>>Disable</option>
                                                        </select>
                                                    </label>
                                                </section>

                                            </fieldset>

                                            <footer>
                                                <input type="hidden" name="id" value="<?php echo $form_data['service_id']; ?>">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <a href="<?php echo base_url().ADMINPATH . 'service'; ?>" name="cancel" class="btn btn-default">Cancel</a>
                                            </footer>
                                        </form>

                                    </div>
                                    <!-- end widget content -->

                                </div>
                                <!-- end widget div -->

                            </div>
                            <!-- end widget -->

                        </article>

                    <!-- </div> -->
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
            $(document).ready(function() {
                pageSetUp();
            })

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
                    package_name: {
                        required: true,
                    },
                    // package_amount: {
                    //     required: true,
                    //     number: true
                    // },
                    package_validity: {
                        required: true,
                    },
                    status: {
                        required: true,
                    }
                },

                // Messages for form validation
                messages: {
                    // package_amount: {
                    //     number: 'Please Enter Valid Amount'
                    // },
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
        </script>

    </body>
</html>