<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentModel extends CI_Model {
    function __construct() {
        $this->table = 'appointment';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('a.*,sp.company_name,u.id as user_id,u.firstname,u.lastname');
        $this->db->from('appointment as a')
            ->join('user as u','u.id = a.user_id','left')
            ->join('sp','sp.sp_id = a.sp_id','left')
            ->join('category as c','c.category_id = a.category_id','left');
        $this->db->order_by("a.id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $key=>$val){

            $query = $this->db->select('s.*')->from('appointment_service as as')->join('service as s','s.id=as.service_id','left')->where('as.appointment_id',$val->id)->get();
            $result[$key]->services = $query->result();
            $result[$key]->service_names = array_map(function($e) { return is_object($e) ? $e->name : $e['name']; }, $result[$key]->services);

            $duration = 0; $amount = 0;
            foreach($result[$key]->services as $key1=>$val1){
                $amount+= $val1->amount;
                $duration+= $val1->duration;
            }
            $result[$key]->amount = $amount;
            $result[$key]->duration = $duration;
        }

        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('a.*')
            ->join('user as u','u.id = a.user_id','left')
            ->join('sp','sp.sp_id = a.sp_id','left')
            ->join('category as c','c.category_id = a.category_id','left');
        $this->db->where('a.id',$id);
        $query = $this->db->get($this->table.' as a');
        $row = $query->row();

        $services = (object) [];
        $duration = 0; $amount = 0; $service_ids = [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('appointment_service as as')->join('service as s','s.id=as.service_id','left')->where('as.appointment_id',$row->id)->get();
            $services = $query->result();

            foreach($services as $key=>$val){
                $amount+=$val->amount;
                $duration+=$val->duration;
                $service_ids[] = $val->id;
            }
        }

        $row->services = $services;
        $row->service_ids = $service_ids;
        $row->duration = $duration;
        $row->amount = $amount;
        // $row->category_ids = array_column($categories,'category_id');
        return $row;
    }

    function create(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'user_id'=>$this->input->post('user_id'),
            'category_id'=>$this->input->post('category_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        foreach($this->input->post('services') as $val){
            $data = array(
                'appointment_id'=>$id,
                'service_id'=>$val
            );
            $this->db->insert('appointment_service',$data);
        }

        
        return $id;
    }

    function update(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'user_id'=>$this->input->post('user_id'),
            'category_id'=>$this->input->post('category_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // ============================

        $this->db->where('service_id', $this->input->post('id'));
        $this->db->delete('appointment_service');

        foreach($this->input->post('services') as $val){
            $data = array(
                'appointment_id'=>$this->input->post('id'),
                'service_id'=>$val
            );
            $this->db->insert('appointment_service',$data);
        }

        // echo $this->db->last_query();
        // exit;
        return true;
    }

    function st_update(){
        $this->db->set('status_id', $this->input->post('publish'));
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->update($this->table);

        // echo $this->db->last_query();
        // exit;

        if($query){
           return true;
        }else{
            return false;
        }
    }

    function delete(){
        $row = $this->getDataById($this->input->post('id'));

        $this->db->where('appointment_id', $this->input->post('id'));
        $this->db->delete('appointment_service');
        
        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }
    
    function deleteselected(){
        
        $arrcat = $this->input->post('u_list');

        for ($m = 0; $m < count($arrcat); $m++) {
            
            $product_data=$this->get_product_data($arrcat[$m]);
            
            for ($n = 0; $n < count($product_data); $n++) {
                $pro_images=explode(',', $product_data[$n]['product_image']);
                
                for ($i = 0; $i < count($pro_images); $i++) {
                    echo PRODUCTPICPATH. $pro_images[$i];
                    if (file_exists(PRODUCTPICPATH. $pro_images[$i])){

                        @unlink(PRODUCTPICPATH . $pro_images[$i]);
                        $sizes = array(50=>50,253=>285,99=>136);
                        foreach ($sizes as $key => $val) {
                            if (PRODUCTPICPATH ."thumb/" . $key. "x" . $val."_".$pro_images[$i]){
                                @unlink(PRODUCTPICPATH ."thumb/" . $key . "x" . $val."_".$pro_images[$i]);
                            }
                        }
                    }
                }
                $this->db->where('category_id',$product_data[$n]['category_id']);
                $query = $this->db->delete('product');
            }
           
        }
        
        $this->db->where_in('category_id', $this->input->post('u_list'));
        if ($query = $this->db->delete($this->table))
            return true;
        else
            return false;
    }
}