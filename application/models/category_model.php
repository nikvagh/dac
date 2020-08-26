<?php
    class category_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='category';
        }
        function get_category($num, $offset) {
            $this->db->select('*');
            $this->db->order_by("category_id", "Desc");
            $this->db->limit($num, $offset);

            $query = $this->db->get($this->table);

            $category = array();
 
            if ($query->num_rows() > 0) {
                $category = $query->result_array();
            }
            return $category;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("category_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_edit_data($categoryid){
            $this->db->select('*');
            $this->db->where('category_id',$categoryid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
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
        function user_insert(){
            $data=array(
                'category_name'=>$this->input->post('categoryname'),
                'category_description'=>$this->input->post('description'),
                'category_status'=>'1',
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            $data=array(
                'category_name'=>$this->input->post('categoryname'),
                'category_description'=>$this->input->post('description'),
            );
            $this->db->where('category_id',$this->input->post('categoryid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
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
            
            $product_data=$this->get_product_data($this->input->post('categoryid'));

            $pro_images=explode(',', $product_data[0]['product_image']);

            for ($i = 0; $i < count($pro_images); $i++) {
                if (file_exists(PRODUCTPICPATH. $pro_images[$i])){
                    @unlink(PRODUCTPICPATH. $pro_images[$i]);
                    $sizes = array(50=>50,253=>285,99=>136);
                    foreach ($sizes as $key => $val) {
                        if (PRODUCTPICPATH ."thumb/" . $key. "x" . $val."_".$pro_images[$i]){
                            @unlink(PRODUCTPICPATH ."thumb/" . $key . "x" . $val."_".$pro_images[$i]);
                        }
                    }
                }
            }
            $this->db->where('category_id',$product_data[0]['category_id']);
            $query = $this->db->delete('product');

            $this->db->where('category_id', $this->input->post('categoryid'));
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
?>