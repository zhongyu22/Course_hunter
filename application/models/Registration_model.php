<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class Registration_model extends CI_Model{

    public function do_registration($username, $email, $password){
        //Check if username has been registered
        $flag = true;
        $this->db->where('username', $username);
        $result_username = $this->db->get('users');
        if($result_username->num_rows() == 0){
            $this->db->where('email', $email);
            $result_email = $this->db->get('users');
            if ($result_email->num_rows() == 0) {
                $data = array(
                'username' => $username,
                'email' => $email,
                'password' => $password
            );
            return $this->db->insert('users', $data);
            }
        } else {}
    }

}