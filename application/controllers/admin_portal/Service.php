<?php
    class Service extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('admin');
        }

        function index(){
            $data['service_manage'] = TRUE;
            $data['title']="Service";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->service->st_update()) {
                    $this->session->set_flashdata('success', 'Service status has been update successfully.');
                    redirect(ADMINPATH.'service');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->service->delete()) {
                    $this->session->set_flashdata('success', 'Service deleted successfully.');
                    redirect(ADMINPATH.'service');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['manage_data'] = $this->service->get_services();
            $this->load->view(ADMINPATH.'service/list',$data);
        }

        function add(){ 
            $data['service_form'] = TRUE;
            $data['action']='add';
            $data['title']="Service";
            
            if(isset($_POST['submit'])){
                if ($this->service->insert()) {
                    $this->session->set_flashdata('success', 'Service information has been insert successfully.');
                    redirect(ADMINPATH.'service');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('service');
            }else{
                $this->load->view(ADMINPATH.'service/add',$data); 
            }
        }

        function edit($id = 0){
            $data['service_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service";
            
            if(isset($_POST['submit'])){
                if ($result = $this->service->update()) {
                    $this->session->set_flashdata('success','Service information has been update successfully.');
                    redirect(ADMINPATH.'service');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('service');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->service->getDataById($id);
                $this->load->view(ADMINPATH.'service/edit',$data); 
            }
        }

    }
?>