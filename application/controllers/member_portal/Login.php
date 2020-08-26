<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();

            // $this->load->library('administration');
//			$this->output->enable_profiler(TRUE);

            $this->tableName = 'member';
            $this->primaryKey = 'member_id';

            $this->load->library('facebook'); 

            $this->authURL = $this->facebook->login_url();

        }
        function index()
        {
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            // exit;

            $data['authURL'] = $this->authURL;

            // if ($this->member->logged_in) 
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                // $data['title'] = "Dashboard";
                // $this->load->view(MEMBERPATH.'dashboard', $data);
                redirect(MEMBERPATH.'dashboard','location');
            }else{
                $data['title'] = "Login";
                $this->load->view(MEMBERPATH.'login', $data);
            }
        }

        function dologin()
        {
            $data['authURL'] = $this->authURL;

            // $this->validation->set_rules('username', 'Username', 'required');
            // if ($this->validation->run() == FALSE)
            // {
            //     echo "1111";
            //         // $this->load->view('myform');
            // }
            // else
            // {
            //         echo "222";
            //         // $this->load->view('formsuccess');
            // }


            // exit;
//            echo $this->input->post('username');
//            echo $this->input->post('password');exit;
            // $data['js'] = array("login.js");

            // if ($this->member->logged_in)
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "member")
            {
                // $data['title'] = "Dashboard";
                // $this->load->view(MEMBERPATH.'index',$data);
                redirect(MEMBERPATH.'dashboard','location');
            } else {
                if (!$this->input->post('submit'))
                {
                    $data['title'] = "Login";
                    $this->load->view(MEMBERPATH.'login', $data);
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->member->login($username, $password))
                    {
                        redirect(MEMBERPATH.'dashboard','location');
                    } else {
                        $data['title'] = "Login";
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->load->view(MEMBERPATH.'login', $data);
                    }
                }
            }
        }

        function logout()
        {
            $this->member->logout();
            redirect(MEMBERPATH.'login');
        }
    }
?>