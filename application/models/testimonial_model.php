<?php
    class testimonial_model extends CI_Model{
        function testimonial_model(){
            parent::__construct();
            $this->table='testimonial';
        }
        function get_testimonial($num, $offset) {
        $this->db->select('*');
        $this->db->order_by("testimonial_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $news = array();
            if ($query->num_rows() > 0) {
                $news = $query->result_array();
            }
            return $news;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("testimonial_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_edit_data($testimonialid){
            $this->db->select('*');
            $this->db->where('testimonial_id',$testimonialid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function testimonial_insert(){
            $data=array(
                'testimonial_name'=>$this->input->post('testimonialname'),
                'testimonial_msg'=>$this->input->post('msg'),
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            $data=array(
                'testimonial_name'=>$this->input->post('testimonialname'),
                'testimonial_msg'=>$this->input->post('msg'),
            );
            $this->db->where('testimonial_id',$this->input->post('testimonialid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        function st_update(){
            $this->db->set('testimonial_status', $this->input->post('publish'));
            $this->db->where('testimonial_id', $this->input->post('testimonialid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        function delete(){
            $testimonialid = $this->get_edit_data($this->input->post('testimonialid'));   
            $this->db->where('testimonial_id', $this->input->post('testimonialid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $productid = $this->get_edit_data($arrProduct[$m]);
            }

            $this->db->where_in('testimonial_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>