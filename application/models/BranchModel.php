<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BranchModel extends CI_Model {
    function __construct() {
        $this->table = 'branch';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="",$where = []) {
        $this->db->select('b.*,z.name as zone_name');
        $this->db->from('branch as b')->join('zone as z','z.id=b.zone_id','left');
        // $this->db->order_by("id", "Desc");
        
        if(!empty($where)){
            foreach($where as $key=>$val){
                if($val['op'] == "="){
                    $this->db->where($val['column'],$val['value']);
                }
            }
        }

        $query = $this->db->get();
        $result = $query->result();
        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();
        return $row;
    }

    function create(){
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $data = array(
            'zone_id'=>$this->input->post('zone_id'),
            'name'=>$this->input->post('name'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'),
            'radius'=>$this->input->post('radius'),
            'mobile'=>$this->input->post('mobile'),
            'status'=>$status,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        
        return $id;
    }

    function update(){
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $data = array(
            'zone_id'=>$this->input->post('zone_id'),
            'name'=>$this->input->post('name'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'),
            'radius'=>$this->input->post('radius'),
            'mobile'=>$this->input->post('mobile'),
            'status'=>$status,
        );

        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);
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
        // $row = $this->getDataById($this->input->post('id'));
        
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