<?php
    class Service extends CI_Controller {
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
            // $data['view'] = "index";
            // $data['profile'] = $this->dashboard->get_admin();
            // $data['total_companies'] = $this->dashboard->get_total_companies();
            // $data['total_orders'] = $this->dashboard->get_total_orders();
            // $data['companies'] = $this->company->get_companies();
            $this->load->view('front/service', $data);
        }
    }
?>