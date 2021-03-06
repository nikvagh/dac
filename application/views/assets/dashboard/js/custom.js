// $('.input-single').change(function(){
// 	const file = this.files[0];
// 	// console.log(file);
// 	if (file){
// 	  let reader = new FileReader();
// 	  reader.onload = function(event){
// 		// console.log(event.target.result);
// 		// $(this).parents('.file-box-wrapper').siblings('.pre-img-box').children('img').attr('src', event.target.result);
// 		$(this).parents('.file-box-wrapper').hide();
// 	  }
// 	  reader.readAsDataURL(file);
// 	}
// });

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

function confirmDelete(frm, id, item_name,action)
{
	// console.log(frm);
	// console.log(id);
	// console.log(item_name);
	// console.log(action);

	// '<div class="modal-header">'+
	// 						'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
	// 						'<h4 class="modal-title">Delete Confirmation</h4>'+
	// 					'</div>'+

	if (typeof action === "undefined") {
		action = 'delete';
	}

	var html  = '<div class="modal-dialog">'+
					'<div class="modal-content">'+
						
						'<div class="modal-body">'+
							'<div id="modal_error"></div>'+
							'<p>Are you sure to delete this '+item_name+'? </p>'+
						'</div>'+
				
						'<div class="modal-footer with-border">'+
							'<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
							'<button class="btn btn-danger btn-flat send_btn" onclick="delete_items(\''+frm+'\',\''+id+'\',\''+action+'\')"> Delete</button>'+
						'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}

function delete_items(frm,id,action){
	$("#id").val(id);
	$("#action").val(action);
	$("#"+frm).submit();
}

function confirmPublishStatus(frm, id, publish, isElement)
{
	// console.log(frm);
	// console.log(id);
	// console.log(item_name);
	// return false;

	// '<div class="modal-header">'+
	// 	'<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>'+
	// 	'<h4 class="modal-title"> Status Confirmation</h4>'+
	// '</div>'+

	// var html  = '<div class="modal-dialog">'+
	// 				'<div class="modal-content">'+
	// 					'<div class="modal-body">'+
	// 						'<div id="modal_error"></div>'+
	// 						'<p>Are you sure to change status? </p>'+
	// 					'</div>'+
				
	// 					'<div class="modal-footer with-border">'+
	// 						'<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
	// 						'<button class="btn btn-success btn-flat send_btn" onclick="change_status(\''+frm+'\',\''+id+'\',\''+publish+'\')"> Change</button>'+
	// 					'</div>'+
	// 				'</div>'+
	// 			'</div>';

	// $('#confirm_model').html(html);
	// $('#confirm_model').modal('show');

	if (isElement !== undefined){
		publish = publish.value;
	}

	change_status(frm,id,publish);
}

function change_status(frm,id,publish){

	// console.log(frm);
	// console.log(id);
	// console.log(publish);
	// return false;

	$("#id").val(id);
	$("#publish").val(publish);
	$("#action").val("change_publish");
	$("#"+frm).submit();
}

function resubmit_false(){
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
}

function handlePermission() {
	navigator.permissions.query({
		name: 'geolocation'
	}).then(function(result) {
		if (result.state == 'granted') {
			report(result.state);
			// geoBtn.style.display = 'none';
		} else if (result.state == 'prompt') {
			report(result.state);
			// geoBtn.style.display = 'none';
   
			navigator.geolocation.getCurrentPosition(revealPosition, positionDenied, geoSettings);
		} else if (result.state == 'denied') {
			report(result.state);
			// geoBtn.style.display = 'inline';
		}
		result.onchange = function() {
			report(result.state);
		}
	});
}

function report(state) {
	console.log('Permission ' + state);
}

function isNumber(evt) {
	evt = (evt) ? evt : window.event;
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}

function toggleNav(){
	if($("#sidenav-main").hasClass("toggleShow")){
		$(".sidenav").addClass('toggleHide');
		$(".sidenav").removeClass('toggleShow');

		$('.main-content').css('margin-left','0px');
	}else{
		$(".sidenav").addClass('toggleShow');
		$(".sidenav").removeClass('toggleHide');

		$('.main-content').css('margin-left','250px');
	}
}