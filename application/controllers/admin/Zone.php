<?php
    class Zone extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('ZoneModel','Zone');
            checkLogin('admin');
        }

        function index(){
            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Zone->st_update()) {
                    $this->session->set_flashdata('success', 'zone status has been update successfully.');
                    redirect(ADMIN.'zone');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Zone->delete()) {
                    $this->session->set_flashdata('success', 'zone deleted successfully.');
                    redirect(ADMIN.'zone');
                }
            }
            
            $content['list'] = $this->Zone->get_list();
            // $content['title_top'] = "Manage Zones";
            $content['title'] = "Manage Zones";
            $views["content"] = ["path"=>ADMIN.'zone_list',"data"=>$content];
            $layout['page'] = 'zone_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function add(){
            $content['title_top'] = "Manage Zones";
            $content['title'] = "Zone";
            $views["content"] = ["path"=>ADMIN.'zone_add',"data"=>$content];
            $layout['page'] = 'zone_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Manage Zones";
            $content['title'] = "Zone";
            $content['form_data'] = $this->Zone->getDataById($id);

            $views["content"] = ["path"=>ADMIN.'zone_edit',"data"=>$content];
            $layout['page'] = 'zone_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Zone->create()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Zone->update()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Zone->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>