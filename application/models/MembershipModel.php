<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MembershipModel extends CI_Model {
    function __construct() {
        $this->table = 'customer_membership';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="",$where = [], $isTotalQuery = 'N') {
        $query = $this->list_query($num,$offset,$where);

        if($isTotalQuery == 'N'){
            $result = $query->result();
            foreach($result as $key=>$val){
                $result[$key]->validity_status = get_membership_validity_status($val->start_date,$val->end_date);
            }
            return $result;
        }else{
            $result = $query->num_rows();
            return $result;
        }
    }

    function list_query($num="", $offset="",$where = []){
        $this->db->select('cm.*,c.firstname,c.lastname,c.username,c.email,c.phone,p.name as package_name,p.validity');
        $this->db->from('customer_membership as cm');
        $this->db->join('customer c','c.id=cm.customer_id','left')
                ->join('package as p','p.id=cm.package_id','left');
        $this->db->order_by("cm.id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        if(!empty($where)){
            foreach($where as $key=>$val){
                if($val['op'] == "="){
                    $this->db->where($val['column'],$val['value']);
                }
            }
        }

        if($num != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        return $query;
    }


    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $services = (object) [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('membership_service as ps')->join('service as s','s.id=ps.service_id','left')->where('ps.membership_id',$row->id)->get();
            $services = $query->result();
        }

        $row->services = $services;
        $row->services_ids = array_map(function($e) { return is_object($e) ? $e->id : $e['id']; }, $services);
        return $row;
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
                $config['upload_path'] = PACKAGE_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'name'=>$this->input->post('name'),
            'amount'=>$this->input->post('amount'),
            'description'=>$this->input->post('description'),
            'validity'=>$this->input->post('year').':'.$this->input->post('month').':'.$this->input->post('day'),
            'image'=>$image_name,
            'status'=>$status,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        foreach($this->input->post('services') as $val){
            $data = array(
                'membership_id'=>$id,
                'service_id'=>$val
            );
            $this->db->insert('membership_service',$data);
        }

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
            if(file_exists(PACKAGE_IMG.$this->input->post('image_old'))){
                @unlink(PACKAGE_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            
            $config['file_name'] = $image_name;
            $config['upload_path'] = PACKAGE_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        $data = array(
            'name'=>$this->input->post('name'),
            'amount'=>$this->input->post('amount'),
            'description'=>$this->input->post('description'),
            'validity'=>$this->input->post('year').':'.$this->input->post('month').':'.$this->input->post('day'),
            'image'=>$image_name,
            'status'=>$status,
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // ============================

        $this->db->where('membership_id', $this->input->post('id'));
        $this->db->delete('membership_service');

        foreach($this->input->post('services') as $val){
            $data = array(
                'membership_id'=>$this->input->post('id'),
                'service_id'=>$val
            );
            $this->db->insert('membership_service',$data);
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
        $row = $this->getDataById($this->input->post('id'));

        // remove old file
        // if(file_exists(PACKAGE_IMG.$row->image)){
        //     @unlink(PACKAGE_IMG.$row->image);
        // }

        $this->db->where('membership_id', $this->input->post('id'));
        $this->db->delete('membership_service');
        
        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

    function getOngoingMembershipCountByMemberId($id){
        $where[] = ["column"=>'cm.customer_id',"op"=>'=','value'=>$id];
        $result = $this->get_list('','',$where);
        $count = 0;
        foreach($result as $key=>$val){
            if($result[$key]->validity_status == "Ongoing"){
                $count++;
            }
        }
        return $count;
    }
}