<?php
    class ServiceProvider extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ServiceProviderModel','Sp');
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('CoWorkerModel','CoWorker');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Service Provider";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Sp->st_update()) {
                    $this->session->set_flashdata('success', 'Service Provider status has been update successfully.');
                    redirect(ADMIN.'serviceProvider');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Sp->delete()) {
                    $this->session->set_flashdata('success', 'Service Provider deleted successfully.');
                    redirect(ADMIN.'serviceProvider');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Sp->get_list();
            $content['title_top'] = "Service Providers";
            $content['title'] = "Service Provider";
            $views["content"] = ["path"=>ADMIN.'serviceProvider_list',"data"=>$content];
            $layout['page'] = 'serviceProvider_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title_top'] = "Service Providers";
            $content['title'] = "Service Provider";
            $views["content"] = ["path"=>ADMIN.'serviceProvider_add',"data"=>$content];
            $layout['page'] = 'serviceProvider_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Service Providers";
            $content['title'] = "Service Provider";
            $content['form_data'] = $this->Sp->getDataById($id);

            // print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'serviceProvider_edit',"data"=>$content];
            $layout['page'] = 'serviceProvider_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function view($id = 0){
            $content['title_top'] = "Service Providers";
            $content['title'] = "Service Provider";
            $content['form_data'] = $this->Sp->getDataById($id);

            $where = [['column'=>'sp.sp_id','op'=>'=','value'=>$id]];
            $content['form_data']->CoWorkers = $this->CoWorker->get_list('','',$where);
            
            $content['totalJobAssigned'] = $this->Appointment->getTotalCount($id);
            $content['totalJobSuccess'] = $this->Appointment->getTotalSuccessCount($id);
            $content['totalJobInProgress'] = $this->Appointment->getTotalInProgressCount($id);

            // echo "<pre>"; print_r($content['form_data']);
            // exit;

            $views["content"] = ["path"=>ADMIN.'serviceProvider_view',"data"=>$content];
            $layout['page'] = 'serviceProvider_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function appointmentList($type,$sp_id){
            $this->session->unset_userdata('serviceProvider_ap_f');
            $this->session->unset_userdata('status_ap_f');
            if($type == 'totalJobAssigned'){
                $this->session->set_userdata('serviceProvider_ap_f', $sp_id);
            }
            if($type == 'totalJobSuccess'){
                $this->session->set_userdata('serviceProvider_ap_f', $sp_id);
                $this->session->set_userdata('status_ap_f',5);
            }
            if($type == 'totalJobInProgress'){
                $this->session->set_userdata('serviceProvider_ap_f', $sp_id);
                $this->session->set_userdata('status_ap_f',4);
            }
            redirect(ADMIN.'appointment');
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone_day', 'Phone', 'required');
            $this->form_validation->set_rules('EIN', 'EIN', 'required');
            
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Sp->create()) {
                $this->session->set_flashdata('success', 'Service Provider information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Sp->update()) {
                $this->session->set_flashdata('success', 'Service Provider information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Sp->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>