<?php
    class Dispatching extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('CategoryModel','Category');
            $this->load->model('ServiceStatusModel','ServiceStatus');
            $this->load->model('ServiceModel','Service');
            $this->load->model('CustomerModel','Customer');
            $this->load->model('ServiceProviderModel','Sp');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Dispatching";
                
            $where = [['column'=>'status_id','op'=>'=','value'=>1]];
            $content['list'] = $this->Appointment->get_list('','',$where);
            $content['statuses'] = $this->ServiceStatus->get_list();
            $content['title'] = "Dispatching";

            $content['tab'] = "";

            // echo "<pre>";print_r($content);exit;
            $views["content"] = ["path"=>ADMIN.'dispatching',"data"=>$content];
            $layout['page'] = 'dispatching';
            $this->layouts->view($views,'admin_dashboard',$layout);

            // $this->load->view(ADMIN.'dispatching',$data);
        }

        function add(){
            $content['title'] = "Dispatch Job";
            $content['categories'] = $this->Category->get_list();
            $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();

            $views["content"] = ["path"=>ADMIN.'dispatch_add',"data"=>$content];
            $layout['page'] = 'dispatch_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Dispatch Job";
            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'dispatch_edit',"data"=>$content];
            $layout['page'] = 'dispatch_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function view($id = 0){
            $content['title'] = "Job";
            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            // $content['sps'] = $this->Sp->get_list();
            $content['services'] = $this->Service->get_list();
            $content['customers'] = $this->Customer->get_list();
            $content['statuses'] = $this->ServiceStatus->get_list();

            $where = [];
            $content['service_providers'] = $this->Sp->get_list($where);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'dispatch_view',"data"=>$content];
            $layout['page'] = 'dispatch_view';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;

            if($_POST['action'] == "view"){
                echo json_encode(['status'=>200]);
            }else{
                $this->form_validation->set_rules('customer_id', 'Customer', 'required');
                $this->form_validation->set_rules('category_id', 'Category', 'required');
                $this->form_validation->set_rules('sp_id', 'Service Provider', 'required');
                $this->form_validation->set_rules('services[]', 'Services', 'required');
                $this->form_validation->set_rules('date', 'Date', 'required');
                $this->form_validation->set_rules('time', 'Time', 'required');
                $this->form_validation->set_rules('status_id', 'Status', 'required');
                if ($this->form_validation->run()) {
                    echo json_encode(['status'=>200]);
                } else {
                    echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
                }
            } 
        }

        public function create(){
            if ($this->Appointment->create()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Appointment->update()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function dispatch_view_update(){
            if ($this->Appointment->dispatch_view_update()) {
                $this->session->set_flashdata('success', 'Job information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Appointment->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }


        public function getData()
        {
            $columns = array(
                                0 => 'id', 
                                1 => 'vehicle_name',
                                2 => 'location',
                                3 => 'company_name',
                                4 => 'created_at',
                                5 => 'id',
                            );
            
            $column_search = array('id','vehicle_name','location','company_name','created_at');


            $limit = $this->input->post('length');
            $start = $this->input->post('start');

            $order = ""; $dir = "";
            if($this->input->post('order')){
                $order = $columns[$this->input->post('order')[0]['column']];
            }
            if($this->input->post('order')){
                $dir = $this->input->post('order')[0]['dir'];
            }

            // custom
            $where = [];
            $where_or = [];
            $where_in = [];

            $totalData = $this->Appointment->get_list("","", $where ,$where_or ,$where_in ,'Y');  //total count
            $totalFiltered = $totalData; 

            if(empty($this->input->post('search')['value'])){
                $result = $this->Appointment->get_list($limit,$start,$where ,$where_or ,$where_in ,'N',$order,$dir); // display data
            } else {
                // $search = $this->input->post('search')['value'];

                // $search_eq_ary = [];
                // foreach($column_search as $key=>$val){
                //     $search_eq_ary[] = $val.' LIKE %'.$search.'%';
                // }

                // if($search_eq_ary){
                //     $where_or[] = '('.implode(' or ',$search_eq_ary).')';
                // }
                 
                // $result =  $this->Appointment->get_list($limit,$start,$where ,$where_or ,$where_in ,'N'); // search
                // $totalFiltered = $this->Appointment->get_list($limit,$start,$where ,$where_or ,$where_in ,'Y'); // search count
            }

            $data = array();
            if(!empty($result))
            {
                foreach ($result as $row){
                    $nestedData['id'] = $row->id;
                    $nestedData['vehicle_name'] = $row->vehicle_name;
                    $nestedData['location'] = $row->location;
                    $nestedData['company_name'] = $row->company_name;
                    $nestedData['created_at'] = date('j M Y h:i a',strtotime($row->created_at));
                    $data[] = $nestedData;
                }
            }
            
            $json_data = array(
                "draw"            => intval($this->input->post('draw')),
                "recordsTotal"    => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data"            => $data
            );

            // echo "<pre>";
            // print_r($json_data);
            // exit;

            echo json_encode($json_data);
        }




    }
?>