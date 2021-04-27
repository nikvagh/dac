<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationTemplateModel extends CI_Model {
    function __construct() {
        $this->table = 'notification_template';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('*');
        // $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    function create(){
        // echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $notification_ids = [];
        foreach($this->input->post('users') as $key=>$val){
            $data = array(
                'title'=>$this->input->post('title'),
                'message'=>$this->input->post('message'),
                'user_id'=>$val
            );
            $this->db->insert($this->table,$data);
            $notification_ids[] = $this->db->insert_id();
        }

        if(!empty($notification_ids)){
            return true;
        }
    }

    function update(){
        // echo "<pre>"; print_r($_POST); print_r($_FILES); exit;

        $data = array(
            'title'=>$this->input->post('title'),
            'subject'=>$this->input->post('subject'),
            'notification_content'=>$this->input->post('notification_content'),
            'mail_content'=>$this->input->post('mail_content')
        );

        $this->db->set($data)->where('heading_code',$this->input->post('heading_code'));
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
        $row = $this->getDataById($this->input->post('id'));

        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

}