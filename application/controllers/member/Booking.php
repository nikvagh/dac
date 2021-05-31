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
            $data['title']="Bookings";

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
            $where_or1[] = '(a.status_id=1 or a.status_id=4)';
            $content['list_current'] = $this->Appointment->get_list('','',$where1,$where_or1);

            $where2 = [['column'=>'a.customer_id','op'=>'=','value'=>$this->member->id]];
            $where_or2[] = '(a.status_id=2 or a.status_id=3 or a.status_id=5)';
            $content['list_prev'] = $this->Appointment->get_list('','',$where2,$where_or2);

            $content['title_top'] = "Service Bookings";
            $content['title'] = "Bookings";
            $views["content"] = ["path"=>MEMBER.'booking_list',"data"=>$content];
            $layout['page'] = 'booking_list';

            $this->layouts->view($views,'member_dashboard',$layout);
            // $this->load->view(MEMBER.'booking/list',$data);
        }

        function book_now(){
            $content['title_top'] = "Service Bookings";
            $content['title'] = "Book Service";

            $where1 = [];

            // $content['zipcodes'] = $this->Zipcode->get_list('','');

            $where1[] = ['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id];
            $content['vehicles'] = $this->Vehicle->get_list('','',$where1);

            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable'],
                        ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id],
                        ['column'=>'cm.start_date','op'=>'<=','value'=>curr_date()],
                        ['column'=>'cm.end_date','op'=>'>=','value'=>curr_date()]
                    ];
            $content['packages'] = $this->Package->get_list('','',$where2);

            $where3 = [['column'=>'a.status','op'=>'=','value'=>'Enable']];
            $content['addOns'] = $this->AddOn->get_list('','',$where3);

            $views["content"] = ["path"=>MEMBER.'book_now',"data"=>$content];
            $layout['page'] = 'book_now';

            $this->layouts->view($views,'member_dashboard',$layout);
        }

        function book_schedule(){
            $content['title_top'] = "Service Bookings";
            $content['title'] = "Book Service";

            $where1[] = ['column'=>'cv.member_id','op'=>'=','value'=>$this->member->id];
            $content['vehicles'] = $this->Vehicle->get_list('','',$where1);

            $where2 = [['column'=>'p.status','op'=>'=','value'=>'Enable'],
                        ['column'=>'cm.customer_id','op'=>'=','value'=>$this->member->id],
                        ['column'=>'cm.start_date','op'=>'<=','value'=>curr_date()],
                        ['column'=>'cm.end_date','op'=>'>=','value'=>curr_date()]
                    ];
            $content['packages'] = $this->Package->get_list('','',$where2);

            $where3 = [['column'=>'a.status','op'=>'=','value'=>'Enable']];
            $content['addOns'] = $this->AddOn->get_list('','',$where3);

            $views["content"] = ["path"=>MEMBER.'book_schedule',"data"=>$content];
            $layout['page'] = 'book_schedule';

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

        public function validationBookSchedule(){
            $this->form_validation->set_rules('location', 'Location', 'required');
            $this->form_validation->set_rules('latitude', 'Latitude', 'required');
            $this->form_validation->set_rules('longitude', 'Longitude', 'required');
            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required');
            $this->form_validation->set_rules('vehicle_id', 'Vehicle', 'required');
            $this->form_validation->set_rules('package_id', 'Package', 'required');
            // $this->form_validation->set_rules('addOn[]', 'Add On', 'required');
            $this->form_validation->set_rules('date_time', 'date Time', 'required');

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

        public function bookScheduleSave(){
            if ($this->Appointment->bookScheduleSave()) {
                $this->session->set_flashdata('success', 'Appointment Booked successfully');
                echo json_encode(['status'=>200]);
            }
        }

        public function view($id){
            $content['title_top'] = "Service Bookings";
            $content['title'] = "Booking";

            $content['form_data'] = $form_data = $this->Appointment->getDataById($id);
            // echo "<pre>";print_r($content);
            // echo "</pre>";
            // exit;

            $views["content"] = ["path"=>MEMBER.'booking_view',"data"=>$content];
            $layout['page'] = 'booking_edit';
            $this->layouts->view($views,'member_dashboard',$layout);

            // if ($this->Appointment->bookNowSave()) {
            //     $this->session->set_flashdata('success', 'Appointment Booked successfully');
            //     echo json_encode(['status'=>200]);
            // }
        }

        function invoice($id = 0){

            $this->load->library('Pdf_Generate');

            $content['form_data'] = $this->Appointment->getDataById($id);
            $content['form_data']->invoice_number = $invoice_number = sprintf("%05d", $content['form_data']->id);

            // echo "<pre>";print_r($content);
            // exit;

            $html = $this->load->view(MEMBER.'invoice_pdf',$content,TRUE);

            // $dataPdf['form_data'] = $this->job->getDataById_invoice($id);
            // $dataPdf['services'] = $this->job->job_request_service($id);
            // $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);
            // $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);
            // $html = $this->load->view(ADMINPATH.'job/invoice_pdf',$dataPdf,TRUE);
            // echo $html;exit;

            $pdf = array(
                "html" => $html,
                "title" => 'invoice',
                "author" => 'invoice',
                "creator" => 'invoice',
                "filename" => 'invoice_'.$invoice_number. '.pdf',
                "badge" => FALSE
            );
            $this->pdf_generate->create_pdf($pdf);
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