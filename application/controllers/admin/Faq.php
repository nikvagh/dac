<?php
    class Faq extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('FaqModel','Faq');
            checkLogin('admin');
        }

        function index(){
            $data['title'] = "Manage FAQ's";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Faq->st_update()) {
                    $this->session->set_flashdata('success', 'Faq status has been update successfully.');
                    redirect(ADMIN.'faq');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Faq->delete()) {
                    $this->session->set_flashdata('success', 'Faq deleted successfully.');
                    redirect(ADMIN.'faq');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Faq->get_list();
            $content['title_top'] = "Manage FAQ's";
            $content['title'] = "Manage FAQ's";
            $views["content"] = ["path"=>ADMIN.'faq_list',"data"=>$content];
            $layout['page'] = 'faq_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title_top'] = "Manage FAQ's";
            $content['title'] = "FAQ";
            $views["content"] = ["path"=>ADMIN.'faq_add',"data"=>$content];
            $layout['page'] = 'faq_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Manage FAQ's";
            $content['title'] = "FAQ";
            $content['form_data'] = $this->Faq->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'faq_edit',"data"=>$content];
            $layout['page'] = 'faq_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('question', 'Question', 'required');
            $this->form_validation->set_rules('answer', 'Answer', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {;
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Faq->create()) {
                $this->session->set_flashdata('success', 'Faq information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Faq->update()) {
                $this->session->set_flashdata('success', 'Faq information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Faq->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>