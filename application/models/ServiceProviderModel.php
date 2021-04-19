<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceProviderModel extends CI_Model {
    function __construct() {
        $this->table = 'sp';
        $this->primaryKey = 'sp_id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('*');
        $this->db->order_by("sp_id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('sp_id',$id);
        $query = $this->db->get($this->table);
        return $query->row();
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
                $config['upload_path'] = SP_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'company_name'=>$this->input->post('company_name'),
            'email'=>$this->input->post('email'),
            'phone_day'=>$this->input->post('phone_day'),
            'status'=>$status,
            'profile'=>$image_name
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
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
            if(file_exists(SP_IMG.$this->input->post('image_old'))){
                @unlink(SP_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            
            $config['file_name'] = $image_name;
            $config['upload_path'] = SP_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        $data = array(
            'company_name'=>$this->input->post('company_name'),
            'email'=>$this->input->post('email'),
            'phone_day'=>$this->input->post('phone_day'),
            'status'=>$status,
            'profile'=>$image_name
        );
        $this->db->set($data)->where('sp_id',$this->input->post('id'));
        $this->db->update($this->table);

        // echo $this->db->last_query();
        // exit;
        return true;
    }

    function st_update(){
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('sp_id', $this->input->post('id'));
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
        if(file_exists(SP_IMG.$row->image)){
            @unlink(SP_IMG.$row->image);
        }

        $this->db->where('sp_id', $this->input->post('id'));
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