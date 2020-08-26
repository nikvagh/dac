<!-- #CSS Links -->
<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/font-awesome.min.css">

<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-production-plugins.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-production.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-skins.min.css">

<!-- SmartAdmin RTL Support -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/smartadmin-rtl.min.css"> 
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/your_style.css">

<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->assets; ?>css/demo.min.css">

<!-- #FAVICONS -->
<link rel="shortcut icon" href="<?php echo $this->assets; ?>img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo $this->assets; ?>img/favicon/favicon.ico" type="image/x-icon">

<!-- #GOOGLE FONT -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

<!-- #APP SCREEN / ICONS -->
<!-- Specifying a Webpage Icon for Web Clip 
        Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
<link rel="apple-touch-icon" href="<?php echo $this->assets; ?>img/splash/sptouch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->assets; ?>img/splash/touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->assets; ?>img/splash/touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->assets; ?>img/splash/touch-icon-ipad-retina.png">

<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Startup image for web apps -->
<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
<link rel="apple-touch-startup-image" href="<?php echo $this->assets; ?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">

<?php if(isset($edit_profile)){ ?>
        <style>
            .select2-selection__choice{
                padding: 1px 28px 1px 8px !important;
                margin: 4px 0 3px 5px !important;
            }
            .select2-selection__choice__remove{
                padding: 3px 4px 3px 6px !important;
            }
        </style>
        <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
<?php } ?>