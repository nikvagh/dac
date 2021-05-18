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
						<h1>FAQ</h1>
						<ul>
							<li><a href="<?php echo base_url(); ?>">Home</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Heading Section End -->
	<!-- Contact Page Section Start -->

	<div class="faq-page-sec pt-100 pb-100">
		<div class="container">

			<div class="panel-group" id="accordion">
				<?php foreach($faqs as $key=>$val){ ?>
					<div class="panel panel-default">
						<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $val->id; ?>"><?php echo $val->question; ?></a>
						</h4>
						</div>
						<div id="collapse<?php echo $val->id; ?>" class="panel-collapse collapse">
						<div class="panel-body"><?php echo $val->answer; ?></div>
						</div>
					</div>
				<?php } ?>
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

		$('.panel-heading a').click(function() {
			$('.panel-heading').removeClass('active');
			if(!$(this).closest('.panel').find('.panel-collapse').hasClass('in'))
				$(this).parents('.panel-heading').addClass('active');
		});

	</script>

</body>

</html>