
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>offer" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Code</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" class="sort">Discount</th>
                                    <th scope="col" class="sort">Start Date</th>
                                    <th scope="col" class="sort">End Date</th>
                                    <th scope="col" class="sort">Categories</th>
                                    <th scope="col" class="sort">Services</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php if(!empty($list)){ ?>
                                    <?php foreach($list as $key=>$val){ ?>
                                        <tr>
                                            <td><?php echo $val->id; ?></td>
                                            <td><?php echo $val->code; ?></td>
                                            <td>
                                                <?php if($val->image != ""){ ?>
                                                    <img src="<?php echo base_url(OFFER_IMG.$val->image); ?>" width="50"/>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $val->discount; ?></td>
                                            <td><?php echo $val->start_date; ?></td>
                                            <td><?php echo $val->end_date; ?></td>
                                            <td><?php echo implode(', ',$val->category_names); ?></td>
                                            <td><?php echo implode(', ',$val->services_names); ?></td>
                                            <td>
                                                <a href="<?php echo base_url(ADMIN.'offer/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a>
                                                <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Offer ')" class="btn btn-sm btn-danger text-white">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <!-- <tr>
                                        <td colspan="9" class="text-center">Empty Data</td>
                                    </tr> -->
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
