
<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(MEMBERPATH . 'head'); ?>
    <?php $this->load->view(MEMBERPATH . 'common_css'); ?>
    <style>
        .bootstrapWizard > li > a{
            pointer-events: none;
        }
    </style>
</head>

<body class="smart-style-1">

	<?php $this->load->view(MEMBERPATH . 'header'); ?>

	<!-- #NAVIGATION -->
	<!-- Left panel : Navigation area -->
	<!-- Note: This width of the aside area can be adjusted through LESS variables -->
	<?php $this->load->view(MEMBERPATH . 'sidebar'); ?>
	<!-- END NAVIGATION -->

	<!-- MAIN PANEL -->
	<div id="main" role="main">

		<?php $this->load->view(MEMBERPATH . 'breadcrumb'); ?>

		<!-- MAIN CONTENT -->
		<div id="content">

			<!-- row -->
			<div class="row">
				<!-- col -->
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<?php echo $title; ?>
					</h1>
                </div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-check"></i>
					<strong>Success</strong> <?php echo $this->session->flashdata('success');?>
				</div>
			<?php endif; ?>
			
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger fade in">
					<button class="close" data-dismiss="alert">×</button>
					<i class="fa-fw fa fa-times"></i>
					<strong>Error!</strong> <?php echo $this->session->flashdata('success');?>
				</div>
            <?php endif; ?>

			<!-- widget grid -->
            <section id="widget-" class="">
                <div class="row">

                    <article class="col-sm-12 col-md-12 col-lg-12">
                    
                        <!-- Widget ID (each widget will need unique ID)-->
                        <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">

                            <header class="txt-color-white bg-color-teal">
                                <!-- <span class="widget-icon"> <i class="fa fa-check"></i> </span> -->
                                <h2>Purchase <?php echo $pack['package_name']; ?></h2>
                            </header>
            
                            <!-- widget div-->
                            <div>
            
                                <!-- widget edit box -->
                                <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
            
                                </div>
                                <!-- end widget edit box -->
            
                                <!-- widget content -->
                                <div class="widget-body">
            
                                    <div class="row">
                                        <form id="wizard-1" novalidate="novalidate" method="post" action="<?php echo base_url().MEMBERPATH . 'membership/purchase'; ?>">
                                            <div id="bootstrap-wizard-1" class="col-sm-12">
                                                <div class="form-bootstrapWizard">
                                                    <ul class="bootstrapWizard form-wizard">
                                                        <li class="active" data-target="#step1">
                                                            <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Vehicle Information</span> </a>
                                                        </li>
                                                        <li data-target="#step2">
                                                            <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Billing Information</span> </a>
                                                        </li>
                                                        <li data-target="#step3">
                                                            <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Payment</span> </a>
                                                        </li> 
                                                        <li data-target="#step4">
                                                            <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Confirm</span> </a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab1">
                                                        <br>
                                                        <h3>Vehicle Information</h3>

                                                        <input type="hidden" name="amount" value="<?php echo $pack['package_amount']; ?>"/>
                                                        <input type="hidden" name="package_id" value="<?php echo $pack['package_id']; ?>"/>
                                                        <input type="hidden" name="month" value="<?php echo $pack['month']; ?>"/>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Vehicle Name *</label>
                                                                    <input class="form-control" placeholder="Vehicle Name" type="text" name="vehicle_name" id="vehicle_name">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Model Number *</label>
                                                                    <input class="form-control" placeholder="Vehicle Name" type="text" name="model_number" id="model_number">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Plate Number*</label>
                                                                    <input class="form-control" placeholder="Number Plate" type="text" name="number_plate" id="number_plate">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Owner Name*</label>
                                                                    <input class="form-control" placeholder="Owner Name" type="text" name="owner_name" id="owner_name">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Vehicle Note</label>
                                                                    <textarea name="vehicle_note" id="vehicle_note" class="form-control"> </textarea>  
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane" id="tab2">
                                                        <br>
                                                        <h3>Billing Information</h3>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>First Name *</label>
                                                                    <input class="form-control" placeholder="First Name" type="text" name="first_name" id="first_name">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Last Name *</label>
                                                                    <input class="form-control" placeholder="Last Name" type="text" name="last_name" id="last_name">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Phone *</label>
                                                                    <input class="form-control" placeholder="Phone Number" type="text" name="phone" id="phone">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Email*</label>
                                                                    <input class="form-control" placeholder="Email" type="text" name="email" id="email">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>address *</label>
                                                                    <textarea name="address" id="address" class="form-control"></textarea>  
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>City *</label>
                                                                    <input class="form-control" placeholder="City" type="text" name="city" id="city">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>State *</label>
                                                                    <input class="form-control" placeholder="State" type="text" name="state" id="state">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Country *</label>
                                                                    <input class="form-control" placeholder="Country" type="text" name="country" id="country">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Zip *</label>
                                                                    <input class="form-control" placeholder="Zip Code" type="text" name="zip" id="zip">    
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="tab3">
                                                        <br>
                                                        <h3>Payment</h3>
                                                        <!-- <div class="alert alert-info fade in">
                                                            <button class="close" data-dismiss="alert"> × </button>
                                                            <i class="fa-fw fa fa-info"></i>
                                                            <strong>Info!</strong> Place an info message box if you wish.
                                                        </div> -->

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Name On Card *</label>
                                                                    <input class="form-control" placeholder="Name On Name" type="text" name="card_name" id="card_name">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>Card Number *</label>
                                                                    <input class="form-control" placeholder="Card Number" type="text" name="card_number" id="card_number">    
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>cvv*</label>
                                                                    <input class="form-control" placeholder="CVV" type="text" name="card_cvv" id="card_cvv">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label>Card Expiry *</label>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" placeholder="Month" type="text" name="card_month" id="card_month">    
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <input class="form-control" placeholder="Year" type="text" name="card_year" id="card_year">    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="tab-pane" id="tab4">
                                                        <br>
                                                        <h3>Confirmation</h3>
                                                        <!-- <br> -->
                                                        <!-- <h1 class="text-center text-success"><strong><i class="fa fa-check fa-lg"></i> Complete</strong></h1> -->
                                                        <!-- <h4 class="text-center">Click Confirm Order</h4> -->
                                                        <div class="confirm_details">

                                                        </div>
                                                        <div class="text-right">
                                                            <input type="submit" name="submit" value="Confirm Order" class="btn btn-success"/>
                                                        </div>
                                                        <br>
                                                        <br>
                                                    </div>
            
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <ul class="pager wizard no-margin">
                                                                    <!--<li class="previous first disabled">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                                    </li>-->
                                                                    <li class="previous disabled">
                                                                        <a href="javascript:void(0);" class="btn btn-default btn-prev"> Previous </a>
                                                                    </li>
                                                                    <!--<li class="next last">
                                                                    <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                                    </li>-->
                                                                    <li class="next">
                                                                        <a href="javascript:void(0);" class="btn txt-color-darken btn-next"> Next </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                </div>
                                            </div>
                                        </form>
                                    </div>
            
                                </div>
                                <!-- end widget content -->
            
                            </div>
                            <!-- end widget div -->
            
                        </div>
                        <!-- end widget -->
            
                    </article>
                    
                </div>
            </section>
            <!-- end widget grid -->


		</div>
		<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

	<?php $this->load->view(MEMBERPATH . 'footer'); ?>

	<!--================================================== -->

    <?php $this->load->view(MEMBERPATH . 'common_js'); ?>
    
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="<?php echo $this->assets; ?>js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="<?php echo $this->assets; ?>js/plugin/fuelux/wizard/wizard.min.js"></script>

	<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			
			pageSetUp();

            //Bootstrap Wizard Validations
            var $validator = $("#wizard-1").validate({
                rules: {
                    vehicle_name:{
                        required: true,
                    },
                    model_number:{
                        required: true,
                    },
                    number_plate:{
                        required: true,
                    },
                    owner_name: {
                        required: true,
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        number: true
                    },
                    address:{
                        required: true,
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    zip: {
                        required: true,
                        minlength: 4
                    },
                    card_name: {
                        required: true
                    },
                    card_number: {
                        required: true,
                        number:true
                    },
                    card_cvv: {
                        required: true,
                        number:true
                    },
                    card_month: {
                        required: true,
                        number:true,
                    minlength: 2,
                    maxlength: 2
                    },
                    card_year: {
                        required: true,
                        number:true,
                    minlength: 4,
                    maxlength: 4
                    },

                },
                messages: {
                    fname: "Please specify your First name",
                    lname: "Please specify your Last name",
                    email: {
                        required: "We need your email address to contact you",
                        email: "Your email address must be in the format of name@abc.com"
                    }
                },
                
                highlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                    } else {
                    error.insertAfter(element);
                    }
                }
            });
            
            $('#bootstrap-wizard-1').bootstrapWizard({
                'tabClass': 'form-wizard',
                'onNext': function (tab, navigation, index) {
                    var $valid = $("#wizard-1").valid();
                    if (!$valid) {
                        $validator.focusInvalid();
                        return false;
                    } else {
                        if(index == 3){
                            var formData = $("#wizard-1").serializeArray();
                            // console.log(formData);

                            var form = {};
                            $(formData).each(function(ind,val) {
                                // console.log(ind);
                                // console.log(val.name);
                                form[val.name] = val.value;
                            });
                            // console.log(form.vehicle_name);

                            html = '';
                            html += '<div class="row">'+
                                        '<div class="col-sm-6">'+
                                            '<h3 class="text-primary">Vehicle Information</h3>'+
                                            '<ul class="list-unstyled text-left">'+
                                                '<li><strong>Vehicle Name:</strong>'+form.vehicle_name+'</li>'+
                                                '<li><strong>Model Number:</strong> '+form.model_number+'</li>'+
                                                '<li><strong>Plate Name:</strong> '+form.number_plate+'</li>'+
                                                '<li><strong>Owner Name:</strong> '+form.owner_name+'</li>'+
                                                '<li><strong>Vehicle Note:</strong> '+form.vehicle_note+'</li>'+
                                            '</ul>'+
                                            '<h3 class="text-primary">Payment</h3>'+
                                            '<ul class="list-unstyled text-left">'+
                                                '<li><strong>Total Amount:</strong> $'+form.amount+'</li>'+ 
                                            '</ul>'+
                                        '</div>'+
                                        '<div class="col-sm-6">'+
                                            '<h3 class="text-primary">Billing Information</h3>'+
                                            '<ul class="list-unstyled text-left">'+
                                                '<li><strong>First Name:</strong> '+form.first_name+'</li>'+
                                                '<li><strong>Last Name:</strong> '+form.last_name+'</li>'+
                                                '<li><strong>Phone:</strong> '+form.phone+'</li>'+
                                                '<li><strong>Email:</strong> '+form.email+'</li>'+
                                                '<li><strong>Address:</strong> '+form.address+'</li>'+
                                                '<li><strong>City:</strong> '+form.city+'</li>'+
                                                '<li><strong>State:</strong> '+form.state+'</li>'+
                                                '<li><strong>Country:</strong> '+form.country+'</li>'+
                                                '<li><strong>Zip:</strong> '+form.zip+'</li>'+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>';

                            $('.confirm_details').html(html);
                        }
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).addClass(
                            'complete');
                        $('#bootstrap-wizard-1').find('.form-wizard').children('li').eq(index - 1).find('.step').html('<i class="fa fa-check"></i>');
                    }
                }
            });

			
		});
	</script>

</body>

</html>

