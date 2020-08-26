<?php
    class Job extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(SPPATH.'job_model','job');
            $this->load->model(SPPATH.'service_model','service');
            $this->load->model(SPPATH.'serviceupgrade_model','serviceupgrade');
            $this->load->model(SPPATH.'profile_model','profile');
            $this->load->model(SPPATH.'serviceprovider_model','sprovider');
            $this->load->library('upload');
            checkLogin('sp');
        }

        function index(){
            $data['job_manage'] = TRUE;
            $data['title']="Service Request";

            // if($this->input->post('action') == "change_publish"){
            //     if ($result = $this->job->st_update()) {
            //         $this->session->set_flashdata('success', 'Service status has been update successfully.');
            //         redirect(SPPATH.'job');
            //     }
            // }elseif(isset($_POST['action']) && $_POST['action'] == "delete"){
            //     if ($result = $this->job->delete()) {
            //         $this->session->set_flashdata('success', 'Service deleted successfully.');
            //         redirect(SPPATH.'job');
            //     }
            // }
            // elseif ($this->input->post('action') == "deleteselected") {
            //     if ($result = $this->membership->deleteselected()) {
            //         $this->session->set_flashdata('notification', 'categoty has been deleted successfully.');
            //         redirect('membership');
            //     }
            // }
            
            $data['manage_data'] = $this->job->get_job_requests();
            $this->load->view(SPPATH.'job/list',$data);
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
            
            $this->load->view(SPPATH.'job/add',$data);
        }

        function payment(){
            $data['job_form'] = TRUE;
            $data['action']='payment';
            $data['title']="Service Payment";

            if(isset($_POST['submit'])){

                $_SESSION['service_request'] = $_POST;
                if(isset($_POST['featured_services_upgrades'])){
                    // $this->load->view(SPPATH.'job/add',$data); 
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
                    $this->load->view(SPPATH.'job/payment',$data);
                }else{
                    if ($this->job->insert()) {
                        $this->session->set_flashdata('success', 'Service Request generate successfully.');
                        redirect(SPPATH.'job');
                    }
                }

            }

            if(isset($_POST['payment'])){
                $_SESSION['service_request']['payment'] = "Y";
                if ($this->job->insert()) {
                    $this->session->set_flashdata('success', 'Service Request generate successfully.');
                    redirect(SPPATH.'job');
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
                    redirect(SPPATH.'job');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                $data['form_data'] = $this->job->getDataById($id);
                $this->load->view(SPPATH.'job/edit',$data); 
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
            
            if(isset($_POST['Dispatch']) || isset($_POST['Progress']) || isset($_POST['Delivery']) || isset($_POST['Confirm']) ){
                if ($result = $this->job->chnange_status()) {
                    $this->session->set_flashdata('success','Job Status Changed successfully.');
                    redirect(SPPATH.'job');
                }
            // }
            // }elseif($this->input->post('cancel')){
            //         redirect('job');
            }else{
                // echo $this->uri->segment(3);exit;
                $this->load->view(SPPATH.'job/view',$data); 
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