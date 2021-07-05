<form id="refer_form" action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-12 text-center">
			<h3>Referral Code <br/> <?php echo $this->member->loginData->refer_code; ?></h3>
		</div>
		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" name="link" id="link" class="form-control" value="<?php echo base_url().'memberRegister/refer/'.$this->member->loginData->refer_code; ?>" readonly>
				<span class="error text-danger validation-message" data-field="link"></span>
			</div>
		</div>
		<div class="col-lg-4">
			<button class="btn btn-primary btn-copy">Copy</button>
		</div>

		<div class="col-lg-8">
			<div class="form-group">
				<input type="text" name="name" id="name" class="form-control" placeholder="Friend's Name" value="">
				<span class="error text-danger validation-message" data-field="name"></span>
			</div>

			<div class="form-group">
				<input type="text" name="email" id="email" class="form-control" placeholder="Friend's Email" value="">
				<span class="error text-danger validation-message" data-field="email"></span>
			</div>

			<div class="form-group">
				<textarea name="content" id="content" cols="30" rows="3" class="form-control text-center">
					<p style="text-align:center">
						Hi <span id="receiver_name"></span>,
						<br/><br/>Signup with the code <?php echo $this->member->loginData->refer_code; ?>.
						<br/> <br/>Earn by refer friend,  Get a $5.00 credit by refer friend.
					</p>
				</textarea>
				<span class="error text-danger validation-message" data-field="content"></span>
			</div>
		</div>
	</div>
	<input type="hidden" name="customer_id" value="<?php echo $this->member->loginData->id; ?>">
</form>

<div class="text-right">
	<button class="btn btn-primary btn-submit btn-pill" onclick="referFriend()">Send Email</button>
</div>
<script>
	var config = CKEDITOR.replace(document.getElementById('content'));

	config.toolbar = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
		{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
		'/',
		{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
		{ name: 'others', items: [ '-' ] },
		{ name: 'about', items: [ 'About' ] }
	];

	// Toolbar groups configuration.
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		'/',
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];


	$("#name").keyup(function(){
		var name = $(this).val();
		var html =  '<p style="text-align:center">'+
						'Hi <span id="receiver_name">'+name+'</span>,'+
						'<br/>Signup with the code <?php echo $this->member->loginData->refer_code; ?> and earn by refer your friend.'+
						'<br/> <br/>Get a $5.00 credit by refer friend.'+
					'</p>';

		document.getElementById("content").value = html;

		CKEDITOR.instances.content.setData(html);
	});	
</script>