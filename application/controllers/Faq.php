<?php
    class Faq extends CI_Controller {
        
        function __construct(){
            parent::__construct();
        }

        function index()
        {
            $data['dashboard'] = TRUE;
            $data['title'] = "Home";
            $data['view'] = "index";
            $this->load->view('front/faq', $data);
        }

    }
?>