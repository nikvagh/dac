<?php
    class MemberAccount extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            // $this->load->model('dashboard_model','dashboard');
            // $this->load->model('company_model','company');
            // $this->load->library('administration');
            checkLogin('member');
        }

        function index()
        {
            // $data['dashboard'] = TRUE;
            $data['title'] = "Account";
            $data['page'] = "memberAccount";
            // $data['profile'] = $this->dashboard->get_admin();
            // $data['total_companies'] = $this->dashboard->get_total_companies();
            // $data['total_orders'] = $this->dashboard->get_total_orders();
            // $data['companies'] = $this->company->get_companies();
            $this->load->view(FRONT.'memberAccount', $data);
        }
    }
?>