<?php
    class MemberAccount extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            checkLogin('member');
            $this->load->model('VehicleModel','Vehicle');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('PaymentModel','Payment');
            $this->load->model('PaymentCardModel','PaymentCard');
            $this->load->library('mail');
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

        function load_refer_friend(){
            $content = [];
            $data['html'] = $this->load->view(FRONT.'member_ac_refer_friend',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function referFriendValidation(){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

        function referFriend(){
            $dataHtml['name'] = $this->member->loginData->firstname.' '.$this->member->loginData->lastname;
			$dataHtml['logo'] = base_url(SYSTEM_IMG).$this->system->company_logo;
			$dataHtml['link'] = $this->input->post('link');
			$html = $this->load->view('mail/refer',$dataHtml,TRUE);

			// echo $html;exit;
			$subject = "Drip Auto Care - Invitation";
			if ($this->mail->send_email($this->input->post('email'),$subject,$html)){
				echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been updated successfully.']);
			}else{
                echo json_encode(['status'=>310,'result'=>[],'message'=>'Something went wrong, please try again.']);
			}

        }

        function load_vehicle_list(){
            $where = [['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id]];
            $content['list'] = $this->Vehicle->get_list('','',$where);
            $data['html'] = $this->load->view(FRONT.'member_ac_vehicle_list',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }


        function load_vehicle_add(){
            $content = [];
            $data['html'] = $this->load->view(FRONT.'member_ac_vehicle_add',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function vehicleCreate(){
            if ($this->Vehicle->create()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            }
        }

        function load_vehicle_edit(){
            $content['form_data'] = $form_data = $this->Vehicle->getDataById($this->input->post('id'));
            $data['html'] = $this->load->view(FRONT.'member_ac_vehicle_edit',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function vehicleUpdate(){
            if ($this->Vehicle->update()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            }
        }

        function vehicleValidation(){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

        function vehicleDelete(){
            if ($this->Vehicle->delete()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been deleted successfully.']);
            }
        }

        function load_payment_list(){
            $where = [];
            $where[] = ['column'=>'p.user_type','op'=>'=','value'=>'customer'];
            $where[] = ['column'=>'p.user_id','op'=>'=','value'=>$this->member->id];
            $content['list'] = $this->Payment->get_list('','',$where);
            $data['html1'] = $this->load->view(FRONT.'member_ac_payment_list',$content,TRUE);

            $where1 = [];
            $where1[] = ['column'=>'pc.customer_id','op'=>'=','value'=>$this->member->id];
            $content['list'] = $this->PaymentCard->get_list('','',$where1);
            $data['html2'] = $this->load->view(FRONT.'member_ac_card_list',$content,TRUE);

            // print_r($content);exit;
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_card_list(){
            $where = [['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id]];
            $content['list'] = $this->Vehicle->get_list('','',$where);
            $data['html'] = $this->load->view(FRONT.'member_ac_vehicle_list',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_card_add(){
            $content = [];
            $data['html'] = $this->load->view(FRONT.'member_ac_card_add',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_card_edit(){
            $content['form_data'] = $form_data = $this->PaymentCard->getDataById($this->input->post('id'));
            $data['html'] = $this->load->view(FRONT.'member_ac_card_edit',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function cardValidation(){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('number', 'Number', 'required|numeric');
            $this->form_validation->set_rules('expiry_year', 'Expiry Year', 'required');
            $this->form_validation->set_rules('expiry_month', 'Expiry Month', 'required');
            $this->form_validation->set_rules('cvv', 'CVV', 'required|numeric');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

        function cardCreate(){
            if ($this->PaymentCard->create()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            }
        }

        function cardUpdate(){
            if ($this->PaymentCard->update()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            }
        }

        function cardDelete(){
            if ($this->PaymentCard->delete()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been deleted successfully.']);
            }
        }

    }
?>