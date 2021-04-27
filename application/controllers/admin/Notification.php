<?php
    class Notification extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('NotificationModel','Notification');
            $this->load->model('CategoryModel','Category');
            $this->load->model('CustomerModel','Customer');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Notification";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Notification->st_update()) {
                    $this->session->set_flashdata('success', 'Notification status has been update successfully.');
                    redirect(ADMIN.'notification');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Notification->delete()) {
                    $this->session->set_flashdata('success', 'Notification deleted successfully.');
                    redirect(ADMIN.'notification');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Notification->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['title'] = "Notification";
            $views["content"] = ["path"=>ADMIN.'notification_add',"data"=>$content];
            $layout['page'] = 'notification_add';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Notification";
            $content['categories'] = $this->Category->get_list();
            $views["content"] = ["path"=>ADMIN.'notification_add',"data"=>$content];
            $layout['page'] = 'notification_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Notification";
            $content['form_data'] = $this->Notification->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'notification_edit',"data"=>$content];
            $layout['page'] = 'notification_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('customers[]', 'Customers', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Notification->create()) {
                $this->session->set_flashdata('success', 'Notification Sent successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Notification->update()) {
                $this->session->set_flashdata('success', 'Notification information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Notification->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>