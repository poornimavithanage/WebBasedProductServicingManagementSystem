<?php

class Login_modal extends CI_Model {

    public function getlogin($user_name, $user_password) {

        $this->db->select(array("user_name", "user_password"));
        $this->db->where(array('user_name' => $user_name, 'user_password' => $user_password));
        $result = $this->db->get("tbl_login");
        $result = $result->num_rows();
        if ($result == 1) {
            $this->session->set_userdata('user_name',$user_name);
            //$this->session->set_userdata('logged_in', $session_data);
            return $result;
        } else {
            return FALSE;
        }
    }

}
