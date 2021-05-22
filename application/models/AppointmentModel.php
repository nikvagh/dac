<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentModel extends CI_Model {
    function __construct() {
        $this->table = 'appointment';
        $this->primaryKey = 'id';
        $this->load->model('PackageModel','Package');
    }

    function get_list($num="", $offset="",$where = [],$where_or = []) {
        $this->db->select('a.*,sp.company_name,cr.id as customer_id,cr.firstname,cr.lastname,ss.status_txt,ss.bgColor,ss.color');
        $this->db->from('appointment as a')
            ->join('customer as cr','cr.id = a.customer_id','left')
            ->join('sp','sp.sp_id = a.sp_id','left')
            ->join('service_status as ss','ss.id = a.status_id','left');

        if(!empty($where)){
            foreach($where as $key=>$val){
                if($val['op'] == "="){
                    $this->db->where($val['column'],$val['value']);
                }
            }
        }
        if(!empty($where_or)){
            foreach($where_or as $key=>$val){
                $this->db->where($val);
            }
        }

        $this->db->order_by("a.id", "Desc");
        // echo "ggg";exit;
        // echo $num; echo $offset; exit;

        if($num != "" || $offset != ""){
            // echo "fff";exit;
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit;

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
        $this->db->select('a.*,
                            sp.sp_id,sp.company_name,cr.id as customer_id,cr.firstname,cr.lastname,
                            p.name as package_name,
                            ss.status_txt')
            ->join('customer as cr','cr.id = a.customer_id','left')
            ->join('sp','sp.sp_id = a.sp_id','left')
            ->join('package as p','p.id = a.package_id','left')
            ->join('service_status as ss','ss.id = a.status_id','left');

        $this->db->where('a.id',$id);
        $query = $this->db->get($this->table.' as a');
        $row = $query->row();

        $services = (object) [];
        $duration = 0; $amount = 0; $service_ids = []; $service_names = [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('appointment_service as as')->join('service as s','s.id=as.service_id','left')->where('as.appointment_id',$row->id)->get();
            $services = $query->result();

            foreach($services as $key=>$val){
                $amount+=$val->amount;
                $duration+=$val->duration;
                $service_ids[] = $val->id;
                $service_names[] = $val->name;
            }
        }

        $row->services = $services;
        $row->service_ids = $service_ids;
        $row->service_names = $service_names;
        $row->duration = $duration;
        $row->amount = $amount;
        // $row->category_ids = array_column($categories,'category_id');

        // echo "<pre>";print_r($row);exit;

        return $row;
    }

    function create(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'location'=>$this->input->post('location'),
            'zipcode'=>$this->input->post('zipcode'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        $package = $this->Package->getDataById($this->input->post('package_id'));
        // print_r($package);exit;
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$id,
                'service_id'=>$val->id
            );
            $this->db->insert('appointment_service',$data);
        }

        return $id;
    }

    function update(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'location'=>$this->input->post('location'),
            'zipcode'=>$this->input->post('zipcode'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // echo $this->db->last_query();
        // exit;

        // ============================

        $this->db->where('service_id', $this->input->post('id'));
        $this->db->delete('appointment_service');


        $package = $this->Package->getDataById($this->input->post('package_id'));
        // print_r($package);
        // exit;
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$this->input->post('id'),
                'service_id'=>$val->id
            );
            $this->db->insert('appointment_service',$data);
        }

        // echo $this->db->last_query();
        // exit;
        return true;
    }

    function dispatch_view_update(){
        // echo "<pre>";print_r($_POST); exit;

        if($this->input->post('sp_id')){
            $data = array('sp_id'=>$this->input->post('sp_id'));
        }

        if($this->input->post('status_id')){
            $data = array('status_id'=>$this->input->post('status_id'));
        }

        if(!empty($data)){
            $this->db->set($data)->where('id',$this->input->post('id'));
            $this->db->update($this->table);
        }

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

    function getTotalCount($sp_id=""){
        $this->db->select("COUNT(id) AS total");
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalPendingCount(){
        $query = $this->db->select("COUNT(id) AS total")->where('status_id',1)->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalSuccessCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',5);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalInProgressCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',4);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
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