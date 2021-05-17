<?php
    class Register extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->library('upload');
        }

        // function index(){
        //     $data['member_register'] = TRUE;
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
        //             $this->load->view(MEMBERPATH.'register',$data);
        //         }else{
        //             if ($this->profile->register()) {
        //                 $this->session->set_flashdata('success', 'Registration Successfully. Login.');
        //                 redirect(MEMBERPATH.'register');
        //             }
        //         }

        //     }else{
        //         $this->load->view(MEMBERPATH.'register',$data); 
        //     }
        // }

        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                redirect(MEMBER.'dashboard','location');
            }else{
                $this->register_form();
            }
        }

        function register_form($data=[]){
            $data1['title'] = "Register";
            $data1['data'] = $data;
            $layout['page'] = 'register';
            $views["form"] = ["path"=>MEMBER.'register_form',"data"=>$data1];
            $views["bottom_link"] = ["path"=>MEMBER.'register_form_bottom_link',"data"=>[]];

            // echo "<pre>";
            // print_r($views);
            // exit;
            $this->layouts->view($views,'member_sign_in_up',$layout);
            // $this->load->view(MEMBER.'login', $data);
        }

        function save($data=[]){
            $this->form_validation->set_rules('username', 'User Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_emailCheckAdd');
            $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('referral_code', 'Referral Code', 'callback_referral_code_check');

            if ($this->form_validation->run()) {
                if($id = $this->Customer->register()){
                    if($this->input->post('staySignedIn')){
                        if($this->member->login('','',$id)){
                            redirect(MEMBER.'dashboard','location');
                        }
                    }else{
                        redirect(MEMBER.'login','location');
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

        function referral_code_check(){
            
            $code = trim($this->input->post('referral_code'));

            if($code != ""){
                $this->db->select('id');
                $this->db->where('refer_code',$code);
                $query1 = $this->db->get('customer');
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
