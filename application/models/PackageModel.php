<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PackageModel extends CI_Model {
    function __construct() {
        $this->table = 'package';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('s.*');
        $this->db->from('package as s');
        $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $key=>$val){
            $query = $this->db->select('s.*')->from('package_service as ps')->join('service as s','s.id=ps.service_id','left')->where('ps.service_id',$val->id)->get();
            $result[$key]->services = $query->result();
            $result[$key]->service_names = array_map(function($e) { return is_object($e) ? $e->name : $e['name']; }, $result[$key]->services );
        }

        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $services = (object) [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('package_service as ps')->join('service as s','s.id=ps.service_id','left')->where('ps.service_id',$row->id)->get();
            $services = $query->result();
        }

        $row->services = $services;
        $row->services_ids = array_map(function($e) { return is_object($e) ? $e->name : $e['name']; }, $services);
        return $row;
    }

    function create(){
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $image_name = "";
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

                $config['file_name'] = $image_name;
                $config['upload_path'] = PACKAGE_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'name'=>$this->input->post('name'),
            'amount'=>$this->input->post('amount'),
            'duration'=>$this->input->post('duration'),
            'description'=>$this->input->post('description'),
            'image'=>$image_name,
            'status'=>$status,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        foreach($this->input->post('categories') as $val){
            $data = array(
                'package_id'=>$id,
                'category_id'=>$val
            );
            $this->db->insert('package_category',$data);
        }

        
        return $id;
    }

    function update(){
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        if($this->input->post('status')){
            $status = '0';
        }else{
            $status = '1';
        }

        $image_name = $this->input->post('image_old');
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

            // remove old file
            if(file_exists(PACKAGE_IMG.$this->input->post('image_old'))){
                @unlink(PACKAGE_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            
            $config['file_name'] = $image_name;
            $config['upload_path'] = PACKAGE_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        $data = array(
            'name'=>$this->input->post('name'),
            'amount'=>$this->input->post('amount'),
            'duration'=>$this->input->post('duration'),
            'description'=>$this->input->post('description'),
            'image'=>$image_name,
            'status'=>$status,
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // ============================

        $this->db->where('package_id', $this->input->post('id'));
        $this->db->delete('package_category');

        foreach($this->input->post('categories') as $val){
            $data = array(
                'package_id'=>$this->input->post('id'),
                'category_id'=>$val
            );
            $this->db->insert('package_category',$data);
        }

        // echo $this->db->last_query();
        // exit;
        return true;
    }

    function st_update(){
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->update($this->table);

        if($query){
           return true;
        }else{
            return false;
        }
    }

    function delete(){
        $row = $this->getDataById($this->input->post('id'));

        // remove old file
        if(file_exists(PACKAGE_IMG.$row->image)){
            @unlink(PACKAGE_IMG.$row->image);
        }

        $this->db->where('package_id', $this->input->post('id'));
        $this->db->delete('package_category');
        
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