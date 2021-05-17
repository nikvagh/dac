<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view(MEMBER . 'parts/head'); ?>
    <?php $this->load->view(MEMBER . 'parts/title'); ?>
    <?php $this->load->view(MEMBER . 'parts/css'); ?>
</head>

<body>
    <?php $this->load->view(MEMBER . 'parts/sideNav'); ?>
  
    <!-- Main content -->
    <div class="main-content" id="panel">
      <?php $this->load->view(MEMBER . 'parts/topNav'); ?>
      <?php $this->load->view(MEMBER . 'parts/header'); ?>

      <!-- Page content -->
      <div class="container-fluid mt--6">
        <?php echo $content; ?>
        <?php $this->load->view(MEMBER . 'parts/footer'); ?>
      </div>
    </div>
    
    <div class="modal fade" id="confirm_model" role="dialog"></div>
    <?php $this->load->view(MEMBER . 'parts/js'); ?>
</body>

</html>