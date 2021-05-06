<?php
    class Zipcode extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ZipcodeModel','Zipcode');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Zipcode";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Zipcode->st_update()) {
                    $this->session->set_flashdata('success', 'Zipcode status has been update successfully.');
                    redirect(ADMIN.'zipcode');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Zipcode->delete()) {
                    $this->session->set_flashdata('success', 'Zipcode deleted successfully.');
                    redirect(ADMIN.'zipcode');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Zipcode->get_list();
            $content['title'] = "Zipcode";
            $views["content"] = ["path"=>ADMIN.'zipcode_list',"data"=>$content];
            $layout['page'] = 'zipcode_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Zipcode";
            $content['categories'] = $this->Category->get_list();
            $views["content"] = ["path"=>ADMIN.'zipcode_add',"data"=>$content];
            $layout['page'] = 'zipcode_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Zipcode";
            $content['form_data'] = $this->Zipcode->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'zipcode_edit',"data"=>$content];
            $layout['page'] = 'zipcode_edit';
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
            if ($this->Zipcode->create()) {
                $this->session->set_flashdata('success', 'Zipcode information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Zipcode->update()) {
                $this->session->set_flashdata('success', 'Zipcode information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Zipcode->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

        public function get_list_dropdown($val = ""){
            // echo "<pre>";print_r($_POST);exit;

            $result = [];
            if(isset($_POST['search'])){
                $where = array(["column"=>"zipcode","op"=>"like","value"=>'%'.$_POST['search'].'%']);
                $resultAll = $this->Zipcode->get_list('','',$where);
            }

            foreach($resultAll as $key=>$val){
                $result[] = ["text"=>$val->zipcode,"id"=>$val->zipcode];
            }
            // echo "<pre>";print_r($zip_codes);exit;

            echo json_encode(['result'=>$result]);
        }

    }
?>