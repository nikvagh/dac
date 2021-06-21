<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->model('AppointmentModel','Appointment');
            checkLogin('sp');
        }

        function index()
        {
            $data1['title'] = "Dashboard";
            $total = $data1['appointmentTotal'] = $this->Appointment->getTotalCount($this->session->userdata('id'));
            $data1['appointmentPendingTotal'] = $this->Appointment->getTotalPendingCount($this->session->userdata('id'));
            $total_success = $data1['appointmentSuccessTotal'] = $this->Appointment->getTotalSuccessCount();
            $total_reject = $data1['appointmentRejectTotal'] = $this->Appointment->getTotalRejectCount();

            $data1['appointmentSuccessPer'] = number_format(($total_success*100)/$total,2);
            $data1['appointmentRejectPer'] = number_format(($total_reject*100)/$total,2);
            
            $views["content"] = ["path"=>SP.'dashboard',"data"=>$data1];
            $layout['page'] = 'dashboard';
            
            $this->layouts->view($views,'sp_dashboard',$layout);
        }
    }
?>