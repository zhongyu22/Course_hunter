<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here
 class User_model extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('users');

        if($result->num_rows() == 1){
            return true;
        } else {
            return false;
        }
    
    }

    public function get_user($username) {
        $query = $this->db->get_where('users',
                                    array(
                                       'username' => $username));
        return $query->row_array();                               
    }

    public function check_email_exists($email) {
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        if($result->num_rows() == 1){
            return false;
        } else {
            return true;
        }
    }

    public function change_email($username, $email) {
            $data["email"] = $email;
            $data["verified"] = 0;
            $this->db->where('username', $username);
            $this->db->update('users', $data);
    }  

    public function confirm_email($email) {
        // $data["email"] = $email;
        $data["verified"] = 1;
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }
    
    public function check_if_verified($username) {  //return 0 if email is not verified
        $this->db->select("verified");
        $this->db->from("users");
        $this->db->where('username', $username);
        return $this->db->get();
    }

    public function save_token($email, $token) {
        $data["email"] = $email;
        $data["token"] = $token;
        $this->db->insert("tokens", $data);
    }

    public function check_token($token) {
        $this->db->where("token", $token);
        $result = $this->db->get('tokens');
        if ($result->num_rows() == 1) {
            $email = $result->row_array()["email"];
            $this->db->delete('tokens', array('token' => $token));
            return $email;
        } else {
            return false;
        }
    }

    public function resetPassword($email, $password) {
        $data["password"] = $password;
        $this->db->where("email", $email);
        $this->db->update('users', $data);
    }
    
    
}
?>
