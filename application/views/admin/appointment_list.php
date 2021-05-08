
    <div class="row">
        <div class="col">

            <form name="filterForm" id="filterForm" action="<?=base_url().ADMIN;?>appointment/filter" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Filter Data</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Service Provider</label>
                                <select name="serviceProvider" class="form-control">
                                    <option value=""> -- Select --</option>
                                    <?php foreach($sps as $key=>$val){ ?>
                                        <option value="<?php echo $val->sp_id; ?>" <?php if($this->session->userdata('serviceProvider_ap_f') == $val->sp_id){ echo 'selected'; } ?>><?php echo $val->company_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control">
                                    <option value=""> -- Select --</option>
                                    <?php foreach($statuses as $key=>$val){ ?>
                                        <option value="<?php echo $val->id; ?>" <?php if($this->session->userdata('status_ap_f') == $val->id){ echo 'selected'; } ?>><?php echo $val->status_txt; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <input type="submit" name="submit" class="btn btn-primary" value="Clear"/>
                        <input type="submit" name="submit" class="btn btn-default" value="Filter"/>
                    </div>
                </div>
            </form>

            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>appointment" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Customer</th>
                                    <th scope="col" class="sort">Service Provider</th>
                                    <th scope="col" class="sort">Date</th>
                                    <th scope="col" class="sort">Duration</th>
                                    <th scope="col" class="sort">Amount</th>
                                    <th scope="col" class="sort">Service At</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ //echo "<pre>";print_r($val); ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        <td><?php echo $val->firstname.' '.$val->lastname; ?></td>
                                        <td><?php echo $val->company_name; ?></td>
                                        <td><?php echo $val->date; ?></td>
                                        <td><?php echo $val->duration; ?></td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><?php echo $val->service_at; ?></td>
                                        <td>
                                            <select name="status" id="" onChange="confirmPublishStatus('dataTableForm',<?php echo $val->id ?>,this,'Y')" class="form-control form-control-sm">
                                                <?php foreach($statuses as $key1=>$val1){ ?>
                                                    <option value="<?php echo $val1->id; ?>" <?php if($val1->id == $val->status_id){ echo "selected"; } ?>><?php echo $val1->status_txt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td>
                                            <!-- <a href="<?php echo base_url(ADMIN.'appointment/view/'.$val->id) ?>" class="btn btn-sm bg-yellow">View</a> -->
                                            <a href="<?php echo base_url(ADMIN.'appointment/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Appointment')" class="btn btn-sm btn-danger text-white">Delete</a>
                                            <a href="<?php echo base_url(ADMIN.'appointment/invoice/'.$val->id) ?>" class="btn btn-sm bg-gray text-white">Invoice</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <input type="hidden" name="action" id="action" />
                    <input type="hidden" name="id" id="id"/>
                    <input type="hidden" name="publish" id="publish"/>
                </form>

            </div>

        </div>
    </div>
