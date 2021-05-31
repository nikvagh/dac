
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Transactions</h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().MEMBER;?>payment" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col" class="sort">User Type</th>
                                    <th scope="col" class="sort">Amount</th>
                                    <th scope="col" class="sort">Transaction Type</th>
                                    <th scope="col">Status</th>
                                    <!-- <th scope="col">Action</th> -->
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($list as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        <td>
                                            <?php 
                                                if($val->user_type == 'customer'){
                                                    echo $val->firstname.' '.$val->lastname; 
                                                }else{
                                                    echo $val->company_name; 
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($val->user_type == 'customer'){ echo "Customer"; }else if($val->user_type == 'sp'){ echo "Service Provider"; } ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($val->transaction_type == "Credit"){
                                                    echo '<span class="text-danger font-weight-bold">'.$val->amount.'</span>';
                                                }else if($val->transaction_type == "Debit"){
                                                    echo '<span class="text-success font-weight-bold">'.$val->amount.'</span>';
                                                }
                                            ?>
                                        </td>
                                        <td> 
                                            <?php if($val->transaction_type == "Credit"){  echo 'Debit'; }else if($val->transaction_type == "Debit"){ echo 'Credit'; } ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($val->status == 'Pending'){
                                                    $status_theme = "info";
                                                }else if($val->status == 'Failed'){
                                                    $status_theme = "danger";
                                                }else if($val->status == 'Success'){
                                                    $status_theme = "success";
                                                }
                                            ?>
                                            <span class="badge badge-lg badge-<?php echo $status_theme; ?>"><?php echo $val->status; ?></span>
                                        </td>
                                        <!-- <td>
                                            <a href="<?php echo base_url(MEMBER.'payment/edit/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Payment')" class="btn btn-sm btn-danger text-white">Delete</a>
                                        </td> -->
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

            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Cards</h3>
                </div>

                <form name="dataTableForm" id="dataTableForm" action="<?=base_url().MEMBER;?>payment" method="post" enctype="multipart/form-data">
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush dataTable table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="sort">#</th>
                                    <th scope="col" class="sort">Name</th>
                                    <th scope="col" class="sort">Number</th>
                                    <th scope="col" class="sort">Expiry Date</th>
                                    <th scope="col" class="sort">CVV</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach($listCard as $key=>$val){ ?>
                                    <tr>
                                        <td><?php echo $val->id; ?></td>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->number; ?></td>
                                        <td> <?php echo $val->expiry_month.'/'.$val->expiry_year; ?></td>
                                        <td> <?php echo $val->cvv; ?></td>
                                        <td>
                                            <?php 
                                                if($val->status == 'pending'){
                                                    $status_theme = "warning";
                                                }else if($val->status == 'approved'){
                                                    $status_theme = "success";
                                                }else if($val->status == 'rejected'){
                                                    $status_theme = "danger";
                                                }
                                            ?>
                                            <span class="badge badge-lg badge-<?php echo $status_theme; ?>"><?php echo $val->status; ?></span>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(MEMBER.'payment/editCard/'.$val->id) ?>" class="btn btn-sm btn-default">Edit</a>
                                            <a onClick="confirmDelete('dataTableForm',<?php echo $val->id ?>,'Card','deleteCard')" class="btn btn-sm btn-danger text-white">Delete</a>
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
