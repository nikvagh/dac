<?php
	class Profile extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('CustomerModel','Customer');
			checkLogin('member');
		}

		function index()
		{
			$content['title'] = "Profile";
			$views["content"] = ["path"=>MEMBER.'profile_edit',"data"=>$content];
            $layout['page'] = 'profile_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
		}

		public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
			$this->form_validation->set_rules('address', 'Address', 'required');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

		function update()
		{
			// echo "<pre>"; print_r($_POST); exit;
			if ($this->Customer->profileUpdate()) {
				$this->session->set_flashdata('success', 'Information has been updated successfully.');
				echo json_encode(['status'=>200]);
			}
		}

	}
?>