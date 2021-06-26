<?php
    class Package extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('PackageModel','Package');
            $this->load->model('ServiceModel','Service');
            checkLogin('admin');
        }

        function index(){
            $data['package_manage'] = TRUE;
            $data['title']="Packages";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Package->st_update()) {
                    $this->session->set_flashdata('success', 'Package status has been update successfully.');
                    redirect(ADMIN.'package');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Package->delete()) {
                    $this->session->set_flashdata('success', 'Package deleted successfully.');
                    redirect(ADMIN.'package');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->Package->get_list();
            $content['title'] = "Packages";
            $views["content"] = ["path"=>ADMIN.'package_list',"data"=>$content];
            $layout['page'] = 'package_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'package/list',$data);
        }

        function add(){
            $content['title_top'] = "Packages";
            $content['title'] = "Package";
            $content['services'] = $this->Service->get_list();
            $views["content"] = ["path"=>ADMIN.'package_add',"data"=>$content];
            $layout['page'] = 'package_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title_top'] = "Packages";
            $content['title'] = "Package";
            $content['form_data'] = $form_data = $this->Package->getDataById($id);
            $content['validity'] = package_validity_converter($form_data->validity);
            $content['services'] = $this->Service->get_list();
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>ADMIN.'package_edit',"data"=>$content];
            $layout['page'] = 'package_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $this->form_validation->set_rules('year', 'Year', 'required|numeric');
            $this->form_validation->set_rules('month', 'Month', 'required|numeric');
            $this->form_validation->set_rules('day', 'Day', 'required|numeric');
            $this->form_validation->set_rules('services[]', 'Services', 'required');
            $this->form_validation->set_rules('total_wash', 'Total Wash', 'required|numeric');
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }
        
        public function create(){
            if ($this->Package->create()) {
                $this->session->set_flashdata('success', 'Package information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Package->update()) {
                $this->session->set_flashdata('success', 'Package information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Package->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>