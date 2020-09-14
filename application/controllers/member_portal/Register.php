<?php
    class Register extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'profile_model','profile');
            $this->load->library('upload');
        }

        function index(){
            $data['member_register'] = TRUE;
            $data['action']='add';
            $data['title']="";
            
            if(isset($_POST['submit'])){

                $config = [
                    [
                            'field' => 'refer_code',
                            'label' => 'Name',
                            'rules' => 'callback_referral_code_check',
                            'errors' => [
                                    // 'required' => 'Amount is required fields',
                            ],
                    ]
                ];
                $this->form_validation->set_data($_POST);
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE)
                {
                    $this->form_validation->set_error_delimiters('<em class="invalid">', '</em>');
                    $this->load->view(MEMBERPATH.'register',$data);
                }else{
                    if ($this->profile->register()) {
                        $this->session->set_flashdata('success', 'Registration Successfully. Login.');
                        redirect(MEMBERPATH.'register');
                    }
                }

            }else{
                $this->load->view(MEMBERPATH.'register',$data); 
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

        function referral_code_check(){
            
            $code = trim($this->input->post('refer_code'));

            if($code != ""){
                $this->db->select('member_id');
                $this->db->where('refer_code',$this->input->post('refer_code'));
                $query1 = $this->db->get('member');
                if ($query1->num_rows() > 0) {
                    return true;
                }else{
                    $this->form_validation->set_message('referral_code_check', 'Invalid Referral Code');
                    return false;
                }
            }else{
                return true;
            }

        }

    }
