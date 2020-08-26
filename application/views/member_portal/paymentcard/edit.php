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
                                        <form id="form1" class="smart-form" action="<?php echo base_url().MEMBERPATH . 'paymentcard/edit'; ?>" method="post" enctype="multipart/form-data">
                                            <!-- <header>Edit Profile</header> -->

                                            <fieldset>
                                                <section>
                                                    <label class="input">
                                                        <label>Name On Card *</label>
                                                        <input type="text" name="name" placeholder="Name On Card" value="<?php echo $form_data['name']; ?>">
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="input">
                                                        <label>Card Number *</label>
                                                        <input type="text" name="number" placeholder="Card Number" value="<?php echo $form_data['number']; ?>">
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="input">
                                                        <label>Expiry Month *</label>
                                                        <input type="text" name="expiry_month" placeholder="Expiry Month" value="<?php echo $form_data['expiry_month']; ?>">
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="input">
                                                        <label>Expiry Year *</label>
                                                        <input type="text" name="expiry_year" placeholder="Expiry Year" value="<?php echo $form_data['expiry_year']; ?>">
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="input">
                                                        <label>CVV *</label>
                                                        <input type="text" name="cvv" placeholder="CVV" value="<?php echo $form_data['cvv']; ?>">
                                                    </label>
                                                </section>
                                            </fieldset>
                                        
                                            <footer>
                                                <input type="hidden" name="id" value="<?php echo $form_data['id']; ?>">
                                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                                <a href="<?php echo base_url().MEMBERPATH . 'paymentcard'; ?>" name="cancel" class="btn btn-default">Cancel</a>
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

        <?php $this->load->view(MEMBERPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(MEMBERPATH . 'common_js'); ?>

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
                    name: {
                        required: true,
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    expiry_month: {
                        required: true,
                        number: true,
                        min: 1,
                        max: 12
                    },
                    expiry_year: {
                        required: true,
                        number: true,
                        minlength:4,
                        maxlength:4
                    },
                    cvv: {
                        required: true,
                        number: true
                    }
                },

                // Messages for form validation
                messages: {
                    package_amount: {
                        number: 'Please Enter Valid Amount'
                    },
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                }
            });
        </script>

    </body>
</html>