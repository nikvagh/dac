base_url = $('.logo a').attr("href");
// console.log(base_url);

$('.sidebar-ul li').on('click', function (e) {
	var target = $(e.target).attr("href");
	if(target == "#profile"){
		var call = ajaxCall(base_url+'memberAccount/load_profile_edit','post','json',[],[]);
		call.success(function(data) {
			userAuth(data);
			$('.member_ac_profile').html(data.result.html);
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
		var call1 = ajaxCall(base_url+'memberAccount/load_payment_list','post','json',[],[]);
		call1.success(function(data) {

			console.log(data);

			userAuth(data);
			$('.member_ac_payment').html(data.result.html1);
			$('.member_ac_card').html(data.result.html2);
		})
	}

});

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

function vehicleDelete(id){
	$('#confirm_model').modal('hide');
	var formData = new FormData();
	formData.append('id', id);

	var call = ajaxCall(base_url+'memberAccount/vehicleDelete','post','json',formData,[]);
	call.success(function(data) {
		userAuth(data);
		// $(".btn-submit").html("Save");
		// $(".sidebar-ul li [href='#vehicle']").trigger("click");
		$('.vehicle_ul').find('[row-id="'+id+'"]').hide();
		$(".success_msg").html(data.message);
		$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
		});
	});
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
		$('.card_ul').find('[row-id="'+id+'"]').hide();
		$(".success_msg").html(data.message);
		$("#success-alert").fadeTo(2500, 500).slideUp(500, function() {
			$("#success-alert").slideUp(500);
		});
	});
}