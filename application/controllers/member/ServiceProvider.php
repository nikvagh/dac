<?php
    class ServiceProvider extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ServiceProviderModel','Sp');
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('CoWorkerModel','CoWorker');
            checkLogin('member');
        }

        function view($id = 0){
            $content['title_top'] = "Service Providers";
            $content['title'] = "Service Provider";
            $content['form_data'] = $this->Sp->getDataById($id);

            $where = [['column'=>'sp.sp_id','op'=>'=','value'=>$id]];
            $content['form_data']->CoWorkers = $this->CoWorker->get_list('','',$where);
            
            $content['totalJobAssigned'] = $this->Appointment->getTotalCount($id);
            $content['totalJobSuccess'] = $this->Appointment->getTotalSuccessCount($id);
            $content['totalJobInProgress'] = $this->Appointment->getTotalInProgressCount($id);

            // echo "<pre>"; print_r($content['form_data']);
            // exit;

            $views["content"] = ["path"=>MEMBER.'serviceProvider_view',"data"=>$content];
            $layout['page'] = 'serviceProvider_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
        }
    }
?>