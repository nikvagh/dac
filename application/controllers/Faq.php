<?php
    class Faq extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model('FaqModel','Faq');
        }

        function index()
        {
            $data['dashboard'] = TRUE;
            $data['title'] = "Home";
            $data['view'] = "index";

            $where = [];
            $where[] = ['column'=>'f.faq_for','op'=>'=','value'=>'customer'];
            $data['faqs'] = $this->Faq->get_list('','',$where);
            $this->load->view('front/faq', $data);
        }

    }
?>