<?php
    class Role extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('RoleModel','Role');
            $this->load->model('PermissionModel','Permission');
            checkLogin('admin');
        }

        function index(){
            $data['title'] = "Role";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Role->st_update()) {
                    $this->session->set_flashdata('success', 'Role status has been update successfully.');
                    redirect(ADMIN.'role');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Role->delete()) {
                    $this->session->set_flashdata('success', 'Role deleted successfully.');
                    redirect(ADMIN.'role');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Role->get_list();
            $content['title'] = "Role";

            // echo "<pre>";
            // print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'role_list',"data"=>$content];
            $layout['page'] = 'role_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Role";
            $content['permissions'] = $this->Permission->get_list();
            $views["content"] = ["path"=>ADMIN.'role_add',"data"=>$content];
            $layout['page'] = 'role_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Role";
            $content['form_data'] = $this->Role->getDataById($id);
            $content['permissions'] = $this->Permission->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'role_edit',"data"=>$content];
            $layout['page'] = 'role_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Role->create()) {
                $this->session->set_flashdata('success', 'Role information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Role->update()) {
                $this->session->set_flashdata('success', 'Role information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Role->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>