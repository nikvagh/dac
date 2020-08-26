<?php
    class partner_model extends CI_Model{
        function partner_model(){
            parent::__construct();
            $this->table='partner';
        }
        function get_partner($num, $offset) {
        $this->db->select('*');

        $this->db->order_by("partner_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $partner = array();
 
            if ($query->num_rows() > 0) {
                $partner = $query->result_array();
            }
                return $partner;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("partner_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_edit_data($partnerid){
            $this->db->select('*');
            $this->db->where('partner_id',$partnerid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function partner_insert(){

            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image_file = $unique .'_'.$this->input->post('partnertitle'). preg_replace("/\s+/", "_", $_FILES['partimage']['name']);

            $config['file_name'] = $image_file;
            $config['upload_path'] = PARTNERPICPATH;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('partimage')) {
                $data['error'] = array('error' => $this->upload->display_errors());
            } else {
                $data['upload_data'] = $this->upload->data();
                $this->load->library('image_lib');
                $sizes = array(30=>30 , 200=>200);
                foreach ($sizes as $key => $val) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $_FILES['partimage']['tmp_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['width'] = $key;
                    $config['height'] = $val;
                    $config['new_image'] = PARTNERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }

            $data=array(
                'partner_title'=>$this->input->post('partnertitle'),
                'partner_url'=>$this->input->post('partnerurl'),
                'partner_image'=>$image_file,
                'partner_status'=>'1',
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            if($_FILES['partimage']['name']==""){
                $image_file=$this->input->post('oldpartimage');
            }else{
                if(file_exists(PARTNERPICPATH.$this->input->post('oldpartimage'))){
                    @unlink(PARTNERPICPATH.$this->input->post('oldpartimage'));
                    $sizes = array(30 => 30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        if (PARTNERPICPATH ."thumb/" . $key. "x" . $val."_".$this->input->post('oldpartimage')){
                             @unlink(PARTNERPICPATH ."thumb/" . $key . "x". $val."_".$this->input->post('oldpartimage'));
                        }
                    }
                }
                $unique = $this->functions->GenerateUniqueFilePrefix();
                $image_file = $unique .'_'.$this->input->post('partnertitle'). preg_replace("/\s+/", "_", $_FILES['partimage']['name']);

                $config['file_name'] = $image_file;
                $config['upload_path'] = PARTNERPICPATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('partimage')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $sizes = array(30=>30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['partimage']['tmp_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = false;
                        $config['width'] = $key;
                        $config['height'] = $val;
                        $config['new_image'] = PARTNERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $data=array(
                'partner_title'=>$this->input->post('partnertitle'),
                'partner_url'=>$this->input->post('partnerurl'),
                'partner_image'=>$image_file,
            );
           // print_r($data);exit;
            $this->db->where('partner_id',$this->input->post('partnerid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        function st_update(){
            $this->db->set('partner_status', $this->input->post('publish'));
            $this->db->where('partner_id', $this->input->post('partnerid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        function delete(){
            $partnerid = $this->get_edit_data($this->input->post('partnerid'));
            if (file_exists(PARTNERPICPATH . $partnerid['partner_image'])){
                @unlink(PARTNERPICPATH . $partnerid['partner_image']);
                $sizes = array(30 => 30 , 200=>200);
                foreach ($sizes as $key => $val) {
                    if (PARTNERPICPATH ."thumb/" . $key. "x" . $val."_".$partnerid['partner_image']){
                         @unlink(PARTNERPICPATH ."thumb/" . $key . "x". $val."_".$partnerid['partner_image']);
                    }
                }
            }        
            $this->db->where('partner_id', $this->input->post('partnerid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $partnerid = $this->get_edit_data($arrProduct[$m]);

                if (file_exists(PARTNERPICPATH . $partnerid['partner_image']))
                    @unlink(PARTNERPICPATH . $partnerid['partner_image']);
                    $sizes = array(30 => 30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        if (PARTNERPICPATH ."thumb/" . $key. "x" . $val."_".$partnerid['partner_image']){
                             @unlink(PARTNERPICPATH ."thumb/" . $key . "x". $val."_".$partnerid['partner_image']);
                        }
                    }
            }

            $this->db->where_in('partner_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>