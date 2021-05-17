<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();
        }

        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                redirect(MEMBER.'dashboard','location');
            }else{
                $this->login_form();
            }
        }

        function login_form($data=[]){
            $data1['title'] = "Login";
            $data1['data'] = $data;
            $layout['page'] = 'login';
            $views["form"] = ["path"=>MEMBER.'login_form',"data"=>$data1];
            $views["bottom_link"] = ["path"=>MEMBER.'login_form_bottom_link',"data"=>[]];

            // echo "<pre>";
            // print_r($views);
            // exit;
            $this->layouts->view($views,'member_sign_in_up',$layout);
            // $this->load->view(MEMBER.'login', $data);
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
                redirect(MEMBER.'dashboard','location');
            } else {
                // echo "222";
                // exit;
                if (!$this->input->post('submit'))
                {
                    // echo "333";
                    // exit;
                    // $data['title'] = "Login";
                    // $this->load->view(MEMBER.'login', $data);
                    redirect(MEMBER.'login');
                } else {
                    // echo "444";
                    // exit;
                    // $this->logout1();
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->member->login($username, $password))
                    {
                        redirect(MEMBER.'dashboard','location');
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
            redirect(MEMBER.'login');
        }

        function logout1()
        {
            $this->member->logout();
            // $this->sp->logout();
        }

    }
?>