<header id="header">
  <div id="logo-group">
    <span id="logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo $this->assets; ?>img/logo.png" alt="SmartAdmin"> </span></a>
  </div>

  <?php if(isset($sp_register)){ ?>
    <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Have Account?</span> 
      <a href="<?php echo base_url().SPPATH . 'login'; ?>" class="btn btn-info">Login</a> 
    </span>
  <?php } ?>
  
  <?php if(isset($sp_login)){ ?>
    <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">Need an account?</span> 
      <a href="<?php echo base_url().SPPATH . 'register'; ?>" class="btn btn-info">Create account</a> 
    </span>
  <?php } ?>

</header>