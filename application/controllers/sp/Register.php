<?php
    class Register extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ServiceProviderModel','ServiceProvider');
            $this->load->library('upload');
        }

        // function index(){
        //     $data['sp_register'] = TRUE;
        //     $data['action'] = 'add';
        //     $data['title'] = "";
            
        //     if(isset($_POST['submit'])){

        //         $config = [
        //             [
        //                     'field' => 'refer_code',
        //                     'label' => 'Name',
        //                     'rules' => 'callback_referral_code_check',
        //                     'errors' => [
        //                             // 'required' => 'Amount is required fields',
        //                     ],
        //             ]
        //         ];
        //         $this->form_validation->set_data($_POST);
        //         $this->form_validation->set_rules($config);

        //         if ($this->form_validation->run() == FALSE)
        //         {
        //             $this->form_validation->set_error_delimiters('<em class="invalid">', '</em>');
        //             $this->load->view(SPPATH.'register',$data);
        //         }else{
        //             if ($this->profile->register()) {
        //                 $this->session->set_flashdata('success', 'Registration Successfully. Login.');
        //                 redirect(SPPATH.'register');
        //             }
        //         }

        //     }else{
        //         $this->load->view(SPPATH.'register',$data); 
        //     }
        // }

        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "sp")
            {
                redirect(SP.'dashboard','location');
            }else{
                $this->register_form();
            }
        }

        function refer($refer_code=""){
            $data['form_data']['referral_code'] = $refer_code;
            $this->register_form($data);
        }

        function register_form($data=[]){
            $data1['title'] = "Register";
            $data1['data'] = $data;
            $layout['page'] = 'register';
            $views["form"] = ["path"=>SP.'register_form',"data"=>$data1];
            $views["bottom_link"] = ["path"=>SP.'register_form_bottom_link',"data"=>[]];

            // echo "<pre>";
            // print_r($views);
            // exit;
            $this->layouts->view($views,'sp_sign_in_up',$layout);
            // $this->load->view(SP.'login', $data);
        }

        function save($data=[]){
            $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_emailCheckAdd');
            $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('EIN', 'EIN', 'required');

            if ($this->form_validation->run()) {
                if($id = $this->ServiceProvider->register()){
                    if($this->input->post('staySignedIn')){
                        if($this->sp->login('','',$id)){
                            redirect(SP.'dashboard','location');
                        }
                    }else{
                        redirect(SP.'login','location');
                    }
                }
            } else {
                $data = ['form_data'=>$_POST,'validation'=>$this->form_validation->error_array()];
                $this->register_form($data);
            }
        }

        function emailCheckAdd(){
            $email = trim($this->input->post('email'));
            $this->db->select('id');
            $this->db->where('email',$email);
            $query1 = $this->db->get('customer');
            if ($query1->num_rows() > 0) {
                $this->form_validation->set_message('emailCheckAdd', 'Email already exist');
                return false;
            }else{
                return true;
            }
        }

        function userNameCheckAdd(){
            $email = trim($this->input->post('username'));
            $this->db->select('id');
            $this->db->where('username',$email);
            $query1 = $this->db->get('customer');
            if ($query1->num_rows() > 0) {
                $this->form_validation->set_message('userNameCheckAdd', 'User Name already exist');
                return false;
            }else{
                return true;
            }
        }

        function phoneCheckAdd(){
            $email = trim($this->input->post('phone'));
            $this->db->select('id');
            $this->db->where('phone',$email);
            $query1 = $this->db->get('customer');
            if ($query1->num_rows() > 0) {
                $this->form_validation->set_message('phoneCheckAdd', 'Phone already exist');
                return false;
            }else{
                return true;
            }
        }

    }
