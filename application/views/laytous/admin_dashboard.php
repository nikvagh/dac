<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view(ADMIN . 'parts/head'); ?>
    <?php $this->load->view(ADMIN . 'parts/title'); ?>
    <?php $this->load->view(ADMIN . 'parts/css'); ?>
</head>

<body>
    <?php $this->load->view(ADMIN . 'parts/sideNav'); ?>
  
    <!-- Main content -->
    <div class="main-content" id="panel">
          
      <?php $this->load->view(ADMIN . 'parts/topNav'); ?>
      <?php $this->load->view(ADMIN . 'parts/header'); ?>

      <!-- Page content -->
      <div class="container-fluid mt--6">
          
        <?php if(isset($filter)){ echo $filter; } ?>
        <?php echo $content; ?>
        <?php $this->load->view(ADMIN . 'parts/footer'); ?>

      </div>
      
    </div>
    
    <div class="modal fade" id="confirm_model" role="dialog"></div>
    <?php $this->load->view(ADMIN . 'parts/js'); ?>
</body>

</html>