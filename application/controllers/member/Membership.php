<?php
    class Membership extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('MembershipModel','Membership');
            $this->load->model('VehicleModel','Vehicle');
            $this->load->model('PackageModel','Package');
            $this->load->model('CustomerMembershipModel','CustomerMembership');
            checkLogin('member');
        }

        function index(){
            $data['membership_manage'] = TRUE;
            $data['title']="Membership";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Membership->st_update()) {
                    $this->session->set_flashdata('success', 'Membership status has been update successfully.');
                    redirect(MEMBER.'membership');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Membership->delete()) {
                    $this->session->set_flashdata('success', 'Membership deleted successfully.');
                    redirect(MEMBER.'membership');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $where = [];
            $where[] = ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id];
            $content['list'] = $this->Membership->get_list('','',$where);
            $content['title'] = "Membership";
            $views["content"] = ["path"=>MEMBER.'membership_list',"data"=>$content];
            $layout['page'] = 'membership_list';

            $this->layouts->view($views,'member_dashboard',$layout);
            // $this->load->view(MEMBER.'membership/list',$data);
        }

        function add(){
            $content['title'] = "Package";
            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable']];
            $content['packages'] = $this->Package->get_list('','',$where2);

            // $where1 = [];
            // $where1[] = ['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id];
            // $content['vehicles'] = $this->Vehicle->get_list('','',$where1);

            $views["content"] = ["path"=>MEMBER.'membership_add',"data"=>$content];
            $layout['page'] = 'membership_add';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        // function edit($id = 0){
        //     $content['title'] = "Membership";
        //     $content['form_data'] = $form_data = $this->Membership->getDataById($id);
        //     $content['services'] = $this->Service->get_list();
        //     // echo "<pre>";print_r($content);
        //     // exit;

        //     $views["content"] = ["path"=>MEMBER.'membership_edit',"data"=>$content];
        //     $layout['page'] = 'membership_edit';
        //     $this->layouts->view($views,'member_dashboard',$layout);
        // }

        public function validation() {
            $this->form_validation->set_rules('package_id', 'Package', 'required', ['required' => 'Please select at least one package']);
            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function create(){
            if ($this->CustomerMembership->purchaseFromCustomer()) {
                $this->session->set_flashdata('success', 'Membership information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Membership->update()) {
                $this->session->set_flashdata('success', 'Membership information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Membership->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

    }
?>