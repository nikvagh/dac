<?php
    class Booking extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('AppointmentModel','Appointment');
            $this->load->model('VehicleModel','Vehicle');
            $this->load->model('AddOnModel','AddOn');
            $this->load->model('ZipcodeModel','Zipcode');
            checkLogin('member');
        }

        function index(){
            $data['booking_manage'] = TRUE;
            $data['title']="Booking";

            if($this->input->post('action') == "change_publish"){
                if ($result = $this->Booking->st_update()) {
                    $this->session->set_flashdata('success', 'Booking status has been update successfully.');
                    redirect(MEMBER.'booking');
                }
            }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
                if ($result = $this->Booking->delete()) {
                    $this->session->set_flashdata('success', 'Booking deleted successfully.');
                    redirect(MEMBER.'booking');
                }
            }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $where1 = [['column'=>'a.customer_id','op'=>'=','value'=>$this->member->id]];
            $where_or[] = '(a.status_id=1 or a.status_id=4)';

            $content['list'] = $this->Appointment->get_list('','',$where1,$where_or);
            $content['title'] = "Booking";
            $views["content"] = ["path"=>MEMBER.'booking_list',"data"=>$content];
            $layout['page'] = 'booking_list';

            $this->layouts->view($views,'member_dashboard',$layout);
            // $this->load->view(MEMBER.'booking/list',$data);
        }

        function book_now(){
            $content['title'] = "Book Service";

            $where1 = [];

            // $content['zipcodes'] = $this->Zipcode->get_list('','');

            $where1[] = ['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id];
            $content['vehicles'] = $this->Vehicle->get_list('','',$where1);

            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable']];
            $content['packages'] = $this->Package->get_list('','',$where2);

            $where3 = [['column'=>'a.status','op'=>'=','value'=>'Enable']];
            $content['addOns'] = $this->AddOn->get_list('','',$where3);

            $views["content"] = ["path"=>MEMBER.'book_now',"data"=>$content];
            $layout['page'] = 'book_now';

            $this->layouts->view($views,'member_dashboard',$layout);
        }

        function edit($id = 0){
            $content['title'] = "Booking";
            $content['form_data'] = $form_data = $this->Booking->getDataById($id);
            // echo "<pre>";print_r($content);
            // exit;

            $views["content"] = ["path"=>MEMBER.'booking_edit',"data"=>$content];
            $layout['page'] = 'booking_edit';
            $this->layouts->view($views,'member_dashboard',$layout);
        }

        // public function validation() {
        //     $this->form_validation->set_rules('name', 'Name', 'required');
        //     $this->form_validation->set_rules('year', 'Year', 'required');
        //     if ($this->form_validation->run()) {
        //         echo json_encode(['status'=>200]);
        //     } else {
        //         echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
        //     }
        // }

        public function validationBookNow(){
            $this->form_validation->set_rules('location', 'Location', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
            $this->form_validation->set_rules('vehicle_id', 'Vehicle', 'required');
            $this->form_validation->set_rules('package_id', 'Package', 'required');
            // $this->form_validation->set_rules('addOn[]', 'Add On', 'required');
            $this->form_validation->set_rules('time', 'Time', 'required');

            if ($this->form_validation->run()) {
                echo json_encode(['status'=>200]);
            } else {
                echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
            }
        }

        public function bookNowSave(){
            if ($this->Appointment->bookNowSave()) {
                $this->session->set_flashdata('success', 'Appointment Booked successfully');
                echo json_encode(['status'=>200]);
            }
        }

        public function create(){
            if ($this->Booking->create()) {
                $this->session->set_flashdata('success', 'Booking information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function update(){
            if ($this->Booking->update()) {
                $this->session->set_flashdata('success', 'Booking information has been saved successfully.');
                echo json_encode(['status'=>200]);
            }
        }

        public function delete(){
            if ($this->Booking->delete()) {
                $this->session->set_flashdata('success', 'Items deleted successfully.');
                // echo json_encode(['status'=>200]);
            }
        }

        public function get_list_dropdown($val = ""){
            $result = [];
            if(isset($_POST['search'])){
                $where = array(["column"=>"zipcode","op"=>"like","value"=>'%'.$_POST['search'].'%']);
                $resultAll = $this->Zipcode->get_list('','',$where);
            }

            foreach($resultAll as $key=>$val){
                $result[] = ["text"=>$val->zipcode,"id"=>$val->zipcode];
            }

            echo json_encode(['result'=>$result]);
        }

    }
?>