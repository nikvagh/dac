<?php
    class Membership extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MembershipModel','Membership');
            checkLogin('admin');
        }

        function index(){
            $data['membership_manage'] = TRUE;
            $data['title']="Membership";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Membership->st_update()) {
                    $this->session->set_flashdata('success', 'Membership status has been update successfully.');
                    redirect(ADMIN.'membership');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Membership->delete()) {
                    $this->session->set_flashdata('success', 'Membership deleted successfully.');
                    redirect(ADMIN.'membership');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Membership->get_list();
            $content['title'] = "Membership";
            $views["content"] = ["path"=>ADMIN.'membership_list',"data"=>$content];
            $layout['page'] = 'membership_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'membership/list',$data);
        }

        function add(){
            $content['title'] = "Membership";
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'membership_add',"data"=>$content];
            $layout['page'] = 'membership_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Membership";
            $content['form_data'] = $form_data = $this->Membership->getDataById($id);
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'membership_edit',"data"=>$content];
            $layout['page'] = 'membership_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('month', 'Month', 'required|numeric');
            $this->form_validation->set_rules('day', 'Day', 'required|numeric');
            $this->form_validation->set_rules('services[]', 'Services', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Membership->create()) {
                $this->session->set_flashdata('success', 'Membership information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Membership->update()) {
                $this->session->set_flashdata('success', 'Membership information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Membership->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>