<?php
    class Plan_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='plans';
        }

        function get_plans() {
            $this->db->select('pl.*,c.company_name,pr.product_name');
            $this->db->from('plans pl');
            $this->db->join("companies c", "c.id=pl.company_id", "left");
            $this->db->join("products pr", "pr.id=pl.product_id", "left");
            $this->db->order_by("pl.id", "Desc");
            // $this->db->where('status', 'Y');
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }

            // echo "<pre>";print_r($result);exit;
            return $result;
        }

        function getDataById($id){
            $this->db->select('pl.*,c.company_name,pr.product_name');
            $this->db->from('plans pl');
            $this->db->join("companies c", "c.id=pl.company_id", "left");
            $this->db->join("products pr", "pr.id=pl.product_id", "left");
            $this->db->where('pl.id',$id);
            // $this->db->where('pl.status','Y');
            $query=$this->db->get();
            // echo $this->db->last_query();
            $row=$query->row_array();
            return $row;
        }

        function insert(){
            $date = date('Y-m-d h:i:s');
            $data=array(
                'company_id'=>$this->input->post('company_id'),
                'product_id'=>$this->input->post('product_id'),
                'plan_name'=>$this->input->post('plan_name'),
                'code'=>trim($this->input->post('code')),
                'app_type'=>trim($this->input->post('app_type')),
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
            // echo "<pre>";print_r($_POST);exit;
            $date = date('Y-m-d h:i:s');
            $data=array(
                'company_id'=>$this->input->post('company_id'),
                'product_id'=>$this->input->post('product_id'),
                'plan_name'=>$this->input->post('plan_name'),
                'code'=>trim($this->input->post('code')),
                'app_type'=>trim($this->input->post('app_type')),
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