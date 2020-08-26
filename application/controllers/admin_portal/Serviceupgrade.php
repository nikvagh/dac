<?php
    class Serviceupgrade extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'serviceupgrade_model','serviceupgrade');
            $this->load->library('upload');
            checkLogin('admin');
        }

        function index(){
            $data['serviceupgrade_manage'] = TRUE;
            $data['title']="Service Upgrade";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->serviceupgrade->st_update()) {
                    $this->session->set_flashdata('success', 'Service status has been update successfully.');
                    redirect(ADMINPATH.'serviceupgrade');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->serviceupgrade->delete()) {
                    $this->session->set_flashdata('success', 'Service deleted successfully.');
                    redirect(ADMINPATH.'serviceupgrade');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['manage_data'] = $this->serviceupgrade->get_serviceupgrades();
            $this->load->view(ADMINPATH.'serviceupgrade/list',$data);
        }

        function add(){ 
            $data['serviceupgrade_form'] = TRUE;
            $data['action']='add';
            $data['title']="Service Upgrade";
            
            if(isset($_POST['submit'])){
                if ($this->serviceupgrade->insert()) {
                    $this->session->set_flashdata('success', 'Service information has been insert successfully.');
                    redirect(ADMINPATH.'serviceupgrade');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('serviceupgrade');
            }else{
                $this->load->view(ADMINPATH.'serviceupgrade/add',$data); 
            }
        }

        function edit($id = 0){
            $data['serviceupgrade_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Upgrade";
            
            if(isset($_POST['submit'])){
                if ($result = $this->serviceupgrade->update()) {
                    $this->session->set_flashdata('success','Service information has been update successfully.');
                    redirect(ADMINPATH.'serviceupgrade');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('serviceupgrade');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->serviceupgrade->getDataById($id);
                $this->load->view(ADMINPATH.'serviceupgrade/edit',$data); 
            }
        }

    }
?>