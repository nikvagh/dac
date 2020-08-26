<?php
class Profile extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(MEMBERPATH.'profile_model','profile');
            $this->load->library('upload');
            checkLogin('member');

            // echo "<pre>";
            // print_r($_SESSION);
            // exit;
        }

        function index(){
            $data['title']="Profile";
            $data['edit_profile']=TRUE;
            $data['profile'] = $this->profile->get_user();
            $data['vehicles'] = $this->profile->get_vehicle();
            $data['last_30_yr'] = get_last_30_yr();
            $this->load->view(MEMBERPATH.'profile_view.php',$data);
            // $this->load->view(MEMBERPATH.'profile_edit.php',$data);
        }

        function view_profile(){
            $data['title']="Profile";
            $data['profile'] = $this->profile->get_admin();
            $this->load->view(MEMBERPATH.'profile_view.php',$data);
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

                redirect(MEMBERPATH.'profile/index/');
            }

            if(isset($_POST['submit_vehicle'])){
                if ($result = $this->profile->update_member_vehicle()) {
                    $this->session->set_flashdata('success', 'Profile Details Updated successfully.');
                }else{
                    $this->session->set_flashdata('error', 'Something Wrong. Please Try Again');
                }

                redirect(MEMBERPATH.'profile/index/');
            }

        }

        function emailCheck_edit(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $this->db->where('member_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('member');
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
            $query3 = $this->db->get('sp');
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
            $this->db->where('member_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('member');
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
            $query3 = $this->db->get('sp');
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