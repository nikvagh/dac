<?php
    class Category extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('CategoryModel','Category');
            checkLogin('admin');
        }

        function index(){
            $data['category_manage'] = TRUE;
            $data['title']="Category";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Category->st_update()) {
                    $this->session->set_flashdata('success', 'Category status has been update successfully.');
                    redirect(ADMIN.'category');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Category->delete()) {
                    $this->session->set_flashdata('success', 'Category deleted successfully.');
                    redirect(ADMIN.'category');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Category->get_list();
            $content['title'] = "Category";
            $views["content"] = ["path"=>ADMIN.'category_list',"data"=>$content];
            $layout['page'] = 'category_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Category";
            $views["content"] = ["path"=>ADMIN.'category_add',"data"=>$content];
            $layout['page'] = 'category_add';
            
            // if(isset($_POST['submit'])){
            //     if ($this->Category->insert()) {
            //         $this->session->set_flashdata('success', 'Category information has been saved successfully.');
            //         redirect(ADMIN.'category');
            //     }
            //     // }elseif($this->input->post('cancel')){
            //     //     redirect('category');
            // }else{
                // $this->load->view(ADMIN.'category/add',$data); 
                $this->layouts->view($views,'admin_dashboard',$layout);
            // }
        }

        function edit($id = 0){
            $content['title'] = "Category";
            $content['form_data'] = $this->Category->getDataById($id);

            // print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'category_edit',"data"=>$content];
            $layout['page'] = 'category_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // exit;
            // $this->form_validation->set_data($_POST);
            $this->form_validation->set_rules('category_name', 'Category Name', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Category->create()) {
                $this->session->set_flashdata('success', 'Category information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Category->update()) {
                $this->session->set_flashdata('success', 'Category information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Category->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>