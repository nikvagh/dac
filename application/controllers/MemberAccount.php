<?php
    class MemberAccount extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            checkLogin('member');
            $this->load->model('VehicleModel','Vehicle');
            $this->load->model('VehicleColorModel','VehicleColor');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('PaymentModel','Payment');
            $this->load->model('PaymentCardModel','PaymentCard');
            $this->load->model('MembershipModel','Membership');
            $this->load->model('CustomerMembershipModel','CustomerMembership');
            $this->load->model('PackageModel','Package');
            $this->load->model('OfferModel','Offer');
            $this->load->model('AddOnModel','AddOn');
            $this->load->model('ZipcodeModel','Zipcode');
            $this->load->model('CountryModel','Country');
            $this->load->model('StateModel','State');
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('ServiceModel','Service');
            $this->load->library('mail');
            $this->load->library('pagination');
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
            $content['form_data'] = $this->Customer->getDataById($this->member->loginData->id);
            $data['html'] = $this->load->view(FRONT.'member_ac_profile',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        public function saveProfileValidation() {
			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');
			$this->form_validation->set_rules('zip', 'Zip', 'required');
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
            $this->form_validation->set_rules('name', 'Name', 'required');
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
			$dataHtml['content'] = $this->input->post('content');
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
            $content['vehicle_colors'] = $this->VehicleColor->get_list();
            $data['html'] = $this->load->view(FRONT.'member_ac_vehicle_add',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function vehicleCreate(){
            if ($this->Vehicle->create()) {
                echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            }
        }

        function load_vehicle_edit(){
            $content['vehicle_colors'] = $this->VehicleColor->get_list();
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
            $this->form_validation->set_rules('make', 'Vehicle Make', 'required');
            $this->form_validation->set_rules('name', 'Model', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');
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

        function load_payment_list($page){

            $per_page = $this->system->per_page;
            $per_page = 5;

            $where = [];
            $where[] = ['column'=>'p.user_type','op'=>'=','value'=>'customer'];
            $where[] = ['column'=>'p.user_id','op'=>'=','value'=>$this->member->id];

            $offset = 0;
            if($page != 0){
                $offset = ($page-1) * $per_page;
            }

            $allCount = $this->Payment->get_list('','',$where,'','Y');
            $content['list'] = $this->Payment->get_list($per_page,$offset,$where);

            $pageConfig['use_page_numbers'] = TRUE;
            $pageConfig['total_rows'] = $allCount;
            $pageConfig['per_page'] = $per_page;
            $pageConfig['attributes'] = array('class' => 'paginationAnchor');
            $this->pagination->initialize($pageConfig);
            
            $content['pagination'] = $this->pagination->create_links();
            $data['html1'] = $this->load->view(FRONT.'member_ac_payment_list',$content,TRUE);

            // =========================

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

        function load_membership_list($page){
            $per_page = $this->system->per_page;
            $per_page = 5;

            $offset = 0;
            if($page != 0){
                $offset = ($page-1) * $per_page;
            }

            $where = [];
            $where[] = ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id];
            $allCount = $this->Membership->get_list('','',$where,'','Y');
            $content['list'] = $this->Membership->get_list($per_page,$offset,$where);
            $content['isPackage'] = false;
            if($allCount > 0){
                $content['isPackage'] = true;
            }

            // echo "<pre>";
            // print_r($content['list']);
            // exit;
            
            $pageConfig['use_page_numbers'] = TRUE;
            $pageConfig['total_rows'] = $allCount;
            $pageConfig['per_page'] = $per_page;
            $pageConfig['attributes'] = array('class' => 'paginationAnchor');
            $this->pagination->initialize($pageConfig);
            
            $content['pagination'] = $this->pagination->create_links();
            $data['html1'] = $this->load->view(FRONT.'member_ac_membership_list',$content,TRUE);

            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_membership_add(){
            $content = [];
            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable']];
            $content['packages'] = $this->Package->get_list('','',$where2);

            $data['html'] = $this->load->view(FRONT.'member_ac_membership_add',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_membership_upgrade(){
            $where = [];
            $where[] = ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id];
            $membership_ongoing = $this->Membership->get_list('','',$where);
            if(count($membership_ongoing) > 0){
                $ongoing_package_details = $membership_ongoing[0];

                $content = [];
                $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable']];
                $where2[] = ['column'=>'p.id','op'=>'!=','value'=>$ongoing_package_details->package_id];
                $where2[] = ['column'=>'p.amount','op'=>'>','value'=>$ongoing_package_details->total_amount];
                $content['packages'] = $this->Package->get_list('','',$where2);
                $content['current_package_amount'] = $ongoing_package_details->total_amount;
                
                // echo "<pre>";
                // echo $this->db->last_query();
                // print_r($content);
                // exit;

                $data['html'] = $this->load->view(FRONT.'member_ac_membership_upgrade',$content,TRUE);
                echo json_encode(['status'=>200,'result'=>$data]);
            }
        }

        function membershipValidation(){
            $this->form_validation->set_rules('package_id', 'Package', 'required', ['required' => 'Please select at least one package']);
            $this->form_validation->set_rules('coupon', 'Coupon', 'callback_checkCoupon');
			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

        public function checkCoupon(){
            if($this->input->post('coupon')){
                if($this->input->post('package_id')){
                    $couponPackage = $this->Offer->checkCouponForPackage($this->input->post('package_id'),$this->input->post('coupon'));
                    // echo "<pre>";print_r($couponPackage);
                    // exit;

                    if($couponPackage['status'] == 400){
                        
                    }else{
                        if($couponPackage['status'] == 200){
                            return true;
                        }else{
                            $this->form_validation->set_message('checkCoupon', 'Invalid coupon code');
                            return false;
                        }
                    }
                }else{
                    return true;
                }
            }
        }

        function membershipCreate(){
            // $_POST;
            // print_r($_POST);
            // exit;

            // $this->session->userdata('payment_before_post',$_POST);
            $package = $this->Package->getDataById($this->input->post('package_id'));
            $validityAry = package_validity_converter($package->validity);

            $total_amount = $package->amount;
            $total_payable = $package->amount;
            $discount = 0;

            if($this->input->post('coupon')){
                $package_coupon = $this->Offer->checkCouponForPackage($this->input->post('package_id'),$this->input->post('coupon'));
                $discount = $package_coupon['result']['offer']->discount;
                $discount = ($total_amount*$discount)/100;
                $total_payable = $total_amount-$discount;
            }

            // ----------------------
            $membershipCreateData = ['package'=>$package,'validityAry'=>$validityAry,'total_amount'=>$total_amount,'total_payable'=>$total_payable,'discount'=>$discount,'customer_id'=>$this->input->post('customer_id')];
            $this->session->set_userdata('membershipCreateData',$membershipCreateData);
            // ----------------------


            $where1 = [];
            $where1[] = ['column'=>'pc.customer_id','op'=>'=','value'=>$this->member->id];
            $data['card_list'] = $this->PaymentCard->get_list('','',$where1);

            $data['amount'] = number_format((float)$total_payable, 2, '.', '');
            $data['action'] = base_url().'stripeController/membershipStripePayment';
            $data1['html1'] = $this->load->view('stripe_member',$data,TRUE);
            echo json_encode(['status'=>200,'result'=>$data1]);

            // =======================

            // if ($this->CustomerMembership->purchaseFromCustomer()) {
            //     echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
            // }
        }

        function membershipUpgrade(){
            $where = [];
            $where[] = ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id];
            $membership_ongoing = $this->Membership->get_list('','',$where);
            $ongoing_package = $membership_ongoing[0];

            $new_package = $this->Package->getDataById($this->input->post('package_id'));
            // $validityAry = package_validity_converter($package->validity);

            // echo "<pre>";
            // print_r($_POST);
            // exit;
            
            $total_amount = $new_package->amount - $ongoing_package->total_amount;
            $total_payable = $total_amount;
            // exit;

            $discount = 0;
            // if($this->input->post('coupon')){
            //     $package_coupon = $this->Offer->checkCouponForPackage($this->input->post('package_id'),$this->input->post('coupon'));
            //     $discount = $package_coupon['result']['offer']->discount;
            //     $discount = ($total_amount*$discount)/100;
            //     $total_payable = $total_amount-$discount;
            // }

            // ----------------------
            $membershipUpgradeData = ['ongoing_package'=>$ongoing_package,'new_package'=>$new_package,'total_amount'=>$total_amount,'total_payable'=>$total_payable,'discount'=>$discount,'customer_id'=>$this->input->post('customer_id')];
            $this->session->set_userdata('membershipUpgradeData',$membershipUpgradeData);
            // ----------------------

            $where1 = [];
            $where1[] = ['column'=>'pc.customer_id','op'=>'=','value'=>$this->member->id];
            $data['card_list'] = $this->PaymentCard->get_list('','',$where1);

            $data['amount'] = number_format((float)$total_payable, 2, '.', '');
            $data['action'] = base_url().'stripeController/membershipUpgradeStripePayment';
            $data1['html1'] = $this->load->view('stripe_member',$data,TRUE);
            echo json_encode(['status'=>200,'result'=>$data1]);
        }

        function getCardDetails(){
            $data['card'] = $this->PaymentCard->getDataById($this->input->post('id'));
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_booking_list($page){
            $per_page = $this->system->per_page;
            $per_page = 5;

            $offset = 0;
            if($page != 0){
                $offset = ($page-1) * $per_page;
            }

            $where1 = [['column'=>'a.customer_id','op'=>'=','value'=>$this->member->id]];
            $where_or1[] = '(a.status_id=1 or a.status_id=4)';
            $allCount = $this->Appointment->get_list('','',$where1,$where_or1,[],'Y');
            $content['list'] = $this->Appointment->get_list($per_page,$offset,$where1,$where_or1);

            $pageConfig1['use_page_numbers'] = TRUE;
            $pageConfig1['total_rows'] = $allCount;
            $pageConfig1['per_page'] = $per_page;
            $pageConfig1['attributes'] = array('class' => 'paginationAnchor');
            $this->pagination->initialize($pageConfig1);
            
            $content['pagination'] = $this->pagination->create_links();
            $data['html1'] = $this->load->view(FRONT.'member_ac_booking_list',$content,TRUE);

            // ========================================================
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_booking_prev_list($page){
            $per_page = $this->system->per_page;
            $per_page = 5;

            $offset = 0;
            if($page != 0){
                $offset = ($page-1) * $per_page;
            }


            $where2 = [['column'=>'a.customer_id','op'=>'=','value'=>$this->member->id]];
            $where_or2[] = '(a.status_id=2 or a.status_id=3 or a.status_id=5)';
            $allCount = $this->Appointment->get_list('','',$where2,$where_or2,[],'Y');
            $content['list'] = $this->Appointment->get_list($per_page,$offset,$where2,$where_or2);

            $pageConfig1['use_page_numbers'] = TRUE;
            $pageConfig1['total_rows'] = $allCount;
            $pageConfig1['per_page'] = $per_page;
            $pageConfig1['attributes'] = array('class' => 'paginationAnchor');
            $this->pagination->initialize($pageConfig1);
            
            $content['pagination'] = $this->pagination->create_links();
            $data['html1'] = $this->load->view(FRONT.'member_ac_booking_prev_list',$content,TRUE);

            // ========================================================
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_booking_add(){
            $where1 = [];
            $where1[] = ['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id];
            $content['vehicles'] = $this->Vehicle->get_list('','',$where1);

            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable'],
                        ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id],
                        ['column'=>'cm.start_date','op'=>'<=','value'=>curr_date()],
                        ['column'=>'cm.end_date','op'=>'>=','value'=>curr_date()]
                    ];  
            $group_by = 'cm.id';
            $content['packages'] = $this->Package->get_list('','',$where2,$group_by);

            $where3 = [['column'=>'a.status','op'=>'=','value'=>'Enable']];
            $content['addOns'] = $this->AddOn->get_list('','',$where3);

            $where4 = [['column'=>'s.status','op'=>'=','value'=>'Enable']];
            $content['services'] = $this->Service->get_list('','',$where4);

            $data['html'] = $this->load->view(FRONT.'member_ac_booking_add',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function bookingValidation(){
            $this->form_validation->set_rules('appointment_type', 'Time', 'required');
            $this->form_validation->set_rules('service_type', 'Service Type', 'required');
            $this->form_validation->set_rules('location', 'Location', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
            
            if($this->input->post('service_type') == 'package'){
                $this->form_validation->set_rules('package_id', 'Package', 'required');
            }else{
                $this->form_validation->set_rules('service[]', 'Service', 'required');
            }

            $this->form_validation->set_rules('vehicle_id', 'Vehicle', 'callback_vehicle_check');
            // $this->form_validation->set_rules('addOn[]', 'Add On', 'required');

            if($this->input->post('appointment_type') == "book_now"){
                $this->form_validation->set_rules('time', 'Time', 'required');
            }else{
                $this->form_validation->set_rules('date_time', 'date Time', 'required');
            }

			if ($this->form_validation->run()) {
				echo json_encode(['status'=>200]);
			} else {
				echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
			}
        }

        function bookingCreate(){
            // echo "<pre>";
            // print_r($_POST);
            // exit;

            if(!empty($this->input->post('addOn')) || ($this->input->post('service') && !empty($this->input->post('service'))) ){
                // pay for amount addon or services
                $total_payable = 0;
                if(!empty($this->input->post('addOn'))){
                    $addons = $this->AddOn->get_list('','',[],[['column'=>'a.id','value'=>$this->input->post('addOn')]]);
                    if(!empty($addons)){
                        $addon_amount_ary = array_column($addons,'amount');
                        $total_payable += array_sum($addon_amount_ary);
                    }
                }

                if(!empty($this->input->post('service'))){
                    $service = $this->Service->get_list('','',[],[['column'=>'s.id','value'=>$this->input->post('service')]]);

                    if(!empty($service)){
                        $service_amount_ary = array_column($service,'amount');
                        $total_payable += array_sum($service_amount_ary);
                    }
                }

                // echo $total_payable;
                // exit;

                // ----------------------
                $bookingCreateData = ['post'=>$_POST,'total_payable'=>$total_payable];
                $this->session->set_userdata('bookingCreateData',$bookingCreateData);
                // ----------------------

                $where1 = [];
                $where1[] = ['column'=>'pc.customer_id','op'=>'=','value'=>$this->member->id];
                $data['card_list'] = $this->PaymentCard->get_list('','',$where1);

                $data['amount'] = number_format((float)$total_payable, 2, '.', '');
                $data['action'] = base_url().'stripeController/bookingStripePayment';
                $data1['html1'] = $this->load->view('stripe_member',$data,TRUE);
                echo json_encode(['status'=>350,'result'=>$data1]);

            }else{
                if ($this->Appointment->bookNowSave()) {
                    echo json_encode(['status'=>200,'result'=>[],'message'=>'Information has been saved successfully.']);
                }
            }
        }

        public function get_list_dropdown($val = ""){
            $result = [];
            if(isset($_POST['search'])){
                if(strlen($_POST['search']) > 2){
                    $where = array(["column"=>"zipcode","op"=>"like","value"=>'%'.$_POST['search'].'%']);
                    $resultAll = $this->Zipcode->get_list('','',$where);

                    foreach($resultAll as $key=>$val){
                        $result[] = ["text"=>$val->zipcode,"id"=>$val->zipcode];
                    }
                }
            }
            echo json_encode(['result'=>$result]);
        }

        public function get_country_list_dropdown(){
            $result = [];
            if(isset($_POST['search'])){
                $where = array(["column"=>"c.nicename","op"=>"like","value"=>'%'.$_POST['search'].'%']);
                $resultAll = $this->Country->get_list('','',$where);
            }

            foreach($resultAll as $key=>$val){
                $result[] = ["text"=>$val->nicename,"id"=>$val->id];
            }

            echo json_encode(['result'=>$result]);
        }

        public function get_state_list_dropdown($country_id=""){
            $result = [];
            if(isset($_POST['search'])){
                $where = array(["column"=>"s.name","op"=>"like","value"=>'%'.$_POST['search'].'%']);
                if($country_id != ""){
                    $where[] = ["column"=>"s.country_id","op"=>"=","value"=>$country_id];
                }
                $resultAll = $this->State->get_list('','',$where);
            }

            foreach($resultAll as $key=>$val){
                $result[] = ["text"=>$val->name,"id"=>$val->id];
            }

            echo json_encode(['result'=>$result]);
        }

        public function vehicle_check(){
            if($this->input->post('vehicle_id') == "" && ($this->input->post('vehicle_name') == "" || $this->input->post('vehicle_year') == "")){
                $this->form_validation->set_message('vehicle_check', 'Please select vehicle or add new vehicle');
                return false;
            }else{
                return true;
            }
        }

        function load_booking_view(){
            $id = $this->input->post('id');
            $content = [];
            $content['form_data'] = $form_data = $this->Appointment->getDataById($id);
            $data['html'] = $this->load->view(FRONT.'member_ac_booking_view',$content,TRUE);
            echo json_encode(['status'=>200,'result'=>$data]);
        }

        function load_booking_invoice($id = 0){
            $this->load->library('Pdf_Generate');

            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['form_data']->invoice_number = $invoice_number = sprintf("%05d", $content['form_data']->id);

            // echo "<pre>";print_r($content);
            // exit;

            $html = $this->load->view(FRONT.'member_ac_booking_invoice',$content,TRUE);

            // $dataPdf['form_data'] = $this->job->getDataById_invoice($id);
            // $dataPdf['services'] = $this->job->job_request_service($id);
            // $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);
            // $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);
            // $html = $this->load->view(ADMINPATH.'job/invoice_pdf',$dataPdf,TRUE);
            // echo $html;exit;

            $pdf = array(
                "html" => $html,
                "title" => 'invoice',
                "author" => 'invoice',
                "creator" => 'invoice',
                "filename" => 'invoice_'.$invoice_number. '.pdf',
                "badge" => FALSE
            );
            $this->pdf_generate->create_pdf($pdf);
        }

    }
?>