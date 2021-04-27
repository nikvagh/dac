<?php
    class NotificationTemplate extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('NotificationTemplateModel','Nt');
            // $this->load->model('CategoryModel','Category');
            checkLogin('admin');
        }

        function index(){
            $data['title'] = "Notification Template";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Nt->st_update()) {
                    $this->session->set_flashdata('success', 'Notification Template status has been update successfully.');
                    redirect(ADMIN.'notificationTemplate');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Nt->delete()) {
                    $this->session->set_flashdata('success', 'Notification Template deleted successfully.');
                    redirect(ADMIN.'notificationTemplate');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Nt->get_list();
            $content['title'] = "Notification Template";
            if(isset($_GET['tab'])){
                $content['tab'] = $_GET['tab'];
            }else{
                $content['tab'] = 'UserAppointmentBook';
            }

            // echo "<pre>";print_r($content); exit;
            $views["content"] = ["path"=>ADMIN.'notificationTemplate_list',"data"=>$content];
            $layout['page'] = 'notificationTemplate_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Notification Template";
            $views["content"] = ["path"=>ADMIN.'notificationTemplate_add',"data"=>$content];
            $layout['page'] = 'notificationTemplate_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Notification Template";
            $content['form_data'] = $this->Nt->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'notificationTemplate_edit',"data"=>$content];
            $layout['page'] = 'notificationTemplate_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('title', 'Title', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Nt->create()) {
                $this->session->set_flashdata('success', 'Notification Template information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            // echo "<pre>";print_r($_POST);exit;
            if ($this->Nt->update()) {
                $this->session->set_flashdata('success', 'Notification Template information has been saved successfully.');
                echo json_encode(['status'=>200,'result'=>['tab'=>$this->input->post('heading_code')]]);
            }
        }

        public function delete(){
            if ($this->Nt->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>