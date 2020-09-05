<?php
    class Contact extends CI_Controller {
        
        function __construct()
        {
            parent::__construct();
            // $this->load->model('dashboard_model','dashboard');
            // $this->load->model('company_model','company');
            // $this->load->library('administration');
        }

        function index()
        {
            $data['dashboard'] = TRUE;
            $data['title'] = "Home";
            $data['view'] = "index";
            // $data['profile'] = $this->dashboard->get_admin();
            // $data['total_companies'] = $this->dashboard->get_total_companies();
            // $data['total_orders'] = $this->dashboard->get_total_orders();
            // $data['companies'] = $this->company->get_companies();

            $this->load->view('front/contact', $data);

            // $data['form_data']['name'] = "dsfdsf"; 
            // $data['form_data']['email'] = "dsfdsf"; 
            // $data['form_data']['phone'] = "dsfdsf"; 
            // $data['form_data']['service_type'] = "dsfdsf"; 
            // $data['form_data']['message'] = "dsfdsf"; 

            // $this->load->view('front/contact_email', $data);
        }

        function contact_mail(){
            
            // echo "<pre>";
            // print_r($_POST);
            // exit;

            $data['form_data'] = $_POST;

            // print_r($data);
            // exit;

            // $message = $this->load->view('front/contact_email',$data, true);

            // print_r($message);
            // echo $message;
            // exit;

            $config = [
                [
                        'field' => 'name',
                        'label' => 'Name',
                        'rules' => 'required',
                        'errors' => [ ],
                ],
                [
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email',
                        'errors' => [],
                ],
                [
                        'field' => 'phone',
                        'label' => 'Phone',
                        'rules' => 'required',
                        'errors' => [],
                ],
                [
                        'field' => 'service_type',
                        'label' => 'Service Type',
                        'rules' => 'required',
                        'errors' => [],
                ],
                [
                        'field' => 'message',
                        'label' => 'Message',
                        'rules' => 'required',
                        'errors' => [],
                ],
            ];

            $this->form_validation->set_data($_POST);
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE)
            {
                $array['status'] = 400;
                $array['title'] = 'Error!';
                $array['result'] = $this->form_validation->error_array();
                echo json_encode($array);
                exit;

            }else{
                $this->load->library('mail');

                $subject = "DAC - Contact Inquiry";
                $message = $this->load->view('front/contact_email',$data, true);

                if($this->mail->send_email($this->system->from_email_address,$subject,$message)){
                    // send mail
                    $array['status'] = 200;
                    $array['title'] = 'Success! Email Sent Successfully';
                    $array['message'] = [];
                    echo json_encode($array);
                    exit;
                }else{
                    // email sending failed
                    $array['status'] = 301;
                    $array['title'] = 'Something Wrong! Please Try Again';
                    $array['message'] = [];
                    echo json_encode($array);
                    exit;
                }

            }
            
        }

    }
?>