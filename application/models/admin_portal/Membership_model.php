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
            $this->db->select('*');
            $this->db->where('package_id',$id);
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