<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();

            // $this->load->library('administration');
//			$this->output->enable_profiler(TRUE);
        }
        function index()
        {   
            $data['sp_login'] = TRUE;
            // echo "<pre>";
            // print_r($_SESSION);
            // echo "</pre>";
            // exit;

            // if ($this->member->logged_in) 
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "sp")
            {
                // $data['title'] = "Dashboard";
                // $this->load->view(SPPATH.'dashboard', $data);
                redirect(SPPATH.'dashboard','location');
            }else{
                $data['title'] = "Login";
                $this->load->view(SPPATH.'login', $data);
            }
        }
        function dologin()
        {
            $data['sp_login'] = TRUE;
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
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "sp")
            {
                // $data['title'] = "Dashboard";
                // $this->load->view(SPPATH.'index',$data);
                redirect(SPPATH.'dashboard','location');
            } else {
                if (!$this->input->post('submit'))
                {
                    $data['title'] = "Login";
                    $this->load->view(SPPATH.'login', $data);
                } else {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->sp->login($username, $password))
                    {
                        redirect(SPPATH.'dashboard','location');
                    } else {
                        $data['title'] = "Login";
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->load->view(SPPATH.'login', $data);
                    }
                }
            }
        }

        function logout()
        {
            $this->sp->logout();
            redirect(SPPATH.'login');
        }
    }
?>