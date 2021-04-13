
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0"></h3>
                </div>

                <form name="datatableForm" id="datatableForm" action="<?=base_url().ADMIN;?>category" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" class="sort">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->category_id; ?></td>
                                        <td><?php echo $val->category_name; ?></td>
                                        <td>
                                            <?php if($val->image != ""){ ?>
                                                <img src="<?php echo base_url(CATEGORY_IMG.$val->image); ?>" width="50"/>
                                            <?php } ?>
                                        </td>
                                        <td><?php if($val->category_status == 0){ echo '<span class="text-success">Enabled</span>'; }else{ echo '<span class="text-danger">Disabled</span>'; } ?></td>
                                        <td>
                                            <a href="<?php echo base_url(ADMIN.'category/edit/'.$val->category_id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('datatableForm',<?php echo $val->category_id ?>,'Category')" class="btn btn-sm btn-danger text-white">Delete</a>
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
