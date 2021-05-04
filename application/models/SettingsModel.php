<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SettingsModel extends CI_Model {
    function __construct() {
        $this->table = 'notification_template';
        $this->primaryKey = 'id';
    }

    function get_list($num="", $offset="") {
        $this->db->select('*');
        // $this->db->order_by("id", "Desc");
        if($num != "" && $offset != ""){
            $this->db->limit($num, $offset);
        }

        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }

    function getDataById($id){
        $this->db->select('*');
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    function create(){
        // echo "<pre>"; print_r($_POST); print_r($_FILES); exit;
        if($this->input->post('status')){
            $status = 'Enable';
        }else{
            $status = 'Disable';
        }

        $notification_ids = [];
        foreach($this->input->post('users') as $key=>$val){
            $data = array(
                'title'=>$this->input->post('title'),
                'message'=>$this->input->post('message'),
                'user_id'=>$val
            );
            $this->db->insert($this->table,$data);
            $notification_ids[] = $this->db->insert_id();
        }

        if(!empty($notification_ids)){
            return true;
        }
    }

    function update(){
        if($_POST['settingType'] == 'companyCoreSetting'){
            $settings_arr = array("currency", "company_name", "company_phone1", "company_email", "company_address");

            $success = "N";
            for($i=0; $i < count($settings_arr); $i++)
            {
                $settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
                $this->db->where('config_name', $settings_arr[$i]);	
                if($query = $this->db->update('web_config', $settings_data)){
                    $success = "Y";
                }
            }

            // $company_logo_name = $this->input->post('company_logo_old');
            if(isset($_FILES['company_logo']['name']) && $_FILES['company_logo']['name'] != ""){

                // remove old file
                if(file_exists(SYSTEM_IMG.$this->input->post('company_logo_old'))){
                    @unlink(SYSTEM_IMG.$this->input->post('company_logo_old'));
                }
                    
                $company_logo_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['company_logo']['name']);
                
                $config['file_name'] = $company_logo_name;
                $config['upload_path'] = SYSTEM_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('company_logo')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                    // echo "<pre>";print_r($data['error']);
                }

                $settings_data = array('config_value' =>  $company_logo_name);
                $this->db->where('config_name', 'company_logo');
                $this->db->update('web_config', $settings_data);
            }

            if(isset($_FILES['company_favicon']['name']) && $_FILES['company_favicon']['name'] != ""){

                // remove old file
                if(file_exists(SYSTEM_IMG.$this->input->post('company_favicon_old'))){
                    @unlink(SYSTEM_IMG.$this->input->post('company_favicon_old'));
                }
                    
                $company_favicon_name = time() .'_'.preg_replace("/\s+/", "_", $_FILES['company_favicon']['name']);
                
                $config['file_name'] = $company_favicon_name;
                $config['upload_path'] = SYSTEM_IMG;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('company_favicon')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                    // echo "<pre>";print_r($data['error']);
                }

                $settings_data = array('config_value' =>  $company_favicon_name);
                $this->db->where('config_name', 'company_favicon');
                $this->db->update('web_config', $settings_data);
            }
            
        }

        if($_POST['settingType'] == 'paymentSetting'){
            $settings_arr = array("service_paid_locally","paypal","stripe","razorpay","flutterwave","paystack","paypal_environment_sandbox", "paypal_environment_production", "stripe_published_key", "stripe_secret_key", "razorpay_key", "flutterwave_public_key", "paystack_public_key");

            $success = "N";
            for($i=0; $i < count($settings_arr); $i++)
            {
                // "service_paid_locally","paypal","stripe","razorpay","flutterwave","paystack"
                if(in_array($settings_arr[$i],["service_paid_locally","paypal","stripe","razorpay","flutterwave","paystack"])){
                    if($this->input->post($settings_arr[$i])){
                        $settings_data = array('config_value' =>  'Yes');
                    }else{
                        $settings_data = array('config_value' =>  'No');
                    }
                }else{
                    $settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
                }

                $this->db->where('config_name', $settings_arr[$i]);
                if($query = $this->db->update('web_config', $settings_data)){
                    $success = "Y";
                }
            }
        }

        if($_POST['settingType'] == 'userVerificationSetting'){
            $settings_arr = array("user_verification","user_verify_by_sms","user_verify_by_email","twilio_account_id","twilio_auth_token","twilio_phone_number");

            $success = "N";
            for($i=0; $i < count($settings_arr); $i++)
            {
                if(in_array($settings_arr[$i],["user_verification","user_verify_by_sms","user_verify_by_email"])){
                    if($this->input->post($settings_arr[$i])){
                        $settings_data = array('config_value' =>  'Yes');
                    }else{
                        $settings_data = array('config_value' =>  'No');
                    }
                }else{
                    $settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
                }

                $this->db->where('config_name', $settings_arr[$i]);
                if($query = $this->db->update('web_config', $settings_data)){
                    $success = "Y";
                }
            }
        }

        if($_POST['settingType'] == 'notificationSetting'){
            $settings_arr = array("push_notification","mail_notification","onesignal_app_id","onesignal_auth_key","onesignal_rest_api_key","project_number","mail_host","mail_port","mail_username","mail_password","mail_encryption","mail_from_address");

            $success = "N";
            for($i=0; $i < count($settings_arr); $i++)
            {
                if(in_array($settings_arr[$i],["push_notification","mail_notification"])){
                    if($this->input->post($settings_arr[$i])){
                        $settings_data = array('config_value' =>  'Yes');
                    }else{
                        $settings_data = array('config_value' =>  'No');
                    }
                }else{
                    $settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
                }

                $this->db->where('config_name', $settings_arr[$i]);
                if($query = $this->db->update('web_config', $settings_data)){
                    $success = "Y";
                }
            }
        }

        if($_POST['settingType'] == 'privacyPolicy'){
            $settings_arr = array("privacy_policy");

            $success = "N";
            for($i=0; $i < count($settings_arr); $i++)
            {
                $settings_data = array('config_value' =>  $this->input->post($settings_arr[$i]));
                $this->db->where('config_name', $settings_arr[$i]);
                if($query = $this->db->update('web_config', $settings_data)){
                    $success = "Y";
                }
            }
        }

        return true;
    }

    function st_update(){
        $this->db->set('status', $this->input->post('publish'));
        $this->db->where('id', $this->input->post('id'));
        $query = $this->db->update($this->table);

        if($query){
           return true;
        }else{
            return false;
        }
    }

    function delete(){
        $row = $this->getDataById($this->input->post('id'));

        $this->db->where('id', $this->input->post('id'));
        if ($query = $this->db->delete($this->table)){
            return true;
        }else{
            return false;
        }
    }

}