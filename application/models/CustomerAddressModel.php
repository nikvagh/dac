<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerAddressModel extends CI_Model {
    function __construct() {
        $this->table = 'customer_address';
        $this->primaryKey = 'id';
        // $this->load->model('PackageModel','Package');
    }

    function get_list($num="", $offset="",$where = [],$where_or = [],$where_in = [], $isTotalQuery = 'N') {
        $query = $this->list_query($num,$offset,$where,$where_or,$where_in);
        if($isTotalQuery == "N"){
            $result = $query->result();
            return $result;
        }else{
            $result = $query->num_rows();
            return $result;
        }
    }

    function list_query($num="", $offset="",$where = [],$where_or = [],$where_in = [], $filterCheck = 'N'){
        $this->db->select('ca.*,cr.firstname,cr.lastname');
        $this->db->from('appointment as a')
            ->join('customer as cr','cr.id = a.customer_id','left');

        if(!empty($where)){
            foreach($where as $key=>$val){
                if($val['op'] == "="){
                    $this->db->where($val['column'],$val['value']);
                }
            }
        }
        if(!empty($where_or)){
            foreach($where_or as $key=>$val){
                $this->db->where($val);
            }
        }
        if(!empty($where_in)){
            foreach($where_in as $key=>$val){
                $this->db->where_in($val['column'],$val['value']);
            }
        }

        $this->db->order_by("a.id", "desc");

        if($num != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        return $query;
    }

    function getDataById($id){
        $this->db->select('a.*,
                            sp.sp_id,sp.company_name,cr.id as customer_id,cr.firstname,cr.lastname,
                            p.name as package_name,
                            v.name as vehicle_name,v.year as vehicle_year,
                            ss.status_txt')
            ->join('customer as cr','cr.id = a.customer_id','left')
            ->join('sp','sp.sp_id = a.sp_id','left')
            ->join('customer_vehicle as v','v.id = a.vehicle_id','left')
            ->join('package as p','p.id = a.package_id','left')
            ->join('service_status as ss','ss.id = a.status_id','left');

        $this->db->where('a.id',$id);
        $query = $this->db->get($this->table.' as a');
        $row = $query->row();

        $services = (object) [];
        $duration = 0; $amount = 0; $service_ids = []; $service_names = []; $addon_ids = []; $addon_names = [];
        if(!empty($row)){
            $query = $this->db->select('s.*')->from('appointment_service as as')->join('service as s','s.id=as.service_id','left')->where('as.appointment_id',$row->id)->get();
            $services = $query->result();

            foreach($services as $key=>$val){
                $amount+=$val->amount;
                $duration+=$val->duration;
                $service_ids[] = $val->id;
                $service_names[] = $val->name;
            }

            $query = $this->db->select('a.id,a.name,aa.amount')->from('appointment_addon as aa')->join('addon as a','a.id=aa.addon_id','left')->where('aa.appointment_id',$row->id)->get();
            $addons = $query->result();
            if(!empty($addons)){
                $addon_ids = array_column($addons,'id');
                $addon_names = array_column($addons,'name');
            }
        }

        $row->services = $services;
        $row->service_ids = $service_ids;
        $row->service_names = $service_names;

        $row->addons = $addons;
        $row->addon_ids = $addon_ids;
        $row->addon_names = $addon_names;

        $row->duration = $duration;
        $row->amount = $amount;
        // $row->category_ids = array_column($categories,'category_id');
        // echo "<pre>";print_r($row);exit;

        return $row;
    }

    function create(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'location'=>$this->input->post('location'),
            'zipcode'=>$this->input->post('zipcode'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        $package = $this->Package->getDataById($this->input->post('package_id'));
        // print_r($package);exit;
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$id,
                'service_id'=>$val->id
            );
            $this->db->insert('appointment_service',$data);
        }

        return $id;
    }

    function update(){
        // echo "<pre>";print_r($_POST); exit;

        $data = array(
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'sp_id'=>$this->input->post('sp_id'),
            'date'=>$this->input->post('date'),
            'time'=>$this->input->post('time'),
            'location'=>$this->input->post('location'),
            'zipcode'=>$this->input->post('zipcode'),
            'status_id'=>$this->input->post('status_id'),
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // echo $this->db->last_query();
        // exit;

        // ============================

        $this->db->where('service_id', $this->input->post('id'));
        $this->db->delete('appointment_service');


        $package = $this->Package->getDataById($this->input->post('package_id'));
        // print_r($package);
        // exit;
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$this->input->post('id'),
                'service_id'=>$val->id
            );
            $this->db->insert('appointment_service',$data);
        }

        // echo $this->db->last_query();
        // exit;
        return true;
    }

    function dispatch_view_update(){
        // echo "<pre>";print_r($_POST); exit;

        if($this->input->post('sp_id')){
            $data = array('sp_id'=>$this->input->post('sp_id'));
        }

        if($this->input->post('status_id')){
            $data = array('status_id'=>$this->input->post('status_id'));
        }

        if(!empty($data)){
            $this->db->set($data)->where('id',$this->input->post('id'));
            $this->db->update($this->table);
        }

        return true;
    }

    function st_update(){
        $this->db->set('status_id', $this->input->post('publish'));
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->update($this->table);

        // echo $this->db->last_query();
        // exit;

        if($query){
           return true;
        }else{
            return false;
        }
    }

    function delete(){
        $row = $this->getDataById($this->input->post('id'));

        $this->db->where('appointment_id', $this->input->post('id'));
        $this->db->delete('appointment_service');
        
        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

    function getTotalCount($sp_id="",$where=[]){
        $this->db->select("COUNT(id) AS total");
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }

        if(!empty($where)){
            foreach($where as $key=>$val){
                if($val['op'] == "="){
                    $this->db->where($val['column'],$val['value']);
                }
            }
        }
        
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalPendingCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',1)->from($this->table);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalSuccessCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',5);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalRejectCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',3);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalInProgressCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',4);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function getTotalCancelledCount($sp_id=""){
        $this->db->select("COUNT(id) AS total")->where('status_id',2);
        if($sp_id != ""){
            $this->db->where('sp_id',$sp_id);
        }
        $query = $this->db->from($this->table)->get();
        if($query){ 
            return $query->row()->total;
        }else{
            return 0;
        }
    }

    function bookNowSave(){
        // echo "<pre>"; print_r($_SESSION); exit;
        $sp_id = 0;
        $payment_id = 0;
        $date = date('Y-m-d');
        $appointment_type = $this->input->post('appointment_type');
        $total_amount = 0;
        $total_payable = 0;
        $additional_fee = 0;
        $discount = 0;
        $status_id = '1';

        // ================= sp_id =================
        $sps = $this->ServiceProvider->getServiceProviderInRadius($this->input->post('latitude'),$this->input->post('longitude'),10);
        if(!empty($sps)){
            $sort_by_km = array_column($sps, 'distance');
            array_multisort($sort_by_km, SORT_ASC, $sps);
            $sp_id = $sps[0]->sp_id;
        }

        if($sp_id == 0){
            $spbyZip = $this->ServiceProvider->getDataByZip($this->input->post('zipcode'));
            if($spbyZip){
                $sp_id = $spbyZip->sp_id;
            }
        }
        // =========================

        // ========================= amount ================
        if($this->input->post('addOn')){
            $addons = $this->AddOn->getDataByIds($this->input->post('addOn'));
            $addon_amt = array_sum(array_column($addons,'amount'));

            $total_amount += $addon_amt;
            $total_payable += $addon_amt;
        }
        // =========================

        if($this->input->post('vehicle_id') != ""){
            $vehicle_id = $this->input->post('vehicle_id');
        }else{
            $vehicle_data['member_id'] = $this->session->userdata('id');
            $vehicle_data['name'] = $this->input->post('vehicle_name');
            $vehicle_data['year'] = $this->input->post('vehicle_year');
            $this->db->insert('customer_vehicle',$vehicle_data);
            $vehicle_id = $this->db->insert_id();
        }

        $data = array(
            'sp_id'=>$sp_id,
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'vehicle_id'=>$vehicle_id,
            'payment_id'=>$payment_id,
            'date'=>$date,
            'time'=>$this->input->post('time'),
            'appointment_type'=>$appointment_type,
            'location'=>$this->input->post('location'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'),
            'zipcode'=>$this->input->post('zipcode'),
            'total_amount'=>$total_amount,
            'total_payable'=>$total_payable,
            'additional_fee'=>$additional_fee,
            'discount'=>$discount,
            'status_id'=>$status_id,
        );

        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        $package = $this->Package->getDataById($this->input->post('package_id'));
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$id,
                'service_id'=>$val->id,
                'service_in'=>'package',
                'amount'=>$val->amount,
            );
            $this->db->insert('appointment_service',$data);
        }

        if($this->input->post('addOn')){
            foreach($this->input->post('addOn') as $val){
                // print_r($val);
                $addon = $this->AddOn->getDataById($val);
                $data = array(
                    'appointment_id'=>$id,
                    'addon_id'=>$val,
                    'amount'=>$addon->amount,
                );
                $this->db->insert('appointment_addon',$data);
            }
        }

        return $id;
    }

    function bookScheduleSave(){
        $sp_id = 0;
        $payment_id = 0;
        $appointment_type = 'schedule_book';
        $total_amount = 0;
        $total_payable = 0;
        $additional_fee = 0;
        $discount = 0;
        $status_id = '1';
        $date_time_ary = explode(' ',$this->input->post('date_time'));
        $date = $date_time_ary[0];
        $time = $date_time_ary[1];

        // ========================== sp_id =================
        $sps = $this->ServiceProvider->getServiceProviderInRadius($this->input->post('latitude'),$this->input->post('longitude'),10);
        if(!empty($sps)){
            $sort_by_km = array_column($sps, 'distance');
            array_multisort($sort_by_km, SORT_ASC, $sps);
            $sp_id = $sps[0]->sp_id;
        }

        if($sp_id == 0){
            $spbyZip = $this->ServiceProvider->getDataByZip($this->input->post('zipcode'));
            if($spbyZip){
                $sp_id = $spbyZip->sp_id;
            }
        }
        // =========================

        // ========================= amount ================
        if($this->input->post('addOn')){
            $addons = $this->AddOn->getDataByIds($this->input->post('addOn'));
            $addon_amt = array_sum(array_column($addons,'amount'));

            $total_amount += $addon_amt;
            $total_payable += $addon_amt;
        }
        // =========================

        $data = array(
            'sp_id'=>$sp_id,
            'customer_id'=>$this->input->post('customer_id'),
            'package_id'=>$this->input->post('package_id'),
            'vehicle_id'=>$this->input->post('vehicle_id'),
            'payment_id'=>$payment_id,
            'date'=>$date,
            'time'=>$time,
            'appointment_type'=>$appointment_type,
            'location'=>$this->input->post('location'),
            'latitude'=>$this->input->post('latitude'),
            'longitude'=>$this->input->post('longitude'),
            'zipcode'=>$this->input->post('zipcode'),
            'total_amount'=>$total_amount,
            'total_payable'=>$total_payable,
            'additional_fee'=>$additional_fee,
            'discount'=>$discount,
            'status_id'=>$status_id,
        );

        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        $package = $this->Package->getDataById($this->input->post('package_id'));
        foreach($package->services as $val){
            $data = array(
                'appointment_id'=>$id,
                'service_id'=>$val->id,
                'service_in'=>'package',
                'amount'=>$val->amount,
            );
            $this->db->insert('appointment_service',$data);
        }

        if($this->input->post('addOn')){
            foreach($this->input->post('addOn') as $val){
                // print_r($val);
                $addon = $this->AddOn->getDataById($val);
                $data = array(
                    'appointment_id'=>$id,
                    'addon_id'=>$val,
                    'amount'=>$addon->amount,
                );
                $this->db->insert('appointment_addon',$data);
            }
        }

        return $id;
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