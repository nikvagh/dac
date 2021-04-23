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

function confirmDelete(frm, id, item_name)
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
							'<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>'+
							'<button class="btn btn-danger btn-flat send_btn" onclick="delete_items(\''+frm+'\',\''+id+'\')"> Delete</button>'+
						'</div>'+
					'</div>'+
				'</div>';

	$('#confirm_model').html(html);
	$('#confirm_model').modal('show');
}

function delete_items(frm,id){
	// console.log(frm);
	$("#id").val(id);
	$("#action").val("delete");
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