base_url = $('.logo a').attr("href");
// console.log(base_url);
$(document).ready(function(){
	$(".sidebar-ul li [href='#membership']").trigger("click");
	// $(".alert-success").slideUp(4000);
});

country_id = "";
$('.sidebar-ul li').on('click', function (e) {
	var target = $(e.target).attr("href");
	if(target == "#profile"){
		var call = ajaxCall(base_url+'memberAccount/load_profile_edit','post','json',[],[]);
		call.success(function(data) {
			userAuth(data);
			$('.member_ac_profile').html(data.result.html);

			// =========================
			$('#country').select2({
				ajax: {
					type: "post",
					url: base_url+'memberAccount/get_country_list_dropdown',
					dataType: 'json',
					data: function (params) {
						// console.log(params)
						var query = {
							search: params.term,
							type: 'public'
						}
						return query;
					},
					processResults: function (data) {
						// console.log(data.result);
						return {
							results: data.result
						};
					},
					// cache: true,
				},
				placeholder: 'Search for a Country',
			});

			// $('#state').select2({
			// 	ajax: {
			// 		type: "post",
			// 		url: base_url+'memberAccount/get_state_list_dropdown/'+country_id,
			// 		dataType: 'json',
			// 		data: function (params) {
			// 			// console.log(params)
			// 			var query = {
			// 				search: params.term,
			// 				type: 'public'
			// 			}
			// 			return query;
			// 		},
			// 		processResults: function (data) {
			// 			// console.log(data.result);
			// 			return {
			// 				results: data.result
			// 			};
			// 		},
			// 		// cache: true,
			// 	},
			// 	placeholder: 'Search for a State',
			// });

			// country_id = $("#country").val();
			// =====================================
			// $('body').on('change','#country',function(e){
			// 	$('#state').val('').trigger('change');
			// 	country_id = $(this).val();

			// 	$('#state').select2({
			// 		ajax: {
			// 			type: "post",
			// 			url: base_url+'memberAccount/get_state_list_dropdown/'+country_id,
			// 			dataType: 'json',
			// 			data: function (params) {
			// 				// console.log(params)
			// 				var query = {
			// 					search: params.term,
			// 					type: 'public'
			// 				}
			// 				return query;
			// 			},
			// 			processResults: function (data) {
			// 				// console.log(data.result);
			// 				return {
			// 					results: data.result
			// 				};
			// 			},
			// 			// cache: true,
			// 		},
			// 		placeholder: 'Search for a State',
			// 	});
			// });
			

			$('#zip').select2({
				ajax: {
					type: "post",
					url: base_url+'memberAccount/get_list_dropdown',
					dataType: 'json',
					data: function (params) {
						// console.log(params)
						var query = {
							search: params.term,
							type: 'public'
						}
						return query;
					},
					processResults: function (data) {
						// console.log(data.result);
						return {
							results: data.result
						};
					},
					// cache: true,
				},
				placeholder: 'Search for a zip code',
			});
			
		})
	}

	if(target == "#refer"){
		var call = ajaxCall(base_url+'memberAccount/load_refer_friend','post','json',[],[]);
		call.success(function(data) {
			userAuth(data);
			$('.member_ac_refer').html(data.result.html);
		})

		$(".btn-copy").click(function(e){
            e.preventDefault();
            $('#link').select();
            document.execCommand("copy");
        })
	}

	if(target == "#vehicle"){
		var call = ajaxCall(base_url+'memberAccount/load_vehicle_list','post','json',[],[]);
		call.success(function(data) {
			userAuth(data);
			$('.member_ac_vehicle').html(data.result.html);
		})
	}

	if(target == "#payment"){
		load_payment_list();
	}

	if(target == "#membership"){
		load_membership_list();
	}

	if(target == "#booking"){
		load_booking_list();
		member_ac_booking_list_prev();
	}
});

