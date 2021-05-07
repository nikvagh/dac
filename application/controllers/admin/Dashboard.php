<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            // $this->load->model(ADMINPATH.'dashboard_model','dashboard');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('AppointmentModel','Appointment');
            checkLogin('admin');
        }

        function index()
        {
            $data1['title'] = "Dashboard";
            $data1['customerTotal'] = $this->Customer->getTotalCount();
            $data1['appointmentTotal'] = $this->Appointment->getTotalCount();
            $data1['appointmentPendingTotal'] = $this->Appointment->getTotalPendingCount();
            $data1['appointmentSuccessTotal'] = $this->Appointment->getTotalSuccessCount();
            

            $views["content"] = ["path"=>ADMIN.'dashboard',"data"=>$data1];
            $layout['page'] = 'dashboard';
            
            $this->layouts->view($views,'admin_dashboard',$layout);

            // $data['dashboard'] = TRUE;
            // $data['title'] = "Dashboard";
            // $data['view'] = "admin/index";
            // $this->load->view(ADMINPATH.'dashboard', $data);
        }
    }
?>