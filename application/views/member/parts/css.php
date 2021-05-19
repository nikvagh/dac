<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<!-- Icons -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
<!-- Argon CSS -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/argon.css?v=1.2.0" type="text/css">

<?php if(isset($page)){ ?>
    <?php if($page == 'vehicle_list' || $page == 'payment_list' || $page == 'membership_list'){ ?>
        <!-- dataTable -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css"> -->
    <?php } ?>

    <?php if($page == 'profile_edit'){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.css">
    <?php } ?>

    <?php if($page == ''){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/jquery.datetimepicker.css">
    <?php } ?>

    <?php if($page == 'vehicle_add' || $page == 'vehicle_edit' || $page == 'paymentCard_add' || $page == 'paymentCard_edit' || $page == 'membership_add' || $page == 'membership_edit'){ ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php } ?>

    <?php if($page == 'calendar_list'){ ?>
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />
    <?php } ?>

<?php } ?>

<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/custom.css" type="text/css">