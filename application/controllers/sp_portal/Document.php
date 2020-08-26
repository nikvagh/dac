<?php
    class Document extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(SPPATH.'document_model','document');
            $this->load->library('upload');
            checkLogin('sp');
        }

        // function index(){
        //     $data['serviceprovider_manage'] = TRUE;
        //     $data['title']="Service Provider";

        //     if($this->input->post('action') == "change_publish"){
        //         if ($result = $this->sprovider->st_update()) {
        //             $this->session->set_flashdata('success', 'Service Provider status has been update successfully.');
        //             redirect(SPPATH.'serviceprovider');
        //         }
        //     }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
        //         if ($result = $this->sprovider->delete()) {
        //             $this->session->set_flashdata('success', 'Service Provider deleted successfully.');
        //             redirect(SPPATH.'serviceprovider');
        //         }
        //     }
        //     // elseif ($this->input->post('action') == "deleteselected") {
        //     //     if ($result = $this->membership->deleteselected()) {
        //     //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
        //     //         redirect('membership');
        //     //     }
        //     // }
            
        //     $data['manage_data'] = $this->sprovider->get_sps();
        //     $this->load->view(SPPATH.'sp/list',$data);
        // }

        // function add(){ 
        //     $data['sp_form'] = TRUE;
        //     $data['action']='add';
        //     $data['title']="Service Provider";
            
        //     if(isset($_POST['submit'])){
        //         if ($this->sprovider->insert()) {
        //             $this->session->set_flashdata('success', 'Service Provider information has been insert successfully.');
        //             redirect(SPPATH.'serviceprovider');
        //         }
        //     // }elseif($this->input->post('cancel')){
        //     //     redirect('sp');
        //     }else{
        //         $this->load->view(SPPATH.'sp/add',$data); 
        //     }
        // }

        // function edit($id = 0){
        //     $data['sp_form'] = TRUE;
        //     $data['action']="edit";
        //     $data['title']="Service Provider";
            
        //     if(isset($_POST['submit'])){
        //         if ($result = $this->sprovider->update()) {
        //             $this->session->set_flashdata('success','Service Provider information has been update successfully.');
        //             redirect(SPPATH.'serviceprovider');
        //         }
        //     // }elseif($this->input->post('cancel')){
        //     //         redirect('sp');
        //     }else{
        //         // echo $this->uri->segment(3);exit;
        //         $data['form_data'] = $this->sprovider->getDataById($id);
        //         $this->load->view(SPPATH.'sp/edit',$data); 
        //     }
        // }

        function document($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Documents";
            $data['documents'] = $this->document->getDocumentBySpId();
            
            if(isset($_POST['submit'])){
                if ($result = $this->document->document_save()) {
                    $this->session->set_flashdata('success','Document Details Saved successfully.');
                    redirect(SPPATH.'document/document');
                }else{
                    $this->session->set_flashdata('error','Document Not Upload. Please Try Again.');
                    redirect(SPPATH.'document/document');
                }
            }elseif(isset($_POST['delete'])){
                if ($result = $this->document->document_delete()) {
                    $this->session->set_flashdata('success','Document Details Saved successfully.');
                    redirect(SPPATH.'document/document');
                }else{
                    $this->session->set_flashdata('error','Document Not Delete. Please Try Again.');
                    redirect(SPPATH.'document/document');
                }
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->document->getDataById();
                $this->load->view(SPPATH.'document/document',$data); 
            }
        }

        function coi($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Certificate Of Insurance";
            $data['cois'] = $this->document->getCoiBySpId();
            
            if(isset($_POST['submit'])){
                if ($result = $this->document->coi_save()) {
                    $this->session->set_flashdata('success','Certificate Details Saved successfully.');
                    redirect(SPPATH.'document/coi');
                }else{
                    $this->session->set_flashdata('error','Certificate Not Upload. Please Try Again.');
                    redirect(SPPATH.'document/coi');
                }
            }elseif(isset($_POST['delete'])){
                if ($result = $this->document->coi_delete()) {
                    $this->session->set_flashdata('success','Certificate Details Saved successfully.');
                    redirect(SPPATH.'document/coi');
                }else{
                    $this->session->set_flashdata('error','Certificate Not Delete. Please Try Again.');
                    redirect(SPPATH.'document/coi');
                }
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->document->getDataById();
                $this->load->view(SPPATH.'document/coi',$data); 
            }
        }


    }
?>