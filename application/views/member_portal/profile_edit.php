<!DOCTYPE html>
<html lang="en-us">
	<head>
		<?php $this->load->view(MEMBERPATH.'head'); ?>
		<?php $this->load->view(MEMBERPATH.'common_css'); ?>
	</head>

	<body class="smart-style-1">

    <?php $this->load->view(MEMBERPATH.'header'); ?>

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
    <?php $this->load->view(MEMBERPATH.'sidebar'); ?>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

      <?php $this->load->view(MEMBERPATH.'breadcrumb'); ?>
			
			<!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">

					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">
              Dashboard 
            </h1>
					</div>
					<!-- end col -->

				</div>
				<!-- end row -->

				<!--
				The ID "widget-grid" will start to initialize all widgets below
				You do not need to use widgets if you dont want to. Simply remove
				the <section></section> and you can use wells or panels instead
				-->

				<!-- widget grid -->
				<section id="widget-grid" class="">

					<!-- row -->

					<div class="row">

						<div class="col-sm-6 col-lg-4">

							<!-- <div class="panel panel-default">
								<div class="panel-body status">
									<div class="who clearfix">
										<img src="img/avatars/5.png" alt="img" class="online">
										<span class="name"><b>Karrigan Mean</b> shared a photo</span>
										<span class="from"><b>1 days ago</b> via Mobile, Sydney, Australia</span>
									</div>
									<div class="image"><img src="img/realestate/6.png" alt="img">
									</div>
									<ul class="links">
										<li>
											<a href="javascript:void(0);"><i class="fa fa-thumbs-o-up"></i> Like</a>
										</li>
										<li>
											<a href="javascript:void(0);"><i class="fa fa-comment-o"></i> Comment</a>
										</li>
										<li>
											<a href="javascript:void(0);"><i class="fa fa-share-square-o"></i> Share</a>
										</li>
									</ul>
									<ul class="comments">
										<li>
											<img src="img/avatars/sunny.png" alt="img" class="online">
											<span class="name">John Doe</span>
											Looks like a nice house, when did you get it? Are we having the party there next week? ;)
										</li>
										<li>
											<img src="img/avatars/2.png" alt="img" class="online">
											<span class="name">Alice Wonder</span>
											Seems cool.
										</li>
										<li>
											<img src="img/avatars/sunny.png" alt="img" class="online">
											<input type="text" class="form-control" placeholder="Post your comment...">
										</li>
									</ul>
								</div>
							</div> -->

						</div>

					</div>

					<!-- end row -->

				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->

		<?php $this->load->view(MEMBERPATH.'footer'); ?>

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<?php $this->load->view(MEMBERPATH.'common_js'); ?>

	</body>

</html>