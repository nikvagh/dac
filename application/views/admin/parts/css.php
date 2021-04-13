<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<!-- Icons -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
<!-- Argon CSS -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/argon.css?v=1.2.0" type="text/css">

<?php if(isset($page)){ ?>
    <?php if($page == 'category_list'){ ?>
        <!-- dataTable -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css"> -->
        
    <?php } ?>

    <?php if($page == 'category_add' || $page == 'category_edit'){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.css">
    <?php } ?>
<?php } ?>

<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/custom.css" type="text/css">