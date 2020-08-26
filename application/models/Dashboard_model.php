<?php
class Dashboard_model extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->table='user';
    }
    function udata(){
        $this->db->select('*');
        $this->db->where("user_id",$this->user->id);
        $query = $this->db->get($this->table);
        if($query->num_rows()>0)
        {
            $udata=$query->row_array();
            return $udata;
        }
    }
    function get_admin(){
        $this->db->select('*');
        $this->db->where('admin_id',$this->session->userdata('id'));	
        $query = $this->db->get('admin');
        $admin = array();

        if ($query->num_rows() > 0) {
                $admin = $query->row_array();
        }
        return $admin;
    }

    function get_total_companies(){
        $this->db->select('count(id) as total');	
        $query = $this->db->get('companies');
        $total = "0";
        if ($query->num_rows() > 0) {
            $total = $query->row('total');
        }
        return $total;
    }

    function get_total_orders(){
        $this->db->select('count(id) as total');	
        $query = $this->db->get('orders');
        $total = "0";
        if ($query->num_rows() > 0) {
            $total = $query->row('total');
        }
        return $total;
    }

}
?>