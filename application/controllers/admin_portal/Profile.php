<?php
class Profile extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model(ADMINPATH.'profile_model','profile');
            $this->load->library('upload');
            checkLogin('admin');

            // echo "<pre>";
            // print_r($_SESSION);
            // exit;

        }
        function index(){
            $data['title']="Profile";
            $data['edit_profile']=TRUE;
            $data['profile'] = $this->profile->get_user();
            $this->load->view(ADMINPATH.'profile_view.php',$data);
            // $this->load->view(ADMINPATH.'profile_edit.php',$data);
        }
        function view_profile(){
            $data['title']="Profile";
            $data['profile'] = $this->profile->get_admin();
            $this->load->view(ADMINPATH.'profile_view.php',$data);
        }
        function update_profile()
        {
            // echo "<pre>";
            // print_r($_POST);
            // exit;
            
            // if($_POST['submit']){
                if ($result = $this->profile->update_profile()) {
                    $this->session->set_flashdata('success', 'Profile Details Updated successfully.');
                }else{
                    $this->session->set_flashdata('error', 'Something Wrong. Please Try Again');
                }

                redirect(ADMINPATH.'profile/index/');
            // }
        }

        function emailCheck_edit(){
            $err = 0;

            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $this->db->where('admin_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('admin');
            if ($query1->num_rows() > 0) {
                $err++;
            }
        
            $this->db->select('*');
            $this->db->where('email =',$this->input->post('email'));
            $query2 = $this->db->get('member');
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
            $this->db->where('admin_id !=',$this->session->userdata('id'));
            $query1 = $this->db->get('admin');
            if ($query1->num_rows() > 0) {
                $err++;
            }

            $this->db->select('*');
            $this->db->where('username =',$this->input->post('username'));
            $query2 = $this->db->get('member');
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