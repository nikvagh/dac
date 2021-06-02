
    <div class="row">
        <div class="col">

            <div class="card bg-gradient-success1">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Jobs</h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo base_url(ADMIN.'report/jobs/all') ?>" class="btn btn-default">All Jobs</a>
                    <a href="<?php echo base_url(ADMIN.'report/jobs/pending') ?>" class="btn btn-default">Pending Jobs</a>
                    <a href="<?php echo base_url(ADMIN.'report/jobs/complete') ?>" class="btn btn-default">Complete Jobs</a>
                </div>
            </div>

            <div class="card bg-gradient-success1">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Payment</h3>
                </div>
                <div class="card-body">
                    <!-- <a href="<?php echo base_url(ADMIN.'report/payment/all') ?>" class="btn btn-default">All Payment</a> -->
                    <a href="<?php echo base_url(ADMIN.'report/payment/customerPayment') ?>" class="btn btn-default">Customer Payment</a>
                    <a href="<?php echo base_url(ADMIN.'report/payment/spPayout') ?>" class="btn btn-default">Service Provider Payout</a>
                </div>
            </div>

            <div class="card bg-gradient-success1">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Member Subscription</h3>
                </div>
                <div class="card-body">
                    <a href="<?php echo base_url(ADMIN.'report/customer/membership') ?>" class="btn btn-default">Membership</a>
                </div>
            </div>

        </div>
    </div>
