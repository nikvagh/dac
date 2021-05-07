<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model {
    function __construct() {
        $this->table = 'customer';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('cr.*');
        $this->db->from('customer as cr');
        // $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
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

        $categories = (object) [];
        if(!empty($row)){
            $query = $this->db->select('c.*')->from('service_category as sc')->join('category as c','c.category_id=sc.category_id','left')->where('sc.service_id',$row->id)->get();
            $categories = $query->result();
        }

        $row->categories = $categories;
        $row->category_ids = array_map(function($e) { return is_object($e) ? $e->category_id : $e['category_id']; }, $categories);
        // $row->category_ids = array_column($categories,'category_id');
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
                $config['upload_path'] = CUSTOMER_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),
            'profile'=>$image_name,
            'status'=>$status,
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
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $image_name = $this->input->post('image_old');
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

            // remove old file
            if(file_exists(CUSTOMER_IMG.$this->input->post('image_old'))){
                @unlink(CUSTOMER_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            
            $config['file_name'] = $image_name;
            $config['upload_path'] = CUSTOMER_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        $data = array(
            'firstname'=>$this->input->post('firstname'),
            'lastname'=>$this->input->post('lastname'),
            'username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'address'=>$this->input->post('address'),
            'profile'=>$image_name,
            'status'=>$status,
        );

        if($this->input->post('password') && $this->input->post('password') != ""){
            $data['password'] = md5($this->input->post('password'));
        }

        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

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
        if(file_exists(CUSTOMER_IMG.$row->profile)){
            @unlink(CUSTOMER_IMG.$row->profile);
        }
        
        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

    function getTotalCount(){
        $query = $this->db->select("COUNT(id) AS total")->from($this->table)->get();
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