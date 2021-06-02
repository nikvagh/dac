<?php
    class Payment extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('PaymentModel','Payment');
            $this->load->model('ServiceModel','Service');
            checkLogin('admin');
        }

        function index(){
            $data['payment_manage'] = TRUE;
            $data['title']="Payments";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Payment->st_update()) {
                    $this->session->set_flashdata('success', 'Payment status has been update successfully.');
                    redirect(ADMIN.'payment');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Payment->delete()) {
                    $this->session->set_flashdata('success', 'Payment deleted successfully.');
                    redirect(ADMIN.'payment');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Payment->get_list();
            $content['title'] = "Payments";
            $views["content"] = ["path"=>ADMIN.'payment_list',"data"=>$content];
            $layout['page'] = 'payment_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'payment/list',$data);
        }

        function add(){
            $content['title'] = "Payments";
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'payment_add',"data"=>$content];
            $layout['page'] = 'payment_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Payments";
            $content['form_data'] = $form_data = $this->Payment->getDataById($id);
            $content['validity'] = payment_validity_converter($form_data->validity);
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'payment_edit',"data"=>$content];
            $layout['page'] = 'payment_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('month', 'Month', 'required|numeric');
            $this->form_validation->set_rules('day', 'Day', 'required|numeric');
            $this->form_validation->set_rules('services[]', 'Services', 'required');
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

    }
?>