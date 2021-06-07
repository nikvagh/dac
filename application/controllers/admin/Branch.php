<?php
    class Branch extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('BranchModel','Branch');
            $this->load->model('ZoneModel','Zone');
            checkLogin('admin');
        }

        function index(){
            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Branch->st_update()) {
                    $this->session->set_flashdata('success', 'branch status has been update successfully.');
                    redirect(ADMIN.'branch');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Branch->delete()) {
                    $this->session->set_flashdata('success', 'branch deleted successfully.');
                    redirect(ADMIN.'branch');
                }
            }
            
            $content['list'] = $this->Branch->get_list();
            // $content['title_top'] = "Manage Branches";
            $content['title'] = "Manage Branches";
            $views["content"] = ["path"=>ADMIN.'branch_list',"data"=>$content];
            $layout['page'] = 'branch_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function add(){
            $content['title_top'] = "Manage Branches";
            $content['title'] = "Branch";

            $where[] = ['column'=>'z.status','op'=>'=','value'=>'Enable'];
            $content['zones'] = $this->Zone->get_list('','',$where);

            $views["content"] = ["path"=>ADMIN.'branch_add',"data"=>$content];
            $layout['page'] = 'branch_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Manage Branches";
            $content['title'] = "Branch";
            $content['form_data'] = $this->Branch->getDataById($id);

            $where[] = ['column'=>'z.status','op'=>'=','value'=>'Enable'];
            $content['zones'] = $this->Zone->get_list('','',$where);
            
            $views["content"] = ["path"=>ADMIN.'branch_edit',"data"=>$content];
            $layout['page'] = 'branch_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('zone_id', 'Zone', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required|numeric');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required|numeric');
            $this->form_validation->set_rules('radius', 'Radius', 'required|numeric');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->Branch->create()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Branch->update()) {
                $this->session->set_flashdata('success', 'Branch information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Branch->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
            }
        }

    }
?>