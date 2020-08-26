<?php
    class user_model extends CI_Model{
        function user_model(){
            parent::__construct();
            $this->table='user';
        }
        function get_user($num, $offset) {
        $this->db->select('*');

        $this->db->order_by("user_id", "Desc");
        $this->db->limit($num, $offset);

        $query = $this->db->get($this->table);
        $user = array();
 
            if ($query->num_rows() > 0) {
                $user = $query->result_array();
            }
                return $user;
        }
        function get_list_count() {
            $this->db->select('*');
            $this->db->order_by("user_id", "desc");
            $query = $this->db->get($this->table);
            return $query->num_rows();
        }
        function get_country(){
            $this->db->select('*');
            $query=$this->db->get('countries');
            $countries=$query->result_array();
            return $countries;
        }
        function get_state($cid){
            $query = $this->db->get_where('states', array('country_id' => $cid));
            $states=$query->result_array();
            return $states;
        }
        function get_city($cid){
            $query = $this->db->get_where('cities', array('state_id' => $cid));
            $cities=$query->result_array();
            return $cities;
        }
        function get_edit_data($userid){
            $this->db->select('*');
            $this->db->where('user_id',$userid);
            $query=$this->db->get($this->table);
            $udata=$query->row_array();
            return $udata;
        }
        function user_insert(){

            $unique = $this->functions->GenerateUniqueFilePrefix();
            $image_file = $unique .'_'.$this->input->post('firstname'). preg_replace("/\s+/", "_", $_FILES['profile']['name']);

            $config['file_name'] = $image_file;
            $config['upload_path'] = MEMBERPICPATH;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('profile')) {
                $data['error'] = array('error' => $this->upload->display_errors());
            }else{
                $data['upload_data'] = $this->upload->data();
                $this->load->library('image_lib');
                $sizes = array(50=>50,160=>160,253=>285);
                foreach ($sizes as $key => $val) {
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $_FILES['profile']['tmp_name'];
                    $config['create_thumb'] = false;
                    $config['maintain_ratio'] = true;
                    $config['width'] = $key;
                    $config['height'] = $val;
                    $config['new_image'] = MEMBERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
            }
            $data=array(
                'user_firstname'=>$this->input->post('firstname'),
                'user_lastname'=>$this->input->post('lastname'),
                'user_username'=>$this->input->post('username'),
                'user_email'=>$this->input->post('email'),
                'user_phno'=>$this->input->post('phno'),
                'user_birthdate'=>$this->input->post('birthdate'),
                'user_profile'=>$image_file,
                'user_country'=>$this->input->post('country'),
                'user_state'=>$this->input->post('state'),
                'user_city'=>$this->input->post('city'),
                'user_address'=>$this->input->post('address'),
                'user_password'=> md5($this->input->post('password')),
                'user_status'=>'1',
            );
            $this->db->insert($this->table,$data);
           // echo $this->db->last_query();exit;
            $id=$this->db->insert_id();
            return $id;
        }
        
        function update(){
            if($_FILES['profile']['name']==""){
                $image_file=$this->input->post('oldprofile');
            }else{
                if(file_exists(MEMBERPICPATH.$this->input->post('oldprofile'))){
                    @unlink(MEMBERPICPATH.$this->input->post('oldprofile'));
                    $sizes = array(50=>50,160=>160,253=>285);
                    foreach ($sizes as $key => $val) {
                        if (MEMBERPICPATH ."thumb/" . $key. "x" . $val."_".$this->input->post('oldprofile')){
                            @unlink(MEMBERPICPATH ."thumb/" . $key . "x" . $val."_".$this->input->post('oldprofile'));
                        }
                    }
                }
                $unique = $this->functions->GenerateUniqueFilePrefix();
                $image_file = $unique . '_'.$this->input->post('firstname'). preg_replace("/\s+/", "_", $_FILES['profile']['name']);

                $config['file_name'] = $image_file;
                $config['upload_path'] = MEMBERPICPATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('profile')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                } else {
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $sizes = array(50=>50,160=>160,253=>285);
                    foreach ($sizes as $key => $val) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['profile']['tmp_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = true;
                        $config['width'] = $key;
                        $config['height'] = $val;
                        $config['new_image'] = MEMBERPICPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $data=array(
                'user_firstname'=>$this->input->post('firstname'),
                'user_lastname'=>$this->input->post('lastname'),
                'user_username'=>$this->input->post('username'),
                'user_email'=>$this->input->post('email'),
                'user_phno'=>$this->input->post('phno'),
                'user_birthdate'=>$this->input->post('birthdate'),
                'user_profile'=>$image_file,
                'user_country'=>$this->input->post('country'),
                'user_state'=>$this->input->post('state'),
                'user_city'=>$this->input->post('city'),
                'user_address'=>$this->input->post('address'),
            );
            $this->db->where('user_id',$this->input->post('userid'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }
        
        function st_update(){
            $this->db->set('user_status', $this->input->post('publish'));
            $this->db->where('user_id', $this->input->post('userid'));
            $query=$this->db->update($this->table);
            if($query){
               return true;
            }else{
                return false;
            }
        }
        
        function delete(){
            $userid = $this->get_edit_data($this->input->post('userid'));
            if (file_exists(MEMBERPICPATH . $userid['user_profile'])){
                @unlink(MEMBERPICPATH . $userid['user_profile']);
                $sizes = array(50=>50,160=>160,253=>285);
                foreach ($sizes as $key => $val) {
                    if (MEMBERPICPATH ."thumb/" . $key. "x" . $val."_".$userid['user_profile']){
                        echo MEMBERPICPATH ."thumb/" .$key . "x" . $val."_".$userid['user_profile'];
                        @unlink(MEMBERPICPATH ."thumb/" . $key . "x" . $val."_".$userid['user_profile']);
                    }
                }
            }        
            $this->db->where('user_id', $this->input->post('userid'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        function deleteselected() {
            $arrProduct = $this->input->post('u_list');

            for ($m = 0; $m < count($arrProduct); $m++) {
                $userid = $this->get_edit_data($arrProduct[$m]);

                if (file_exists(MEMBERPICPATH . $userid['user_profile']))
                    @unlink(MEMBERPICPATH . $userid['user_profile']);
                    $sizes = array(50=>50,160=>160,253=>285);
                    foreach ($sizes as $key => $val) {
                        if (MEMBERPICPATH ."thumb/" . $key. "x" . $val."_".$userid['user_profile']){
                            echo MEMBERPICPATH ."thumb/" .$key . "x" . $val."_".$userid['user_profile'];
                            @unlink(MEMBERPICPATH ."thumb/" . $key . "x" . $val."_".$userid['user_profile']);
                        }
                    }
            }

            $this->db->where_in('user_id', $this->input->post('u_list'));

            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
    }
?>