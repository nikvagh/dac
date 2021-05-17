<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->model('AppointmentModel','Appointment');
            checkLogin('member');
        }

        function index()
        {
            $data1['title'] = "Dashboard";
            $data1['customerTotal'] = $this->Customer->getTotalCount();
            $data1['appointmentTotal'] = $this->Appointment->getTotalCount();
            $data1['appointmentPendingTotal'] = $this->Appointment->getTotalPendingCount();
            $data1['appointmentSuccessTotal'] = $this->Appointment->getTotalSuccessCount();

            $views["content"] = ["path"=>MEMBER.'dashboard',"data"=>$data1];
            $layout['page'] = 'dashboard';
            
            $this->layouts->view($views,'member_dashboard',$layout);

            // $data['dashboard'] = TRUE;
            // $data['title'] = "Dashboard";
            // $data['view'] = "admin/index";
            // $this->load->view(MEMBERPATH.'dashboard', $data);
        }
    }
?>