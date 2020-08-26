<?php
class Profile extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(SPPATH.'profile_model','profile');
            $this->load->model(SPPATH.'service_model','service');
            $this->load->library('upload');
            checkLogin('sp');

            // echo "<pre>";
            // print_r($_SESSION);
            // exit;

        }
        function index(){
            $data['title']="Profile";
            $data['edit_profile'] = TRUE;
            $data['profile'] = $this->profile->get_user();
            $data['services'] = $this->service->get_services_active();
            $this->load->view(SPPATH.'profile_view.php',$data);
            // $this->load->view(SPPATH.'profile_edit.php',$data);
        }
        function profile_edit(){
            $data['company_form'] = TRUE;
            $data['title']= "Company Info";
            $data['services'] = $this->service->get_services_active();
            $data['equipments'] = $this->profile->get_equipments();
            $data['last_30_yr'] = get_last_30_yr();

            $data['vehicle_selected'] = $this->profile->get_selected_vehicles();
            $data['industry_reference_seleted'] = $this->profile->get_selected_industry_reference();
            $data['employee_seleted'] = $this->profile->get_selected_employee();
            $data['certificate_seleted'] = $this->profile->get_selected_certificate();
            $data['form_data'] = $this->profile->get_user();

            if(isset($_POST['submit'])){
                if ($result = $this->profile->update_profile_all()) {
                    $this->session->set_flashdata('success','Service Provider information has been update successfully.');
                    redirect(SPPATH.'profile/profile_edit');
                }
            // }elseif($this->input->post('cancel')){
            //         redirect('sp');
            }else{
                $this->load->view(SPPATH.'profile_edit',$data);
            }
            
        }
        function update_profile()
        {
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            
            if(isset($_POST['submit'])){
                if ($result = $this->profile->update_profile()) {
                    $this->session->set_flashdata('success', 'Profile Details Updated successfully.');
                }else{
                    $this->session->set_flashdata('error', 'Something Wrong. Please Try Again');
                }

                redirect(SPPATH.'profile/index/');
            }
        }

        function emailCheck_edit(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $this->db->where('sp_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('sp');
            if ($query1->num_rows() > 0) {
                $err++;
            }
        
            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query2 = $this->db->get('admin');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query3 = $this->db->get('member');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }

        function usernameCheck_edit(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $this->db->where('sp_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('sp');
            if ($query1->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query2 = $this->db->get('admin');
            if ($query2->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query3 = $this->db->get('member');
            if ($query3->num_rows() > 0) {
                $err++;
            }

            if ($err > 0) {
                echo json_encode(false);
            }else{
                echo json_encode(true);
            }
        }

    }
?>