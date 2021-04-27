<?php
    class Customer extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->model('CategoryModel','Category');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Customer";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Customer->st_update()) {
                    $this->session->set_flashdata('success', 'Customer status has been update successfully.');
                    redirect(ADMIN.'customer');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Customer->delete()) {
                    $this->session->set_flashdata('success', 'Customer deleted successfully.');
                    redirect(ADMIN.'customer');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Customer->get_list();
            $content['title'] = "Customer";
            $views["content"] = ["path"=>ADMIN.'customer_list',"data"=>$content];
            $layout['page'] = 'customer_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Customer";
            $content['categories'] = $this->Category->get_list();
            $views["content"] = ["path"=>ADMIN.'customer_add',"data"=>$content];
            $layout['page'] = 'customer_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Customer";
            $content['form_data'] = $this->Customer->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'customer_edit',"data"=>$content];
            $layout['page'] = 'customer_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
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
            if ($this->Customer->create()) {
                $this->session->set_flashdata('success', 'Customer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Customer->update()) {
                $this->session->set_flashdata('success', 'Customer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Customer->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>