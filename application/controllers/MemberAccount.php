<?php
    class MemberAccount extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            // $this->load->model('dashboard_model','dashboard');
            $this->load->model('CustomerModel','Customer');
            checkLogin('member');
        }

        function index()
        {
            // $data['dashboard'] = TRUE;
            $data['title'] = "Account";
            $data['page'] = "memberAccount";
            // $data['profile'] = $this->dashboard->get_admin();
            // $data['total_companies'] = $this->dashboard->get_total_companies();
            // $data['total_orders'] = $this->dashboard->get_total_orders();
            // $data['companies'] = $this->company->get_companies();
            $this->load->view(FRONT.'memberAccount', $data);
        }

        function load_profile_edit(){
            $content = [];
            $data['html'] = $this->load->view(FRONT.'member_ac_profile',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        public function saveProfileValidation() {
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

        function saveProfile(){
            if ($this->Customer->profileUpdate()) {
				echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been updated successfully.']);
			}
        }

    }
?>