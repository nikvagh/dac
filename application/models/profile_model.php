<?php
class Profile_model extends CI_Model{
	function profile_model(){
		parent::__construct();
		$this->table = 'admin';
	}
	function get_admin() {
		$this->db->select('*');
		$this->db->where('admin_id',$this->session->userdata('id'));	
		$query = $this->db->get($this->table);
		$admin = array();
 
		if ($query->num_rows() > 0) {
			$admin = $query->row_array();
		}
		return $admin;
	}
	
	function update_profile()
	{
            if($_FILES['admin_image']['name'] == ""){
                    $image_file=$this->input->post('old_admin_image');
            }else{

                if(file_exists(ADMINPATH.$this->input->post('old_admin_image')))
                {
                        @unlink(ADMINPATH.$this->input->post('old_admin_image'));
                        $sizes = array(50=>50,45=>45,128=>128);
                        foreach ($sizes as $key => $val) {
                                if (ADMINPATH ."thumb/" . $key. "x" . $val."_".$this->input->post('old_admin_image'))
                                {
                                        @unlink(ADMINPATH ."thumb/" . $key . "x" . $val."_".$this->input->post('old_admin_image'));
                                }
                        }
                }

                $unique = $this->functions->GenerateUniqueFilePrefix();
                $image_file = $unique .'_'.preg_replace("/\s+/", "_", $_FILES['admin_image']['name']);

                $config['file_name'] = $image_file;
                $config['upload_path'] = ADMINPATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('admin_image')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                }else{
                    $data['upload_data'] = $this->upload->data();
                    $this->load->library('image_lib');
                    $sizes = array(50=>50,45=>45,128=>128);
                    foreach ($sizes as $key => $val) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $_FILES['admin_image']['tmp_name'];
                        $config['create_thumb'] = false;
                        $config['maintain_ratio'] = false;
                        $config['width'] = $key;
                        $config['height'] = $val;
                        $config['new_image'] = ADMINPATH . "thumb/" . $config['width'] . "x" . $config['height'] . "_" . $image_file;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                }
            }
            $data=array(
                    'admin_name' => $this->input->post('admin_name'),
                    'admin_firstname' => $this->input->post('admin_firstname'),
                    'admin_lastname' => $this->input->post('admin_lastname'),
                    'admin_email' => $this->input->post('admin_email'),
                    'admin_image' => $image_file,
                    'admin_website' => $this->input->post('admin_website'),
                    'admin_contact1' => $this->input->post('admin_contact1'),
                    'admin_contact2' => $this->input->post('admin_contact2'),
                    'admin_fax' => $this->input->post('admin_fax'),
                    'admin_address' => $this->input->post('admin_address'),
                    'admin_city' => $this->input->post('admin_city'),
                    'admin_zip' => $this->input->post('admin_zip')
            );
            $this->db->where('admin_id',$this->session->userdata('id'));
            $query=$this->db->update($this->table,$data);
            if($query){
                    return true;
            }else{
                    return false;
            }
	}
}
?>