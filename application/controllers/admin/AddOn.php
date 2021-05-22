<?php
    class AddOn extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AddOnModel','AddOn');
            $this->load->model('ServiceModel','Service');
            checkLogin('admin');
        }

        function index(){
            $data['addOn_manage'] = TRUE;
            $data['title']="AddOn";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->AddOn->st_update()) {
                    $this->session->set_flashdata('success', 'AddOn status has been update successfully.');
                    redirect(ADMIN.'addOn');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->AddOn->delete()) {
                    $this->session->set_flashdata('success', 'AddOn deleted successfully.');
                    redirect(ADMIN.'addOn');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->AddOn->get_list();
            $content['title'] = "AddOn";
            $views["content"] = ["path"=>ADMIN.'addOn_list',"data"=>$content];
            $layout['page'] = 'addOn_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'addOn/list',$data);
        }

        function add(){
            $content['title'] = "AddOn";
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'addOn_add',"data"=>$content];
            $layout['page'] = 'addOn_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "AddOn";
            $content['form_data'] = $form_data = $this->AddOn->getDataById($id);
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'addOn_edit',"data"=>$content];
            $layout['page'] = 'addOn_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->AddOn->create()) {
                $this->session->set_flashdata('success', 'AddOn information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->AddOn->update()) {
                $this->session->set_flashdata('success', 'AddOn information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->AddOn->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>