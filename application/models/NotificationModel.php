<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationModel extends CI_Model {
    function __construct() {
        $this->table = 'notification';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('*');
        $this->db->order_by("id", "Desc");
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

        $data = array(
            'sp_id'=>$this->input->post('sp_id'),
            'name'=>$this->input->post('name'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'start_time'=>$this->input->post('start_time'),
            'end_time'=>$this->input->post('end_time'),
            'experience'=>$this->input->post('experience'),
            'description'=>$this->input->post('description'),
            'image'=>$image_name,
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

        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

}