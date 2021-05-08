<?php
    class Dispatch extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('CategoryModel','Category');
            $this->load->model('ServiceStatusModel','ServiceStatus');
            $this->load->model('ServiceModel','Service');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('ServiceProviderModel','Sp');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Dispatch Job";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Appointment->st_update()) {
                    $this->session->set_flashdata('success', 'Appointment status has been update successfully.');
                    redirect(ADMIN.'dispatch');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Appointment->delete()) {
                    $this->session->set_flashdata('success', 'Appointment deleted successfully.');
                    redirect(ADMIN.'dispatch');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
                
            $where = [['column'=>'status_id','op'=>'=','value'=>1]];
            $content['list'] = $this->Appointment->get_list('','',$where);
            $content['statuses'] = $this->ServiceStatus->get_list();
            $content['title'] = "New Jobs";

            // echo "<pre>";print_r($content);exit;
            $views["content"] = ["path"=>ADMIN.'dispatch_list',"data"=>$content];
            $layout['page'] = 'dispatch_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Dispatch Job";
            $content['categories'] = $this->Category->get_list();
            $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();

            $views["content"] = ["path"=>ADMIN.'dispatch_add',"data"=>$content];
            $layout['page'] = 'dispatch_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Dispatch Job";
            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'dispatch_edit',"data"=>$content];
            $layout['page'] = 'dispatch_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function view($id = 0){
            $content['title'] = "Job";
            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();

            $where = [];
            $content['service_providers'] = $this->Sp->get_list($where);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'dispatch_view',"data"=>$content];
            $layout['page'] = 'dispatch_view';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;

            if($_POST['action'] == "view"){
                echo json_encode(['status'=>200]);
            }else{
                $this->form_validation->set_rules('customer_id', 'Customer', 'required');
                $this->form_validation->set_rules('category_id', 'Category', 'required');
                $this->form_validation->set_rules('sp_id', 'Service Provider', 'required');
                $this->form_validation->set_rules('services[]', 'Services', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('time', 'Time', 'required');
                $this->form_validation->set_rules('status_id', 'Status', 'required');
                if ($this->form_validation->run()) {
                    echo json_encode(['status'=>200]);
                } else {
                    echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
                }
            } 
        }

        public function create(){
            if ($this->Appointment->create()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Appointment->update()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function dispatch_view_update(){
            if ($this->Appointment->dispatch_view_update()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Appointment->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>