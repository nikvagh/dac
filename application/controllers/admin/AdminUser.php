<?php
    class AdminUser extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AdminUserModel','AdminUser');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Admin";
            if($this->input->post('action') == "change_publish"){
                if ($result = $this->AdminUser->st_update()) {
                    $this->session->set_flashdata('success', 'Admin status has been update successfully.');
                    redirect(ADMIN.'adminUser');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->AdminUser->delete()) {
                    $this->session->set_flashdata('success', 'Admin deleted successfully.');
                    redirect(ADMIN.'adminUser');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->AdminUser->get_list();
            $content['title'] = "Admin";
            $views["content"] = ["path"=>ADMIN.'adminUser_list',"data"=>$content];
            $layout['page'] = 'adminUser_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Admin";
            $views["content"] = ["path"=>ADMIN.'adminUser_add',"data"=>$content];
            $layout['page'] = 'adminUser_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Admin";
            $content['form_data'] = $this->AdminUser->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'adminUser_edit',"data"=>$content];
            $layout['page'] = 'adminUser_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if($_POST['action'] == 'add'){
                $this->form_validation->set_rules('password', 'Password', 'required');
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
            if ($this->AdminUser->create()) {
                $this->session->set_flashdata('success', 'Admin information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->AdminUser->update()) {
                $this->session->set_flashdata('success', 'Admin information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->AdminUser->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>