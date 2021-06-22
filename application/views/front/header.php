	<!-- Preloader Start -->
	<!-- <div id="preloader">
		<div id="preloader-status">  -->
			
			<div class="spinner-eff spinner-eff-5">
				<div class="ellipse"></div>
			</div>
		  
		<!-- </div>
	</div> -->
	<!-- Preloader End -->
	<!-- Header Start -->
	<header>
		<!-- Main Menu Start -->
		<div class="hd-style1">
			<!-- Header Top Start -->
			<div class="hd-sec">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-sm-8">
							<div class="hd-lft">
								<ul>
									<li><i class="fa fa-envelope"></i> dripautocare@gmail.com</li>
									<li><i class="fa fa-phone"></i>(888) 010203-4567</li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-4">
							<div class="hd-rgt">
								<a href="index.php#appoitment">Make An Appointment</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Header Top End -->
			<div class="mnmenu-sec">
				<div class="container">
					<div class="row">
						<div class="nav-menu">
							<div class="col-md-3">
								<div class="logo">
									<a href="<?php echo base_url(); ?>"><img src="<?php echo $this->front; ?>img/dac2.png" alt="" /></a>
								</div>
							</div>
							<div class="col-md-9">
								<div class="menu">

									<?php $menu_sel = $this->uri->segment(1); ?>
									<nav id="main-menu" class="main-menu">
										<ul>
											<li class="<?php if($menu_sel == "" || $menu_sel == "home"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
											<li class="<?php if($menu_sel == "about"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>about">About</a></li>
											<li class="<?php if($menu_sel == "service"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>service">Services</a></li>
											<li class="<?php if($menu_sel == "account"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>memberAccount">My Account</a></li>
											<li class="<?php if($menu_sel == "contact"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>contact">Contact</a></li>
											<li class="<?php if($menu_sel == "faq"){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>faq">FAQ</a></li>
										</ul>
									</nav>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Main Menu End -->
	</header>
	<!-- Header End -->