$('body').on('click','.pagination_wrapper a',function(e){
	e.preventDefault(); 
	var pageNo = $(this).attr('data-ci-pagination-page');
	var pagination_wrapper = $(this).parent('.pagination_wrapper');
	
	if(pagination_wrapper.hasClass('payment_pagination')){
		load_payment_list(pageNo);
	}

	if(pagination_wrapper.hasClass('membership_pagination')){
		load_membership_list(pageNo);
	}

	if(pagination_wrapper.hasClass('booking_pagination')){
		load_booking_list(pageNo);
	}

	if(pagination_wrapper.hasClass('booking_prev_pagination')){
		member_ac_booking_list_prev(pageNo);
	}
});

function cancel(href){
	if(href == "card"){
		load_payment_list();
	}else if(href == 'vehicle'){
		$('.sidebar-ul li [href="#'+href+'"]').trigger("click");
	}else if(href=='booking'){
		load_booking_list();
		member_ac_booking_list_prev();
	}else if(href=='membership'){
		$(".sidebar-ul li [href='#membership']").trigger("click");
	}
}

function saveProfile_validation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/saveProfileValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function saveProfile(){
	var formData = new FormData(document.getElementById("profile_form"));
	if(saveProfile_validation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/saveProfile','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");

			$(".success_msg").html(data.message);
			$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});
		});

	}
}

function referFriend_validation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/referFriendValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function referFriend(){
	var formData = new FormData(document.getElementById("refer_form"));
	if(referFriend_validation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/referFriend','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");

			if(data.status == 200){
				$("#refer_form")[0].reset();
				$(".success_msg").html(data.message);
				$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
					$("#success-alert").slideUp(500);
				});
			}else{
				$(".error_msg").html(data.message);
				$("#error-alert").fadeTo(2500, 500).slideUp(500, function() {
					$("#error-alert").slideUp(500);
				});
			}
		});
	}
}

function load_vehicle_add(){
	var call = ajaxCall(base_url+'memberAccount/load_vehicle_add','post','json',[],[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_vehicle').html(data.result.html);
	})
}

function load_vehicle_edit(id){
	var formData = new FormData();
	formData.append('id', id);
	var call = ajaxCall(base_url+'memberAccount/load_vehicle_edit','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_vehicle').html(data.result.html);
	})
}

function vehicleValidation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/vehicleValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function vehicleCreate(){
	var formData = new FormData(document.getElementById("vehicle_form"));
	if(vehicleValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/vehicleCreate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			$(".sidebar-ul li [href='#vehicle']").trigger("click");

			$(".success_msg").html(data.message);
			$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});
		});

	}
}

function vehicleUpdate(){
	var formData = new FormData(document.getElementById("vehicle_form"));
	if(vehicleValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/vehicleUpdate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			$(".sidebar-ul li [href='#vehicle']").trigger("click");

			$(".success_msg").html(data.message);
			$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});
		});

	}
}

function vehicleDelete(id){
	$('#confirm_model').modal('hide');
	var formData = new FormData();
	formData.append('id', id);

	var call = ajaxCall(base_url+'memberAccount/vehicleDelete','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		// $(".btn-submit").html("Save");
		$('.sidebar-ul li [href="#vehicle"]').trigger("click");

		$('.vehicle_ul').find('[row-id="'+id+'"]').hide();
		$(".success_msg").html(data.message);
		$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
		});
	});
}

function load_payment_list(pageNo){
	if(typeof pageNo == 'undefined'){ pageNo=1; }
	var call1 = ajaxCall(base_url+'memberAccount/load_payment_list/'+pageNo,'post','json',[],[]);
	call1.success(function(data) {
		// console.log(data);

		userAuth(data);
		$('.member_ac_payment').html(data.result.html1);
		// $('.pagination1').html(data.result.pagination1);

		$('.member_ac_card').html(data.result.html2);
	})
}

function load_card_add(){
	var call = ajaxCall(base_url+'memberAccount/load_card_add','post','json',[],[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_card').html(data.result.html);
	})
}

function load_card_edit(id){
	var formData = new FormData();
	formData.append('id', id);
	var call = ajaxCall(base_url+'memberAccount/load_card_edit','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_card').html(data.result.html);
	})
}

