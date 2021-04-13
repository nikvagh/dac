<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryModel extends CI_Model {
    function __construct() {
        $this->table = 'category';
        $this->primaryKey = 'category_id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('*');
        $this->db->order_by("category_id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get($this->table);

        // $category = array();

        // if ($query->num_rows() > 0) {
            $category = $query->result();
        // }
        return $category;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('category_id',$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    function get_product_data($categoryid){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('category_id',$categoryid);
        $query=$this->db->get();
        $product = array();
        if ($query->num_rows() > 0) {
            $product = $query->result_array();
        }
        return $product; 
    }

    function create(){
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        if($this->input->post('status')){
            $status = '0';
        }else{
            $status = '1';
        }

        $image_name = "";
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

                $config['file_name'] = $image_name;
                $config['upload_path'] = CATEGORY_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'category_name'=>$this->input->post('category_name'),
            'category_description'=>$this->input->post('description'),
            'category_status'=>$status,
            'image'=>$image_name
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        return $id;
    }

    function update(){
        // echo "<pre>";
        // print_r($_POST);
        // exit;

        if($this->input->post('status')){
            $status = '0';
        }else{
            $status = '1';
        }

        $image_name = "";
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

            $config['file_name'] = $image_name;
            $config['upload_path'] = CATEGORY_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        // echo "fff";exit;

        $data = array(
            'category_name'=>$this->input->post('category_name'),
            'category_description'=>$this->input->post('description'),
            'category_status'=>$status,
            'image'=>$image_name
        );
        $this->db->set($data)->where('category_id',$this->input->post('id'));
        $this->db->update($this->table);
        return true;
    }

    function st_update(){
        $this->db->set('category_status', $this->input->post('publish'));
        $this->db->where('category_id', $this->input->post('categoryid'));
        $query=$this->db->update($this->table);
        if($query){
           return true;
        }else{
            return false;
        }
    }

    function delete(){
        
        // $product_data=$this->get_product_data($this->input->post('categoryid'));
        // $pro_images=explode(',', $product_data[0]['product_image']);

        // for ($i = 0; $i < count($pro_images); $i++) {
        //     if (file_exists(PRODUCTPICPATH. $pro_images[$i])){
        //         @unlink(PRODUCTPICPATH. $pro_images[$i]);
        //         $sizes = array(50=>50,253=>285,99=>136);
        //         foreach ($sizes as $key => $val) {
        //             if (PRODUCTPICPATH ."thumb/" . $key. "x" . $val."_".$pro_images[$i]){
        //                 @unlink(PRODUCTPICPATH ."thumb/" . $key . "x" . $val."_".$pro_images[$i]);
        //             }
        //         }
        //     }
        // }

        $this->db->where('category_id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table))
            return true;
        else
            return false;
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