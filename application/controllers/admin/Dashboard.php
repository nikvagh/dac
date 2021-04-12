<?php
    class Dashboard extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model(ADMINPATH.'dashboard_model','dashboard');
            checkLogin('admin');
        }
        function index()
        {
            $data1['title'] = "Dashboard";
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