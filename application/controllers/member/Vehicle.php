<?php
    class Vehicle extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('VehicleModel','Vehicle');
            checkLogin('member');
        }

        function index(){
            $data['vehicle_manage'] = TRUE;
            $data['title']="Vehicle";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Vehicle->st_update()) {
                    $this->session->set_flashdata('success', 'Vehicle status has been update successfully.');
                    redirect(MEMBER.'vehicle');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Vehicle->delete()) {
                    $this->session->set_flashdata('success', 'Vehicle deleted successfully.');
                    redirect(MEMBER.'vehicle');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
                
            $where = [['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id]];
            $content['list'] = $this->Vehicle->get_list('','',$where);
            $content['title_top'] = "Vehicles";
            $content['title'] = "Vehicle";
            $views["content"] = ["path"=>MEMBER.'vehicle_list',"data"=>$content];
            $layout['page'] = 'vehicle_list';

            $this->layouts->view($views,'member_dashboard',$layout);
            // $this->load->view(MEMBER.'vehicle/list',$data);
        }

        function add(){
            $content['title_top'] = "Vehicles";
            $content['title'] = "Vehicle";
            $views["content"] = ["path"=>MEMBER.'vehicle_add',"data"=>$content];
            $layout['page'] = 'vehicle_add';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Vehicles";
            $content['title'] = "Vehicle";
            $content['form_data'] = $form_data = $this->Vehicle->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>MEMBER.'vehicle_edit',"data"=>$content];
            $layout['page'] = 'vehicle_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Vehicle->create()) {
                $this->session->set_flashdata('success', 'Vehicle information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Vehicle->update()) {
                $this->session->set_flashdata('success', 'Vehicle information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Vehicle->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>