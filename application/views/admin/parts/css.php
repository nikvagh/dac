<!-- Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
<!-- Icons -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/nucleo/css/nucleo.css" type="text/css">
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
<!-- Argon CSS -->
<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/argon.css?v=1.2.0" type="text/css">

<?php if(isset($page)){ ?>
    <?php if($page == 'category_list' || $page == 'serviceProvider_list' || $page == 'coWorker_list' || $page == 'service_list' || $page == 'offer_list' || 
                $page == 'appointment_list' || $page == 'adminUser_list' || $page == 'customer_list' || $page == 'faq_list' || $page == 'role_list' || $page == 'package_list' || 
                $page == 'membership_list' || $page == 'dispatch_list'){ ?>
        <!-- dataTable -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/plug-ins/1.10.15/integration/font-awesome/dataTables.fontAwesome.css"> -->
    <?php } ?>

    <?php if($page == 'category_add' || $page == 'category_edit' || $page == 'serviceProvider_add' || $page == 'serviceProvider_edit' || 
            $page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'adminUser_add' || $page == 'adminUser_edit' || $page == 'customer_add' || $page == 'customer_edit' || $page == 'faq_add' || $page == 'faq_edit' || 
            $page == 'settings_list' || $page == 'package_add' || $page == 'package_edit' ){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->dash_assets; ?>custom-plugin/fileStyle/fileStyle.css">
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'offer_add' || $page == 'offer_edit' || $page == 'appointment_add' || $page == 'appointment_edit'){ ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->dash_assets; ?>custom-plugin/datetimepicker/jquery.datetimepicker.css">
    <?php } ?>

    <?php if($page == 'coWorker_add' || $page == 'coWorker_edit' || $page == 'service_add' || $page == 'service_edit' || $page == 'offer_add' || $page == 'offer_edit' ||
            $page == 'appointment_add' || $page == 'appointment_edit' || $page == 'notification_add' || $page == 'role_edit' || $page == 'role_add' || $page == 'settings_list' ||
            $page == 'package_edit' || $page == 'package_add'){ ?>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php } ?>

    <?php if($page == 'calendar_list'){ ?>
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
        <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />
    <?php } ?>

<?php } ?>

<link rel="stylesheet" href="<?php echo $this->dash_assets; ?>css/custom.css" type="text/css">