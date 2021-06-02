<div class="card bg-secondary border-0 mb-0">
    <div class="card-header bg-transparent">
        <img src="<?php echo $this->assets; ?>img/logo.png" class="mx-auto pt-2 d-block pb-3" width="200">
        <h3 class="text-center">Login To start your session!</h3>
    </div>

    <div class="card-body px-lg-5 py-lg-5">

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">×</button>
                <i class="fa-fw fa fa-times"></i>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <!-- <div class="text-center text-muted mb-4">
                <small>Or sign in with credentials</small>
              </div> -->

              <?php 
            //   echo "<pre>";
            //   print_r($data);
              ?>
        <form action="<?php echo site_url(SP.'login/dologin/')?>" method="post" id="login-form">
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="text" name="username" value="<?php if(isset($data['username'])){ echo $data['username']; } ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" value="<?php if(isset($data['password'])){ echo $data['password']; } ?>">
                </div>
            </div>
            <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Remember me</span>
                </label>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary my-4" value="Sign in">
            </div>
        </form>
    </div>
</div>