function cardCreate(){
	var formData = new FormData(document.getElementById("card_form"));
	if(cardValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/cardCreate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			$(".sidebar-ul li [href='#payment']").trigger("click");

			$(".success_msg").html(data.message);
			$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});
		});

	}
}

function cardUpdate(){
	var formData = new FormData(document.getElementById("card_form"));
	if(cardValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/cardUpdate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			$(".sidebar-ul li [href='#payment']").trigger("click");

			$(".success_msg").html(data.message);
			$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
				$("#success-alert").slideUp(500);
			});
		});

	}
}

function cardValidation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/cardValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function cardDelete(id){
	$('#confirm_model').modal('hide');
	var formData = new FormData();
	formData.append('id', id);

	var call = ajaxCall(base_url+'memberAccount/cardDelete','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		// $(".btn-submit").html("Save");
		// $(".sidebar-ul li [href='#vehicle']").trigger("click");
		// $('.card_ul').find('[row-id="'+id+'"]').hide();
		load_payment_list();
		$(".success_msg").html(data.message);
		$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
		});
	});
}

function load_membership_list(pageNo){
	if(typeof pageNo == 'undefined'){ pageNo=1; }
	var call1 = ajaxCall(base_url+'memberAccount/load_membership_list/'+pageNo,'post','json',[],[]);
	call1.success(function(data) {
		userAuth(data);
		$('.member_ac_membership').html(data.result.html1);
	})
}

function load_membership_add(){
	var call = ajaxCall(base_url+'memberAccount/load_membership_add','post','json',[],[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_membership').html(data.result.html);
	})
}

function load_membership_upgrade(){
	var call = ajaxCall(base_url+'memberAccount/load_membership_upgrade','post','json',[],[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_membership').html(data.result.html);
	})
}

function membershipCreate(){
	var formData = new FormData(document.getElementById("membership_form"));
	if(membershipValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/membershipCreate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			// load_strip_form();

			$('.member_ac_membership').html(data.result.html1);
			
			// load_membership_list();
			// $(".success_msg").html(data.message);
			// $("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
			// 	$("#success-alert").slideUp(500);
			// });
		});

	}
}

function membershipUpgrade(){
	var formData = new FormData(document.getElementById("membership_form"));
	if(membershipValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/membershipUpgrade','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);
			$(".btn-submit").html("Save");
			// load_strip_form();

			$('.member_ac_membership').html(data.result.html1);
		});

	}
}

$('body').on('change','input[name="payment_card"]',function(e){
	var card_id = $(this).val();
	var formData = new FormData();
	formData.append('id', card_id);
	var call = ajaxCall(base_url+'memberAccount/getCardDetails','post','json',formData,[]);
	call.success(function(data) {
		// console.log(data);
		$(".card_name").val(data.result.card.name);
		$(".card_number").val(data.result.card.number);
		$(".card_cvv").val(data.result.card.cvv);
		$(".card_month").val(data.result.card.expiry_month);
		$(".card_year").val(data.result.card.expiry_year);
	});
});


function membershipValidation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/membershipValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function load_booking_list(pageNo){
	if(typeof pageNo == 'undefined'){ pageNo=1; }
	var call1 = ajaxCall(base_url+'memberAccount/load_booking_list/'+pageNo,'post','json',[],[]);
	call1.success(function(data) {
		userAuth(data);
		$('.member_ac_booking').html(data.result.html1);
	})
}

function member_ac_booking_list_prev(pageNo){
	if(typeof pageNo == 'undefined'){ pageNo=1; }
	var call1 = ajaxCall(base_url+'memberAccount/load_booking_prev_list/'+pageNo,'post','json',[],[]);

	call1.success(function(data) {
		userAuth(data);
		// console.log(data);
		$('.member_ac_booking_prev').html(data.result.html1);
	})
}

