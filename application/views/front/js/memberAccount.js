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
