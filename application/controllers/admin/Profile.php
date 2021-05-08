<?php
	class Profile extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('AdminUserModel','AdminUser');
			checkLogin('admin');
		}

		function index()
		{
			$content['title'] = "Profile";
			$views["content"] = ["path"=>ADMIN.'profile_edit',"data"=>$content];
            $layout['page'] = 'profile_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
		}

		public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

		function update()
		{
			// echo "<pre>"; print_r($_POST); exit;
			if ($this->AdminUser->profileUpdate()) {
				$this->session->set_flashdata('success', 'Information has been updated successfully.');
				echo json_encode(['status'=>200]);
			}
		}

	}
?>