function load_booking_add(){
	var call = ajaxCall(base_url+'memberAccount/load_booking_add','post','json',[],[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_booking').html(data.result.html);
		$('.member_ac_booking_prev').html('');

		// ===================================
		$('.select2').select2();

        $('#zipcode').select2({
            ajax: {
                type: "post",
                url: base_url+'memberAccount/get_list_dropdown',
                dataType: 'json',
                data: function (params) {
                    // console.log(params)
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {
                    // console.log(data.result);
                    return {
                        results: data.result
                    };
                },
                // cache: true,
            },
            placeholder: 'Search for a zip code',
        });

		var date = new Date();

        var setTime = function(currentDateTime){
            if(date.getHours() >= 7){
                var minTime = date.getHours()+":"+date.getMinutes();
            }else{
                var minTime = '7:00';
            }

            this.setOptions({
                minTime:minTime,
                maxTime:'18:15'
            });
        };

        $('#time').datetimepicker({
            datepicker:false,
            format:'H:i',
            step:15,
            onShow:setTime,
            timezone:'UTC'

            // minTime:'11:00',
            // maxTime:'18:00',
        });

        // =============================

        var minDate = new Date();
        minDate.setDate(minDate.getDate() + 1);

        var maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 8);
        
        $('#date_time').datetimepicker({
            format:'Y-m-d H:i',
            step:15,
            defaultDate: minDate,
            // onShow:setDateTime,
            timezone:'UTC',
            minDate: minDate,
            maxDate: maxDate,
        });

        // handlePermission();
        getLocation();

		$(".date_time_box").hide();
        $("input[name=appointment_type]").on('change',function(){
            if($(this).val() == "book_now"){
                $(".time_box").show();
                $(".date_time_box").hide();
            }else{
                $(".date_time_box").show();
                $(".time_box").hide();
            }
        });

		$(".service_box").hide();
		$("input[name=service_type]").on('change',function(){
			if($(this).val() == "package"){
                $(".package_box").show();
                $(".service_box").hide();
            }else{
                $(".service_box").show();
                $(".package_box").hide();
            }
		});
		

	})
}

getLocation();
function getLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else {
		console.log('Geolocation is not supported by this browser.');
	}
}

function showPosition(position) {
	// console.log(position.coords.latitude)
	// console.log(position.coords.longitude)
	$("#latitude").val(position.coords.latitude);
	$("#longitude").val(position.coords.longitude);
}

function bookingCreate(){
	var formData = new FormData(document.getElementById("booking_form"));
	if(bookingValidation(formData) == 'success'){

		$(".btn-submit").html("Saving data, please wait...");
		var call = ajaxCall(base_url+'memberAccount/bookingCreate','post','json',formData,[]);
		call.success(function(data) {
			userAuth(data);

			// console.log(data);
			// return false;

			if(data.status == 200){
				$(".btn-submit").html("Save");
				load_booking_list();

				$(".success_msg").html(data.message);
				$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
					$("#success-alert").slideUp(500);
				});
			}

			if(data.status == 350){
				$('.member_ac_booking').html(data.result.html1);
				$('.member_ac_booking_prev').html('');
			}
			
		});

	}
}

function bookingValidation(formData){
	$(".btn-submit").html("Validating data, please wait...");
	var call = ajaxCall(base_url+'memberAccount/bookingValidation','post','json',formData,[]);
	var returnData;
	call.success(function(data) {
		userAuth(data);
		returnData = data;
	});
	
	$('.validation-message').html('');
	if (returnData.status != 200) {
		$(".btn-submit").html("Submit");
		$('.validation-message').each(function () {
			for (var key in returnData.result) {
				if ($(this).attr('data-field') == key) {
					$(this).html(returnData.result[key]);
				}
			}
		});
	} else {
		return 'success';
	}
}

function load_booking_view(id){
	var formData = new FormData();
	formData.append('id', id);
	var call = ajaxCall(base_url+'memberAccount/load_booking_view','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		$('.member_ac_booking').html(data.result.html);
		$('.member_ac_booking_prev').html('');
	})
}


