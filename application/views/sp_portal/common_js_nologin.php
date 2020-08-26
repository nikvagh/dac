<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> if (!window.jQuery) { document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');} </script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) { document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo $this->assets; ?>js/app.config.js"></script>
<!-- JS TOUCH : include this plugin for mobile drag / drop touch events 		
<script src="<?php echo $this->assets; ?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->
<!-- BOOTSTRAP JS -->		
<script src="<?php echo $this->assets; ?>js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="<?php echo $this->assets; ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?php echo $this->assets; ?>js/app.min.js"></script>