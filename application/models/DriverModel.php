<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DriverModel extends CI_Model {
    function __construct() {
        $this->table = 'driver';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('d.*');
        $this->db->from('driver as d');
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $branches = (object) [];
        if(!empty($row)){
            $query = $this->db->select('b.*')->from('driver_branch as db')->join('branch as b','b.id=db.branch_id','left')->where('db.driver_id',$row->id)->get();
            $branches = $query->result();
        }
        $row->branches = $branches;
        $row->branch_ids = array_map(function($e) { return is_object($e) ? $e->id : $e['id']; }, $branches);

        // echo $this->db->last_query();
        // echo "<pre>";print_r($row);
        // exit;

        return $row;
    }

    function create(){
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $image_name = "";
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

            $config['file_name'] = $image_name;
            $config['upload_path'] = DRIVER_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
                // exit;
            }
        }

        $driving_license_name = "";
        if(isset($_FILES['driving_license']['name']) && $_FILES['driving_license']['name'] != ""){
            $driving_license_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['driving_license']['name']);

            $config['file_name'] = $driving_license_name;
            $config['upload_path'] = DRIVER_LICENSE_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('driving_license')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
                // exit;
            }
        }

        $data = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'mobile'=>$this->input->post('mobile'),
            'pincode'=>$this->input->post('pincode'),
            'start_time'=>$this->input->post('start_time'),
            'end_time'=>$this->input->post('end_time'),
            'profile'=>$image_name,
            'driving_license'=>$driving_license_name,
            'status'=>$status,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();

        foreach($this->input->post('branch') as $val){
            $data = array(
                'driver_id'=>$id,
                'branch_id'=>$val,
            );
            $this->db->insert('driver_branch',$data);
        }
        
        return $id;
    }

    function update(){
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $image_name = $this->input->post('image_old');
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

            // remove old file
            if(file_exists(DRIVER_IMG.$this->input->post('image_old'))){
                @unlink(DRIVER_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            $config['file_name'] = $image_name;
            $config['upload_path'] = DRIVER_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
                // exit;
            }
        }

        $driving_license_name = $this->input->post('driving_license_old');
        if(isset($_FILES['driving_license']['name']) && $_FILES['driving_license']['name'] != ""){

            // remove old file
            if(file_exists(DRIVER_LICENSE_IMG.$this->input->post('driving_license_old'))){
                @unlink(DRIVER_LICENSE_IMG.$this->input->post('driving_license_old'));
            }
                
            $driving_license_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['driving_license']['name']);
            $config['file_name'] = $driving_license_name;
            $config['upload_path'] = DRIVER_LICENSE_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('driving_license')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
                // exit;
            }
        }

        $data = array(
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'mobile'=>$this->input->post('mobile'),
            'pincode'=>$this->input->post('pincode'),
            'start_time'=>$this->input->post('start_time'),
            'end_time'=>$this->input->post('end_time'),
            'profile'=>$image_name,
            'driving_license'=>$driving_license_name,
            'status'=>$status,
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        $this->db->where('driver_id', $this->input->post('id'));
        $query = $this->db->delete('driver_branch');

        foreach($this->input->post('branch') as $val){
            $data = array(
                'driver_id'=>$this->input->post('id'),
                'branch_id'=>$val,
            );
            $this->db->insert('driver_branch',$data);
        }

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
        if(file_exists(DRIVER_IMG.$row->profile)){
            @unlink(DRIVER_IMG.$row->profile);
        }
        
        if(file_exists(DRIVER_LICENSE_IMG.$row->driving_license)){
            @unlink(DRIVER_LICENSE_IMG.$row->driving_license);
        }

        $this->db->where('driver_id', $this->input->post('id'));
        $this->db->delete('driver_branch');

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