<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model(ADMINPATH.'dashboard_model','dashboard');
            // $this->load->model('company_model','company');
            // $this->load->library('administration');
            // $this->load->helper('functions');
            checkLogin('admin');

            // echo "<pre>";
            // print_r($this->member);
            // echo "</pre>";
            // exit;
        }
        function index()
        {
            $data['dashboard'] = TRUE;
            $data['title'] = "Dashboard";
            $data['view'] = "admin/index";
            // $data['profile'] = $this->dashboard->get_admin();
            // $data['total_companies'] = $this->dashboard->get_total_companies();
            // $data['total_orders'] = $this->dashboard->get_total_orders();
            // $data['companies'] = $this->company->get_companies();
            $this->load->view(ADMINPATH.'dashboard', $data);
        }
    }
?>