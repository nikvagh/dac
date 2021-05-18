<div class="card bg-secondary border-0 mb-0">
    <?php //echo "<pre>";print_r($data); ?>
    <div class="card-header bg-transparent">
        <img src="<?php echo $this->assets; ?>img/logo.png" class="mx-auto pt-2 d-block pb-3" width="200">
        <h3 class="text-center">Sign Up</h3>
        <!-- <div class="text-muted text-center mt-2 mb-3"><small>Sign up</small></div> -->
              <!-- <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div> -->
    </div>

    <div class="card-body px-lg-6 py-lg-5">

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
        <form action="<?php echo site_url(MEMBER.'register/save')?>" method="post" id="login-form">
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-badge"></i></span>
                    </div>
                    <input class="form-control" placeholder="User Name" type="text" name="username" value="<?php if(isset($data['form_data']['username'])){ echo $data['form_data']['username']; } ?>">
                </div>
                <?php if(isset($data['validation']['username'])){ ?>
                    <label id="username-error" class="error text-danger text-italic" for="username"><?php echo $data['validation']['username']; ?></label>
                <?php } ?>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="text" name="email" value="<?php if(isset($data['form_data']['email'])){ echo $data['form_data']['email']; } ?>">
                    
                </div>
                <?php if(isset($data['validation']['email'])){ ?>
                    <label id="email-error" class="error text-danger text-italic" for="email"><?php echo $data['validation']['email']; ?></label>
                <?php } ?>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                    </div>
                    <input class="form-control" placeholder="Phone" type="text" name="phone" value="<?php if(isset($data['form_data']['phone'])){ echo $data['form_data']['phone']; } ?>">
                    
                </div>
                <?php if(isset($data['validation']['phone'])){ ?>
                    <label id="phone-error" class="error text-danger text-italic" for="phone"><?php echo $data['validation']['phone']; ?></label>
                <?php } ?>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" value="<?php if(isset($data['form_data']['password'])){ echo $data['form_data']['password']; } ?>">
                    
                </div>
                <?php if(isset($data['validation']['password'])){ ?>
                    <label id="password-error" class="error text-danger text-italic" for="password"><?php echo $data['validation']['password']; ?></label>
                <?php } ?>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm Password" type="password" name="confirm_password" value="<?php if(isset($data['form_data']['confirm_password'])){ echo $data['form_data']['confirm_password']; } ?>">
                    
                </div>
                <?php if(isset($data['validation']['confirm_password'])){ ?>
                    <label id="confirm_password-error" class="error text-danger text-italic" for="confirm_password"><?php echo $data['validation']['confirm_password']; ?></label>
                <?php } ?>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-sitemap"></i></span>
                    </div>
                    <input class="form-control" placeholder="Referral code" type="text" name="referral_code" value="<?php if(isset($data['form_data']['referral_code'])){ echo $data['form_data']['referral_code']; } ?>">
                    
                </div>
                <?php if(isset($data['validation']['referral_code'])){ ?>
                    <label id="referral_code-error" class="error text-danger text-italic" for="referral_code"><?php echo $data['validation']['referral_code']; ?></label>
                <?php } ?>
            </div>
            <div class="custom-control custom-control-alternative custom-checkbox text-center">
                <input class="custom-control-input" id="staySignedIn" name="staySignedIn" type="checkbox" <?php if(isset($data['form_data']['staySignedIn'])){ echo "checked"; } ?>>
                <label class="custom-control-label" for="staySignedIn">
                    <span class="text-muted">Stay signed in</span>
                </label>
            </div>
            <div class="text-center">
                <input type="submit" name="submit" class="btn btn-primary my-4" value="Sign Up">
            </div>
        </form>
        
    </div>
</div>