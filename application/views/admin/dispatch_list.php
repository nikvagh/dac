
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>appointment" method="post" enctype="multipart/form-data">
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
                                    <!-- <th scope="col" class="sort">Status</th> -->
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
                                        <!-- <td>
                                            <select name="status" id="" onChange="confirmPublishStatus('dataTableForm',<?php echo $val->id ?>,this,'Y')" class="form-control">
                                                <?php foreach($statuses as $key1=>$val1){ ?>
                                                    <option value="<?php echo $val1->id; ?>" <?php if($val1->id == $val->status_id){ echo "selected"; } ?>><?php echo $val1->status_txt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td> -->
                                        <td>
                                            <a href="<?php echo base_url(ADMIN.'dispatch/view/'.$val->id) ?>" class="btn btn-sm bg-yellow">Details</a>
                                            <!-- <a href="<?php echo base_url(ADMIN.'dispatch/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a> -->
                                            <!-- <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Appointment')" class="btn btn-sm btn-danger text-white">Delete</a> -->
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
