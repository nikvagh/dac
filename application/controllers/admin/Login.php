<?php
    class Login extends CI_Controller {
        function __construct()
        {
            //parent::CI_Controller();
            parent::__construct();
        }
        function index()
        {
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin")
            {
                redirect(ADMIN.'dashboard','location');
            }else{
                $data['title'] = "Login";
                $this->load->view(ADMIN.'login', $data);
            }
        }
        function dologin()
        {
            // if ($this->admin->logged_in)
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin")
            {
                // echo "111";
                // exit;
                // $data['title'] = "Dashboard";
                // $this->load->view(ADMIN.'index',$data);
                redirect(ADMIN.'dashboard','location');
            } else {
                // echo "222";
                // exit;
                if (!$this->input->post('submit'))
                {
                    // echo "333";
                    // exit;
                    $data['title'] = "Login";
                    $this->load->view(ADMIN.'login', $data);
                } else {
                    // echo "444";
                    // exit;
                    // $this->logout1();
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');

                    if ($this->admin->login($username, $password))
                    {
                        // echo "555";
                        // exit;
                        redirect(ADMIN.'dashboard','location');
                    } else {
                        // echo "666";
                        // exit;
                        $data['title'] = "Login";
                        $this->session->set_flashdata('error', 'Invalid Login. Please try again.');
                        $this->load->view(ADMIN.'login', $data);
                    }
                }
            }
        }

        function logout()
        {
            $this->admin->logout();
            redirect(ADMIN.'login');
        }

        function logout1()
        {
            $this->admin->logout();
            $this->member->logout();
            // $this->sp->logout();
        }

    }
?>