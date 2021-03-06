<?php
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    class Report extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->library('PhpSpreadsheet1');
            $this->load->model('CategoryModel','Category');
            $this->load->model('ServiceModel','Service');
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('PaymentModel','Payment');
            $this->load->model('MembershipModel','Membership');
            checkLogin('admin');
        }

        function index(){
            $data['title'] = "Report";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Report->st_update()) {
                    $this->session->set_flashdata('success', 'Report status has been update successfully.');
                    redirect(ADMIN.'report');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Report->delete()) {
                    $this->session->set_flashdata('success', 'Report deleted successfully.');
                    redirect(ADMIN.'report');
                }
            }
            
            // $content['appointments'] = $this->Appointment->get_list();
            $content['title'] = "Report";
            $views["content"] = ["path"=>ADMIN.'report_list',"data"=>$content];
            $layout['page'] = 'report_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function jobs($name=""){

            if($name == "all"){
                $headers = ['Customer','Service Provider','Date','Amount','Service At','Status'];
                $list = $this->Appointment->get_list();
                $data = [];
                foreach($list as $key=>$val){

                    // echo "<pre>";print_r($val);exit;
                    $data[] = [$val->firstname.' '.$val->lastname,$val->company_name,$val->date,$val->amount,$val->service_at,$val->status_txt];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'allJobs.xlsx');
            }

            if($name == "pending"){
                $headers = ['Customer','Service Provider','Date','Amount','Service At'];
                $where = ['status_id','=',1];
                $list = $this->Appointment->get_list($where);
                $data = [];
                foreach($list as $key=>$val){
                    $data[] = [$val->firstname.' '.$val->lastname,$val->company_name,$val->date,$val->amount,$val->service_at];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'pendingJobs.xlsx');
            }

            if($name == "complete"){
                $headers = ['Customer','Service Provider','Date','Amount','Service At'];
                $where = ['status_id','=',5];
                $list = $this->Appointment->get_list($where);
                $data = [];
                foreach($list as $key=>$val){
                    $data[] = [$val->firstname.' '.$val->lastname,$val->company_name,$val->date,$val->amount,$val->service_at];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'completeJobs.xlsx');
            }

        }

        function payment($name=""){
            if($name == "customerPayment"){
                $headers = ['Customer Name','Amount','Transaction Type','Status'];
                $where = ['user_type','=','customer'];
                $list = $this->Payment->get_list($where);
                $data = [];
                foreach($list as $key=>$val){
                    // echo "<pre>";print_r($val);exit;
                    $data[] = [$val->firstname.' '.$val->lastname,$val->amount,$val->transaction_type,$val->status];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'customerPayment.xlsx');
            }

            if($name == "spPayout"){
                $headers = ['Service Provider','Amount','Transaction Type','Status'];
                $where = ['user_type','=','sp'];
                $list = $this->Payment->get_list($where);
                $data = [];
                foreach($list as $key=>$val){
                    $data[] = [$val->company_name,$val->amount,$val->transaction_type,$val->status];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'serviceProviderPayout.xlsx');
            }
        }

        function customer($name=""){
            if($name == "membership"){
                $headers = ['Customer Name','Package','Start Date','End Date','Validity Status'];
                // $where = ['user_type','=','customer'];
                $list = $this->Membership->get_list();
                $data = [];
                foreach($list as $key=>$val){
                    // echo "<pre>";print_r($val);exit;
                    $data[] = [$val->firstname.' '.$val->lastname,$val->package_name,$val->start_date,$val->end_date,$val->validity_status];
                }

                $spreadsheet = new PhpSpreadsheet1();
                $spreadsheet->downloadExcel($data,$headers,'customerPayment.xlsx');
            }
        }

        function add(){
            $content['title'] = "Report";
            $content['categories'] = $this->Category->get_list();
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'report_add',"data"=>$content];
            $layout['page'] = 'report_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Report";
            $content['form_data'] = $this->Report->getDataById($id);
            $content['categories'] = $this->Category->get_list();
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'report_edit',"data"=>$content];
            $layout['page'] = 'report_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;
            $this->form_validation->set_rules('code', 'Code', 'required');
            $this->form_validation->set_rules('discount', 'Discount', 'required|numeric|less_than_equal_to[100]');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required');
            $this->form_validation->set_rules('end_date', 'End Date', 'required');
            $this->form_validation->set_rules('categories[]', 'Categories', 'required');
            $this->form_validation->set_rules('services[]', 'Services', 'required');
            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Report->create()) {
                $this->session->set_flashdata('success', 'Report information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Report->update()) {
                $this->session->set_flashdata('success', 'Report information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Report->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>