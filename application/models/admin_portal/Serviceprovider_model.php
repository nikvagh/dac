<?php
    class Serviceprovider_model extends CI_Model{
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

        function get_sps_active() {
            $this->db->select('s.*');
            $this->db->from('sp s');
            $this->db->where('s.status','Enable');
            $this->db->order_by("sp_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function get_equipments() {
            $this->db->select('e.*');
            $this->db->from('equipment e');
            $this->db->order_by("equipment_id", "Desc");
            $query = $this->db->get();

            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result; 
        }

        function getDataById($id){
            $this->db->select('sp.*,group_concat(equipment_name SEPARATOR "</br>") as equipment_str');
            $this->db->where('sp.sp_id',$id);
            $this->db->join('equipment e','find_in_set(e.equipment_id,sp.equipment) > 0','left');
            $this->db->from('sp');
            $query = $this->db->get();
            $row = $query->row_array();
            return $row;
        }

        function getDocumentBySpId($id){
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

        function get_selected_vehicles($id){
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_vehicle');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_selected_industry_reference($id){
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_industry_reference');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_selected_employee($id){
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_employee');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function get_selected_certificate($id){
            $this->db->select('*');
            $this->db->where('sp_id',$id);
            $query=$this->db->get('sp_certificate');
            $result = array();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
            }
            return $result;
        }

        function insert(){

            // echo "<pre>";
            // print_r($_POST);
            // exit;

            $success = "N";

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
            if(isset($_POST['service_provide'])){
                $service_provide = implode(',',$_POST['service_provide']);
            }

            $data['company_name'] = $this->input->post('company_name');
            $data['email'] = $this->input->post('email');
            // $data['phone'] = $this->input->post('phone');
            $data['username'] = $this->input->post('username');
            $data['profile'] = $profile_name;
            // $data['latitude'] = $this->input->post('latitude');
            // $data['longitude'] = $this->input->post('longitude');
            // $data['city'] = $this->input->post('city');
            // $data['state'] = $this->input->post('state');
            // $data['zipcode'] = $this->input->post('zipcode');
            // $data['service_provide'] = $service_provide;
            $data['type_of_facility'] = $this->input->post('type_of_facility');
            $data['address'] = $this->input->post('address');
            $data['status'] = $this->input->post('status');
            $data['password'] = md5($this->input->post('password'));
            $data['hours_of_road_operation'] = $this->input->post('hours_of_road_operation');
            $data['phone_day'] = $this->input->post('phone_day');
            $data['phone_night'] = $this->input->post('phone_night');
            $data['phone_cell'] = $this->input->post('phone_cell');
            $data['tax_identification_number'] = $this->input->post('tax_identification_number');

            $data['length_of_operation'] = $this->input->post('length_of_operation');
            $data['owner_first_name'] = $this->input->post('owner_first_name');
            $data['owner_last_name'] = $this->input->post('owner_last_name');
            $data['more_than_one_owner'] = "N";
            if(isset($_POST['more_than_one_owner'])){
                $data['more_than_one_owner'] = $this->input->post('more_than_one_owner');
            }

            $data['owner_address'] = $this->input->post('owner_address');
            $data['diff_mail_address'] = "N";
            if(isset($_POST['diff_mail_address'])){
                    $data['diff_mail_address'] = $this->input->post('diff_mail_address');
            }
            $data['owner_phone'] = $this->input->post('owner_phone');

            $data['liability_insurance_amount'] = $this->input->post('liability_insurance_amount');
            $data['liability_insurance_carrier'] = $this->input->post('liability_insurance_carrier');
            $data['compensation_insurance_carrier'] = $this->input->post('compensation_insurance_carrier');

            $data['with_uniform_or_not'] = $this->input->post('with_uniform_or_not');
            if(isset($_POST['uniform_supplier'])){
                $data['uniform_supplier'] = $this->input->post('uniform_supplier');
            }
            $data['test_drugs_alcohol'] = $this->input->post('test_drugs_alcohol');
            $equipment = "";
            if(isset($_POST['equipment'])){
                $equipment = implode(',',$_POST['equipment']);
            } 
            $data['equipment'] = $equipment;

            if($this->db->insert($this->table,$data)){
                $sp_id = $this->db->insert_id();

                // =================
                    foreach($_POST['vehicle_type'] as $key=>$val){
                        $data_vh = array();
                        $data_vh['sp_id'] = $sp_id;
                        $data_vh['vehicle_type'] = $_POST['vehicle_type'][$key];
                        $data_vh['vehicle_year'] = $_POST['vehicle_year'][$key];
                        $data_vh['make'] = $_POST['make'][$key];
                        // $data_vh['class'] = $_POST['class'][$key];
                        $this->db->insert('sp_vehicle',$data_vh);
                    }
                // =================
                    foreach($_POST['employee_name'] as $key=>$val){
                        $data_emp = array();
                        $data_emp['sp_id'] = $sp_id;
                        $data_emp['employee_name'] = $_POST['employee_name'][$key];
                        $data_emp['driver_license'] = $_POST['driver_license'][$key];
                        $data_emp['license_class'] = $_POST['license_class'][$key];
                        $this->db->insert('sp_employee',$data_emp);
                    }
                // =================
                    foreach($_POST['organization'] as $key=>$val){
                        $data_or = array();
                        $data_or['sp_id'] = $sp_id;
                        $data_or['organization'] = $_POST['organization'][$key];
                        $data_or['date_certified'] = $_POST['date_certified'][$key];
                        $this->db->insert('sp_certificate',$data_or);
                    }
                // =================
                    foreach($_POST['ref_name'] as $key=>$val){
                        $data_ir = array();
                        $data_ir['sp_id'] = $sp_id;
                        $data_ir['ref_name'] = $_POST['ref_name'][$key];
                        $data_ir['ref_company'] = $_POST['ref_company'][$key];
                        $data_ir['ref_phone'] = $_POST['ref_phone'][$key];
                        $data_ir['ref_year'] = $_POST['ref_year'][$key];
                        $this->db->insert('sp_industry_reference',$data_ir);
                    }
                // =================
                
                $success = "Y";
            }
            
            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        function update(){

            // echo "<pre>";print_r($_POST);
            // exit;

            $success = "N";
            
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

            $data['email'] = $this->input->post('email');
            $data['username'] = $this->input->post('username');
            if($_POST['password'] != ""){
                $data['password'] = md5($this->input->post('password'));
            }
            $data['profile'] = $profile_name;
            $data['status'] = $this->input->post('status');
            $data['company_name'] = $this->input->post('company_name');
            $data['type_of_facility'] = $this->input->post('type_of_facility');
            $data['address'] = $this->input->post('address');
            // $data['latitude'] = $this->input->post('latitude');
            // $data['longitude'] = $this->input->post('longitude');
            // $data['city'] = $this->input->post('city');
            // $data['state'] = $this->input->post('state');
            // $data['zipcode'] = $this->input->post('zipcode');
            // if(isset($_POST['service_provide'])){
            //     $service_provide = implode(',',$_POST['service_provide']);
            // } 
            // $data['service_provide'] = $service_provide;
            $data['hours_of_road_operation'] = $this->input->post('hours_of_road_operation');
            $data['phone_day'] = $this->input->post('phone_day');
            $data['phone_night'] = $this->input->post('phone_night');
            $data['phone_cell'] = $this->input->post('phone_cell');
            $data['tax_identification_number'] = $this->input->post('tax_identification_number');

            $data['length_of_operation'] = $this->input->post('length_of_operation');
            $data['owner_first_name'] = $this->input->post('owner_first_name');
            $data['owner_last_name'] = $this->input->post('owner_last_name');
            $data['more_than_one_owner'] = "N";
            if(isset($_POST['more_than_one_owner'])){
                $data['more_than_one_owner'] = $this->input->post('more_than_one_owner');
            }
            
            $data['owner_address'] = $this->input->post('owner_address');
            $data['diff_mail_address'] = "N";
            if(isset($_POST['diff_mail_address'])){
                    $data['diff_mail_address'] = $this->input->post('diff_mail_address');
            }
            $data['owner_phone'] = $this->input->post('owner_phone');

            $data['liability_insurance_amount'] = $this->input->post('liability_insurance_amount');
            $data['liability_insurance_carrier'] = $this->input->post('liability_insurance_carrier');
            $data['compensation_insurance_carrier'] = $this->input->post('compensation_insurance_carrier');

            $data['with_uniform_or_not'] = $this->input->post('with_uniform_or_not');
            if(isset($_POST['uniform_supplier'])){
                $data['uniform_supplier'] = $this->input->post('uniform_supplier');
            }
            $data['test_drugs_alcohol'] = $this->input->post('test_drugs_alcohol');
            $equipment = "";
            if(isset($_POST['equipment'])){
                $equipment = implode(',',$_POST['equipment']);
            } 
            $data['equipment'] = $equipment;

            $this->db->where('sp_id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){

                // =================
                    $this->db->where('sp_id', $this->input->post('id'));
                    $this->db->delete('sp_vehicle');

                    foreach($_POST['vehicle_type'] as $key=>$val){
                        $data_vh = array();
                        $data_vh['sp_id'] = $this->input->post('id');
                        $data_vh['vehicle_type'] = $_POST['vehicle_type'][$key];
                        $data_vh['vehicle_year'] = $_POST['vehicle_year'][$key];
                        $data_vh['make'] = $_POST['make'][$key];
                        // $data_vh['class'] = $_POST['class'][$key];
                        $this->db->insert('sp_vehicle',$data_vh);
                    }
                // =================
                    $this->db->where('sp_id', $this->input->post('id'));
                    $this->db->delete('sp_employee');

                    foreach($_POST['employee_name'] as $key=>$val){
                        $data_emp = array();
                        $data_emp['sp_id'] = $this->input->post('id');
                        $data_emp['employee_name'] = $_POST['employee_name'][$key];
                        $data_emp['driver_license'] = $_POST['driver_license'][$key];
                        $data_emp['license_class'] = $_POST['license_class'][$key];
                        $this->db->insert('sp_employee',$data_emp);
                    }
                // =================
                    $this->db->where('sp_id', $this->input->post('id'));
                    $this->db->delete('sp_certificate');

                    foreach($_POST['organization'] as $key=>$val){
                        $data_or = array();
                        $data_or['sp_id'] = $this->input->post('id');
                        $data_or['organization'] = $_POST['organization'][$key];
                        $data_or['date_certified'] = $_POST['date_certified'][$key];
                        $this->db->insert('sp_certificate',$data_or);
                    }
                // =================
                    $this->db->where('sp_id', $this->input->post('id'));
                    $this->db->delete('sp_industry_reference');

                    foreach($_POST['ref_name'] as $key=>$val){
                        $data_ir = array();
                        $data_ir['sp_id'] = $this->input->post('id');
                        $data_ir['ref_name'] = $_POST['ref_name'][$key];
                        $data_ir['ref_company'] = $_POST['ref_company'][$key];
                        $data_ir['ref_phone'] = $_POST['ref_phone'][$key];
                        $data_ir['ref_year'] = $_POST['ref_year'][$key];
                        $this->db->insert('sp_industry_reference',$data_ir);
                    }
                // =================
                
                $success = "Y";
            }

            if($success == "Y"){
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
                    $data['sp_id'] = $this->input->post('id');
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
            // $documents = $this->getDocumentBySpId($this->input->post('id'));
            // foreach($documents as $doc){
            //     if(file_exists(SPDOC_PATH.$doc['document']))
            //     {
            //         @unlink(SPDOC_PATH.$doc['document']);
            //     }
            // }

            // $this->db->where('sp_id', $this->input->post('id'));
            // $this->db->delete('sp_document');

            $this->db->where('sp_id', $this->input->post('id'));
            $this->db->delete('sp_certificate');

            $this->db->where('sp_id', $this->input->post('id'));
            $this->db->delete('sp_employee');

            $this->db->where('sp_id', $this->input->post('id'));
            $this->db->delete('sp_industry_reference    ');

            $this->db->where('sp_id', $this->input->post('id'));
            $this->db->delete('sp_vehicle');

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