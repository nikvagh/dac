<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerMembershipModel extends CI_Model {
    function __construct() {
        $this->table = 'customer_membership';
        $this->primaryKey = 'id';

        $this->load->model('PackageModel','Package');
    }

    // function get_list($num="", $offset="",$where = []) {
    //     $this->db->select('p.*');
    //     $this->db->from('package as p');
    //     $this->db->order_by("id", "Desc");
    //     if($num != "" && $offset != ""){
    //         $this->db->limit($num, $offset);
    //     }

    //     if(!empty($where)){
    //         foreach($where as $key=>$val){
    //             if($val['op'] == "="){
    //                 $this->db->where($val['column'],$val['value']);
    //             }
    //         }
    //     }

    //     $query = $this->db->get();
    //     $result = $query->result();

    //     foreach($result as $key=>$val){
    //         $query = $this->db->select('s.*')->from('package_service as ps')->join('service as s','s.id=ps.service_id','left')->where('ps.package_id',$val->id)->get();
    //         $result[$key]->services = $query->result();
    //         $result[$key]->service_names = array_map(function($e) { return is_object($e) ? $e->name : $e['name']; }, $result[$key]->services );
    //     }

    //     // echo "<pre>";print_r($result);exit;
    //     return $result;
    // }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $services = (object) [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('package_service as ps')->join('service as s','s.id=ps.service_id','left')->where('ps.package_id',$row->id)->get();
            $services = $query->result();
        }

        $row->services = $services;
        $row->services_ids = array_map(function($e) { return is_object($e) ? $e->id : $e['id']; }, $services);
        return $row;
    }

    function purchaseFromCustomer(){
        $payment_id = 0;
        $package = $this->Package->getDataById($this->input->post('package_id'));

        $validityAry = package_validity_converter($package->validity);
        // echo "<prE>";print_r($package);exit;

        // payment
        $payment = array(
            'user_id'=>$this->input->post('customer_id'),
            'user_type'=>'customer',
            'amount' => $package->amount,
            'transaction_type' => 'Credit',
            'status' => 'Success',
            'description' => 'membership purchase',
        );
        $this->db->insert('payment',$payment);
        $payment_id = $this->db->insert_id();

        $data = array(
            'package_id'=>$this->input->post('package_id'),
            'customer_id'=>$this->input->post('customer_id'),
            'payment_id'=>$payment_id,
            'start_date'=>$validityAry['start_date'],
            'end_date'=>$validityAry['end_date'],
            // 'end_date'=>$end_date
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        // foreach($package->services as $val){
        //     $data = array(
        //         'membership_id'=>$id,
        //         'service_id'=>$val->id
        //     );
        //     $this->db->insert('membership_service',$data);
        // }

        return $id;
    }

}