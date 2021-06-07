
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().ADMIN;?>zone" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        <td><?php echo $val->name; ?></td>
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
                                                <input type="checkbox" name="status" <?php echo $checked; ?> onClick="confirmPublishStatus('dataTableForm',<?php echo $val->id ?>,'<?php echo $publish_st; ?>')">
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(ADMIN.'zone/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Zone')" class="btn btn-sm btn-danger text-white">Delete</a>
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
