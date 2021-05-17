<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view(MEMBER . 'parts/head'); ?>
  <?php $this->load->view(MEMBER . 'parts/title'); ?>
  <?php $this->load->view(MEMBER . 'parts/css'); ?>
</head>

<body class="bg-default">
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <!-- <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome!</h1>
            </div>
          </div>
        </div>
      </div> -->
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
            <?php if(isset($form)){ echo $form; } ?>
            <?php if(isset($bottom_link)){ echo $bottom_link; } ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view(MEMBER . 'parts/js'); ?>
</body>

</html>