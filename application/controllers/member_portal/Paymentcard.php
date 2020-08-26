<?php
    class Paymentcard extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'paymentcard_model','paymentcard');
            // $this->load->model(MEMBERPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('member');
        }

        function index(){
            $data['paymentcard_manage'] = TRUE;
            $data['title']="Payment";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->paymentcard->st_update()) {
                    $this->session->set_flashdata('success', 'Payment status has been update successfully.');
                    redirect(MEMBERPATH.'payment');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->paymentcard->delete()) {
                    $this->session->set_flashdata('success', 'Payment details deleted successfully.');
                    redirect(MEMBERPATH.'paymentcard');
                }
            }
            $data['manage_data'] = $this->paymentcard->get_lists();
            $this->load->view(MEMBERPATH.'paymentcard/list',$data);
        }

        function add(){ 
            $data['payment_form'] = TRUE;
            $data['action']='add';
            $data['title']="Payment";
            
            if(isset($_POST['submit'])){
                if ($this->paymentcard->insert()) {
                    $this->session->set_flashdata('success', 'Payment information has been insert successfully.');
                    redirect(MEMBERPATH.'paymentcard');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('sp');
            }else{
                $this->load->view(MEMBERPATH.'paymentcard/add',$data); 
            }
        }

        function edit($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Payment";
            
            if(isset($_POST['submit'])){
                if ($result = $this->paymentcard->update()) {
                    $this->session->set_flashdata('success','Payment information has been update successfully.');
                    redirect(MEMBERPATH.'paymentcard');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->paymentcard->getDataById($id);
                $this->load->view(MEMBERPATH.'paymentcard/edit',$data); 
            }
        }

        function view($id = 0){
            $data['payment_view'] = TRUE;
            $data['action']="edit";
            $data['title']="Payment History";
            $data['payment_validity'] = $this->membership->get_membership_validity();
            $data['services'] = $this->service->get_services();
            
            if(isset($_POST['submit'])){
                if ($result = $this->payment->update()) {
                    $this->session->set_flashdata('success','Payment History information has been update successfully.');
                    redirect(MEMBERPATH.'payment');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('payment');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->payment->getDataById($id);
                $this->load->view(MEMBERPATH.'payment/view',$data); 
            }
        }

    }
?>