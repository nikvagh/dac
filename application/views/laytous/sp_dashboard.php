<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view(SP . 'parts/head'); ?>
    <?php $this->load->view(SP . 'parts/title'); ?>
    <?php $this->load->view(SP . 'parts/css'); ?>
</head>

<body>
    <?php $this->load->view(SP . 'parts/sideNav'); ?>
  
    <!-- Main content -->
    <div class="main-content" id="panel">
          
      <?php $this->load->view(SP . 'parts/topNav'); ?>
      <?php $this->load->view(SP . 'parts/header'); ?>

      <!-- Page content -->
      <div class="container-fluid mt--6">

        <?php echo $content; ?>
        <?php $this->load->view(SP . 'parts/footer'); ?>

      </div>
      
    </div>
    
    <div class="modal fade" id="confirm_model" role="dialog"></div>
    <?php $this->load->view(SP . 'parts/js'); ?>
</body>

</html>