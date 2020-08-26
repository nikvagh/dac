<?php
    class Service_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='service';
        }

        function get_services() {
            $this->db->select('s.*');
            $this->db->from('service s');
            $this->db->order_by("service_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_services_active() {
            $this->db->select('s.*');
            $this->db->from('service s');
            $this->db->where('s.status','Enable');
            $this->db->order_by("service_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }
        
    }
?>