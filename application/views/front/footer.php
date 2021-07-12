<!-- Footer Section Start -->
	<footer>	
		<!-- Footer Top Section Start -->
		<div class="footer-sec">
			<div class="container">
				<div class="row">				
					<div class="col-md-4 col-sm-6">
						<div class="footer-wedget-one">
							<h2>About Us</h2>
							<p>Drip Auto Care is a mobile carwash company that offers subscription-based service. Our package includes two mini-details for $69.99 on a monthly basis. Subscription requires auto-draft payments that will be drafted on a monthly basis within a week prior to automatic renewal.  </p>							
							<div class="footer-social-profile">
								<ul>
									<li><a href="https://www.facebook.com/Drip-Auto-Care-100277321437918/"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://twitter.com/CareDrip"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://www.instagram.com/dripautocare/"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
								</ul>
							</div>							
						
						</div>
					</div>											
					<div class="col-md-4 col-sm-6">
						<div class="col-md-6 col-sm-6 no-padding">
							<div class="footer-widget-menu">
								<h2>quick links</h2>
								<ul>
									<li><a href="<?php echo base_url(); ?>">Home</a></li>
									<li><a href="<?php echo base_url(); ?>contact">Help center</a></li>
									<li><a href="<?php echo base_url(); ?>about">About</a></li>
									<li><a href="<?php echo base_url(); ?>account">Create Account</a></li>
									<li><a href="<?php echo base_url(); ?>service">Service and Help</a></li>
									<li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 no-padding">
							<div class="footer-widget-menu">
								<h2>Support links</h2>
								<ul>
									<li><a href="<?php echo base_url(); ?>disclaimer">Disclaimer</a></li>
									<li><a href="<?php echo base_url(); ?>account">Create Account</a></li>
									<li><a href="#">Privacy & Policy</a></li>
									<li><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>
					</div>	
					<div class="col-md-4 col-sm-12">
						<div class="flicker-photo">
							<h2>Account</h2>
							<a href="#" target="_blank" class="user">Service Provider</a>
							<a href="<?php echo base_url(); ?>memberLogin" target="_blank" class="manager">Drip Member</a>
							<!--- <ul>
								<li><img src="img/g5.jpg" alt=""/></li>
								<li><img src="img/g2.jpg" alt=""/></li>
								<li><img src="img/g4.jpg" alt=""/></li>
								<li><img src="img/g1.jpg" alt=""/></li>
								<li><img src="img/g6.jpg" alt=""/></li>								
								<li><img src="img/g5.jpg" alt=""/></li>
								<li><img src="img/g2.jpg" alt=""/></li>
								<li><img src="img/g4.jpg" alt=""/></li>
								<li><img src="img/g1.jpg" alt=""/></li>
							</ul> ---->
						</div>
					</div>								
				</div>
			</div>
		</div>
		<!-- Footer Top Section End -->
		
	</footer>
	<!-- Footer Section End -->
	<!-- Scripts Js Start -->
    <script src="<?php echo $this->front; ?>js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo $this->front; ?>js/bootstrap.min.js"></script>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

	<script src="<?php echo $this->front; ?>js/imagesloaded.pkgd.min.js"></script>
	<script src="<?php echo $this->front; ?>js/isotope.pkgd.min.js"></script>
	<script src="<?php echo $this->front; ?>js/owl.carousel.min.js"></script>
	<script src="<?php echo $this->front; ?>js/owl.animate.js"></script>
	<script src="<?php echo $this->front; ?>js/jquery.scrollUp.min.js"></script>
	<script src="<?php echo $this->front; ?>js/jquery.counterup.min.js"></script>
	<script src="<?php echo $this->front; ?>js/modernizr.min.js"></script>
	<script src="<?php echo $this->front; ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo $this->front; ?>js/wow.min.js"></script>
	<script src="<?php echo $this->front; ?>js/waypoints.min.js"></script>
	<script src="<?php echo $this->front; ?>js/jquery.meanmenu.min.js"></script>
	<script src="<?php echo $this->front; ?>js/jquery.sticky.js"></script>
	<script src="<?php echo $this->front; ?>js/custom.js"></script>
	<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

	<?php if(isset($page) && ($page == 'memberAccount')){ ?>
		<script src="<?php echo $this->front; ?>plugins/fileStyle/fileStyle.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="<?php echo $this->front; ?>plugins/datetimepicker/build/jquery.datetimepicker.full.js"></script>

		<?php if($page == 'memberAccount'){ ?>
			<script src="<?php echo $this->front; ?>js/memberAccount.js"></script>
		<?php } ?>
		
	<?php } ?>

	<?php if($this->session->userdata('success')){ ?>
		<script>
			$(".alert-success-php").fadeTo(2500, 500).slideUp(500, function() {
				$(".alert-success-php").slideUp(500);
			});
		</script>
	<?php } ?>
	<!-- Scripts Js End -->	
