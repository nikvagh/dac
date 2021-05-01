<?php
	class Settings extends CI_Controller {
	
		function __construct()
		{
			parent::__construct();
			$this->load->model('CountryModel','Country');
			$this->load->model('SettingsModel','Settings');
			checkLogin('admin');
		}

		function index()
		{
			$content['title'] = "Settings";
			$content['currency_list'] = $this->Country->get_currency_list();
			$views["content"] = ["path"=>ADMIN.'settings_list',"data"=>$content];
            $layout['page'] = 'settings_list';
            $this->layouts->view($views,'admin_dashboard',$layout);
		}

		// function add_currency_to_country(){
		// 	$this->db->select('s.*');
		// 	$this->db->from('countries as s');
		// 	$this->db->order_by("id", "Desc");
		// 	$query = $this->db->get();
		// 	$result = $query->result();

		// 	foreach($result as $key=>$val){
		// 		$row = $this->db->select('cr.*')->from('currency as cr')->where("cr.country", $val->nicename)->get()->row();
		// 		if($row){
		// 			$update_data = [];
		// 			$update_data['currency'] = $row->currency;
		// 			$update_data['currency_code'] = $row->code;
		// 			$update_data['currency_symbol'] = $row->symbol;
		// 			$this->db->where('nicename', $val->nicename);
		// 			$this->db->update('countries', $update_data);
		// 		}
		// 	}
		// }

		public function validation() {
            // echo "<pre>";print_r($_POST);print_r($_FILES);
            // $this->form_validation->set_data($_POST);
            // exit;

			if($_POST['settingType'] == 'companyCoreSetting'){
				$this->form_validation->set_rules('currency', 'Currency', 'required');
				$this->form_validation->set_rules('company_name', 'Company name', 'required');
				$this->form_validation->set_rules('company_phone1', 'Company Phone', 'required|numeric');
				$this->form_validation->set_rules('company_address', 'Company Address', 'required');
				if ($this->form_validation->run()) {
					// header("Content-type:application/json");
					echo json_encode(['status'=>200]);
				} else {
					// header("Content-type:application/json");
					echo json_encode(['status'=>400,'result'=>$this->form_validation->error_array()]);
				}
			} 
        }

		function update()
		{
			// echo "<pre>"; print_r($_POST); exit;
			if ($this->Settings->update()) {
				$this->session->set_flashdata('success', 'Settings has been updated successfully.');
				$result['tab'] = $this->input->post('settingType');
				echo json_encode(['status'=>200,'result'=>$result]);
			}
		}

	}
?>