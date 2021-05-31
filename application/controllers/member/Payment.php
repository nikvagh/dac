<?php
    class Payment extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('PaymentModel','Payment');
            $this->load->model('PaymentCardModel','PaymentCard');
            checkLogin('member');
        }

        function index(){
            $data['payment_manage'] = TRUE;
            $data['title']="Payments";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Payment->st_update()) {
                    $this->session->set_flashdata('success', 'Payment status has been update successfully.');
                    redirect(MEMBER.'payment');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Payment->delete()) {
                    $this->session->set_flashdata('success', 'Payment deleted successfully.');
                    redirect(MEMBER.'payment');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "deleteCard"){
                if ($result = $this->PaymentCard->delete()) {
                    $this->session->set_flashdata('success', 'Card deleted successfully.');
                    redirect(MEMBER.'payment');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }

            $where = [];
            $where[] = ['column'=>'p.user_type','op'=>'=','value'=>'customer'];
            $where[] = ['column'=>'p.user_id','op'=>'=','value'=>$this->member->id];
            $content['list'] = $this->Payment->get_list('','',$where);

            $content['listCard'] = $this->PaymentCard->get_list('','');
            $content['title_top'] = "Payments";
            $content['title'] = "Payment";
            $views["content"] = ["path"=>MEMBER.'payment_list',"data"=>$content];
            $layout['page'] = 'payment_list';

            $this->layouts->view($views,'member_dashboard',$layout);
            // $this->load->view(MEMBER.'payment/list',$data);
        }

        function add(){
            $content['title'] = "Payment";
            $views["content"] = ["path"=>MEMBER.'payment_add',"data"=>$content];
            $layout['page'] = 'payment_add';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Payment";
            $content['form_data'] = $form_data = $this->Payment->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>MEMBER.'payment_edit',"data"=>$content];
            $layout['page'] = 'payment_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Payment->create()) {
                $this->session->set_flashdata('success', 'Payment information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Payment->update()) {
                $this->session->set_flashdata('success', 'Payment information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Payment->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

        function addCard(){
            $content['title'] = "Payment Card";
            $views["content"] = ["path"=>MEMBER.'paymentCard_add',"data"=>$content];
            $layout['page'] = 'paymentCard_add';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        function editCard($id = 0){
            $content['title'] = "Payment Card";
            $content['form_data'] = $form_data = $this->PaymentCard->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>MEMBER.'paymentCard_edit',"data"=>$content];
            $layout['page'] = 'paymentCard_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        public function validationCard() {
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

        public function createCard(){
            if ($this->PaymentCard->create()) {
                $this->session->set_flashdata('success', 'Card information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function updateCard(){
            if ($this->PaymentCard->update()) {
                $this->session->set_flashdata('success', 'Card information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

    }
?>