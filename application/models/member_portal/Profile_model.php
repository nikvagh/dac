<?php
class Profile_model extends CI_Model{
	function __construct(){
                parent::__construct();
                $this->table = 'member';
                $this->profile_thumb = array('50'=>'50', '120'=>'120');
        }
        
	function get_user() {
                $this->db->select('*');
		$this->db->where('member_id',$this->session->userdata('id'));	
		$query = $this->db->get($this->table);
		$result = array();
		if ($query->num_rows() > 0) {
		        $result = $query->row_array();
		}
		return $result;
        }

        function get_user_by_refer_code($refer_code) {
                $this->db->select('*');
		$this->db->where('refer_code',$refer_code);	
		$query = $this->db->get($this->table);
		$result = array();
		if ($query->num_rows() > 0) {
		        $result = $query->row_array();
		}
		return $result;
        }
        
        function get_vehicle(){
                $this->db->select('*');
		$this->db->where('member_id',$this->session->userdata('id'));	
		$query = $this->db->get('member_vehicle');
		$result = array();
		if ($query->num_rows() > 0) {
		        $result = $query->result_array();
		}
		return $result;
        }
	
	function update_profile()
	{
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
                $data['firstname'] = $this->input->post('firstname');
                $data['lastname'] = $this->input->post('lastname');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['profile'] = $profile_name;
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['address'] = $this->input->post('address');
                if($_POST['password'] != ""){
                        $data['password'] = md5($this->input->post('password'));
                }

                $this->db->where('member_id',$this->session->userdata('id'));
                $query=$this->db->update($this->table,$data);
                if($query){
                        $user = $this->get_user();
                        $_SESSION['loginData'] = (object) $user;
                        return true;
                }else{
                        return false;
                }
        }
        
        function update_member_vehicle(){
                // echo "<pre>";
                // print_r($_POST['vehicle_name']);
                // exit;

                $this->db->where('member_id', $this->session->userdata('id'));
                $query = $this->db->delete('member_vehicle');

                foreach($_POST['vehicle_name'] as $key=>$val){
                        $name = $_POST['vehicle_name'][$key];
                        $year = $_POST['vehicle_year'][$key];
                        if($name != "" && $year != ""){

                                $data = array();
                                $data['member_id'] = $this->session->userdata('id');
                                $data['name'] = $name;
                                $data['year'] = $year;
                                if($this->db->insert('member_vehicle',$data)){

                                }
                        }
                }

                return true;
        }

        function register(){
                $success = "N";

                $data = array();
                // if(isset($_POST['service_provide'])){
                //         $service_provide = implode(',',$_POST['service_provide']);
                // }

                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['password'] = md5($this->input->post('password'));
                $data['refer_code'] = random_str(6);
                if(isset($_POST['refer_code']) &&  $_POST['refer_code'] != ""){
                        $member = $this->get_user_by_refer_code($_POST['refer_code']);
                        if(!empty($member)){
                                $data['refer_from'] = $member['member_id'];
                                $data['refer_valid_paid'] = 'Y';
                        }
                }

                if($this->db->insert($this->table,$data)){
                        $member_id = $this->db->insert_id();
                        $success = "Y";
                }
                
                if($success == "Y"){
                        return true;
                }else{
                        return false;
                }

        }
}
?>