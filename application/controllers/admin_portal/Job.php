<?php

    class Job extends CI_Controller{

        function __construct(){

            parent::__construct();

            $this->load->model(ADMINPATH.'job_model','job');

            $this->load->model(ADMINPATH.'service_model','service');

            $this->load->model(ADMINPATH.'serviceupgrade_model','serviceupgrade');

            $this->load->model(ADMINPATH.'profile_model','profile');

            $this->load->model(ADMINPATH.'serviceprovider_model','sprovider');

            $this->load->library('upload');

            checkLogin('admin');

        }



        function index(){

            $data['job_manage'] = TRUE;

            $data['title']="Service Request";



            // if($this->input->post('action') == "change_publish"){

            //     if ($result = $this->job->st_update()) {

            //         $this->session->set_flashdata('success', 'Service status has been update successfully.');

            //         redirect(ADMINPATH.'job');

            //     }

            // }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){

            //     if ($result = $this->job->delete()) {

            //         $this->session->set_flashdata('success', 'Service deleted successfully.');

            //         redirect(ADMINPATH.'job');

            //     }

            // }

            // elseif ($this->input->post('action') == "deleteselected") {

            //     if ($result = $this->membership->deleteselected()) {

            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');

            //         redirect('membership');

            //     }

            // }

            

            $data['manage_data'] = $this->job->get_job_requests();

            $this->load->view(ADMINPATH.'job/list',$data);

        }



        function add(){

            $data['job_form'] = TRUE;

            $data['action']='add';

            $data['title']="Service Request";

            $data['services'] = $this->service->get_services_active();

            $data['serviceupgrades'] = $this->serviceupgrade->get_services_active();

            $data['request_location'] = request_location();

            $data['notification_preference_list'] = notification_preference_list();

            $data['vehicles'] = $this->profile->get_vehicle();

            $data['last_30_yr'] = get_last_30_yr();



            // echo "<pre>";

            // print_r($data);

            // exit;

            

            $this->load->view(ADMINPATH.'job/add',$data);

        }



        function payment(){

            $data['job_form'] = TRUE;

            $data['action']='payment';

            $data['title']="Service Payment";



            if(isset($_POST['submit'])){



                $_SESSION['service_request'] = $_POST;

                if(isset($_POST['featured_services_upgrades'])){

                    // $this->load->view(ADMINPATH.'job/add',$data); 

                    $services_up = $this->serviceupgrade->getDataByIds($_POST['featured_services_upgrades']);

                    

                    $total = 0;

                    $data['services_list'] = array();

                    foreach($services_up as $key => $service){

                        $total += $service['amount'];



                        $ary = array(

                            'name' => $service['title'],

                            'amount' => $service['amount']

                        );

                        $data['services_list'][] = $ary;

                    }



                    $ary = array(

                        'name' => 'Total',

                        'amount' => $total 

                    );

                    $data['services_list'][] = $ary;



                    // echo "<pre>";print_r($services_list);exit;

                    $_SESSION['service_request']['total'] = $total;

                    $this->load->view(ADMINPATH.'job/payment',$data);

                }else{

                    if ($this->job->insert()) {

                        $this->session->set_flashdata('success', 'Service Request generate successfully.');

                        redirect(ADMINPATH.'job');

                    }

                }



            }



            if(isset($_POST['payment'])){

                $_SESSION['service_request']['payment'] = "Y";

                if ($this->job->insert()) {

                    $this->session->set_flashdata('success', 'Service Request generate successfully.');

                    redirect(ADMINPATH.'job');

                }

            }



        }



        function edit($id = 0){

            $data['job_form'] = TRUE;

            $data['action']="edit";

            $data['title']="Service Request";

            $data['services'] = $this->service->get_services_active();

            $data['serviceupgrades'] = $this->serviceupgrade->get_services_active();

            $data['request_location'] = request_location();

            $data['notification_preference_list'] = notification_preference_list();

            $data['vehicles'] = $this->profile->get_vehicle();

            

            if(isset($_POST['submit'])){

                if ($result = $this->job->update()) {

                    $this->session->set_flashdata('success','Service Request has been update successfully.');

                    redirect(ADMINPATH.'job');

                }

            // }elseif($this->input->post('cancel')){

            //         redirect('job');

            }else{

                // echo $this->uri->segment(3);exit;

                $data['form_data'] = $this->job->getDataById($id);

                $this->load->view(ADMINPATH.'job/edit',$data); 

            }

        }



        function view($id = 0){

            $data['job_view'] = TRUE;

            $data['action'] = "edit";

            $data['title'] = "Service Request";

            // $data['services'] = $this->service->get_services_active();

            // $data['serviceupgrades'] = $this->serviceupgrade->get_services_active();

            // $data['request_location'] = request_location();

            // $data['notification_preference_list'] = notification_preference_list();



            $data['sproviders'] = $this->sprovider->get_sps_active();

            $data['form_data'] = $this->job->getDataById($id);

            

            if(isset($_POST['submit'])){

                if ($result = $this->job->assign_sp()) {

                    $this->session->set_flashdata('success','Request Assign To Service Provider successfully.');

                    redirect(ADMINPATH.'job');

                }

            // }elseif($this->input->post('cancel')){

            //         redirect('job');

            }else{

                // echo $this->uri->segment(3);exit;

                $this->load->view(ADMINPATH.'job/view',$data); 

            }

        }



        function invoice($id = 0){

            $data['job_invoice'] = TRUE;

            $data['action'] = "invoice";

            $data['title'] = "Invoice";



            // $data['sproviders'] = $this->sprovider->get_sps_active();

            $data['form_data'] = $this->job->getDataById_invoice($id);



            $data['services'] = $this->job->job_request_service($id);

            $data['featured_services'] = $this->job->job_request_featured_services($id);



            // echo "<pre>";

            // print_r($data);

            // exit;



            if(isset($_POST['submit'])){

                if ($result = $this->job->assign_sp()) {

                    $this->session->set_flashdata('success','Request Assign To Service Provider successfully.');

                    redirect(ADMINPATH.'job');

                }

            }else{

                // echo $this->uri->segment(3);exit;

                $this->load->view(ADMINPATH.'job/invoice',$data); 

            }

        }



        function download_invoice($id = 0){

            $this->load->library('Pdf_Generate');



            $dataPdf['form_data'] = $this->job->getDataById_invoice($id);

            $dataPdf['services'] = $this->job->job_request_service($id);

            $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);



            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);



            $html = $this->load->view(ADMINPATH.'job/invoice_pdf',$dataPdf,TRUE);

            // $html = $this->load->view('engagementLetter/pdfData',$data,TRUE);

            // echo $html;

            // exit;



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



        function email_invoice($id = 0){



            $this->load->library('Pdf_Generate');

            $dataPdf['form_data'] = $this->job->getDataById_invoice($id);

            $dataPdf['services'] = $this->job->job_request_service($id);

            $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);



            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);



            $html = $this->load->view(ADMINPATH.'job/invoice_pdf',$dataPdf,TRUE);

            // $html = $this->load->view('engagementLetter/pdfData',$data,TRUE);

            // echo $html;

            // exit;



            $pdf = array(

                "html" => $html,

                "title" => 'invoice',

                "author" => 'invoice',

                "creator" => 'invoice',

                "filename" => 'invoice_'.$invoice_number. '.pdf',

                "badge" => FALSE,

                "attach" => TRUE,

                "attachpath" => INVOICE_PATH

            );

            $pdf = $this->pdf_generate->create_pdf($pdf);

            $pdf_file = INVOICE_PATH.$pdf;



            // ===================

            

            $this->load->library('mail');



            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);

            $subject = "Invoice - ".$invoice_number;

            $message = "Thanks For joining toghather with Drip Auto Care.";



            if($this->mail->send_email($dataPdf['form_data']['email'],$subject,$message,$pdf_file)){

                $this->session->set_flashdata('success','Email Send Successfully.');

                redirect(ADMINPATH.'job');

            }else{

                $this->session->set_flashdata('error','Something Wrong. Email Not Sent.');

                redirect(ADMINPATH.'job');

            }



        }



        function get_sp_byServiceId($service_id){

            // echo "<pre>";print_r($_POST);

            // exit;

            $result = $this->job->get_sp_byServiceId($service_id);

            echo json_encode($result); 

        }



        function addVehicle(){

            $data = array();

            $data['member_id'] = $this->session->userdata('id');

            $data['name'] = $_POST['vehicle_name'];

            $data['year'] = $_POST['vehicle_year'];

            $this->db->insert('member_vehicle',$data);



            $vehicles = $this->profile->get_vehicle();



            foreach($vehicles as $val){

            ?>

                <label>

                    <input type="radio" name="vehicle" value="<?php echo $val['member_vehicle_id']; ?>">

                    <?php echo $val['year'].' '.$val['name']; ?>

                </label>

                <br/>

            <?php } ?>

            <div class="radio_err"></div>

            <?php

        }



    }

?>