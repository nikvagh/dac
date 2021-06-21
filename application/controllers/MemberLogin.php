<?php
    class MemberLogin extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            // $this->load->model('dashboard_model','dashboard');
            // $this->load->model('company_model','company');
            // $this->load->library('administration');
        }
        
        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                redirect('memberAccount','location');
            }else{
                $this->login_form();
            }
        }

        function login_form($data=[]){
            $data1['title'] = "Login";
            $data1['data'] = $data;
            $data1['page'] = 'login';
            // $views["form"] = ["path"=>'memberLogin',"data"=>$data1];
            // $this->layouts->view($views,'memberLogin',$layout);
            $this->load->view(FRONT.'memberLogin',$data1);
        }

        function dologin()
        {
            // if ($this->member->logged_in)
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                // echo "111";
                // exit;
                // $data['title'] = "Dashboard";
                // $this->load->view(MEMBER.'index',$data);
                redirect('memberAccount','location');
            } else {
                // echo "222";
                // exit;
                if (!$this->input->post('submit'))
                {
                    // echo "333";
                    // exit;
                    // $data['title'] = "Login";
                    // $this->load->view(MEMBER.'login', $data);
                    redirect('memberLogin');
                } else {
                    // echo "444";
                    // exit;
                    // $this->logout1();
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->member->login($username, $password))
                    {
                        redirect('memberAccount','location');
                    } else {
                        // echo "666";
                        // exit;
                        $data['username'] = $username;
                        $data['password'] = $password;
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->login_form($data);
                    }
                }
            }
        }

        function logout()
        {
            $this->member->logout();
            redirect('memberLogin');
        }

    }
?>