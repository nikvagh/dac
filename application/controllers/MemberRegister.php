<?php
    class MemberRegister extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->library('upload');
        }

        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                redirect('memberAccount','location');
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
            $data1['page'] = 'register';

            // $views["form"] = ["path"=>FRONT.'register_form',"data"=>$data1];
            // $views["bottom_link"] = ["path"=>FRONT.'register_form_bottom_link',"data"=>[]];

            // echo "<pre>";
            // print_r($views);
            // exit;
            // $this->layouts->view($views,'member_sign_in_up',$layout);
            // $this->load->view(FRONT.'login', $data);
            
            $this->load->view(FRONT.'memberRegister',$data1);
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
                            redirect('memberAccount','location');
                        }
                    }else{
                        redirect('memberLogin','location');
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
