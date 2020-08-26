<?php
    class Membership_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='package';
        }

        function get_memberships() {
            $this->db->select('p.*,mv.*');
            $this->db->from('package p');
            $this->db->join("membership_validity mv", "mv.membership_validity_id = p.package_validity", "left");
            $this->db->order_by("package_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_membership_active() {
            $this->db->select('p.*,mv.*,group_concat(s.title) as service_list');
            $this->db->from('package p');
            $this->db->join("membership_validity mv", "mv.membership_validity_id = p.package_validity", "left");
            $this->db->join("service s", "find_in_set(s.service_id,p.service_includes) > 0", "left");
            $this->db->where('p.status','Enable');
            $this->db->group_by("p.package_id");
            $this->db->order_by("package_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_current_plan() {
            $this->db->select('mtm.*,p.package_name');
            $this->db->from('membership_to_member mtm');
            $this->db->join("package p", "p.package_id = mtm.package_id", "left");
            // $this->db->where("mtm.end_date >= ", CURDATE()); 
            $this->db->where("date_format(mtm.end_date,'%Y-%m-%d') >= CURDATE()"); 
            
            
            // $this->db->group_by("p.package_id");
            // $this->db->order_by("package_id", "Desc");
            $this->db->limit("1");
            $query = $this->db->get();

            // echo $this->db->last_query();
            // exit;

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
            }
            return $result; 
        }

        function get_membership_validity(){
            $this->db->select('*');
            $this->db->order_by('month','ASC');
            $query = $this->db->get('membership_validity');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }

            return $result;
        }

        function get_all_memberships(){
            $this->db->select('*');
            $this->db->where('status','Y');
            $query = $this->db->get('package');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function getDataById($id){
            $this->db->select('p.*,mv.*');
            $this->db->from('package p');
            $this->db->join("membership_validity mv", "mv.membership_validity_id = p.package_validity", "left");
            $this->db->where('p.package_id',$id);
            $query=$this->db->get($this->table);
            $row=$query->row_array();
            return $row;
        }

        function get_membership_by_compnayId($company_id){
            $this->db->select('*');
            $this->db->where('status','Y');
            $this->db->where('company_id',$company_id);
            $query = $this->db->get('memberships');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function insert(){
            $date = date('Y-m-d h:i:s');
            if(isset($_POST['service_includes'])){
                $service_includes = implode(',',$_POST['service_includes']);
            }
            $data=array(
                'package_name'=>$this->input->post('package_name'),
                'package_description'=>$this->input->post('package_description'),
                'package_amount'=>$this->input->post('package_amount'),
                'package_validity'=>$this->input->post('package_validity'),
                'service_includes'=>$service_includes,
                'status'=>$this->input->post('status')
            );
            if($this->db->insert($this->table,$data)){
                $id=$this->db->insert_id();
                return true;
            }else{
                return false;
            }
        }

        function purchase(){
            // echo "<pre>";print_r($_POST);
            // exit;

            $success = "N";
            $date = date('Y-m-d h:i:s');
            if(isset($_POST['service_includes'])){
                $service_includes = implode(',',$_POST['service_includes']);
            }
            $data_0 = array(
                'member_id'=>$this->session->userdata('id'),
                'vehicle_name'=>$this->input->post('vehicle_name'),
                'model_number'=>$this->input->post('model_number'),
                'number_plate'=>$this->input->post('number_plate'),
                'owner_name'=>$this->input->post('owner_name'),
                'vehicle_note'=>$this->input->post('vehicle_note'),
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name'),
                'phone'=>$this->input->post('phone'),
                'email'=>$this->input->post('email'),
                'address'=>$this->input->post('address'),
                'city'=>$this->input->post('city'),
                'state'=>$this->input->post('state'),
                'country'=>$this->input->post('country'),
                'zip'=>$this->input->post('zip')
            );
            if($this->db->insert('order',$data_0)){
                $order_id=$this->db->insert_id();
                $data_p = array(
                    'order_id'=>$order_id,
                    'package_id'=>$this->input->post('package_id'),
                    'member_id'=>$this->session->userdata('id'),
                    'card_name'=>$this->input->post('card_name'),
                    'card_number'=>$this->input->post('card_number'),
                    'card_cvv'=>$this->input->post('card_cvv'),
                    'card_month'=>$this->input->post('card_month'),
                    'card_year'=>$this->input->post('card_year'),
                    'amount'=>$this->input->post('amount'),
                    'description'=>'membership purchase'
                );
                if($this->db->insert('payment',$data_p)){
                    $payment_id=$this->db->insert_id();

                    $month = $this->input->post('month');
                    $start_date = date('Y-m-d h:i:s');
                    $end_date = date('Y-m-d h:i:s', strtotime("+".$month." months", strtotime($start_date)) );

                    $data_p = array(
                        'package_id'=>$this->input->post('package_id'),
                        'order_id'=>$order_id,
                        'payment_id'=>$payment_id,
                        'member_id'=>$this->session->userdata('id'),
                        'start_date'=>$start_date,
                        'end_date'=>$end_date
                    );
                    if($this->db->insert('membership_to_member',$data_p)){
                        $success = 'Y';
                    }
                }
            }
            if($success == 'Y'){
                return true;
            }else{
                return false;
            }

        }

        function update(){
            $date = date('Y-m-d h:i:s');
            if(isset($_POST['service_includes'])){
                $service_includes = implode(',',$_POST['service_includes']);
            }
            $data=array(
                'package_name'=>$this->input->post('package_name'),
                'package_description'=>$this->input->post('package_description'),
                'package_amount'=>$this->input->post('package_amount'),
                'package_validity'=>$this->input->post('package_validity'),
                'service_includes'=>$service_includes,
                'status'=>$this->input->post('status'),
                'updated_at'=>$date
            );
            $this->db->where('package_id',$this->input->post('id'));
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
            $this->db->where('package_id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        
    }
?>