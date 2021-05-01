<?php
	class Settings extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			checkLogin('admin');
		}		

		function index()
		{
        	$data['settings'] = TRUE;
			$data['title'] = "Settings";
			$this->load->view(ADMINPATH.'settings', $data);
		}

		function update()
		{
			$data['title'] = "Settings";
			if(isset($_POST['submit'])){
				$settings_arr = array("company_name", "company_address", "company_mobile", "company_email", "site_name", "company_copyright", "service_provider_content", "");

				$success = "N";
				for($i=0; $i < count($settings_arr); $i++)
				{
					$settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
					$this->db->where('config_name', $settings_arr[$i]);	
					if($query = $this->db->update('web_config', $settings_data)){
						$success = "Y";
					}
				}

				if($success == "Y"){
					$this->session->set_flashdata('success', 'Settings has been updated successfully.');
				}
			}
			redirect(ADMINPATH.'settings');
		}

	}
?>