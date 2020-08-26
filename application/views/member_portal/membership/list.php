
<!DOCTYPE html>
<html lang="en-us">

<head>
	<?php $this->load->view(MEMBERPATH . 'head'); ?>
	<?php $this->load->view(MEMBERPATH . 'common_css'); ?>
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

				<div class="row-flex">
                    <div class="col-sm-12">

						<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                            <header class="txt-color-white bg-color-teal">
                                <h2>Your Current Plan </h2>
                            </header>
                            <div>
								<?php if(!empty($current_plan)){ ?>
									<h4 class="semi-bold"><?php echo $current_plan['package_name']; ?></h4>
									<br/>
									<p><strong>Starting Date: </strong> <?php echo date('d M Y',strtotime($current_plan['start_date'])); ?></p>
									<p><strong>Expire On: </strong> <?php echo date('d M Y',strtotime($current_plan['end_date'])); ?></p>
								<?php }else{ ?>
									<h4 class="semi-bold">Not Any Current Active </h4>
									<br/>
								<?php } ?>

								<p><a href="<?php echo base_url().MEMBERPATH;?>paymenthistory" class="btn btn-sm btn-default"> Click To View Package History </a>
                            </div>
						</div>

                    </div>
				</div>
				
                
                <div class="row-flex">

                    <?php foreach($package_data as $pack) { ?>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="panel panel-teal pricing-big">
                                
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo $pack['package_name']; ?></h3>
                                </div>
                                <div class="panel-body no-padding text-align-center">
                                    <div class="the-price">
                                        <h1>
                                            $<?php echo $pack['package_amount']; ?><span class="subscript">/ <?php echo $pack['text']; ?></span></h1>
                                    </div>
                                    <div class="price-features">
                                        <ul class="list-unstyled text-left">
                                            <?php 
                                                if($pack['service_list'] != ""){ 
                                                    $services = explode(',',$pack['service_list']);
                                                    foreach($services as $val){
                                                        echo '<li><i class="fa fa-check text-success"></i> <strong>'.$val.'</strong></li>';
                                                    }
                                                } 
                                            ?>
                                        </ul>
                                    </div>
                                </div>
								<div class="panel-footer text-align-center" style="">
									<?php if(empty($current_plan)){ ?>
										<a href="<?php echo base_url().MEMBERPATH;?>membership/purchase/<?php echo $pack['package_id']; ?>" class="btn btn-primary btn-block" role="button">Purchase <span></span></a>
										<div>
											<a href="javascript:void(0);"><i>We accept all major credit cards</i></a>
										</div>
									<?php }else{ ?>
										<div>You Have Already Purchase One Plan</div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                                
                    <?php } ?>
                    
                </div>
                <!-- end row -->
            
            </section>
            <!-- end widget grid -->


		</div>
		<!-- END MAIN CONTENT -->

	</div>
	<!-- END MAIN PANEL -->

	<?php $this->load->view(MEMBERPATH . 'footer'); ?>

	<!--================================================== -->

	<?php $this->load->view(MEMBERPATH . 'common_js'); ?>

	<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		$(document).ready(function() {
			pageSetUp();
		})
	</script>

</body>

</html>

