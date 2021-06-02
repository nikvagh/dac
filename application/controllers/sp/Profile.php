<?php
	class Profile extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('ServiceProviderModel','ServiceProvider');
			checkLogin('sp');
		}

		function index()
		{
			$content['title'] = "Profile";
			$views["content"] = ["path"=>SP.'profile_edit',"data"=>$content];
            $layout['page'] = 'profile_edit';
            $this->layouts->view($views,'sp_dashboard',$layout);
		}

		public function validation() {
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			$this->form_validation->set_rules('phone_day', 'Phone', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_emailCheckEdit');
			$this->form_validation->set_rules('EIN', 'EIN', 'required');

			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

		function update()
		{
			if ($this->ServiceProvider->profileUpdate()) {
				$this->session->set_flashdata('success', 'Information has been updated successfully.');
				echo json_encode(['status'=>200]);
			}
		}

		function emailCheckEdit(){
            $email = trim($this->input->post('email'));
            $sp_id = $this->input->post('id');

            $this->db->select('sp_id');
            $this->db->where('email',$email);
            $this->db->where('sp_id != ',$sp_id);
            $query1 = $this->db->get('sp');
            if ($query1->num_rows() > 0) {
                $this->form_validation->set_message('emailCheckAdd', 'Email already exist');
                return false;
            }else{
                return true;
            }
        }

	}
?>