<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerMembershipModel extends CI_Model {
    function __construct() {
        $this->table = 'customer_membership';
        $this->primaryKey = 'id';

        $this->load->model('PackageModel','Package');
        $this->load->model('OfferModel','Offer');
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
        $this->db->select('cm.*,p.name as package_name');
        $this->db->where('cm.id',$id)->join('package as p','p.id = cm.package_id','left');
        $query = $this->db->get('customer_membership cm');
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

    function purchaseFromCustomer($paymentResult){
        $payment_id = 0;

        // $package = $this->Package->getDataById($this->input->post('package_id'));
        // $validityAry = package_validity_converter($package->validity);
        // $total_amount = $package->amount;
        // $total_payable = $package->amount;
        // $discount = 0;

        // if($this->input->post('coupon')){
        //     $package_coupon = $this->Offer->checkCouponForPackage($this->input->post('package_id'),$this->input->post('coupon'));
        //     // print_r($package_coupon);
        //     // exit;

        //     $discount = $package_coupon['result']['offer']->discount;

        //     $discount = ($total_amount*$discount)/100;
        //     $total_payable = $total_amount-$discount;
        // }

        // echo "<pre>";
        // print_r($paymentResult);
        // print_r($_SESSION);
        // print_r($this->session->userdata('membershipCreateData'));

        $saveData = $this->session->userdata('membershipCreateData');
        // exit;

        // payment
        $payment = array(
            'user_id'=>$saveData['customer_id'],
            'user_type'=>'customer',
            'amount' => $saveData['total_payable'],
            'transaction_type' => 'Credit',
            'status' => 'Success',
            'description' => 'Membership purchased',
            'txn_id' => $paymentResult->balance_transaction,
            'pg_status' => $paymentResult->status,
        );
        $this->db->insert('payment',$payment);
        $payment_id = $this->db->insert_id();

        $data = array(
            'package_id'=>$saveData['package']->id,
            'customer_id'=>$saveData['customer_id'],
            'payment_id'=>$payment_id,
            'start_date'=>$saveData['validityAry']['start_date'],
            'end_date'=>$saveData['validityAry']['end_date'],
            'total_amount'=>$saveData['total_amount'],
            'total_payable'=>$saveData['total_payable'],
            'discount'=>$saveData['discount'],
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

    function upgradeFromCustomer($paymentResult){
        $payment_id = 0;
        $saveData = $this->session->userdata('membershipUpgradeData');

        // payment
        $payment = array(
            'user_id'=>$saveData['customer_id'],
            'user_type'=>'customer',
            'amount' => $saveData['total_payable'],
            'transaction_type' => 'Credit',
            'status' => 'Success',
            'description' => 'Membership upgraded',
            'txn_id' => $paymentResult->balance_transaction,
            'pg_status' => $paymentResult->status,
        );
        $this->db->insert('payment',$payment);
        $payment_id = $this->db->insert_id();

        $data = array(
            'package_id'=>$saveData['new_package']->id,
            'customer_id'=>$saveData['customer_id'],
            'payment_id'=>$payment_id,
            'start_date'=>curr_date(),
            'end_date'=>$saveData['ongoing_package']->end_date,
            'total_amount'=>$saveData['total_amount'],
            'total_payable'=>$saveData['total_payable'],
            'discount'=>$saveData['discount'],
            'upgrade_from_id'=>$saveData['ongoing_package']->id,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();

        // =============================
        $update_data = array(
            'end_date' => date('Y-m-d', strtotime('-1 day', strtotime(curr_date())))
        );
        $this->db->set($update_data)->where('id',$saveData['ongoing_package']->id);
        $this->db->update('customer_membership');

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