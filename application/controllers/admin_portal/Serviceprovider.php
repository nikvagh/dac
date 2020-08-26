<?php
    class Serviceprovider extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'serviceprovider_model','sprovider');
            $this->load->model(ADMINPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('admin');
        }

        function index(){
            $data['serviceprovider_manage'] = TRUE;
            $data['title']="Service Provider";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->sprovider->st_update()) {
                    $this->session->set_flashdata('success', 'Service Provider status has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->sprovider->delete()) {
                    $this->session->set_flashdata('success', 'Service Provider deleted successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['manage_data'] = $this->sprovider->get_sps();
            $this->load->view(ADMINPATH.'sp/list',$data);
        }

        function add(){ 
            $data['sp_form'] = TRUE;
            $data['action']='add';
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();
            
            
            if(isset($_POST['submit'])){
                if ($this->sprovider->insert()) {
                    $this->session->set_flashdata('success', 'Service Provider information has been insert successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //     redirect('sp');
            }else{
                $this->load->view(ADMINPATH.'sp/add',$data); 
            }
        }

        function edit($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();

            $data['vehicle_selected'] = $this->sprovider->get_selected_vehicles($id);
            $data['industry_reference_seleted'] = $this->sprovider->get_selected_industry_reference($id);
            $data['employee_seleted'] = $this->sprovider->get_selected_employee($id);
            $data['certificate_seleted'] = $this->sprovider->get_selected_certificate($id);
            
            if(isset($_POST['submit'])){
                if ($result = $this->sprovider->update()) {
                    $this->session->set_flashdata('success','Service Provider information has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->sprovider->getDataById($id);
                $this->load->view(ADMINPATH.'sp/edit',$data); 
            }
        }

        function view($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();

            $data['vehicle_selected'] = $this->sprovider->get_selected_vehicles($id);
            $data['industry_reference_seleted'] = $this->sprovider->get_selected_industry_reference($id);
            $data['employee_seleted'] = $this->sprovider->get_selected_employee($id);
            $data['certificate_seleted'] = $this->sprovider->get_selected_certificate($id);
            
            if(isset($_POST['submit'])){
                if ($result = $this->sprovider->update()) {
                    $this->session->set_flashdata('success','Service Provider information has been update successfully.');
                    redirect(ADMINPATH.'serviceprovider');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->sprovider->getDataById($id);
                $this->load->view(ADMINPATH.'sp/view',$data); 
            }
        }

        function document($id = 0){
            $data['sp_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Provider Documents";

            $data['documents'] = $this->sprovider->getDocumentBySpId($id);
            
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                if ($result = $this->sprovider->document_save()) {
                    $this->session->set_flashdata('success','Document Details Saved successfully.');
                    redirect(ADMINPATH.'serviceprovider/document/'.$id);
                }else{
                    $this->session->set_flashdata('error','Document Not Upload. Please Try Again.');
                    redirect(ADMINPATH.'serviceprovider/document/'.$id);
                }
            }elseif(isset($_POST['delete'])){
                $id = $_POST['id'];
                if ($result = $this->sprovider->document_delete()) {
                    $this->session->set_flashdata('success','Document Details Saved successfully.');
                    redirect(ADMINPATH.'serviceprovider/document/'.$id);
                }else{
                    $this->session->set_flashdata('error','Document Not Delete. Please Try Again.');
                    redirect(ADMINPATH.'serviceprovider/document/'.$id);
                }
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->sprovider->getDataById($id);
                $this->load->view(ADMINPATH.'sp/document',$data); 
            }
        }

        function emailCheck_add(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query1 = $this->db->get('admin');
            if ($query1->num_rows() > 0) {
                $err++;
            }
        
            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query2 = $this->db->get('member');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query3 = $this->db->get('sp');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }

        function usernameCheck_add(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query1 = $this->db->get('admin');
            if ($query1->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query2 = $this->db->get('member');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query3 = $this->db->get('sp');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }

        function emailCheck_edit(){
            $err = 0;

            // echo "<pre>";
            // print_r($_POST);

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $this->db->where('sp_id !=',$this->input->post('id'));
            $query1 = $this->db->get('sp');
            if ($query1->num_rows() > 0) {
                $err++;
            }
        
            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query2 = $this->db->get('member');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query3 = $this->db->get('admin');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }

        function usernameCheck_edit(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $this->db->where('sp_id !=',$this->input->post('id'));
            $query1 = $this->db->get('sp');
            if ($query1->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query2 = $this->db->get('member');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query3 = $this->db->get('admin');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }


    }
?>