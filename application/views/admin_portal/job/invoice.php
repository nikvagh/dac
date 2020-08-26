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
                            $invoice_number = sprintf("%05d", $form_data['job_request_id']);
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h5 class="">Invoice #<?php echo $invoice_number; ?></h5> 
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <h5 class="">
                                                        <a href="<?php echo base_url().ADMINPATH . 'job/download_invoice/'.$form_data['job_request_id']; ?>" class="btn btn-primary">Download</a>
                                                        <a href="<?php echo base_url().ADMINPATH . 'job/email_invoice/'.$form_data['job_request_id']; ?>" class="btn btn-primary">Email To Customer</a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-body">

                                            <div class="padding-10">
                                                <div class="pull-right text-right">
                                                    <img src="<?php echo $this->assets; ?>img/logo.png" width="100" alt="invoice icon">
                                                    <br/><br>
                                                    <address>
                                                        <strong><?php echo $this->system->company_name; ?></strong>
                                                        <br/>
                                                        <?php echo $this->system->company_address; ?>
                                                    </address>
                                                    <h4>Invoice Number #<?php echo $invoice_number; ?></h4>
                                                    <h4 class="">Date: <?php echo date('d M, Y',strtotime($form_data['created_at'])); ?></h4>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="pull-left">
                                                    <!-- <address> -->
                                                        <h3>To, <?php echo $form_data['firstname'].' '.$form_data['lastname']; ?></h3>
                                                        <br/>
                                                        <?php //echo $this->system->company_address; ?>
                                                    <!-- </address> -->
                                                </div>
                                                <div class="clearfix"></div>
                                                
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>SERVICE LIST</th>
                                                            <th>SUBTOTAL</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(!empty($services)){ ?>
                                                            <tr>
                                                                <td colspan="3" class="text-center">Services</td>
                                                            </tr>
                                                            <?php $cnt1=1; $total=0; foreach($services as $val){ ?>
                                                                <tr>
                                                                    <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                                                                    <td><a><?php echo $val['title']; ?></a></td>
                                                                    <td>
                                                                        <?php 
                                                                            // $total += $val['amount'];
                                                                            echo '$0'; 
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php $cnt1++; } ?>
                                                        <?php } ?>
                                                                
                                                        <?php if(!empty($featured_services)){ ?>
                                                            <tr>
                                                                <td colspan="3" class="text-center">Featured Services</td>
                                                            </tr>
                                                            <?php $total=0; foreach($featured_services as $val){ ?>
                                                                <tr>
                                                                    <td class="text-center"><strong><?php echo $cnt1; ?></strong></td>
                                                                    <td><a><?php echo $val['title']; ?></a></td>
                                                                    <td>
                                                                        <?php 
                                                                            $total += $val['amount'];
                                                                            echo '$'.$val['amount']; 
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php $cnt1++; } ?>
                                                        <?php }  ?>

                                                        <?php if($form_data['fee'] > 0){ ?> 
                                                            <tr>
                                                                <td colspan="2" class="text-right">Additional Fee</td>
                                                                <td><strong><?php echo '$'.$form_data['fee']; ?></strong></td>
                                                            </tr>
                                                        <?php } ?>

                                                        <tr>
                                                            <td colspan="2" class="text-right">Total</td>
                                                            <!-- <td><strong><?php echo '$'.$total; ?></strong></td> -->
                                                            <td><strong><?php echo '$'.$form_data['payeble_amount']; ?></strong></td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td colspan="2" class="text-right">HST/GST</td>
                                                            <td><strong>13%</strong></td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                    
                                            </div>

                                        </div>
                                    </div>
                                    <br/>
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