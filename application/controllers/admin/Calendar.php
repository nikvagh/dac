<?php
    class Calendar extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AppointmentModel','Appointment');
            checkLogin('admin');
        }

        function index(){

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Offer->st_update()) {
                    $this->session->set_flashdata('success', 'Offer status has been update successfully.');
                    redirect(ADMIN.'offer');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Offer->delete()) {
                    $this->session->set_flashdata('success', 'Offer deleted successfully.');
                    redirect(ADMIN.'offer');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            // $content['list'] = $this->Offer->get_list();
            $content['title'] = "Calendar";
            $views["content"] = ["path"=>ADMIN.'calendar_list',"data"=>$content];
            $layout['page'] = 'calendar_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Offer";
            $content['categories'] = $this->Category->get_list();
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'offer_add',"data"=>$content];
            $layout['page'] = 'offer_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Offer";
            $content['form_data'] = $this->Offer->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'offer_edit',"data"=>$content];
            $layout['page'] = 'offer_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('discount', 'Discount', 'required|numeric|less_than_equal_to[100]');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'required');
            $this->form_validation->set_rules('categories[]', 'Categories', 'required');
            $this->form_validation->set_rules('services[]', 'Services', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Offer->create()) {
                $this->session->set_flashdata('success', 'Offer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Offer->update()) {
                $this->session->set_flashdata('success', 'Offer information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Offer->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>