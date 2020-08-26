<?php
    class Serviceupgrade_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='service_upgrade';
        }

        function get_serviceupgrades() {
            $this->db->select('s.*');
            $this->db->from('service_upgrade s');
            $this->db->order_by("service_upgrade_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_services_active() {
            $this->db->select('s.*');
            $this->db->from('service_upgrade s');
            $this->db->where('s.status','Enable');
            $this->db->order_by("service_upgrade_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function getDataById($id){
            $this->db->select('*');
            $this->db->where('service_upgrade_id',$id);
            $query=$this->db->get($this->table);
            $row=$query->row_array();
            return $row;
        }

        function insert(){
            $date = date('Y-m-d h:i:s');
            $data=array(
                'title'=>$this->input->post('title'),
                'description'=>$this->input->post('description'),
                'amount'=>$this->input->post('amount'),
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
            $data=array(
                'title'=>$this->input->post('title'),
                'description'=>$this->input->post('description'),
                'amount'=>$this->input->post('amount'),
                'status'=>$this->input->post('status'),
                'updated_at'=>$date
            );
            $this->db->where('service_upgrade_id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }

        function st_update(){
            $this->db->set('status', $this->input->post('publish'));
            $this->db->where('service_upgrade', $this->input->post('id'));
            if($this->db->update($this->table)){
                // echo $this->db->last_query();
                // echo "dddd";exit;
               return true;
            }else{
                return false;
            }
        }

        function delete(){
            $this->db->where('service_upgrade_id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        
    }
?>