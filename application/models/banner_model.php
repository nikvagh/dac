<?php
    class banner_model extends CI_Model{
        function banner_model(){
            parent::__construct();
            $this->table='banner';
        }
        function get_banner($num, $offset) {
        $this->db->select('*');
        $this->db->order_by("banner_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $banner = array();
            if ($query->num_rows() > 0) {
                $banner = $query->result_array();
            }
            return $banner;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("banner_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_edit_data($bannerid){
            $this->db->select('*');
            $this->db->where('banner_id',$bannerid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function banner_insert(){

            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image_file = $unique .'_'. preg_replace("/\s+/", "_", $_FILES['bannerimage']['name']);

            $config['file_name'] = $image_file;
            $config['upload_path'] = BANNERPICPATH;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bannerimage')) {
                $data['error'] = array('error' => $this->upload->display_errors());
            } else {
                $data['upload_data'] = $this->upload->data();
                $this->load->library('image_lib');
                $sizes = array(30=>30,1500=>500);
                foreach ($sizes as $key => $val) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $_FILES['bannerimage']['tmp_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['width'] = $key;
                    $config['height'] = $val;
                    $config['new_image'] = BANNERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            $data=array(
                'banner_title'=>$this->input->post('bannertitle'),
                'banner_image'=>$image_file,
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            if($_FILES['bannerimage']['name']==""){
                $image_file=$this->input->post('oldbanimage');
            }else{
                if(file_exists(BANNERPICPATH.$this->input->post('oldbanimage'))){
                    @unlink(BANNERPICPATH.$this->input->post('oldbanimage'));
                    $sizes = array(30=>30,1500=>500);
                    foreach ($sizes as $key => $val) {
                        if (BANNERPICPATH ."thumb/" . $key. "x" . $val."_".$this->input->post('oldbanimage')){
                            @unlink(BANNERPICPATH ."thumb/" . $key . "x" . $val."_".$this->input->post('oldbanimage'));
                        }
                    }
                }
                $unique = $this->functions->GenerateUniqueFilePrefix();
                $image_file = $unique .'_'. preg_replace("/\s+/", "_", $_FILES['bannerimage']['name']);

                $config['file_name'] = $image_file;
                $config['upload_path'] = BANNERPICPATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('bannerimage')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $sizes = array(30 => 30,1500=>500);
                    foreach ($sizes as $key => $val) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['bannerimage']['tmp_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = false;
                        $config['width'] = $key;
                        $config['height'] = $val;
                        $config['new_image'] = BANNERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $data=array(
                'banner_title'=>$this->input->post('bannertitle'),
                'banner_image'=>$image_file,
            );
            $this->db->where('banner_id',$this->input->post('bannerid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        function st_update(){
            $this->db->set('banner_status', $this->input->post('publish'));
            $this->db->where('banner_id', $this->input->post('bannerid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        function delete(){
            $bannerid = $this->get_edit_data($this->input->post('bannerid'));
            if (file_exists(BANNERPICPATH . $bannerid['banner_image'])){
                @unlink(BANNERPICPATH . $bannerid['banner_image']);
                $sizes = array(30 => 30 ,1500=>500);
                foreach ($sizes as $key => $val) {
                    if (BANNERPICPATH ."thumb/" . $key. "x" . $val."_".$bannerid['banner_image']){
                        @unlink(BANNERPICPATH ."thumb/" . $key . "x" . $val."_".$bannerid['banner_image']);
                    }
                }
            }        
            $this->db->where('banner_id', $this->input->post('bannerid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $bannerid = $this->get_edit_data($arrProduct[$m]);

                if (file_exists(BANNERPICPATH . $bannerid['banner_image']))
                    @unlink(BANNERPICPATH . $bannerid['banner_image']);
                    $sizes = array(30 => 30 ,1500=>500);
                    foreach ($sizes as $key => $val) {
                        if (BANNERPICPATH ."thumb/" . $key. "x" . $val."_".$bannerid['banner_image']){
                            @unlink(BANNERPICPATH ."thumb/" . $key . "x" . $val."_".$bannerid['banner_image']);
                        }
                    }
            }

            $this->db->where_in('banner_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>