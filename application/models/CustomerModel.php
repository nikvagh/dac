<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerModel extends CI_Model {
    function __construct() {
        $this->table = 'customer';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="", $where=[], $whereIn=[]) {
        $this->db->select('cr.*');
        $this->db->from('customer as cr');
        // $this->db->order_by("id", "Desc");
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

        // echo "<pre>";
        // print_r($whereIn);
        // exit;

        if(!empty($whereIn)){
            foreach($whereIn as $key=>$val){
                $this->db->where_in($val['column'],implode(',',$val['value']));
            }
        }

        $query = $this->db->get();
        $result = $query->result();
        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('c.*,cou.name as country_name,s.name as state_name')
                ->join('countries as cou','cou.id = c.country','left')
                ->join('states as s','s.id = c.state','left');
        $this->db->where('c.id',$id);
        $query = $this->db->get('customer as c');
        $row = $query->row();

        $categories = (object) [];
        if(!empty($row)){
            $query = $this->db->select('c.*')->from('service_category as sc')->join('category as c','c.category_id=sc.category_id','left')->where('sc.service_id',$row->id)->get();
            $categories = $query->result();
        }

        $row->categories = $categories;
        $row->category_ids = array_map(function($e) { return is_object($e) ? $e->category_id : $e['category_id']; }, $categories);

        $home_address = $this->db->select('ca.*')->from('customer_address as ca')->where('ca.type','home')->where('ca.customer_id',$row->id)->get()->row();
        $row->home_address = $home_address;

        $addresses = (object) [];
        if(!empty($row)){
            $query = $this->db->select('ca.*')->from('customer_address as ca')->where('ca.type !=','home')->where('ca.customer_id',$row->id)->get();
            $addresses = $query->result();
        }
        $row->addresses = $addresses;

        $vehicles = (object) [];
        if(!empty($row)){
            $query = $this->db->select('cv.*')->from('customer_vehicle as cv')->where('cv.member_id',$row->id)->get();
            $vehicles = $query->result();
        }
        $row->vehicles = $vehicles;

        $cards = (object) [];
        if(!empty($row)){
            $query = $this->db->select('pc.*')->from('payment_cards as pc')->where('pc.customer_id',$row->id)->get();
            $cards = $query->result();
        }
        $row->cards = $cards;

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
                    // exit;
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

        // =============================

        $customer_address = array(
            'customer_id'=>$id,
            'type'=> 'home',
            'address'=>$this->input->post('address'),
            'zipcode'=>$this->input->post('zipcode'),
        );
        $this->db->insert('customer_address',$customer_address);

        if($this->input->post('address_type')){
            foreach($this->input->post('address_type') as $key=>$val){

                $type = $this->input->post('address_type')[$key];
                $address = $this->input->post('address_address')[$key];
                $zipcode = $this->input->post('address_zipcode')[$key];

                if($address != ""){
                    $customer_address = array(
                        'customer_id'=>$id,
                        'type'=> $type,
                        'address'=> $address,
                        'zipcode'=> $zipcode,
                    );
                    $this->db->insert('customer_address',$customer_address);
                }

            }
        }

        // ============================

        if($this->input->post('vehicle_name')){
            foreach($this->input->post('vehicle_name') as $key=>$val){

                $name = $this->input->post('vehicle_name')[$key];
                $year = $this->input->post('vehicle_year')[$key];

                if($name != "" && $year != ""){
                    $vehicle_image_name = "";
                    if(isset($_FILES['vehicle_image']['name'][$key]) && $_FILES['vehicle_image']['name'][$key] != ""){

                        $_FILES['vehicle_image1']['name'] = $_FILES['vehicle_image']['name'][$key];
                        $_FILES['vehicle_image1']['type'] = $_FILES['vehicle_image']['type'][$key];
                        $_FILES['vehicle_image1']['tmp_name'] = $_FILES['vehicle_image']['tmp_name'][$key];
                        $_FILES['vehicle_image1']['error'] = $_FILES['vehicle_image']['error'][$key];
                        $_FILES['vehicle_image1']['size'] = $_FILES['vehicle_image']['size'][$key];
                            
                        $vehicle_image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['vehicle_image1']['name']);
                        $config['file_name'] = $vehicle_image_name;
                        $config['upload_path'] = VEHICLE_IMG;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';

                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('vehicle_image1')) {
                            $data['error'] = array('error' => $this->upload->display_errors());
                            // echo "<pre>";print_r($data['error']);
                            // exit;
                        }
                    }
                
                    $customer_vehicle = array(
                        'member_id'=> $id,
                        'name'=> $name,
                        'year'=> $year,
                        'image'=> $vehicle_image_name
                    );
                    $this->db->insert('customer_vehicle',$customer_vehicle);
                }
                
            }
        }

        // ============================

        if($this->input->post('card_name')){
            foreach($this->input->post('card_name') as $key=>$val){
                $name = $this->input->post('card_name')[$key];
                $number = $this->input->post('card_number')[$key];
                $expiry_month = $this->input->post('card_expiry_month')[$key];
                $expiry_year = $this->input->post('card_expiry_year')[$key];
                $cvv = $this->input->post('card_cvv')[$key];

                if($name != "" && $number != "" && $expiry_month != "" && $expiry_year != "" && $cvv != ""){
                    $payment_cards = array(
                        'customer_id'=> $id,
                        'name'=> $name,
                        'number'=> $number,
                        'expiry_month'=> $expiry_month,
                        'expiry_year'=> $expiry_year,
                        'cvv'=> $cvv
                    );
                    $this->db->insert('payment_cards',$payment_cards);
                }

            }
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
                // exit;
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

        // ==================
        $this->db->where('customer_id', $this->input->post('id'));
        $this->db->delete('customer_address');

        $customer_address = array(
            'customer_id'=>$this->input->post('id'),
            'type'=> 'home',
            'address'=>$this->input->post('address'),
            'zipcode'=>$this->input->post('zipcode'),
        );
        $this->db->insert('customer_address',$customer_address);

        if($this->input->post('address_type')){
            foreach($this->input->post('address_type') as $key=>$val){

                $type = $this->input->post('address_type')[$key];
                $address = $this->input->post('address_address')[$key];
                $zipcode = $this->input->post('address_zipcode')[$key];

                if($address != ""){
                    $customer_address = array(
                        'customer_id'=>$this->input->post('id'),
                        'type'=> $type,
                        'address'=> $address,
                        'zipcode'=> $zipcode,
                    );
                    $this->db->insert('customer_address',$customer_address);
                }

            }
        }

        // ===============

        $this->db->where('member_id', $this->input->post('id'));
        $this->db->delete('customer_vehicle');

        // echo "<pre>";
        // print_r($_FILES);
        // exit;

        if($this->input->post('vehicle_name')){
            foreach($this->input->post('vehicle_name') as $key=>$val){

                $name = $this->input->post('vehicle_name')[$key];
                $year = $this->input->post('vehicle_year')[$key];

                if($name != "" && $year != ""){
                    $vehicle_image_name = $this->input->post('vehicle_image_old')[$key];
                    if(isset($_FILES['vehicle_image']['name'][$key]) && $_FILES['vehicle_image']['name'][$key] != ""){

                        $_FILES['vehicle_image1']['name'] = $_FILES['vehicle_image']['name'][$key];
                        $_FILES['vehicle_image1']['type'] = $_FILES['vehicle_image']['type'][$key];
                        $_FILES['vehicle_image1']['tmp_name'] = $_FILES['vehicle_image']['tmp_name'][$key];
                        $_FILES['vehicle_image1']['error'] = $_FILES['vehicle_image']['error'][$key];
                        $_FILES['vehicle_image1']['size'] = $_FILES['vehicle_image']['size'][$key];

                        // remove old file
                        if(file_exists(VEHICLE_IMG.$this->input->post('vehicle_image_old')[$key])){
                            @unlink(VEHICLE_IMG.$this->input->post('vehicle_image_old')[$key]);
                        }
                            
                        $vehicle_image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['vehicle_image1']['name']);
                        $config['file_name'] = $vehicle_image_name;
                        $config['upload_path'] = VEHICLE_IMG;
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';

                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('vehicle_image1')) {
                            $data['error'] = array('error' => $this->upload->display_errors());
                            // echo "<pre>";print_r($data['error']);
                            // exit;
                        }
                    }

                
                    $customer_vehicle = array(
                        'member_id'=> $this->input->post('id'),
                        'name'=> $name,
                        'year'=> $year,
                        'image'=> $vehicle_image_name
                    );
                    $this->db->insert('customer_vehicle',$customer_vehicle);
                }

            }
        }

        // ===========================

        $this->db->where('customer_id', $this->input->post('id'));
        $this->db->delete('payment_cards');

        if($this->input->post('card_name')){
            foreach($this->input->post('card_name') as $key=>$val){
                $name = $this->input->post('card_name')[$key];
                $number = $this->input->post('card_number')[$key];
                $expiry_month = $this->input->post('card_expiry_month')[$key];
                $expiry_year = $this->input->post('card_expiry_year')[$key];
                $cvv = $this->input->post('card_cvv')[$key];

                if($name != "" && $number != "" && $expiry_month != "" && $expiry_year != "" && $cvv != ""){
                    $payment_cards = array(
                        'customer_id'=> $this->input->post('id'),
                        'name'=> $name,
                        'number'=> $number,
                        'expiry_month'=> $expiry_month,
                        'expiry_year'=> $expiry_year,
                        'cvv'=> $cvv
                    );
                    $this->db->insert('payment_cards',$payment_cards);
                }

            }
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

    function deleteCustomerPackage(){
        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete('customer_membership')){
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

    public function register(){
        $status = 'Enable';

        $refer_from = 0;
        if($this->input->post('referral_code') != ""){
            $code = $this->input->post('referral_code');
            
            $this->db->select('*');
            $this->db->where('refer_code',$code);
            $query1 = $this->db->get('customer');
            if ($query1->num_rows() > 0) {
                $refer_from = $query1->row()->id;
            }
        }

        $data = array(
            'username'=>$this->input->post('username'),
            'email'=>$this->input->post('email'),
            'phone'=>$this->input->post('phone'),
            'password'=>md5($this->input->post('phone')),
            'status'=>$status,
            'refer_code' => random_str(6),
            'refer_from' => $refer_from,
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        
        return $id;
    }

    public function profileUpdate(){
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
            'phone'=>$this->input->post('phone'),
            'country'=>$this->input->post('country'),
            'state'=>$this->input->post('state'),
            'city'=>$this->input->post('city'),
            'zip'=>$this->input->post('zip'),
            'address'=>$this->input->post('address'),
            'profile'=>$image_name
        );

        if($this->input->post('password') && $this->input->post('password') != ""){
            $data['password'] = md5($this->input->post('password'));
        }

        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        $this->member->login('','',$this->input->post('id'));

        // echo $this->db->last_query();
        // exit;
        return true;
    }
}