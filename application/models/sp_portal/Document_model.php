<?php
    class Document_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='sp';
            $this->profile_thumb = array('50'=>'50', '120'=>'120');
        }

        function get_sps() {
            $this->db->select('s.*');
            $this->db->from('sp s');
            $this->db->order_by("sp_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function getDataById(){
            $id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get($this->table);
            $row=$query->row_array();
            return $row;
        }

        function getDocumentBySpId(){
            $id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_document');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function getDocumentById($id){
            $this->db->select('*');
            $this->db->where('sp_document_id',$id);
            $query=$this->db->get('sp_document');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->row_array();
            }
            return $result;
        }

        function getCoiBySpId(){
            $id = $this->session->userdata('id');
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_coi');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function insert(){
            $profile_name = "";
            if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != ""){

                $profile_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['profile_pic']['name']);

                $config['file_name'] = $profile_name;
                $config['upload_path'] = PROFILE_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('profile_pic')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";
                        // print_r($data['error']);
                        // exit;
                }else{
                        $data['upload_data'] = $this->upload->data();
                        $this->load->library('image_lib');
                        foreach ($this->profile_thumb as $key => $val) {
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = $_FILES['profile_pic']['tmp_name'];
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = false;
                                $config['width'] = $key;
                                $config['height'] = $val;
                                $config['new_image'] = PROFILE_PATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $profile_name;
                                $this->image_lib->clear();
                                $this->image_lib->initialize($config);
                                $this->image_lib->resize();
                        }
                }
            }

            $data = array();
            $data['company_name'] = $this->input->post('company_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['username'] = $this->input->post('username');
            $data['profile'] = $profile_name;
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
            $data['address'] = $this->input->post('address');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['status'] = $this->input->post('status');
            $data['password'] = md5($this->input->post('password'));

            if($this->db->insert($this->table,$data)){
                $id=$this->db->insert_id();
                return true;
            }else{
                return false;
            }
        }

        function update(){

            // echo "<pre>";print_r($_POST);
            // exit;

            if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name'] != ""){
                    if(file_exists(PROFILE_PATH.$this->input->post('profile_pic_old')))
                    {
                            @unlink(PROFILE_PATH.$this->input->post('profile_pic_old'));
                            foreach ($this->profile_thumb as $key => $val) {
                                    if (PROFILE_PATH ."thumb/" . $key. "x" . $val."_".$this->input->post('profile_pic_old'))
                                    {
                                            @unlink(PROFILE_PATH ."thumb/" . $key . "x" . $val."_".$this->input->post('profile_pic_old'));
                                    }
                            }
                    }

                    $profile_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['profile_pic']['name']);

                    $config['file_name'] = $profile_name;
                    $config['upload_path'] = PROFILE_PATH;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('profile_pic')) {
                            $data['error'] = array('error' => $this->upload->display_errors());
                            // echo "<pre>";
                            // print_r($data['error']);
                            // exit;
                    }else{
                            $data['upload_data'] = $this->upload->data();
                            $this->load->library('image_lib');
                            foreach ($this->profile_thumb as $key => $val) {
                                    $config['image_library'] = 'gd2';
                                    $config['source_image'] = $_FILES['profile_pic']['tmp_name'];
                                    $config['create_thumb'] = false;
                                    $config['maintain_ratio'] = false;
                                    $config['width'] = $key;
                                    $config['height'] = $val;
                                    $config['new_image'] = PROFILE_PATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $profile_name;
                                    $this->image_lib->clear();
                                    $this->image_lib->initialize($config);
                                    $this->image_lib->resize();
                            }
                    }
            }else{
                    $profile_name = $this->input->post('profile_pic_old');
            }

            $data = array();
            $data['company_name'] = $this->input->post('company_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['username'] = $this->input->post('username');
            $data['profile'] = $profile_name;
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
            $data['address'] = $this->input->post('address');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['status'] = $this->input->post('status');
            if($_POST['password'] != ""){
                $data['password'] = md5($this->input->post('password'));
            }
            
            $this->db->where('sp_id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){
                return true;
            }else{
                return false;
            }
        }

        function document_save(){
            $success = "N";

            $document_name = "";
            if(isset($_FILES['document']['name']) && $_FILES['document']['name'] != ""){

                $document_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['document']['name']);
                $config['file_name'] = $document_name;
                $config['upload_path'] = SPDOC_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|pdf';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('document')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";
                        // print_r($data['error']);
                        // exit;
                }else{
                    $data = array();
                    $data['sp_id'] = $this->session->userdata('id');;
                    $data['title'] = $this->input->post('title');
                    $data['discription'] = $this->input->post('discription');
                    $data['document'] = $document_name;

                    if($this->db->insert('sp_document',$data)){
                        $id=$this->db->insert_id();
                        $success = "Y";
                    }
                }
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }
            
        }

        function coi_save(){

            $success = "N";

            $document_name = "";
            if(isset($_FILES['document']['name']) && $_FILES['document']['name'] != ""){

                $document_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['document']['name']);
                $config['file_name'] = $document_name;
                $config['upload_path'] = SPDOC_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg|doc|docx|pdf';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('document')) {
                        $data['error'] = array('error' => $this->upload->display_errors());
                        // echo "<pre>";
                        // print_r($data['error']);
                        // exit;
                }else{
                    $data = array();
                    $data['sp_id'] = $this->session->userdata('id');;
                    $data['title'] = $this->input->post('title');
                    $data['description'] = $this->input->post('description');
                    $data['expiry_date'] = $this->input->post('expiry_date');
                    $data['document'] = $document_name;

                    if($this->db->insert('sp_coi',$data)){
                        $id=$this->db->insert_id();
                        $success = "Y";
                    }
                }
            }

            if($success == "Y"){
                return true;
            }else{
                return false;
            }

        }

        function document_delete(){
            $success = "N";

            // echo "<pre>";print_r($_POST);
            // exit;

            if(isset($_POST['document'])){
                foreach($_POST['document'] as $doc_id){
                    $doc = $this->getDocumentById($doc_id);

                    if(file_exists(SPDOC_PATH.$doc['document']))
                    {
                        @unlink(SPDOC_PATH.$doc['document']);
                    }
                }

                $this->db->where_in('sp_document_id', $_POST['document']);
                $query = $this->db->delete('sp_document');
            }
            
            return true;
        }

        function st_update(){
            $this->db->set('status', $this->input->post('publish'));
            $this->db->where('id', $this->input->post('id'));
            if($this->db->update($this->table)){
                // echo $this->db->last_query();
                // echo "dddd";exit;
               return true;
            }else{
                return false;
            }
        }

        function delete(){
            $documents = $this->getDocumentBySpId($this->input->post('id'));
            foreach($documents as $doc){
                if(file_exists(SPDOC_PATH.$doc['document']))
                {
                    @unlink(SPDOC_PATH.$doc['document']);
                }
            }

            $this->db->where('sp_id', $this->input->post('id'));
            $query = $this->db->delete('sp_document');

            // ==============
            $res = $this->getDataById($this->input->post('id'));
            $profile_pic = $res['profile'];

            if(file_exists(PROFILE_PATH.$profile_pic))
            {
                @unlink(PROFILE_PATH.$profile_pic);
                foreach ($this->profile_thumb as $key => $val) {
                        if (PROFILE_PATH ."thumb/" . $key. "x" . $val."_".$profile_pic)
                        {
                            @unlink(PROFILE_PATH ."thumb/" . $key . "x" . $val."_".$profile_pic);
                        }
                }
            }
            // return true;
            // exit;
            $this->db->where('sp_id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        
    }
?>