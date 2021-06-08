<?php
    class Driver extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('DriverModel','Driver');
            $this->load->model('BranchModel','Branch');
            checkLogin('admin');
        }

        function index(){
            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Driver->st_update()) {
                    $this->session->set_flashdata('success', 'driver status has been update successfully.');
                    redirect(ADMIN.'driver');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Driver->delete()) {
                    $this->session->set_flashdata('success', 'driver deleted successfully.');
                    redirect(ADMIN.'driver');
                }
            }
            
            $content['list'] = $this->Driver->get_list();
            // $content['title_top'] = "Manage Drivers";
            $content['title'] = "Manage Drivers";
            $views["content"] = ["path"=>ADMIN.'driver_list',"data"=>$content];
            $layout['page'] = 'driver_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function add(){
            $content['title_top'] = "Manage Drivers";
            $content['title'] = "Driver";

            $where[] = ['column'=>'b.status','op'=>'=','value'=>'Enable'];
            $content['branches'] = $this->Branch->get_list('','',$where);

            $views["content"] = ["path"=>ADMIN.'driver_add',"data"=>$content];
            $layout['page'] = 'driver_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Manage Drivers";
            $content['title'] = "Driver";

            $where[] = ['column'=>'b.status','op'=>'=','value'=>'Enable'];
            $content['branches'] = $this->Branch->get_list('','',$where);
            $content['form_data'] = $this->Driver->getDataById($id);

            $views["content"] = ["path"=>ADMIN.'driver_edit',"data"=>$content];
            $layout['page'] = 'driver_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
            $this->form_validation->set_rules('pincode', 'Pin code', 'required|numeric');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'End Time', 'required');
            $this->form_validation->set_rules('branch[]', 'Branch', 'required');
            if(empty($_FILES['driving_license']['name'])){
                $this->form_validation->set_rules('driving_license', 'Driving License', 'required');
            }

            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Driver->create()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Driver->update()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Driver->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>