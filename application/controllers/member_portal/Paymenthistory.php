<?php
    class Paymenthistory extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'paymenthistory_model','paymenthistory');
            // $this->load->model(MEMBERPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('member');
        }

        function index(){
            $data['paymenthistory_manage'] = TRUE;
            $data['title']="Payment History";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->paymenthistory->st_update()) {
                    $this->session->set_flashdata('success', 'Payment history status has been update successfully.');
                    redirect(MEMBERPATH.'paymenthistory');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->paymenthistory->delete()) {
                    $this->session->set_flashdata('success', 'Payment History deleted successfully.');
                    redirect(MEMBERPATH.'paymenthistory');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->paymenthistory->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('paymenthistory');
            //     }
            // }
            
            $data['membership_payment'] = $this->paymenthistory->get_membership_payment();
            $data['service_payment'] = $this->paymenthistory->get_service_payment();
            $this->load->view(MEMBERPATH.'paymenthistory/list',$data);
        }

        function view($id = 0){
            $data['paymenthistory_view'] = TRUE;
            $data['action']="edit";
            $data['title']="Payment History";
            $data['paymenthistory_validity'] = $this->membership->get_membership_validity();
            $data['services'] = $this->service->get_services();
            
            if(isset($_POST['submit'])){
                if ($result = $this->paymenthistory->update()) {
                    $this->session->set_flashdata('success','Payment History information has been update successfully.');
                    redirect(MEMBERPATH.'paymenthistory');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('paymenthistory');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->paymenthistory->getDataById($id);
                $this->load->view(MEMBERPATH.'paymenthistory/view',$data); 
            }
        }

    }
?>