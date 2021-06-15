<div class="row">

    <div class="col-3">
        <div class="card bg-gradient-success">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Ongoing Memberships</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $ongoingMembershipTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(MEMBER.'membership'); ?>" class="text-white"> View</a>
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-teal">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Bookings</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $appointmentTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(MEMBER.'booking'); ?>" class="text-white"> View</a>
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-danger">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Vehicles</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $vehicleTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(MEMBER.'vehicle'); ?>" class="text-white"> View</a>
                </p>
            </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card bg-gradient-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title text-uppercase mb-0">Total Payment</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo "$".$paymentTotal; ?></span>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-sm text-right font-weight-bold">
                    <a href="<?php echo base_url(MEMBER.'payment').'?origin=dashboard'; ?>" class="text-white"> View</a>
                </p>
            </div>
        </div>
    </div>

</div>