<?php
    class news_model extends CI_Model{
        function news_model(){
            parent::__construct();
            $this->table='news';
        }
        function get_news($num, $offset) {
        $this->db->select('*');
        $this->db->order_by("news_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $news = array();
            if ($query->num_rows() > 0) {
                $news = $query->result_array();
            }
            return $news;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("news_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_edit_data($newsid){
            $this->db->select('*');
            $this->db->where('news_id',$newsid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function news_insert(){

            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image_file = $unique .'_'.preg_replace("/\s+/", "_", $_FILES['newsimage']['name']);
            
            $config['file_name'] = $image_file;
            $config['upload_path'] = NEWSPICPATH;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('newsimage')) {
                $data['error'] = array('error' => $this->upload->display_errors());
            } else {
                $data['upload_data'] = $this->upload->data();
                $this->load->library('image_lib');
                $sizes = array(30=>30,200=>200);
                foreach ($sizes as $key => $val) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $_FILES['newsimage']['tmp_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = false;
                    $config['width'] = $key;
                    $config['height'] = $val;
                    $config['new_image'] = NEWSPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            
            $data=array(
                'news_title'=>$this->input->post('newstitle'),
                'news_shortdescription'=>$this->input->post('shortdes'),
                'news_longdescription'=>$this->input->post('longdes'),
                'news_image'=>$image_file,
                'news_status'=>'1'
            );
            $this->db->insert($this->table,$data);
            $id=$this->db->insert_id();
            return $id;
        }
        function update(){
            if($_FILES['newsimage']['name']==""){
                $image_file=$this->input->post('oldnewsimage');
            }else{
                if(file_exists(NEWSPICPATH.$this->input->post('oldnewsimage'))){
                    @unlink(NEWSPICPATH.$this->input->post('oldnewsimage'));
                    $sizes = array(30 => 30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        if (NEWSPICPATH ."thumb/" . $key. "x" . $val."_".$this->input->post('oldnewsimage')){
                            @unlink(NEWSPICPATH ."thumb/" . $key . "x" . $val."_".$this->input->post('oldnewsimage'));
                        }
                    }
                }
                $unique = $this->functions->GenerateUniqueFilePrefix();
                $image_file = $unique .'_'. preg_replace("/\s+/", "_", $_FILES['newsimage']['name']);

                $config['file_name'] = $image_file;
                $config['upload_path'] = NEWSPICPATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('newsimage')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $sizes = array(30 => 30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        echo"dscd";
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['newsimage']['tmp_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = false;
                        $config['width'] = $key;
                        $config['height'] = $val;
                        $config['new_image'] = NEWSPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $data=array(
                'news_title'=>$this->input->post('newstitle'),
                'news_shortdescription'=>$this->input->post('shortdes'),
                'news_longdescription'=>$this->input->post('longdes'),
                'news_image'=>$image_file,
                'news_status'=>'1',
            );
           // print_r($data);exit;
            $this->db->where('news_id',$this->input->post('newsid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        function st_update(){
            $this->db->set('news_status', $this->input->post('publish'));
            $this->db->where('news_id', $this->input->post('newsid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        function delete(){
            $newsid = $this->get_edit_data($this->input->post('newsid'));
            if (file_exists(NEWSPICPATH . $newsid['news_image'])){
                @unlink(NEWSPICPATH . $newsid['news_image']);
                $sizes = array(30 => 30 , 200=>200);
                foreach ($sizes as $key => $val) {
                    if (NEWSPICPATH ."thumb/" . $key. "x" . $val."_".$newsid['news_image']){
                        @unlink(NEWSPICPATH ."thumb/" . $key . "x". $val."_".$newsid['news_image']);
                    }
                }
            }        
            $this->db->where('news_id', $this->input->post('newsid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $newsid = $this->get_edit_data($arrProduct[$m]);

                if (file_exists(NEWSPICPATH . $newsid['news_image']))
                    @unlink(NEWSPICPATH . $newsid['news_image']);
                    $sizes = array(30 => 30 , 200=>200);
                    foreach ($sizes as $key => $val) {
                        if (NEWSPICPATH ."thumb/" . $key. "x" . $val."_".$newsid['news_image']){
                             @unlink(NEWSPICPATH ."thumb/" . $key . "x". $val."_".$newsid['news_image']);
                        }
                    }
            }

            $this->db->where_in('news_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>