(function ($) {
 "use strict";
// base_url = 'http://localhost/dac';
// base_url = 'http://dac.igeekteam.org';

$(document).ready(function(){
	  
		/*
		Mean Menu Responsive
		============================*/		
        jQuery('nav#main-menu').meanmenu();		
		/*
		Why Choose Us Crousel
		============================*/ 	
		  $(".why-choose-all-inner").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			margin:20,
			items :3,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:2
				},				
				992:{
					items:3
				}
			}
		  });  		
		 /*
		Why Choose Us Crousel
		============================*/ 	
		  $(".recent-blog-crousel").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			margin:20,
			items :3,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:2
				},				
				992:{
					items:3
				}
			}
		  });  	
		/*
		Testimonial 3 Crousel
		============================*/ 	
		  $(".all-testimonial3").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:false, 
			dots:true, 
			items :1,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:1
				},				
				1000:{
					items:1
				}
			}			
		  }); 		
		/*
		Testimonial 4 Crousel
		============================*/ 	
		  $(".all-testimonial4").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],			
			items :1,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:1
				},				
				1000:{
					items:1
				}
			}			
		  }); 		  
		/*
		Testimonial Crousel
		============================*/ 	
		  $(".all-testimonial").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:false, 
			dots:true, 
			items :2,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				768:{
					items:2
				},				
				1000:{
					items:2
				}
			}			
		  });			  		
		
		/*
		Slider Crousel
		============================*/ 
		$(".all-slide").owlCarousel({
            items: 1,
            nav: false,
			navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: true,
            autoplay: true,
            loop: true,
			animateOut: 'slideOutDown',
			animateIn: 'flipInX',
            mouseDrag: false,
            touchDrag: false,
        });
        
        $(".all-slide").on("translate.owl.carousel", function(){
            $(".slider-text h1").removeClass("animated fadeInLeft").css("opacity", "0");
            $(".slider-text p").removeClass("animated fadeInDown").css("opacity", "0");
            $(".slider-text ul li a").removeClass("animated fadeInUp").css("opacity", "0");
            $(".slider-img img").removeClass("animated zoomIn").css("opacity", "0");
        });
        
        $(".all-slide").on("translated.owl.carousel", function(){
            $(".slider-text h1").addClass("animated fadeInLeft").css("opacity", "1");
            $(".slider-text p").addClass("animated fadeInDown").css("opacity", "1");
            $(".slider-text ul li a").addClass("animated fadeInUp").css("opacity", "1");
            $(".slider-img img").addClass("animated zoomIn").css("opacity", "1");
        });
		
		/*
		Patner Crousel
		============================*/ 	
		  $(".all-patner").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			items :4,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
				0:{
					items:2
				},
				600:{
					items:2
				},
				768:{
					items:2
				},				
				992:{
					items:4
				},				
				1000:{
					items:4
				}
			}
		  }); 		
		/*
		Patner Crousel
		============================*/ 	
		  $(".all-team2").owlCarousel({
			autoplay: true, 
			pagination:false,
			nav:true, 
			dots:false, 
			items :4,
			navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
			responsive:{
				0:{
					items:2
				},
				600:{
					items:2
				},
				768:{
					items:2
				},				
				992:{
					items:3
				},				
				1000:{
					items:4
				}
			}
		  }); 
		  
		/*
		Magnific Popup
		============================*/ 		
        $('.gallery-photo').magnificPopup({
            type: 'image',
            gallery: {
              enabled: true
            },
        });		  		  
		/*
		scrollUp
		============================*/	
		$.scrollUp({
			scrollText: '<i class="fa fa-angle-up"></i>',
			easingType: 'linear',
			scrollSpeed: 900,
			animation: 'fade'
		});	
		/*
		Counter Js
		============================*/ 
        $('.counter').counterUp({
            delay: 10,
            time: 1000			
        }); 				

		/*
		Stikey Js
		============================*/ 
		(function () {
			var nav = $('.mnmenu-sec');
			var scrolled = false;
			$(window).scroll(function () {
				if (120 < $(window).scrollTop() && !scrolled) {
					nav.addClass('sticky_menu animated fadeInDown').animate({ 'margin-top': '0px' });
					scrolled = true;
				}
				if (120 > $(window).scrollTop() && scrolled) {
					nav.removeClass('sticky_menu animated fadeInDown').css('margin-top', '0px');
					scrolled = false;
				}
			});
		}());		
		/*
		Preeloader
		============================*/
		// $(window).load(function() {
		// 	$('#preloader').fadeOut();
		// 	$('#preloader-status').delay(200).fadeOut('slow');
		// 	$('body').delay(200).css({'overflow-x':'hidden'});
		// });

		$(window).load(function() {
			// $(".spinner-eff").fadeOut("slow");
			$('.spinner-eff').delay(200).fadeOut('slow');
		});
		
		/*
		Project Gallery Js
		============================*/	
		$(".project-gallery").imagesLoaded( function() {
			$(".filtr-container").isotope({
				itemSelector: '.filtr-item',
				layoutMode: 'fitRows',
			});
			$("ul.simplefilter li").on("click",function(){
				$("ul.simplefilter li").removeClass("active");
				$(this).addClass("active");
				
				var selector = $(this).attr('data-filter');
				$(".filtr-container").isotope({
					filter: selector,
					animationOptions: {
						duration: 750,
						easing: 'linear',
						queue: false,
					}
				});
				return false;
			});
		});	
		/*
		Wow Js
		============================*/	
		new WOW().init();	
		
		
	});	
})(jQuery);

// ==========================
setTimeout(function (event) {
	$(".alert.fadeOut").fadeOut();
}, 2000);


function preview(input) {

	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(input.files[0]);
		reader.onload = function (e) {
			// console.log($(input).closest('.file-box-wrapper').parent().attr(''));
			// console.log(e);
			$(input).closest('.file-box-wrapper').parent().find('.pre-img-box img').attr('src', e.target.result);
		}

	}
}

function ajaxCall(url,method,datatype,data,headers){
	// console.log(base_url);
	return $.ajax({
		url: url,
		method: method,
		headers: headers,
		cache: false,
		contentType: false,
		processData: false,
		async: false,
		dataType: datatype,
		data: data,
		// success: function(result){
		//   // sendNotificationResult(result);
		//   console.log(result);
		//   // return result;
		// }
	});
}

function userAuth(data){
	base_url = $('.logo a').attr("href");
	// console.log(data);
	if(data.status == 401){
		window.location.replace(base_url+'memberLogin');
	}
}


function confirmDelete(id, item_name)
{
	// console.log(frm);
	// console.log(id);
	// console.log(item_name);
	// return false;

	// '<div class="modal-header">'+
	// 						'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
	// 						'<h4 class="modal-title">Delete Confirmation</h4>'+
	// 					'</div>'+

	var html  = '<div class="modal-dialog">'+
					'<div class="modal-content">'+
						
						'<div class="modal-body">'+
							'<div id="modal_error"></div>'+
							'<p>Are you sure to delete this '+item_name+'? </p>'+
						'</div>'+
				
						'<div class="modal-footer with-border">'+
							'<button type="button" class="btn btn-default btn-flat btn-pill" data-dismiss="modal">Cancel</button>'+
							'<button class="btn btn-danger btn-flat send_btn btn-pill" onclick="'+item_name+'Delete(\''+id+'\')"> Delete</button>'+
						'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}
