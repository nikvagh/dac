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
                                            <h5 class="">Payment </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">

                                            <table class="table table-striped">
                                                <?php $total = 0; foreach($services_list as $service){ ?>
                                                    <tr>
                                                        <td><?php echo $service['name']; ?></td>
                                                        <td><?php echo '$'.number_format($service['amount'],2); ?></td>
                                                    </tr>            
                                                <?php } ?>
                                            </table>

                                        </div>
                                    </div>
                                    <br/>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box with-shadow">
                                <div class="box-footer text-right bg-color-white">
                                    <a href="<?php echo base_url().MEMBERPATH . 'job/add'; ?>" name="cancel" class="btn btn-default">Cancel</a>
                                    <button type="submit" name="payment" class="btn btn-primary">Pay</button>
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

            var errorClass = 'invalid';
            var errorElement = 'em';

            $(document).ready(function() {
                pageSetUp();
            });
        </script>

    </body>
</html>