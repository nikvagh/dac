<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OfferModel extends CI_Model {
    function __construct() {
        $this->table = 'offers';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('o.*');
        $this->db->from('offers as o');
        $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get();
        $result = $query->result();

        foreach($result as $key=>$val){
            $query = $this->db->select('c.*')->from('offer_category as oc')->join('category as c','c.category_id=oc.category_id','left')->where('oc.offer_id',$val->id)->get();
            $result[$key]->categories = $query->result();
            $result[$key]->category_names = array_map(function($e) { return is_object($e) ? $e->category_name : $e['category_name']; }, $result[$key]->categories );

            $query = $this->db->select('p.*')->from('offer_package as op')->join('package as p','p.id = op.package_id','left')->where('op.offer_id',$val->id)->get();
            $result[$key]->packages = $query->result();
            $result[$key]->packages_names = array_map(function($e) { return is_object($e) ? $e->name : $e['name']; }, $result[$key]->packages );
        }

        // echo "<pre>";print_r($result);exit;
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        $row = $query->row();

        $categories = (object) [];
        $packages = (object) [];
        if(!empty($row)){
            $query = $this->db->select('c.*')->from('offer_category as oc')->join('category as c','c.category_id = oc.category_id','left')->where('oc.offer_id',$row->id)->get();
            $categories = $query->result();

            $query = $this->db->select('p.*')->from('offer_package as op')->join('package as p','p.id = op.package_id','left')->where('op.offer_id',$row->id)->get();
            $packages = $query->result();
        }

        $row->categories = $categories;
        $row->category_ids = array_map(function($e) { return is_object($e) ? $e->category_id : $e['category_id']; }, $categories);

        $row->packages = $packages;
        $row->packages_ids = array_map(function($e) { return is_object($e) ? $e->id : $e['id']; }, $packages);

        // echo "<pre>";print_r($row);exit;
        return $row;
    }

    function create(){
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit;

        // if($this->input->post('status')){
        //     $status = 'Enable';
        // }else{
        //     $status = 'Disable';
        // }

        $image_name = "";
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
                $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);

                $config['file_name'] = $image_name;
                $config['upload_path'] = OFFER_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('image')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";print_r($data['error']);
                }
        }

        $data = array(
            'code'=>$this->input->post('code'),
            'discount'=>$this->input->post('discount'),
            'start_date'=>$this->input->post('start_date'),
            'end_date'=>$this->input->post('end_date'),
            'description'=>$this->input->post('description'),
            'image'=>$image_name
        );
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();
        // ================================

        // foreach($this->input->post('categories') as $val){
        //     $data = array(
        //         'offer_id'=>$id,
        //         'category_id'=>$val
        //     );
        //     $this->db->insert('offer_category',$data);
        // }

        // foreach($this->input->post('services') as $val){
        //     $data = array(
        //         'offer_id'=>$id,
        //         'service_id'=>$val
        //     );
        //     $this->db->insert('offer_service',$data);
        // }

        foreach($this->input->post('packages') as $val){
            $data = array(
                'offer_id'=>$id,
                'package_id'=>$val
            );
            $this->db->insert('offer_package',$data);
        }

        return $id;
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
        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

            // remove old file
            if(file_exists(OFFER_IMG.$this->input->post('image_old'))){
                @unlink(OFFER_IMG.$this->input->post('image_old'));
            }
                
            $image_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['image']['name']);
            
            $config['file_name'] = $image_name;
            $config['upload_path'] = OFFER_IMG;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                // echo "<pre>";print_r($data['error']);
            }
        }

        $data = array(
            'code'=>$this->input->post('code'),
            'discount'=>$this->input->post('discount'),
            'start_date'=>$this->input->post('start_date'),
            'end_date'=>$this->input->post('end_date'),
            'description'=>$this->input->post('description'),
            'image'=>$image_name
        );
        $this->db->set($data)->where('id',$this->input->post('id'));
        $this->db->update($this->table);

        // ============================

        // $this->db->where('offer_id', $this->input->post('id'));
        // $this->db->delete('offer_category');

        // foreach($this->input->post('categories') as $val){
        //     $data = array(
        //         'offer_id'=>$this->input->post('id'),
        //         'category_id'=>$val
        //     );
        //     $this->db->insert('offer_category',$data);
        // }

        // $this->db->where('offer_id', $this->input->post('id'));
        // $this->db->delete('offer_service');

        // foreach($this->input->post('services') as $val){
        //     $data = array(
        //         'offer_id'=>$this->input->post('id'),
        //         'service_id'=>$val
        //     );
        //     $this->db->insert('offer_service',$data);
        // }

        $this->db->where('offer_id', $this->input->post('id'));
        $this->db->delete('offer_package');

        foreach($this->input->post('packages') as $val){
            $data = array(
                'offer_id'=>$this->input->post('id'),
                'package_id'=>$val
            );
            $this->db->insert('offer_package',$data);
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
        if(file_exists(OFFER_IMG.$row->image)){
            @unlink(OFFER_IMG.$row->image);
        }

        $this->db->where('offer_id', $this->input->post('id'));
        $this->db->delete('offer_category');

        $this->db->where('offer_id', $this->input->post('id'));
        $this->db->delete('offer_service');

        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
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

    function checkCouponForPackage($package_id,$coupon){
        if($coupon == ""){
            return ['status'=>400,'title'=>'Coupon code is empty'];
        }

        if($package_id == ""){
            return ['status'=>400,'title'=>'Package_id is empty'];
        }

        $curr_date = curr_date();
        $offer = $this->db->where('code',$coupon)->where('start_date <= "'.$curr_date.'"')->where('end_date >= "'.$curr_date.'"')->get('offers as o')->row();
        if($offer){
            $offerPackages = $this->db->where('offer_id',$offer->id)->get('offer_package as op')->result_array();
            if(!empty($offerPackages)){
                $package_ids = array_column($offerPackages,'package_id');
                if(in_array($package_id,$package_ids)){
                    return ['status'=>200,'title'=>'Valid Coupon code','result'=>['offer'=>$offer]];
                }else{
                    return ['status'=>310,'title'=>'Invalid coupon code for selected package'];
                }
            }else{
                return $result = ['status'=>330,'title'=>'Invalid Coupon Code'];
            }
        }else{
            return $result = ['status'=>330,'title'=>'Invalid Coupon Code'];
        }
    }
    
}