<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<?php $this->load->view('front/head'); ?>
</head>
<?php $this->load->view('front/header'); ?>

<body>

	<!-- Page Heading Section Start -->
	<div class="pagehding-sec">
		<div class="pagehding-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-heading">
						<h1>Contact Us</h1>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->
	<!-- Contact Page Section Start -->

	<div class="contact-page-sec pt-100 pb-100">
		<div class="container">
			<span class="message_popup"> </span>
			<div class="row">
				<div class="col-md-4">
					<div class="contact-info">
						<div class="contact-info-item">
							<div class="contact-info-icon">
								<img src="<?php echo $this->front; ?>img/icon/phone-call.png" alt="" />
							</div>
							<div class="contact-info-text">
								<h2>phone</h2>
								<span>(949)259-5857</span>

							</div>
						</div>
					</div>
					<div class="contact-info">
						<div class="contact-info-item">
							<div class="contact-info-icon">
								<img src="<?php echo $this->front; ?>img/icon/contact.png" alt="" />
							</div>
							<div class="contact-info-text">
								<h2>e-mail</h2>
								<span>Support@dripautocare.com</span>

							</div>
						</div>
					</div>
					<div class="contact-info">
						<div class="contact-info-item">
							<div class="contact-info-icon">
								<img src="<?php echo $this->front; ?>img/icon/map-marker.png" alt="" />
							</div>
							<div class="contact-info-text">
								<h2>address</h2>
								<span>P.O. Box 1235, Irvine CA 92618</span>

							</div>
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<form method="post" id="contact_frm">
						<div class="contact-field">
							<h2>Write Your Message</h2>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Full Name" type="text" name="name">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Your E-mail" type="email" name="email">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="single-input-field">
									<input placeholder="Phone" type="text" name="phone">
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="select-arrow">
									<select name="service_type">
										<option value="">Service Type</option>
										<option value="Select Service Type">Select Service Type</option>
										<option value="Wheel Service">Wheel Service</option>
										<option value="Steering Service">Steering Service</option>
										<option value="Glass wash Service ">Glass wash Service </option>
										<option value="Carpet Wash Service">Carpet Wash Service</option>
										<option value="Interiors VAC Service">Interiors VAC Service</option>
										<option value="Repair Service">Repair Service</option>
									</select>
								</div>
							</div>
							<div class="col-md-12 message-input">
								<div class="single-input-field">
									<textarea placeholder="Message" name="message"></textarea>
								</div>
							</div>
							<div class="single-input-fieldsbtn pull-right">
								<input value="Send Now" type="button" class="btn-theme" id="contact_email">
							</div>
							
						</div>
					</form>
				</div>


			</div>
		</div>
	</div>
	<!-- Contact Page Section End -->

	<?php $this->load->view('front/footer'); ?>
	
	<script>
		$("#contact_email").click(function(){

			form = $("#contact_frm")[0];
			var formData = new FormData(form);

			$.ajax({
				url: '<?php echo base_url(); ?>/contact/contact_mail',
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				type: 'POST',
				dataType: "json",
				success: function(data){
					// alert(data);
					if(data.status != 200){

						if(data.status == 400){
							html = '<div class="alert alert-danger">';
								$.each(data.result, function( index, value ) {
									html += value+"<br/>";
								});
							html += '</div>';
						}else{
							html = '<div class="alert alert-danger">';
							html += data.title+"<br/>";
							html += '</div>';
						}

						// $(".message_popup").html(html);
						$(".message_popup").html(html).show().delay(2000).fadeOut(1000);
						$('html, body').animate({
							'scrollTop' : $("body").position().top
						});
					}else{

						html = '<div class="alert alert-success">';
						html += data.title+"<br/>";
						html += '</div>';
						$(".message_popup").html(html).show().delay(2000).fadeOut(1000);
						$('html, body').animate({
							'scrollTop' : $("body").position().top
						});

						$("#contact_frm")[0].reset();
					}
				}
			});

		});
	</script>

</body>

</html>