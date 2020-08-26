<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<!-- <script data-pace-options='{ "restartOnRequestAfter": true }' src="<?php //    echo $this->assets; ?>js/plugin/pace/pace.min.js"></script> -->

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="<script src="<?php echo $this->assets; ?>js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="<?php echo $this->assets; ?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<!-- IMPORTANT: APP CONFIG -->
<script src="<?php echo $this->assets; ?>js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
<script src="<?php echo $this->assets; ?>js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

<!-- BOOTSTRAP JS -->
<script src="<?php echo $this->assets; ?>js/bootstrap/bootstrap.min.js"></script>

<!-- CUSTOM NOTIFICATION -->
<!-- <script src="<?php echo $this->assets; ?>js/notification/SmartNotification.min.js"></script> -->

<!-- JARVIS WIDGETS -->
<script src="<?php echo $this->assets; ?>js/smartwidgets/jarvis.widget.min.js"></script>

<!-- EASY PIE CHARTS -->
<!-- <script src="<?php echo $this->assets; ?>js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script> -->

<!-- SPARKLINES -->
<script src="<?php echo $this->assets; ?>js/plugin/sparkline/jquery.sparkline.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="<?php echo $this->assets; ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<!-- <script src="<?php echo $this->assets; ?>js/plugin/masked-input/jquery.maskedinput.min.js"></script> -->

<?php if(isset($membership_form) || isset($sp_form) || isset($job_view) ){ ?>
<!-- JQUERY SELECT2 INPUT -->
<script src="<?php echo $this->assets; ?>js/plugin/select2/select2.min.js"></script>

 <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
<?php } ?>

<!-- JQUERY UI + Bootstrap Slider -->
<!-- <script src="<?php //echo $this->assets; ?>js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script> -->

<!-- browser msie issue fix -->
<!-- <script src="<?php //echo $this->assets; ?>js/plugin/msie-fix/jquery.mb.browser.min.js"></script> -->

<!-- FastClick: For mobile devices -->
<script src="<?php echo $this->assets; ?>js/plugin/fastclick/fastclick.min.js"></script>

<!-- Demo purpose only -->
<script src="<?php echo $this->assets; ?>js/demo.min.js"></script>

<!-- MAIN APP JS FILE -->
<script src="<?php echo $this->assets; ?>js/app.min.js"></script>

<?php if(isset($membership_manage) || isset($service_manage) || isset($serviceprovider_manage) || isset($serviceupgrade_manage) || isset($job_manage)){ ?>
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="<?php echo $this->assets; ?>js/plugin/datatables/jquery.dataTables.min.js"></script>
    <!-- <script src="<?php echo $this->assets; ?>js/plugin/datatables/dataTables.colVis.min.js"></script> -->
    <!-- <script src="<?php echo $this->assets; ?>js/plugin/datatables/dataTables.tableTools.min.js"></script> -->
    <script src="<?php echo $this->assets; ?>js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $this->assets; ?>js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<?php } ?>

<?php if(isset($settings)){ ?>
    <script src="<?php echo $this->assets; ?>js/plugin/ckeditor/ckeditor.js"></script>
<?php } ?>

<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
<!-- Voice command : plugin -->
<!-- <script src="<?php echo $this->assets; ?>js/speech/voicecommand.min.js"></script> -->

<!-- SmartChat UI : plugin -->
<!-- <script src="<?php echo $this->assets; ?>js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?php echo $this->assets; ?>js/smart-chat-ui/smart.chat.manager.min.js"></script> -->

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script type="text/javascript">

    $(document).ready(function() {
        pageSetUp();
    });

</script>