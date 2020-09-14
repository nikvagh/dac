<?php
    class Job_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='job';
        }

        function get_jobs() {
            $this->db->select('j.*');
            $this->db->from('job j');
            $this->db->where('j.member_id',$this->session->userdata('id'));
            $this->db->order_by("j.job_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_job_requests() {
            $this->db->select('j.*,mv.name,sp.company_name,js.status_txt');
            $this->db->from('job_request j');
            $this->db->join('member_vehicle mv','mv.member_vehicle_id = j.vehicle','left');
            $this->db->join('job_status js','js.job_status_id = j.status','left');
            $this->db->join('sp','sp.sp_id = j.sp_id','left');
            $this->db->where('j.member_id',$this->session->userdata('id'));
            $this->db->order_by("j.job_request_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_job_requests_book_now() {
            // echo $this->session->userdata('id');
            $this->db->select('j.*,mv.name,sp.company_name,js.status_txt');
            $this->db->from('job_request j');
            $this->db->join('member_vehicle mv','mv.member_vehicle_id = j.vehicle','left');
            $this->db->join('job_status js','js.job_status_id = j.status','left');
            $this->db->join('sp','sp.sp_id = j.sp_id','left');
            $this->db->where('j.member_id',$this->session->userdata('id'));
            $this->db->where('j.schedule_service','N');
            $this->db->order_by("j.job_request_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_job_requests_schedule() {
            $this->db->select('j.*,mv.name,sp.company_name,js.status_txt');
            $this->db->from('job_request j');
            $this->db->join('member_vehicle mv','mv.member_vehicle_id = j.vehicle','left');
            $this->db->join('job_status js','js.job_status_id = j.status','left');
            $this->db->join('sp','sp.sp_id = j.sp_id','left');
            $this->db->where('j.member_id',$this->session->userdata('id'));
            $this->db->where('j.schedule_service','Y');
            $this->db->order_by("j.job_request_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function getDataById($id){
            $this->db->select('j.*,j.created_at as request_date,mv.*,js.status_txt,sp.sp_id,sp.company_name,group_concat(DISTINCT(s.title)) as service_need_str,group_concat(DISTINCT(su.title)) as featured_services_upgrades_str');
            // $this->db->select('j.*,j.created_at as request_date,mv.*,js.status_txt,sp.sp_id,sp.company_name,group_concat(DISTINCT(s.title) SEPARATOR "<br>") as service_need_str,group_concat(DISTINCT(su.title), " - $ ", FORMAT(su.amount,2) SEPARATOR "<br/>") as featured_services_upgrades_str');
            
            // $this->db->select('j.*,mv.*,group_concat(s.title) as service_need_str,group_concat(su.title , " - $ ", FORMAT(su.amount,2) SEPARATOR "<br/>") as featured_services_upgrades_str');
            $this->db->from('job_request j');
            $this->db->join('member_vehicle mv','mv.member_vehicle_id = j.vehicle','left');
            $this->db->join('sp','sp.sp_id = j.sp_id','left');
            $this->db->join('service s','find_in_set(s.service_id,j.services_need) > 0','left');
            $this->db->join('service_upgrade su','find_in_set(su.service_upgrade_id,j.featured_services_upgrades) > 0','left');
            $this->db->join('job_status js','js.job_status_id = j.status','left');
            $this->db->where('j.job_request_id',$id);
            $this->db->group_by('j.job_request_id');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;
            
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
            }
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // exit;
            return $result;
        }

        function getStatusDataTrack($id){
            $this->db->select('jsc.*,js.status_txt');
            $this->db->from('job_status_change jsc');
            $this->db->join('job_status js','js.job_status_id = jsc.status','left');
            $this->db->where('jsc.job_request_id',$id);
            // $this->db->group_by('j.job_request_id');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;
            
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // exit;
            return $result;
        }

        function insert(){
            $data = array();

            $service_req = $_SESSION['service_request'];

            // echo "<pre>";
            // print_r($service_req);
            // print_r($_SESSION);
            // echo "</pre>";
            // exit;

            $success = "N";
            
            $data['member_id'] = $this->session->userdata('id');
            $data['location'] = $service_req['location'];

            $use_phone_or_not = 'N';
            if(isset($service_req['use_phone_or_not'])){
                $use_phone_or_not = 'Y';
            }
            $data['use_phone_or_not'] = $use_phone_or_not;
            
            $data['time'] = $service_req['time'];

            $data['notification_preference'] = $service_req['notification_preference'];
            $data['vehicle'] = $service_req['vehicle'];
            $data['with_vehicle_or_not'] = $service_req['with_vehicle_or_not'];

            if(isset($service_req['not_with_vehicle_note'])){
                $data['not_with_vehicle_note'] = $service_req['not_with_vehicle_note'];
            }

            $services_need = "";
            if(isset($service_req['services_need'])){
                $services_need = implode(',',$service_req['services_need']);
            }
            $data['services_need'] = $services_need;

            $featured_services_upgrades = "";
            if(isset($service_req['featured_services_upgrades'])){
                $featured_services_upgrades = implode(',',$service_req['featured_services_upgrades']);
            }
            $data['featured_services_upgrades'] = $featured_services_upgrades;

            $data['additional_note'] = $service_req['additional_note'];

            if($this->db->insert('job_request',$data)){
                $id = $this->db->insert_id();

                if(check_for_credit()){
                    $this->db->set('wallet_credit', 'wallet_credit+5', FALSE);
                    $this->db->where('member_id', $_SESSION['loginData']->refer_from);
                    $this->db->update('member');

                    $this->db->set('refer_valid_paid', 'N');
                    $this->db->where('member_id', $_SESSION['loginData']->member_id);
                    $this->db->update('member');

                    update_member_login_array();
                }

                if(isset($service_req['payment'])){
                    $pay_data = array();
                    $pay_data['job_request_id'] = $id;
                    $pay_data['member_id'] = $this->session->userdata('id');
                    $pay_data['location'] = $service_req['location'];
                    $pay_data['services'] = $featured_services_upgrades;
                    $pay_data['fee'] = $service_req['fee'];
                    $pay_data['payeble_amount'] = $service_req['total'];
                    if($this->db->insert('service_payment',$pay_data)){
                        $success = "Y";
                    }
                }else{
                    $success = "Y";
                }
            }

            if($success == "Y"){
                unset($_SESSION['service_request']);
                return true;
            }else{
                return false;
            }
        }

        function add_schedule(){
            $date = date('Y-m-d H:i:s');

            // $service_req = $_SESSION['service_request'];
            // echo "<pre>";
            // print_r($service_req);
            // echo "</pre>";
            // exit;

            $success = "N";
            
            $data['member_id'] = $this->session->userdata('id');
            $data['schedule_datetime'] = $this->session->userdata('schedule_datetime');
            $data['created_at'] = $date;
            $data['schedule_service'] = 'Y';

            // $data['location'] = $service_req['location'];

            // $use_phone_or_not = 'N';
            // if(isset($service_req['use_phone_or_not'])){
            //     $use_phone_or_not = 'Y';
            // }
            // $data['use_phone_or_not'] = $use_phone_or_not;

            // $data['notification_preference'] = $service_req['notification_preference'];
            // $data['vehicle'] = $service_req['vehicle'];
            // $data['with_vehicle_or_not'] = $service_req['with_vehicle_or_not'];

            // if(isset($service_req['not_with_vehicle_note'])){
            //     $data['not_with_vehicle_note'] = $service_req['not_with_vehicle_note'];
            // }

            // $services_need = "";
            // if(isset($service_req['services_need'])){
            //     $services_need = implode(',',$service_req['services_need']);
            // }
            // $data['services_need'] = $services_need;

            // $featured_services_upgrades = "";
            // if(isset($service_req['featured_services_upgrades'])){
            //     $featured_services_upgrades = implode(',',$service_req['featured_services_upgrades']);
            // }
            // $data['featured_services_upgrades'] = $featured_services_upgrades;

            // $data['additional_note'] = $service_req['additional_note'];

            if($this->db->insert("job_request",$data)){
                return true;
            }else{
                return false;
            }
        }

        function update(){
            $date = date('Y-m-d h:i:s');
            $data=array(
                'location'=>$this->input->post('location'),
                'latitude'=>$this->input->post('latitude'),
                'longitude'=>$this->input->post('longitude'),
                'zipcode'=>$this->input->post('zipcode'),
                'service_id'=>$this->input->post('service_id'),
                'sp_id'=>$this->input->post('sp_id'),
                'service_date'=>$this->input->post('service_date')
            );
            $this->db->where('job_id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }

        function st_update(){
            $this->db->set('status', $this->input->post('publish'));
            $this->db->where('id', $this->input->post('id'));
            if($this->db->update($this->table)){
                // echo $this->db->last_query();
                // echo "dddd";exit;
               return true;
            }else{
                return false;
            }
        }

        function delete(){
            $this->db->where('service_id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }

        function get_sp_byServiceId($service_id){

            // echo $service_id;
            // exit;
            
            $this->db->select('sp.*');
            $this->db->from('sp');
            $this->db->where("find_in_set(".$service_id.",sp.service_provide) > 0");
            $this->db->where('sp.status','Enable');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }

            return $result;
        }

        function getDataById_invoice($id){
            $this->db->select('j.*,mv.*,js.status_txt,sp.sp_id,sp.company_name,group_concat(DISTINCT(s.title)) as service_need_str,group_concat(DISTINCT(su.title)) as featured_services_upgrades_str,m.firstname,m.lastname,m.email,sp1.fee,sp1.payeble_amount');
            // $this->db->select('j.*,mv.*,js.status_txt,sp.sp_id,sp.company_name,group_concat(DISTINCT(s.title) SEPARATOR "<br>") as service_need_str,group_concat(DISTINCT(su.title), " - $ ", FORMAT(su.amount,2) SEPARATOR "<br/>") as featured_services_upgrades_str');
            // $this->db->select('j.*,mv.*,group_concat(s.title) as service_need_str,group_concat(su.title , " - $ ", FORMAT(su.amount,2) SEPARATOR "<br/>") as featured_services_upgrades_str');
            $this->db->from('job_request j');
            $this->db->join('member m','m.member_id = j.member_id','left');
            $this->db->join('member_vehicle mv','mv.member_vehicle_id = j.vehicle','left');
            $this->db->join('sp','sp.sp_id = j.sp_id','left');
            $this->db->join('service s','find_in_set(s.service_id,j.services_need) > 0','left');
            $this->db->join('service_upgrade su','find_in_set(su.service_upgrade_id,j.featured_services_upgrades) > 0','left');
            $this->db->join('job_status js','js.job_status_id = j.status','left');
            $this->db->join('service_payment sp1','sp1.job_request_id = j.job_request_id','left');
            $this->db->where('j.job_request_id',$id);
            $this->db->group_by('j.job_request_id');
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;
            
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
            }
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // exit;
            return $result;
        }

        function job_request_service($id){
            $this->db->select('s.title');
            $this->db->from('job_request j');
            $this->db->join('service s','find_in_set(s.service_id,j.services_need) > 0','left');
            $this->db->where('j.job_request_id',$id);
            $this->db->where('j.services_need != "" ');
            $this->db->group_by('s.service_id');
            $query = $this->db->get();
            
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }

            return $result;
        }

        function job_request_featured_services($id){
            $this->db->select('su.title,su.amount');
            $this->db->from('job_request j');
            $this->db->join('service_upgrade su','find_in_set(su.service_upgrade_id,j.featured_services_upgrades) > 0','left');
            $this->db->where('j.job_request_id',$id);
            $this->db->where('j.featured_services_upgrades != "" ');
            $this->db->group_by('su.service_upgrade_id');
            $query = $this->db->get();
            
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }

            return $result;
        }
        
    }
?>