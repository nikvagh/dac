<?php
    class Job extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'job_model','job');
            $this->load->model(MEMBERPATH.'service_model','service');
            $this->load->model(MEMBERPATH.'serviceupgrade_model','serviceupgrade');
            $this->load->model(MEMBERPATH.'profile_model','profile');
            $this->load->library('upload');
            checkLogin('member');
        }

        function index(){
            $data['job_manage'] = TRUE;
            $data['title']="Service Request";

            // if($this->input->post('action') == "change_publish"){
            //     if ($result = $this->job->st_update()) {
            //         $this->session->set_flashdata('success', 'Service status has been update successfully.');
            //         redirect(MEMBERPATH.'job');
            //     }
            // }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
            //     if ($result = $this->job->delete()) {
            //         $this->session->set_flashdata('success', 'Service deleted successfully.');
            //         redirect(MEMBERPATH.'job');
            //     }
            // }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['manage_data_1'] = $this->job->get_job_requests_book_now();
            $data['manage_data_2'] = $this->job->get_job_requests_schedule();
            $this->load->view(MEMBERPATH.'job/list',$data);
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
            
            $this->load->view(MEMBERPATH.'job/add',$data);
        }

        function schedule_service(){
            $data['job_form'] = TRUE;
            $data['action'] = 'add';
            $data['title'] = "Schedule Service";

            // echo "<pre>";
            // print_r($data);
            // exit;
            
            $this->load->view(MEMBERPATH.'job/schedule_service_add',$data);
        }

        function add_schedule(){
            $data['job_form'] = TRUE;
            $data['action']="edit";
            $data['title']="Service Request";
            
            if(isset($_POST['submit'])){
                if ($result = $this->job->add_schedule()) {
                    $this->session->set_flashdata('success','Service Request has been update successfully.');
                    redirect(MEMBERPATH.'job');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                // $data['form_data'] = $this->job->getDataById($id);
                // $this->load->view(MEMBERPATH.'job/schedule_service',$data); 
            }
        }

        function payment(){
            $data['job_form'] = TRUE;
            $data['action']='payment';
            $data['title']="Service Payment";

            if(isset($_POST['submit'])){

                $_SESSION['service_request'] = $_POST;
                if(isset($_POST['featured_services_upgrades'])){
                    // $this->load->view(MEMBERPATH.'job/add',$data); 
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

                    $fee = 7;
                    if($fee > 0){

                        $ary = array(
                            'name' => 'Additional Fee',
                            'amount' => $fee 
                        );
                        $data['services_list'][] = $ary;

                        $total = $total + $fee;
                    }

                    $ary = array(
                        'name' => 'Total',
                        'amount' => $total 
                    );
                    $data['services_list'][] = $ary;

                    // echo "<pre>";print_r($services_list);exit;
                    $_SESSION['service_request']['fee'] = $fee;
                    $_SESSION['service_request']['total'] = $total;
                    $this->load->view(MEMBERPATH.'job/payment',$data);
                }else{
                    if ($this->job->insert()) {
                        $this->session->set_flashdata('success', 'Service Request generate successfully.');
                        redirect(MEMBERPATH.'job');
                    }
                }

            }

            if(isset($_POST['payment'])){
                $_SESSION['service_request']['payment'] = "Y";
                if ($this->job->insert()) {
                    $this->session->set_flashdata('success', 'Service Request generate successfully.');
                    redirect(MEMBERPATH.'job');
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
                    redirect(MEMBERPATH.'job');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->job->getDataById($id);
                $this->load->view(MEMBERPATH.'job/edit',$data); 
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

            // $data['sproviders'] = $this->sprovider->get_sps_active();
            $data['form_data'] = $this->job->getDataById($id);

            // echo "<pre>";print_r($data['form_data']);
            // echo "</pre>";
            // exit;
            
            if(isset($_POST['submit'])){
                if ($result = $this->job->assign_sp()) {
                    $this->session->set_flashdata('success','Request Assign To Service Provider successfully.');
                    redirect(MEMBERPATH.'job');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                $this->load->view(MEMBERPATH.'job/view',$data); 
            }
        }

        function track($id = 0){
            $data['job_view'] = TRUE;
            $data['action'] = "edit";
            $data['title'] = "Service Request";
            $data['form_data'] = $this->job->getDataById($id);
            $data['status_data'] = $this->job->getStatusDataTrack($id);

            // echo "<pre>";print_r($data['form_data']);
            // echo "</pre>";
            // exit;
            
            if(isset($_POST['submit'])){
                // if ($result = $this->job->assign_sp()) {
                //     $this->session->set_flashdata('success','Request Assign To Service Provider successfully.');
                //     redirect(MEMBERPATH.'job');
                // }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                $this->load->view(MEMBERPATH.'job/track',$data); 
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

                    redirect(MEMBERPATH.'job');

                }

            }else{

                // echo $this->uri->segment(3);exit;
                $this->load->view(MEMBERPATH.'job/invoice',$data); 

            }

        }



        function download_invoice($id = 0){

            $this->load->library('Pdf_Generate');

            $dataPdf['form_data'] = $this->job->getDataById_invoice($id);
            $dataPdf['services'] = $this->job->job_request_service($id);
            $dataPdf['featured_services'] = $this->job->job_request_featured_services($id);

            $invoice_number = sprintf("%05d", $dataPdf['form_data']['job_request_id']);

            $html = $this->load->view(MEMBERPATH.'job/invoice_pdf',$dataPdf,TRUE);

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

    }
?>