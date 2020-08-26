<!DOCTYPE html>
<html lang="en-us">
    <head>
        <?php $this->load->view(SPPATH . 'head'); ?>
        <?php $this->load->view(SPPATH . 'common_css'); ?>
        <style>
            /* table .form-control{
                padding:2px;
            } */
        </style>
    </head>

    <body class="smart-style-1">

        <?php $this->load->view(SPPATH . 'header'); ?>

        <!-- #NAVIGATION -->
        <!-- Left panel : Navigation area -->
        <!-- Note: This width of the aside area can be adjusted through LESS variables -->
        <?php $this->load->view(SPPATH . 'sidebar'); ?>
        <!-- END NAVIGATION -->

        <!-- MAIN PANEL -->
        <div id="main" role="main">

            <?php $this->load->view(SPPATH . 'breadcrumb'); ?>

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

                <form id="form1" class="" action="<?php echo base_url().SPPATH . 'profile/profile_edit'; ?>" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                        
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">COMPANY INFORMATION </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">

                                            <div class="form-group">
                                                <label class="control-label">Company Email *</label>
                                                <input type="text" name="email" placeholder="Email"  value="<?php echo $form_data['email']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Username *</label>
                                                <input type="text" name="username" placeholder="Username" value="<?php echo $form_data['username']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Password *</label>
                                                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Confirm Password *</label>
                                                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" class="form-control">
                                            </div>

                                            <div class="note txt-color-teal">
                                                <strong>Note:</strong>  Only Enter Password When You Want To Chnage It
                                            </div>
                                            <br/>

                                            <div class="form-group">
                                                <label class="control-label">Profile Picture </label>
                                                <input type="file" id="profile_pic" name="profile_pic" class="form-control">
                                                <input type="hidden" name="profile_pic_old" value="<?php echo $form_data['profile']; ?>"/>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label class="control-label">Status *</label>
                                                <select name="status" class="form-control">
                                                    <option value="">-- Select --</option>
                                                    <option value="Enable" <?php if($form_data['status'] == "Enable"){ echo "selected"; } ?>>Enable</option>
                                                    <option value="Disable" <?php if($form_data['status'] == "Disable"){ echo "selected"; } ?>>Disable</option>
                                                </select>
                                            </div> -->
                                            <hr/>

                                            <div class="form-group">
                                                <label class="control-label">Bussiness Name *</label>
                                                <input type="text" name="company_name" placeholder="Name" value="<?php echo $form_data['company_name']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Type of Facility *</label>
                                                <textarea name="type_of_facility" class="form-control" placeholder="Type of Facility"><?php if(isset($form_data['type_of_facility'])){ echo $form_data['type_of_facility']; } ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Bussiness Address *</label>
                                                <textarea name="address" class="form-control" placeholder="Address"><?php if(isset($form_data['address'])){ echo $form_data['address']; } ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Current Hours of Road Operation *</label>
                                                <input type="text" name="hours_of_road_operation" placeholder="Hours" value="<?php echo $form_data['hours_of_road_operation']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Bussiness Phone Number*</label>
                                                <input type="text" name="phone_day" placeholder="Main Dispatch Number" value="<?php echo $form_data['phone_day']; ?>" class="form-control">
                                                <br/>
                                                <input type="text" name="phone_night" placeholder="Backup Dispatch Number" value="<?php echo $form_data['phone_night']; ?>" class="form-control">
                                                <br/>
                                                <input type="text" name="phone_cell" placeholder="Owner / General manager cell" value="<?php echo $form_data['phone_cell']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Tax Identification Number *</label>
                                                <input type="text" name="tax_identification_number" placeholder="Tax Identification Number" value="<?php echo $form_data['tax_identification_number']; ?>" class="form-control">
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
                                                <label class="control-label">Length of Operation Under Present Ownership *</label>
                                                <input type="text" name="length_of_operation" placeholder="Length of Operation Under Present Ownership" value="<?php echo $form_data['length_of_operation']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">First Name *</label>
                                                <input type="text" name="owner_first_name" placeholder="Owner's First Name" value="<?php echo $form_data['owner_first_name']; ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Last Name *</label>
                                                <input type="text" name="owner_last_name" placeholder="Owner's Last Name" value="<?php echo $form_data['owner_last_name']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label><input type="checkbox" name="more_than_one_owner" value="Y" class="" <?php if($form_data['more_than_one_owner'] == "Y"){ echo "checked"; } ?>> 
                                                    More than one owner
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Owner's address *</label>
                                                <textarea name="owner_address" class="form-control" placeholder="Address"><?php if(isset($form_data['owner_address'])){ echo $form_data['owner_address']; } ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label><input type="checkbox" name="diff_mail_address" value="Y" class="" <?php if($form_data['diff_mail_address'] == "Y"){ echo "checked"; } ?>> 
                                                    Mail Address is Diffrent ?
                                                </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Owner's Phone Number *</label>
                                                <input type="text" name="owner_phone" placeholder="Phone" value="<?php echo $form_data['owner_phone']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Insurance </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">How much do you carry in garage liability insurance? *</label>
                                            <div class="form-group">
                                                <label>Amount *</label>
                                                <input type="text" name="liability_insurance_amount" placeholder="Amount" value="<?php echo $form_data['liability_insurance_amount']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Carrier *</label>
                                                <input type="text" name="liability_insurance_carrier" placeholder="Carrier" value="<?php echo $form_data['liability_insurance_carrier']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Carrier *</label>
                                                <input type="text" name="compensation_insurance_carrier" placeholder="Carrier" value="<?php echo $form_data['compensation_insurance_carrier']; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br/>

                                </div>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Vehicles </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">List any van or service vehicle owned and operated by your facility below</label>
                                            
                                            <table class="table table-striped vehicle_tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Vehicle Type (Van,Sedan, etc)</th>
                                                        <th width="20%">Year</th>
                                                        <th>Make</th>
                                                        <!-- <th>Class (Light, Medium, Heavy)</th> -->
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($vehicle_selected)){ ?>
                                                        <?php foreach($vehicle_selected as $key => $val){ ?>
                                                            <tr class="vehicle_row" id="vehicle_row_<?php echo $key; ?>">
                                                                <td><input type="text" name="vehicle_type[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['vehicle_type']; ?>" class="form-control"></td>
                                                                <td>
                                                                    <select name="vehicle_year[<?php echo $key; ?>]" id="" class="form-control" >
                                                                        <option value=""></option>
                                                                        <?php foreach($last_30_yr as $yr){ ?>
                                                                            <option value="<?php echo $yr; ?>" <?php if($yr == $val['vehicle_year']){ echo "selected"; } ?> > <?php echo $yr; ?> </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="make[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['make']; ?>" class="form-control"></td>
                                                                <!-- <td><input type="text" name="class[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['class']; ?>" class="form-control"></td> -->
                                                                <td>
                                                                    <?php if($key == 0){ ?>
                                                                        <button class="btn btn-primary btn-sm vehicle_add_btn"><i class="fa fa-plus"></i></button>
                                                                    <?php }else{ ?>
                                                                        <button class="btn btn-danger btn-sm vehicle_remove_btn"><i class="fa fa-minus"></i></button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <tr class="vehicle_row" id="vehicle_row_0">
                                                            <td><input type="text" name="vehicle_type[0]" placeholder="" value="" class="form-control"></td>
                                                            <td>
                                                                <select name="vehicle_year[0]" id="" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach($last_30_yr as $yr){ ?>
                                                                        <option value="<?php echo $yr; ?>"> <?php echo $yr; ?> </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="make[0]" placeholder="" value="" class="form-control"></td>
                                                            <!-- <td><input type="text" name="class[0]" placeholder="" value="" class="form-control"></td> -->
                                                            <td><button class="btn btn-primary btn-sm vehicle_add_btn"><i class="fa fa-plus"></i></button></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Employees </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">List current employees that currently provide care service for your facility</label>
                                            
                                            <table class="table table-striped employee_tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Driver's License #</th>
                                                        <!-- <th>License Class and Endorsements</th>  -->
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php if(!empty($employee_seleted)){ ?>
                                                        <?php foreach($employee_seleted as $key => $val){ ?>
                                                            <tr class="employee_row" id="employee_row_<?php echo $key; ?>">
                                                                <td><input type="text" name="employee_name[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['employee_name']; ?>" class="form-control"></td>
                                                                <td><input type="text" name="driver_license[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['driver_license']; ?>" class="form-control"></td>
                                                                <td><input type="text" name="license_class[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['license_class']; ?>" class="form-control"></td>
                                                                <td>
                                                                    <?php if($key == 0){ ?>
                                                                        <button class="btn btn-primary btn-sm employee_add_btn"><i class="fa fa-plus"></i></button>
                                                                    <?php }else{ ?>
                                                                        <button class="btn btn-danger btn-sm employee_remove_btn"><i class="fa fa-minus"></i></button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                <?php }else{ ?>
                                                    <tr class="employee_row" id="employee_row_0">
                                                        <td><input type="text" name="employee_name[0]" placeholder="" value="" class="form-control"></td>
                                                        <td><input type="text" name="driver_license[0]" placeholder="" value="" class="form-control"></td>
                                                        <td><input type="text" name="license_class[0]" placeholder="" value="" class="form-control"></td>
                                                        <td><button class="btn btn-primary btn-sm employee_add_btn"><i class="fa fa-plus"></i></button></td>
                                                    </tr>
                                                <?php } ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Certificates </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">List any professional affiliations or certifications below</label>
                                            
                                            <table class="table table-striped certificate_tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Organization</th>
                                                        <th>Date Certified #</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!empty($certificate_seleted)){ ?>
                                                        <?php foreach($certificate_seleted as $key => $val){ ?>
                                                            <tr class="certificate_row" id="certificate_row_<?php echo $key; ?>">
                                                                <td><input type="text" name="organization[<?php echo $key; ?>]" placeholder="" value="<?php echo $val['organization']; ?>" class="form-control"></td>
                                                                <td><input type="text" name="date_certified[<?php echo $key; ?>]" placeholder="" value="<?php if($val['date_certified'] != '0000-00-00'){ echo $val['date_certified']; } ?>" class="form-control date_certified" autocomplete="off"></td>
                                                                <td>
                                                                    <?php if($key == 0){ ?>
                                                                        <button class="btn btn-primary btn-sm certificate_add_btn"><i class="fa fa-plus"></i></button>
                                                                    <?php }else{ ?>
                                                                        <button class="btn btn-danger btn-sm certificate_remove_btn"><i class="fa fa-minus"></i></button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <tr class="certificate_row" id="certificate_row_0">
                                                            <td><input type="text" name="organization[0]" placeholder="" value="" class="form-control"></td>
                                                            <td><input type="text" name="date_certified[0]" placeholder="" value="" class="form-control date_certified" autocomplete="off"></td>
                                                            <td><button class="btn btn-primary btn-sm certificate_add_btn"><i class="fa fa-plus"></i></button></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Industry References </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <label class="control-label">Please list three care or vehicle cleaning industry references below</label>
                                            
                                            <table class="table table-striped ir_tbl">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Company</th>
                                                        <th>Telephone Number</th>
                                                        <th width="20%">Years Known</th>
                                                        <!-- <th></th> -->
                                                    </tr>
                                                </thead>

                                                <?php if(!empty($industry_reference_seleted)){ ?>
                                                    <?php foreach($industry_reference_seleted as $key => $val){ ?>

                                                    <?php } ?>
                                                <?php } ?>
                                                <tbody>
                                                    <?php for($i=0; $i<=2; $i++){ ?>
                                                        <tr class="ir_row" id="ir_row_<?php echo $i; ?>">
                                                            <td><input type="text" name="ref_name[<?php echo $i; ?>]" placeholder="" value="<?php echo $industry_reference_seleted[$i]['ref_name']; ?>" class="form-control"></td>
                                                            <td><input type="text" name="ref_company[<?php echo $i; ?>]" placeholder="" value="<?php echo $industry_reference_seleted[$i]['ref_company']; ?>" class="form-control"></td>
                                                            <td><input type="text" name="ref_phone[<?php echo $i; ?>]" placeholder="" value="<?php echo $industry_reference_seleted[$i]['ref_phone']; ?>" class="form-control"></td>
                                                            <td>
                                                                <select name="ref_year[<?php echo $i; ?>]" id="" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach($last_30_yr as $yr){ ?>
                                                                        <option value="<?php echo $yr; ?>" <?php if($industry_reference_seleted[$i]['ref_year'] == $yr){ echo "selected"; } ?> > <?php echo $yr; ?> </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <!-- <td><button class="btn btn-primary btn-sm certificate_add_btn"><i class="fa fa-plus"></i></button></td> -->
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <br/>

                                    <div class="box with-shadow">
                                        <div class="box-header bg-color-teal txt-color-white">
                                            <h5 class="">Others </h5>
                                        </div>
                                        <div class="box-body bg-color-gray">
                                            <div class="form-group">
                                                <label class="control-label">Are the employees of your organization outfitted with uniforms? *</label>
                                                <br/>
                                                <label><input type="radio" name="with_uniform_or_not" value="Y" class="" <?php if($form_data['with_uniform_or_not'] && $form_data['with_uniform_or_not'] == "Y"){ echo "checked"; } ?>> Yes</label> &nbsp;
                                                <label><input type="radio" name="with_uniform_or_not" value="N" class="" <?php if($form_data['with_uniform_or_not'] && $form_data['with_uniform_or_not'] == "N"){ echo "checked"; } ?>> No</label>
                                                <br/>
                                                <div class="radio_err"></div>
                                            </div>

                                            <div class="form-group uniform_supplier_box">
                                                <label class="control-label">which supplier provides the uniforms?</label>
                                                <input type="text" name="uniform_supplier" placeholder="Supplier Name" value="<?php echo $form_data['uniform_supplier']; ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Do you test employees for drugs and/or alcohol?</label>
                                                <br/>
                                                <label><input type="radio" name="test_drugs_alcohol" value="Y" class="" <?php if($form_data['test_drugs_alcohol'] && $form_data['test_drugs_alcohol'] == "Y"){ echo "checked"; } ?>> Yes</label> &nbsp;
                                                <label><input type="radio" name="test_drugs_alcohol" value="N" class="" <?php if($form_data['test_drugs_alcohol'] && $form_data['test_drugs_alcohol'] == "N"){ echo "checked"; } ?>> No</label>
                                                <br/>
                                                <div class="radio_err"></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">What equipment do you carry on your vehicle(s)?</label><br/>
                                                <div class="row">
                                                    <?php $equipment_old = explode(',',$form_data['equipment']); ?>
                                                    <?php foreach($equipments as $eq){ ?>
                                                        <div class="col-sm-6">
                                                            <label><input type="checkbox" name="equipment[]" value="<?php echo $eq['equipment_id'];?>" class="" <?php if(in_array($eq['equipment_id'],$equipment_old )){ echo "checked"; } ?> > 
                                                                <?php echo $eq['equipment_name'];?> 
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
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
                                    <!-- <input type="hidden" name="id" id="sp_id" value="<?php //echo $form_data['sp_id']; ?>"/> -->
                                    <!-- <a href="<?php echo base_url().SPPATH . 'serviceprovider'; ?>" name="cancel" class="btn btn-default">Cancel</a> -->
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

        <?php $this->load->view(SPPATH . 'footer'); ?>

        <!--================================================== -->
        <?php $this->load->view(SPPATH . 'common_js'); ?>

        <script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            $(document).ready(function() {
                pageSetUp();

                $('.date_certified').datepicker({
                    dateFormat: 'yy-mm-dd',
                    prevText: '<i class="fa fa-chevron-left"></i>',
                    nextText: '<i class="fa fa-chevron-right"></i>',
                    maxDate: 0,
                    changeMonth: true, 
                    changeYear: true,
                });

            });

            if_uniform();
            $("input[name='with_uniform_or_not']").change(function(){
                if_uniform();
            });

            function if_uniform(){
                val1 = $("input[name='with_uniform_or_not']:checked").val();
                // console.log(val1);
                if(val1 == "Y"){
                    $('.uniform_supplier_box').css('display','block');
                }else{
                    $('.uniform_supplier_box').css('display','none');
                }
            }

            // ================

            $('.vehicle_add_btn').click(function(e){
                e.preventDefault();

                last_row_id = $('.vehicle_tbl .vehicle_row').last().attr('id');
                // console.log(last_row_id);
                last_row_ary = last_row_id.split('_');
                last_row = last_row_ary[2];
                new_row = parseInt(last_row) + 1;
                // console.log(new_row);

                html = "";
                html += '<tr class="vehicle_row" id="vehicle_row_'+new_row+'">'+
                            '<td><input type="text" name="vehicle_type['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td>'+
                                '<select name="vehicle_year['+new_row+']" id="" class="form-control">'+
                                    '<option value=""></option>'+
                                    <?php foreach($last_30_yr as $yr){ ?>
                                        '<option value="<?php echo $yr; ?>"> <?php echo $yr; ?> </option>'+
                                    <?php } ?>
                                '</select>'+
                            '</td>'+
                            '<td><input type="text" name="make['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            // '<td><input type="text" name="class['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td><button class="btn btn-danger btn-sm vehicle_remove_btn"><i class="fa fa-minus"></i></button></td>'+
                        '</tr>';

                $("#"+last_row_id).after(html);
            });

            $('body').on('click', '.vehicle_remove_btn', function(e) {
                e.preventDefault();
                $(this).parents('.vehicle_row').remove();
            });

            // =============

            $('.employee_add_btn').click(function(e){
                e.preventDefault();

                last_row_id = $('.employee_tbl .employee_row').last().attr('id');
                // console.log(last_row_id);
                last_row_ary = last_row_id.split('_');
                last_row = last_row_ary[2];
                new_row = parseInt(last_row) + 1;
                // console.log(new_row);

                html = "";
                html += '<tr class="employee_row" id="employee_row_'+new_row+'">'+
                            '<td><input type="text" name="employee_name['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td><input type="text" name="driver_license['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td><input type="text" name="license_class['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td><button class="btn btn-danger btn-sm employee_remove_btn"><i class="fa fa-minus"></i></button></td>'+
                        '</tr>';

                $("#"+last_row_id).after(html);
            });

            $('body').on('click', '.employee_remove_btn', function(e) {
                e.preventDefault();
                $(this).parents('.employee_row').remove();
            });

            // =============

            $('.certificate_add_btn').click(function(e){
                e.preventDefault();

                last_row_id = $('.certificate_tbl .certificate_row').last().attr('id');
                // console.log(last_row_id);
                last_row_ary = last_row_id.split('_');
                last_row = last_row_ary[2];
                new_row = parseInt(last_row) + 1;
                // console.log(new_row);

                html = "";
                html += '<tr class="certificate_row" id="certificate_row_'+new_row+'">'+
                            '<td><input type="text" name="organization['+new_row+']" placeholder="" value="" class="form-control"></td>'+
                            '<td><input type="text" name="date_certified['+new_row+']" placeholder="" value="" class="form-control date_certified" autocomplete="off"></td>'+
                            '<td><button class="btn btn-danger btn-sm certificate_remove_btn"><i class="fa fa-minus"></i></button></td>'+
                        '</tr>';

                $("#"+last_row_id).after(html);

                $('.date_certified').datepicker({
                    dateFormat: 'yy-mm-dd',
                    prevText: '<i class="fa fa-chevron-left"></i>',
                    nextText: '<i class="fa fa-chevron-right"></i>',
                    maxDate: 0,
                    changeMonth: true, 
                    changeYear: true,
                });
            });

            $('body').on('click', '.certificate_remove_btn', function(e) {
                e.preventDefault();
                $(this).parents('.certificate_row').remove();
            });

            // ===========

            var errorClass = 'invalid';
            var errorElement = 'em';
            var latLongReg = new RegExp("^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}");

            t1 = "22.6730365";
            if(latLongReg.test(t1)) {
                // return true;
                // console.log('yy');
            } else {
                // return false;
                // console.log('nn');
            }

            // $.validator.addMethod("latlongcheck", function(value, element){
            //     console.log(value);
            //     // console.log(latLongReg);
            //     if(latLongReg.exec(value)) {
            //         console.log('yy');
            //     } else {;
            //         console.log('nn');
            //     }
            // }, "invalid location"); 

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
                    username: {
                        required: true,
                        remote:
                        {
                            url: '<?php echo base_url().SPPATH . 'profile/usernameCheck_edit'; ?>',
                            type: "post",
                            // data:
                            // {
                            // 	id: function(){return $('#sp_id').val();}
                            // }
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote:
                        {
                            url: '<?php echo base_url().SPPATH . 'profile/emailCheck_edit'; ?>',
                            type: "post",
                            // data:
                            // {
                            // 	id: function(){return $('#sp_id').val();}
                            // }
                        }
                    },
                    phone: {
                        required: true
                    },
                    password: {
                        // required: function(element) {
                        //     if ($("#password").val().length > 0 && $("#passwordConfirm").val().length > 0) {
                        //         return false;
                        //     } else {
                        //         return true;
                        //     }
                        // },
                        minlength: 3,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: function(element) {
                            if ($("#password").val().length > 0) {
                                return true;
                            } else {
                                return false;
                            }
                        },
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    // latitude:{
                    //     required: true,
                    //     number:true,
                    // },
                    // longitude:{
                    //     required: true,
                    //     number:true,
                    // },
                    // city: {
                    //     required: true
                    // },
                    // zipcode: {
                    //     required: true,
                    //     number:true,
                    // },
                    // state: {
                    //     required: true
                    // },
                    type_of_facility: {
                        required: true
                    },
                    address: {
                        required: true,
                    },
                    hours_of_road_operation:{
                        required: true,
                        // numbers:true,
                    },
                    phone_day:{
                        required: true,
                        digits:true,
                    },
                    phone_night:{
                        required: true,
                        digits:true,
                    },
                    phone_cell:{
                        required: true,
                        digits:true,
                    },
                    tax_identification_number: {
                        required: true,
                    },
                    length_of_operation: {
                        required: true
                    },
                    owner_first_name: {
                        required: true
                    },
                    owner_last_name: {
                        required: true
                    },
                    owner_address: {
                        required: true
                    },
                    owner_phone: {
                        required: true
                    },
                    liability_insurance_amount: {
                        required: true
                    },
                    liability_insurance_carrier: {
                        required: true
                    },
                    compensation_insurance_carrier: {
                        required: true
                    },
                    length_of_operation: {
                        required: true
                    },
                    length_of_operation: {
                        required: true
                    },
                    // status: {
                    //     required: true
                    // },
                    // "service_provide[]": "required",
                    with_uniform_or_not: {
                        required: true
                    },
                    test_drugs_alcohol: {
                        required: true
                    },
                },

                // Messages for form validation
                messages: {
                    username: {
                        remote: 'Username Already Exist'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address',
                        remote: 'Email Already Exist'
                    },
                    password: {
                        // required: 'Please enter your password'
                    },
                    passwordConfirm: {
                        // required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    latitude:{
                        number: 'Please enter valid latitude'
                    },
                    longitude:{
                        number: 'Please enter valid longitude'
                    },
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