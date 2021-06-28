<div class="row justify-content-md-center">
    <div class="col-xl-8 order-xl-1">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"><?php echo $title; ?> Details</h3>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-muted">General Information</h5>
                        <table class="table breakSpace align-items-center dataTable table-hover table-striped">
                            <tbody class="list">
                                <tr>
                                    <td width="25%">Name</td>
                                    <td><?php echo $form_data->firstname." ".$form_data->lastname; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $form_data->username; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $form_data->email; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $form_data->phone; ?></td>
                                </tr>
                                <tr>
                                    <td>Profile Pic</td>
                                    <td><img src="<?php echo base_url(CUSTOMER_IMG.$form_data->profile); ?>" width="80"/></td>
                                </tr>
                                <tr>
                                    <td>Active</td>
                                    <td>
                                        <?php if($form_data->status == 'Enable'){ ?>
                                            <span class="badge badge-pill badge-default"><?php echo $form_data->status; ?></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-pill badge-danger"><?php echo $form_data->status; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="text-muted">Address</h5>
                        <table class="table breakSpace align-items-center dataTable table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Address Type</th>
                                    <th>Address</th>
                                    <th>Zip Code</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $cnt=0; foreach($form_data->addresses as $key=>$val){ $cnt++; ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $val->type; ?></td>
                                        <td><?php echo $val->address; ?></td>
                                        <td><?php echo $val->zipcode; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h5 class="text-muted">Vehicles</h5>
                        <table class="table breakSpace align-items-center dataTable table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Model</th>
                                    <th>Year</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $cnt=0; foreach($form_data->vehicles as $key=>$val){ $cnt++; ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td>
                                            <?php if($val->image != ""){ ?>
                                                <img src="<?php echo base_url(VEHICLE_IMG.$val->image); ?>" alt="" width="50">
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->year; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h5 class="text-muted">Cards</h5>
                        <table class="table breakSpace align-items-center dataTable table-hover table-striped">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Number</th>
                                    <th>Validity</th>
                                    <th>CVV</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php $cnt=0; foreach($form_data->cards as $key=>$val){ $cnt++; ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->number; ?></td>
                                        <td><?php echo $val->expiry_month."/".$val->expiry_year; ?></td>
                                        <td><?php echo $val->cvv; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h5 class="text-muted">Ongoing Packages</h5>

                        <form name="customerPackageForm" id="customerPackageForm" action="<?=base_url().ADMIN;?>customer" method="post" enctype="multipart/form-data">
                            <table class="table breakSpace align-items-center dataTable table-hover table-striped">
                                <tbody class="list">
                                    <?php 
                                        // echo "<pre>";
                                        // print_r($ongoing_packages);
                                        $cnt = 0;
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package Details</th>
                                            <th>Validity</th>
                                            <th>Service Usage (Total Used / Total Wash)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php foreach($ongoing_packages as $key=>$val){ $cnt++; ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $val->package_name; ?></td>
                                            <td><?php echo date('d M,Y',strtotime($val->start_date))." - ".date('d M,Y',strtotime($val->end_date)); ?></td>
                                            <td><?php echo $val->service_used_count.'/'.$val->total_wash; ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?php echo base_url(ADMIN.'customer/memberPackageEdit/'.$val->customer_id.'/'.$val->id) ?>"><i class="fa fa-pen-nib"></i></a>
                                                <a class="btn btn-danger btn-sm text-white" onClick="confirmDelete('customerPackageForm','<?php echo $val->id.'_'.$val->customer_id ?>','Package','deleteCustomerPackage')"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <input type="hidden" name="action" id="action" />
                            <input type="hidden" name="id" id="id"/>
                            <input type="hidden" name="publish" id="publish"/>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>