
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>serviceProvider" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Company Name</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col" class="sort">Email</th>
                                    <th scope="col" class="sort">Phone</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->sp_id; ?></td>
                                        <td><?php echo $val->company_name; ?></td>
                                        <td>
                                            <?php if($val->profile != ""){ ?>
                                                <img src="<?php echo base_url(SP_IMG.$val->profile); ?>" width="50"/>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $val->email; ?></td>
                                        <td><?php echo $val->phone_day; ?></td>
                                        <td>
                                            <label class="custom-toggle">
                                                <?php 
                                                    if($val->status == 'Enable'){ 
                                                        $checked = "checked";
                                                        $publish_st = "Disable";
                                                    }else{
                                                        $checked = "";
                                                        $publish_st = "Enable";
                                                    }
                                                ?>
                                                <input type="checkbox" name="status" <?php echo $checked; ?> onClick="confirmPublishStatus('dataTableForm',<?php echo $val->sp_id ?>,'<?php echo $publish_st; ?>')">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(ADMIN.'serviceProvider/view/'.$val->sp_id) ?>" class="btn btn-sm btn-info">Portfolio</a>
                                            <a href="<?php echo base_url(ADMIN.'serviceProvider/edit/'.$val->sp_id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('dataTableForm',<?php echo $val->sp_id ?>,'Service Provider')" class="btn btn-sm btn-danger text-white">Delete</a>
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
