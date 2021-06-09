<?php
    class VehicleType extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('VehicleTypeModel','VehicleType');
            $this->load->model('BranchModel','Branch');
            checkLogin('admin');
        }

        function index(){
            if($this->input->post('action') == "change_publish"){
                if ($result = $this->VehicleType->st_update()) {
                    $this->session->set_flashdata('success', 'Vehicle Type status has been update successfully.');
                    redirect(ADMIN.'vehicleType');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->VehicleType->delete()) {
                    $this->session->set_flashdata('success', 'Vehicle Type deleted successfully.');
                    redirect(ADMIN.'vehicleType');
                }
            }
            
            $content['list'] = $this->VehicleType->get_list();
            // $content['title_top'] = "Manage VehicleTypes";
            $content['title'] = "Manage Vehicle Types";
            $views["content"] = ["path"=>ADMIN.'vehicleType_list',"data"=>$content];
            $layout['page'] = 'vehicleType_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function add(){
            $content['title_top'] = "Manage Vehicle Types";
            $content['title'] = "Vehicle Type";

            $where[] = ['column'=>'b.status','op'=>'=','value'=>'Enable'];
            $content['branches'] = $this->Branch->get_list('','',$where);

            $views["content"] = ["path"=>ADMIN.'vehicleType_add',"data"=>$content];
            $layout['page'] = 'vehicleType_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Manage Vehicle Types";
            $content['title'] = "Vehicle Type";

            $where[] = ['column'=>'b.status','op'=>'=','value'=>'Enable'];
            $content['branches'] = $this->Branch->get_list('','',$where);
            $content['form_data'] = $this->VehicleType->getDataById($id);

            $views["content"] = ["path"=>ADMIN.'vehicleType_edit',"data"=>$content];
            $layout['page'] = 'vehicleType_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->VehicleType->create()) {
                $this->session->set_flashdata('success', 'Vehicle type information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->VehicleType->update()) {
                $this->session->set_flashdata('success', 'Vehicle type information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->VehicleType->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>