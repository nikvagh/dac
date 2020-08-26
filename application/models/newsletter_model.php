<?php
    class newsletter_model extends CI_Model{
        function newsletter_model(){
            parent::__construct();
            $this->table='newsletter';
        }
        function get_newsletter($num, $offset) {
        $this->db->select('*');

        $this->db->order_by("newsletter_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $newsletter = array();
 
            if ($query->num_rows() > 0) {
                $newsletter = $query->result_array();
            }
                return $newsletter;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("newsletter_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }

        function get_edit_data($newsletterid){
            $this->db->select('*');
            $this->db->where('newsletter_id',$newsletterid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function newsletter_insert(){
            $data=array(
                'newsletter_email'=>$this->input->post('nemail'),
                'newsletter_status'=>'1',
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            $data=array(
                'newsletter_email'=>$this->input->post('nemail'),
            );
           // print_r($data);exit;
            $this->db->where('newsletter_id',$this->input->post('newsletterid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        function st_update(){
            $this->db->set('newsletter_status', $this->input->post('publish'));
            $this->db->where('newsletter_id', $this->input->post('newsletterid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        function delete(){
            $newsletterid = $this->get_edit_data($this->input->post('newsletterid'));   
            $this->db->where('newsletter_id', $this->input->post('newsletterid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $newsletterid = $this->get_edit_data($arrProduct[$m]);
            }

            $this->db->where_in('newsletter_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>