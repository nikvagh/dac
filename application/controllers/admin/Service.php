<?php
    class Service extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ServiceModel','Service');
            $this->load->model('CategoryModel','Category');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Services";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Service->st_update()) {
                    $this->session->set_flashdata('success', 'Service status has been update successfully.');
                    redirect(ADMIN.'service');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Service->delete()) {
                    $this->session->set_flashdata('success', 'Service deleted successfully.');
                    redirect(ADMIN.'service');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Service->get_list();
            $content['title'] = "Services";
            $views["content"] = ["path"=>ADMIN.'service_list',"data"=>$content];
            $layout['page'] = 'service_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title_top'] = "Services";
            $content['title'] = "Service";
            $content['categories'] = $this->Category->get_list();
            $views["content"] = ["path"=>ADMIN.'service_add',"data"=>$content];
            $layout['page'] = 'service_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Services";
            $content['title'] = "Service";
            $content['form_data'] = $this->Service->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'service_edit',"data"=>$content];
            $layout['page'] = 'service_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $this->form_validation->set_rules('duration', 'Duration', 'required|numeric');
            $this->form_validation->set_rules('categories[]', 'Categories', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Service->create()) {
                $this->session->set_flashdata('success', 'Service information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Service->update()) {
                $this->session->set_flashdata('success', 'Service information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Service->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>