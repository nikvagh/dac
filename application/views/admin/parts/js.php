<!-- Core -->
<script src="<?php echo $this->dash_assets; ?>vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/js-cookie/js.cookie.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<!-- Optional JS -->
<script src="<?php echo $this->dash_assets; ?>/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo $this->dash_assets; ?>vendor/chart.js/dist/Chart.extension.js"></script>

<!-- Argon JS -->
<script src="<?php echo $this->dash_assets; ?>js/argon.js?v=1.2.0"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

<?php if($page == 'login'){ ?>
    <script type="text/javascript">
        $("#login-form").validate({
            // Rules for form validation
            rules : {
                username : {
                    required : true,
                },
                password : {
                    required : true,
                }
            },
            errorClass: 'error text-danger text-italic',
            // Messages for form validation
            messages : {
                username : {
                    required : 'Please enter your email',
                },
                password : {
                    required : 'Please enter your password'
                }
            },

            // Do not change code below
            errorPlacement : function(error, element) {
                element.addClass('text-danger');
                error.insertAfter(element.parent());
            }
        });
    </script>
<?php } ?>