<?php
	class Refer extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('CustomerModel','Customer');
			checkLogin('member');
		}

		function index()
		{
			$content['title'] = "Refer Friend";
			$views["content"] = ["path"=>MEMBER.'refer_friend',"data"=>$content];
            $layout['page'] = 'refer_friend';
            $this->layouts->view($views,'member_dashboard',$layout);
		}

		function validation()
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
		}

		function sendMail()
		{
			// echo "<pre>"; print_r($_POST); exit;
			// if ($this->Customer->profileUpdate()) {
				$this->session->set_flashdata('success', 'EMail sent successfully.');
				echo json_encode(['status'=>200]);
			// }
		}

	}
?>