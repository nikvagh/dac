<?php
    class Paymentcard_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->table='payment_cards';
            $this->profile_thumb = array('50'=>'50', '120'=>'120');
        }

        function get_lists() {
            $this->db->select('pc.*');
            $this->db->from('payment_cards pc');
            $this->db->order_by("pc.id", "Desc");
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
            $this->db->select('pc.*');
            $this->db->where('pc.id',$id);
            $this->db->from('payment_cards pc');
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
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['number'] = $this->input->post('number');
            $data['expiry_month'] = $this->input->post('expiry_month');
            $data['expiry_year'] = $this->input->post('expiry_year');
            $data['cvv'] = $this->input->post('cvv');

            if($this->db->insert($this->table,$data)){
                $payment_id = $this->db->insert_id();
                $success = "Y";
            }
            
            if($success == "Y"){
                return true;
            }else{
                return false;
            }
        }

        function update(){
            $success = "N";
        
            $data = array();
            $data['name'] = $this->input->post('name');
            $data['number'] = $this->input->post('number');
            $data['expiry_month'] = $this->input->post('expiry_month');
            $data['expiry_year'] = $this->input->post('expiry_year');
            $data['cvv'] = $this->input->post('cvv');

            $this->db->where('id',$this->input->post('id'));
            if($this->db->update($this->table,$data)){
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
            $this->db->where('id', $this->input->post('id'));
            if ($query = $this->db->delete($this->table))
                return true;
            else
                return false;
        }
        
    }
?>