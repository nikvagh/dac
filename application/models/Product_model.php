<?php
    class Product_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='products';
        }

        function get_products() {
            $this->db->select('p.*,c.company_name');
            $this->db->from('products p');
            $this->db->join("companies c", "c.id=p.company_id", "left");
            $this->db->order_by("p.id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_companies(){
            $this->db->select('*');
            $this->db->where('status','Y');
            $query = $this->db->get('companies');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_all_products(){
            $this->db->select('*');
            $this->db->where('status','Y');
            $query = $this->db->get('products');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function getDataById($id){
            $this->db->select('*');
            $this->db->where('id',$id);
            $query=$this->db->get($this->table);
            $row=$query->row_array();
            return $row;
        }

        function get_product_by_compnayId($company_id){
            $this->db->select('*');
            $this->db->where('status','Y');
            $this->db->where('company_id',$company_id);
            $query = $this->db->get('products');

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function insert(){
            $date = date('Y-m-d h:i:s');
            $data=array(
                'product_name'=>$this->input->post('product_name'),
                'company_id'=>$this->input->post('company_id'),
                'status'=>$this->input->post('status'),
                'created_at'=>$date
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
                'product_name'=>$this->input->post('product_name'),
                'company_id'=>$this->input->post('company_id'),
                'status'=>$this->input->post('status'),
                'updated_at'=>$date
            );
            $this->db->where('id',$this->input->post('id'));
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
            $this->db->where('id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        
    }
?>