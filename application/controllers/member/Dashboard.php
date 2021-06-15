<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('CustomerModel','Customer');
            $this->load->model('MembershipModel','Membership');
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('VehicleModel','Vehicle');
            $this->load->model('PaymentModel','Payment');
            checkLogin('member');
        }

        function index()
        {
            $data1['title'] = "Dashboard";
            $data1['ongoingMembershipTotal'] = $this->Membership->getOngoingMembershipCountByMemberId($this->session->userdata('id'));

            $where1[] = ["column"=>"customer_id","op"=>"=","value"=>$this->session->userdata('id')];
            $data1['appointmentTotal'] = $this->Appointment->getTotalCount('',$where1);
            
            $where2[] = ["column"=>"cv.member_id","op"=>"=","value"=>$this->session->userdata('id')];
            $data1['vehicleTotal'] = $this->Vehicle->getTotalVehicleCount($where2);

            $where3[] = ["column"=>"p.user_id","op"=>"=","value"=>$this->session->userdata('id')];
            $where3[] = ["column"=>"p.user_type","op"=>"=","value"=>'customer'];
            $where3[] = ["column"=>"p.transaction_type","op"=>"=","value"=>'Credit'];
            $data1['paymentTotal'] = $this->Payment->getTotalPaymentCount($where3);

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