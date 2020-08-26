<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<?php $this->load->view(MEMBERPATH . 'head_nologin'); ?>
        <?php $this->load->view(MEMBERPATH . 'common_css_nologin'); ?>
	</head>
	
	<body class="animated fadeInDown">

		<?php $this->load->view(MEMBERPATH . 'header_nologin'); ?>

		<div id="main" role="main">
			<!-- MAIN CONTENT -->
			<div id="content" class="container">

                <?php if ($this->session->flashdata('error_register')): ?>
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error_register'); ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-times"></i>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <h1 class="jumbotron" style="border-radius: 0px;padding-top:30px;padding-bottom:30px;">
                    JOIN WITH DRIP AUTO CARE
                </h1>
                <br/>

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6">
                        <?php echo $this->system->service_provider_content; ?>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-6">

                        <form id="form1" class="" action="<?php echo base_url().MEMBERPATH . 'register'; ?>" method="post" enctype="multipart/form-data">

                                <div class="box with-shadow">
                                    <div class="box-header bg-color-teal txt-color-white">
                                        <h5 class=""> COMPANY INFORMATION </h5>
                                    </div>
                                    <div class="box-body bg-color-gray">

                                        <div class="form-group">
                                            <label class="control-label">Email *</label>
                                            <input type="text" name="email" placeholder="Email"  value="" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Phone *</label>
                                            <input type="text" name="phone" placeholder="Phone" value="" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Password *</label>
                                            <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Confirm Password *</label>
                                            <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <br/>

                                <div class="box with-shadow">
                                    <div class="box-footer text-right bg-color-white">
                                        <!-- <a href="<?php //echo base_url().MEMBERPATH . 'serviceprovider'; ?>" name="cancel" class="btn btn-default">Cancel</a> -->
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                        </form>

                    </div>
                    

                </div>
                
			</div>
		</div>

		<!--================================================== -->	

		<?php $this->load->view(MEMBERPATH . 'common_js_nologin'); ?>

	    <!-- JQUERY VALIDATE -->
		<script src="<?php echo $this->assets; ?>js/plugin/jquery-validate/jquery.validate.min.js"></script>

		<script type="text/javascript">
            // DO NOT REMOVE : GLOBAL FUNCTIONS!
            $(document).ready(function() {

            });

            // ==============

            var errorClass = 'invalid';
            var errorElement = 'em';

            $("#form1").validate({
                errorClass: errorClass,
                errorElement: errorElement,
                highlight: function(element) {
                    $(element).parent().removeClass('state-success').addClass("state-error");
                    $(element).removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).parent().removeClass("state-error").addClass('state-success');
                    $(element).addClass('valid');
                },

                // Rules for form validation
                rules: {
                    username: {
                        required: true,
                        remote:
                        {
                            url: '<?php echo base_url().MEMBERPATH . 'register/usernameCheck_add'; ?>',
                            type: "post",
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote:
                        {
                            url: '<?php echo base_url().MEMBERPATH . 'register/emailCheck_add'; ?>',
                            type: "post",
                        }
                    },
                    phone: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    passwordConfirm: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                },

                // Messages for form validation
                messages: {
                    username: {
                        remote: 'Username Already Exist'
                    },
                    email: {
                        required: 'Please enter your email address',
                        email: 'Please enter a VALID email address',
                        remote: 'Email Already Exist'
                    }
                },

                // Do not change code below
                errorPlacement: function(error, element) {
                    if(element.attr("type") == "checkbox") {
                        error.insertAfter(element.parent().parent().children('.checkbox_err'));    
                    }else if(element.attr("type") == "radio") {
                        error.insertAfter(element.parent().parent().children('.radio_err'));    
                    }else{
                        error.insertAfter(element);
                    }
                },
                ignore: 'input[type=hidden]'
            });
        </script>

	</body>
</html>