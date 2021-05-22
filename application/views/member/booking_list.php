
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Current services</h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().MEMBER;?>booking" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Service Provider</th>
                                    <th scope="col" class="sort">Date</th>
                                    <th scope="col" class="sort">Time</th>
                                    <th scope="col" class="sort">Total Amount</th>
                                    <th scope="col" class="sort">Payable Amount</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->id; //echo "<pre>";print_r($val);  ?></td>
                                        <td><?php echo $val->company_name; ?></td>
                                        <td><?php echo $val->date; ?></td>
                                        <td><?php echo $val->time; ?></td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><?php echo $val->status_txt; ?></td>
                                        <td>
                                            <a href="<?php echo base_url(MEMBER.'booking/view/'.$val->id) ?>" class="btn btn-sm bg-gray text-white">View</a>
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
