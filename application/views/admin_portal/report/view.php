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
                                                <label class="control-label">Name </label>
                                                <p><?php echo $form_data['company_name']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Email </label>
                                                <p><?php echo $form_data['email']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Type of Facility </label>
                                                <p><?php echo $form_data['type_of_facility']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Address </label>
                                                <p><?php echo $form_data['address']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"> Current Hours of Road Operation </label>
                                                <p><?php echo $form_data['hours_of_road_operation']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Phone </label>
                                                <p>Day: <?php echo $form_data['phone_day']; ?></p>
                                                <p>Night: <?php echo $form_data['phone_night']; ?></p>
                                                <p>Cell: <?php echo $form_data['phone_cell']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label"> Tax Identification Number </label>
                                                <p><?php echo $form_data['tax_identification_number']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Owner </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <div class="form-group">
                                                <label class="control-label">Length of Operation Under Present Ownership </label>
                                                <p><?php echo $form_data['length_of_operation']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Owner's Name </label>
                                                <p><?php echo $form_data['owner_name']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Address </label>
                                                <p><?php echo $form_data['owner_address']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Phone  </label>
                                                <p><?php echo $form_data['owner_phone']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Insurance </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">Garage liability insurance </label><br/>

                                            <div class="form-group">
                                                <label class="control-label">Amount </label>
                                                <p><?php echo $form_data['liability_insurance_amount']; ?></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Carrier </label>
                                                <p><?php echo $form_data['liability_insurance_carrier']; ?></p>
                                            </div>

                                            <label class="control-label">Garage liability insurance </label><br/>

                                            <div class="form-group">
                                                <label class="">Carrier </label>
                                                <p><?php echo $form_data['compensation_insurance_carrier']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Vehicles</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <!-- <label class="control-label">List any van or service vehicle owned and operated by your facility below</label> -->
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Vehicle Type (Van,Sedan, etc)</th>
                                                    <th>Year</th>
                                                    <th>Make</th>
                                                    <th>Class (Light, Medium, Heavy)</th>
                                                </tr>

                                                <?php foreach($vehicle_selected as $val){ ?>
                                                    <tr>
                                                        <td><?php echo $val['vehicle_type']; ?></td>
                                                        <td><?php echo $val['vehicle_year']; ?></td>
                                                        <td><?php echo $val['make']; ?></td>
                                                        <td><?php echo $val['class']; ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </table>

                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Employees</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <!-- <label class="control-label">List current employees that currently provide care service for your facility</label> -->
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Driver's License #</th>
                                                    <th>License Class and Endorsements</th>
                                                </tr>

                                                <?php foreach($employee_seleted as $val){ ?>
                                                    <tr>
                                                        <td><?php echo $val['employee_name']; ?></td>
                                                        <td><?php echo $val['driver_license']; ?></td>
                                                        <td><?php echo $val['license_class']; ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </table>

                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Certificates</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <!-- <label class="control-label">List any professional affiliations or certifications below</label> -->
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Organization</th>
                                                    <th>Date Certified #</th>
                                                </tr>

                                                <?php foreach($certificate_seleted as $val){ ?>
                                                    <tr>
                                                        <td><?php echo $val['organization']; ?></td>
                                                        <td><?php if($val['date_certified'] != '0000-00-00'){ echo $val['date_certified']; } ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </table>

                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Industry References </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <!-- <label class="control-label">Please list three care or vehicle cleaning industry references below</label> -->
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Company</th>
                                                    <th>Telephone Number</th>
                                                    <th>Years Known</th>
                                                </tr>

                                                <?php foreach($industry_reference_seleted as $val){ ?>
                                                    <tr>
                                                        <td><?php echo $val['ref_name']; ?></td>
                                                        <td><?php echo $val['ref_company']; ?></td>
                                                        <td><?php echo $val['ref_phone']; ?></td>
                                                        <td><?php echo $val['ref_year']; ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </table>

                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Others</h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            
                                            <div class="form-group">
                                                <label class="control-label">Employees of organization outfitted with uniforms</label>
                                                <?php if($form_data['with_uniform_or_not'] == "Y"){ ?>
                                                    <p><?php echo "Yes"; ?></p>
                                                <?php }else if($form_data['with_uniform_or_not'] == "N"){ ?>
                                                    <p><?php echo "No"; ?></p>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Test employees for drugs and/or alcohol</label>
                                                <?php if($form_data['test_drugs_alcohol'] == "Y"){ ?>
                                                    <p><?php echo "Yes"; ?></p>
                                                <?php }else if($form_data['test_drugs_alcohol'] == "N"){ ?>
                                                    <p><?php echo "No"; ?></p>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Equipment carry on vehicle(s)</label>
                                                <p><?php echo $form_data['equipment_str']; ?></p>
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