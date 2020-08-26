<?php

    class Forgotpassword_Model extends CI_Model {

        function Forgotpassword_Model() {
            //parent::CI_Model();
            parent::__construct();

            $this->table = 'admin';
        }
        function updatePassword()
        {
            $return_data = array();
            $select = mysql_fetch_array(mysql_query("select * from $this->table where admin_email = '".trim($this->input->post('email'))."'"));
            if(count($select['admin_id']) > 0)
            {
                $pw = 'pd'.$this->functions->generate_randomnumber(5);
                $password = $pw;
                $data = array(
                    'admin_password'   => md5($pw)
                );

                $this->db->where('admin_email', $this->input->post('email'));
                if ($this->db->update($this->table, $data))
                {
//                    echo "ya";exit;
                    $return_data['update_id'] = $select['admin_id'];
                    $return_data['password'] = $password;
                    return $return_data;
                }
                else
                    return false;
            }else{
//                echo "na";exit;
                return 'fail';
            }
        }
        
        function getUser($id)
        {
            $this->db->select('*');
            $this->db->where('admin_id', $id);

            $query = $this->db->get($this->table);

            if ($query->num_rows() == 1) {
                return $query->row_array();
            } else {
                return false;
            }
        }
    }

?>