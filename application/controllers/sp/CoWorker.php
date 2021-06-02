<?php
    class CoWorker extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('CoWorkerModel','CoWorker');
            $this->load->model('ServiceProviderModel','Sp');
            checkLogin('admin');
        }

        function index(){
            $data['title']="Co-Worker";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->CoWorker->st_update()) {
                    $this->session->set_flashdata('success', 'Co-Worker status has been update successfully.');
                    redirect(ADMIN.'coWorker');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->CoWorker->delete()) {
                    $this->session->set_flashdata('success', 'Co-Worker Provider deleted successfully.');
                    redirect(ADMIN.'coWorker');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $content['list'] = $this->CoWorker->get_list();
            $content['title'] = "Co-Worker";
            $views["content"] = ["path"=>ADMIN.'coWorker_list',"data"=>$content];
            $layout['page'] = 'coWorker_list';

            $this->layouts->view($views,'admin_dashboard',$layout);
            // $this->load->view(ADMIN.'category/list',$data);
        }

        function add(){
            $content['title'] = "Co-Worker";
            $content['serviceProvider'] = $this->Sp->get_list();
            $views["content"] = ["path"=>ADMIN.'coWorker_add',"data"=>$content];
            $layout['page'] = 'coWorker_add';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Co-Worker";
            $content['form_data'] = $this->CoWorker->getDataById($id);
            $content['serviceProvider'] = $this->Sp->get_list();

            // print_r($content);
            // exit;
            
            $views["content"] = ["path"=>ADMIN.'coWorker_edit',"data"=>$content];
            $layout['page'] = 'coWorker_edit';
            $this->layouts->view($views,'admin_dashboard',$layout);
        }

        public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;

            // echo $_POST['start_time'];
            // exit;

            $this->form_validation->set_rules('sp_id', 'Service Provider', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required|callback_validate_time_hm');
            $this->form_validation->set_rules('end_time', 'End Time', 'required|callback_validate_time_hm');
            if($_POST['action'] == 'add'){
                $this->form_validation->set_rules('password', 'Password', 'required');
            }

            if ($this->form_validation->run()) {
                // header("Content-type:application/json");
                echo json_encode(['status'=>200]);
            } else {
                // header("Content-type:application/json");
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->CoWorker->create()) {
                $this->session->set_flashdata('success', 'Co-Worker information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->CoWorker->update()) {
                $this->session->set_flashdata('success', 'Co-Worker information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->CoWorker->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

        public function validate_time_hm($str)
        {
            //Assume $str SHOULD be entered as HH:MM
            $hh = ""; $mm = "";
            $time = explode(":",$str);

            if (count($time) != 2){
                $this->form_validation->set_message('validate_time_hm', 'Invalid time');
                return FALSE;
            }


            if(!empty($time)){
                if(array_key_exists(0,$time)){
                    $hh = $time[0];
                }
                if(array_key_exists(0,$time)){
                    $mm = $time[1];
                }
            }

            if (!is_numeric($hh) || !is_numeric($mm))
            {
                $this->form_validation->set_message('validate_time_hm', 'Not numeric');
                return FALSE;
            }
            else if ((int) $hh > 24 || (int) $mm > 59)
            {
                $this->form_validation->set_message('validate_time_hm', 'Invalid time');
                return FALSE;
            }
            else if (mktime((int) $hh, (int) $mm) === FALSE)
            {
                $this->form_validation->set_message('validate_time_hm', 'Invalid time');
                return FALSE;
            }
            return TRUE;
        }

    }
?>