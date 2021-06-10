<?php
    class Offer extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('OfferModel','Offer');
            $this->load->model('CategoryModel','Category');
            $this->load->model('ServiceModel','Service');
            $this->load->model('PackageModel','Package');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('NotificationTemplateModel','NotificationTemplate');
            $this->load->library('mail');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Coupons";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Offer->st_update()) {
                    $this->session->set_flashdata('success', 'Offer status has been update successfully.');
                    redirect(ADMIN.'offer');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Offer->delete()) {
                    $this->session->set_flashdata('success', 'Offer deleted successfully.');
                    redirect(ADMIN.'offer');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Offer->get_list();
            $content['title_top'] = "Coupons";
            $content['title'] = "Coupon";
            $views["content"] = ["path"=>ADMIN.'offer_list',"data"=>$content];
            $layout['page'] = 'offer_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title_top'] = "Coupons";
            $content['title'] = "Coupon";
            // $content['categories'] = $this->Category->get_list();
            // $content['services'] = $this->Service->get_list();
            $content['packages'] = $this->Package->get_list();
            $views["content"] = ["path"=>ADMIN.'offer_add',"data"=>$content];
            $layout['page'] = 'offer_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Coupons";
            $content['title'] = "Coupon";
            $content['form_data'] = $this->Offer->getDataById($id);
            // $content['categories'] = $this->Category->get_list();
            // $content['services'] = $this->Service->get_list();
            $content['packages'] = $this->Package->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'offer_edit',"data"=>$content];
            $layout['page'] = 'offer_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;

            if($this->input->post('action') == 'add' || $this->input->post('action') == 'edit'){
                $this->form_validation->set_rules('code', 'Code', 'required');
                $this->form_validation->set_rules('discount', 'Discount', 'required|numeric|less_than_equal_to[100]');
                $this->form_validation->set_rules('start_date', 'Start Date', 'required');
                $this->form_validation->set_rules('end_date', 'End Date', 'required');
                // $this->form_validation->set_rules('categories[]', 'Categories', 'required');
                $this->form_validation->set_rules('packages[]', 'Packages', 'required');
            }

            if($this->input->post('action') == 'send'){
                $this->form_validation->set_rules('customer[]', 'Customers', 'required');
            }

            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Offer->create()) {
                $this->session->set_flashdata('success', 'Offer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Offer->update()) {
                $this->session->set_flashdata('success', 'Offer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Offer->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

        public function sendToCustomerLoad($id = 0){
            $content['title_top'] = "Send Coupon";
            $content['title'] = "Coupon";
            $content['form_data'] = $this->Offer->getDataById($id);
            $content['customers'] = $this->Customer->get_list();
            // $content['services'] = $this->Service->get_list();
            $content['packages'] = $this->Package->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'offer_send',"data"=>$content];
            $layout['page'] = 'offer_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function sendMail(){

            $offer = $this->Offer->getDataById($this->input->post('id'));
            $template = $this->NotificationTemplate->getDataById(8);

            // echo $template->mail_content;
            // exit;

            $search = array("{coupon}", "{coupon_percentage}", "{coupon_expiry}");
            $replace = array($offer->code, $offer->discount.' %', date('d M, Y',strtotime($offer->end_date)) );
            $content = str_replace($search, $replace, $template->mail_content);

            $customer = $this->input->post('customer');
            if(in_array('All',$customer)){
                $customer_list = $this->Customer->get_list();
            }else{
                $whereIn[] = ['column'=>'cr.id','value'=>$this->input->post('customer')];
                $customer_list = $this->Customer->get_list('','','',$whereIn);
            }

            $all_emails = array_column($customer_list,'email');
            $first_email = $all_emails[0];
            array_shift($all_emails); // remove first element from array

            // echo "<pre>";
            // print_r($first_email);
            // print_r($all_emails);
            // exit;

            // NotificationTemplate->getby
            // CouponCode

            // $dataHtml['name'] = $this->member->loginData->firstname.' '.$this->member->loginData->lastname;
			$dataHtml['logo'] = base_url(SYSTEM_IMG).$this->system->company_logo;
            $dataHtml['content'] = $content;
			$html = $this->load->view('mail/coupon_code',$dataHtml,TRUE);

			// echo $html;exit;
			// $subject = "Drip Auto Care - Invitation";

			if ($this->mail->send_email($first_email,$template->subject,$html,0,$all_emails)){
				$this->session->set_flashdata('success', 'Email sent successfully.');
				echo json_encode(['status'=>200]);
			}else{
				$this->session->set_flashdata('error', 'Something went wrong, please try again.');
				echo json_encode(['status'=>200]);
			}

        }

    }
?>