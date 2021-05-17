
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>package" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Customer Name</th>
                                    <th scope="col" class="sort">Package</th>
                                    <!-- <th scope="col" class="sort">Amount</th> -->
                                    <th scope="col" class="sort">Start Date</th>
                                    <th scope="col" class="sort">End Date</th>
                                    <th scope="col">Validity Status</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        <td><?php echo $val->firstname.' '.$val->lastname; ?></td>
                                        <td><?php echo $val->package_name; ?></td>
                                        <td><?php echo $val->start_date; ?></td>
                                        <td><?php echo $val->end_date; ?></td>
                                        <td>
                                            <?php 
                                                if($val->validity_status == 'Ongoing'){
                                                    $st_class = "badge-success";
                                                }elseif($val->validity_status == 'Pending'){
                                                    $st_class = "badge-primary";
                                                }elseif($val->validity_status == 'Expired'){
                                                    $st_class = "badge-danger";
                                                }
                                                echo '<span class="badge badge-pill '.$st_class.'">'.$val->validity_status.'</span>';
                                            ?>
                                        </td>
                                        <!-- <td> -->
                                            <!-- <a href="<?php echo base_url(ADMIN.'package/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a> -->
                                            <!-- <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Package')" class="btn btn-sm btn-danger text-white">Delete</a> -->
                                        <!-- </td> -->
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
