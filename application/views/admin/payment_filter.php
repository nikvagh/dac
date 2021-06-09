<div class="row">
    <div class="col">
        <form action="<?=base_url().ADMIN;?>payment/filter" method="post">
            <div class="card">
                <div class="card-header">Filter</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="payment_id" placeholder="Transaction Id" value="<?php echo $this->session->userdata('payment_id_payment'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select name="status" id="" class="form-control">
                                    <option value="">--status--</option>
                                    <option value="Pending" <?php if($this->session->userdata('status_payment') == 'Pending'){ echo "selected"; } ?>>Pending</option>
                                    <option value="Failed" <?php if($this->session->userdata('status_payment') == 'Failed'){ echo "selected"; } ?>>Failed</option>
                                    <option value="Success" <?php if($this->session->userdata('status_payment') == 'Success'){ echo "selected"; } ?>>Success</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Start Date" autocomplete="off" value="<?php echo $this->session->userdata('start_date_payment'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" autocomplete="off" value="<?php echo $this->session->userdata('end_date_payment'); ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" name="submit" class="btn btn-sm btn-default" value="Filter" />
                    <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Reset" />
                </div>
            </div>
        </form>
    </div>
</div>