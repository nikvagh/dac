<?php
    class Register extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(SPPATH.'serviceprovider_model','sprovider');
            $this->load->model(SPPATH.'service_model','service');
            $this->load->library('upload');
        }

        function index(){
            $data['sp_register'] = TRUE;
            $data['action']='add';
            $data['title']="Service Provider";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->sprovider->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();
            
            if(isset($_POST['submit'])){
                if ($this->sprovider->register()) {
                    $this->session->set_flashdata('success', 'Registration Successfully. You Can Login After Drip Auto Care Approval.');
                    redirect(SPPATH.'register');
                }
            }else{
                $this->load->view(SPPATH.'register',$data); 
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