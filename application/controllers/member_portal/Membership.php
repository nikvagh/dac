<?php
    class Membership extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'membership_model','membership');
            // $this->load->model(MEMBERPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('member');
        }

        function index(){
            $data['membership_manage'] = TRUE;
            $data['title']="Membership";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->membership->st_update()) {
                    $this->session->set_flashdata('success', 'Membership status has been update successfully.');
                    redirect(MEMBERPATH.'membership');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->membership->delete()) {
                    $this->session->set_flashdata('success', 'Membership deleted successfully.');
                    redirect(MEMBERPATH.'membership');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['package_data'] = $this->membership->get_membership_active();
            $data['current_plan'] = $this->membership->get_current_plan();

            // echo "<pre>";
            // print_r($data);
            // exit;
                
            $this->load->view(MEMBERPATH.'membership/list',$data);
        }

        function add(){ 
            $data['membership_form'] = TRUE;
            $data['action']='add';
            $data['title']="Membership";
            $data['membership_validity'] = $this->membership->get_membership_validity();
            $data['services'] = $this->service->get_services();
            
            if(isset($_POST['submit'])){
                if ($this->membership->insert()) {
                    $this->session->set_flashdata('success', 'Membership information has been insert successfully.');
                    redirect(MEMBERPATH.'membership');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('membership');
            }else{
                $this->load->view(MEMBERPATH.'membership/add',$data);
            }
        }

        function edit($id = 0){
            $data['membership_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Membership";
            $data['membership_validity'] = $this->membership->get_membership_validity();
            $data['services'] = $this->service->get_services();
            
            if(isset($_POST['submit'])){
                if ($result = $this->membership->update()) {
                    $this->session->set_flashdata('success','Membership information has been update successfully.');
                    redirect(MEMBERPATH.'membership');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('membership');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->membership->getDataById($id);
                $this->load->view(MEMBERPATH.'membership/edit',$data); 
            }
        }

        function purchase($id = 0){
            $data['membership_form'] = TRUE;
            $data['action']="purchase";
            $data['title']="Membership";
            $data['membership_validity'] = $this->membership->get_membership_validity();
            // $data['services'] = $this->service->get_services();
            
            if(isset($_POST['submit'])){
                if ($result = $this->membership->purchase()) {
                    $this->session->set_flashdata('success','Order Placed Successfully.');
                    redirect(MEMBERPATH.'membership');
                }
            }else{
                // echo $this->uri->segment(3);exit;
                $data['pack'] = $this->membership->getDataById($id);
                $this->load->view(MEMBERPATH.'membership/purchase',$data); 
            }
        }

    }
?>