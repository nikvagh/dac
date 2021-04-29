<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleModel extends CI_Model {
    function __construct() {
        $this->table = 'role';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('r.*');
        $this->db->from('role as r');
        $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $key=>$val){
            $query = $this->db->select('p.*')->from('role_permission as rp')->join('permission as p','p.id = rp.permission_id','left')->where('rp.role_id',$val->id)->get();
            $result[$key]->permission = $query->result();
            $result[$key]->texts = array_map(function($e) { return is_object($e) ? $e->text : $e['text']; }, $result[$key]->permission);
            $result[$key]->codes = array_map(function($e) { return is_object($e) ? $e->code : $e['code']; }, $result[$key]->permission);
        }

        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $permissions = (object) [];
        if(!empty($row)){
            $query = $this->db->select('p.*')->from('role_permission as rp')->join('permission as p','p.id = rp.permission_id','left')->where('rp.role_id',$row->id)->get();
            $permissions = $query->result();
        }

        $row->permissions = $permissions;
        $row->permission_ids = array_map(function($e) { return is_object($e) ? $e->id : $e['id']; }, $permissions);
        $row->permission_texts = array_map(function($e) { return is_object($e) ? $e->text : $e['text']; }, $permissions);
        $row->permission_codes = array_map(function($e) { return is_object($e) ? $e->code : $e['code']; }, $permissions);
        return $row;
    }

    function create(){
        // if($this->input->post('status')){
        //     $status = 'Enable';
        // }else{
        //     $status = 'Disable';
        // }

        $data = array(
            'name'=>$this->input->post('name')
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        if(!empty($this->input->post('permissions'))){
            foreach($this->input->post('permissions') as $val){
                $data = array(
                    'role_id'=>$id,
                    'permission_id'=>$val
                );
                $this->db->insert('role_permission',$data);
            }
        }
        return $id;
    }

    function update(){
        // if($this->input->post('status')){
        //     $status = '0';
        // }else{
        //     $status = '1';
        // }

        $data = array(
            'name'=>$this->input->post('name')
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // ============================

        $this->db->where('role_id', $this->input->post('id'));
        $this->db->delete('role_permission');

        if(!empty($this->input->post('permissions'))){
            foreach($this->input->post('permissions') as $val){
                $data = array(
                    'role_id'=>$this->input->post('id'),
                    'permission_id'=>$val
                );
                $this->db->insert('role_permission',$data);
            }
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
        $this->db->where('role_id', $this->input->post('id'));
        $this->db->delete('role_permission');
        
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