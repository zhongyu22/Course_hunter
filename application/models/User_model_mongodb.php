<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //put your code here 
 class User_model_mongodb extends CI_Model{

    // Log in
    public function login($username, $password){
        // Validate
        $this->mongo_db->where('username', $username);
        $this->mongo_db->where('password', $password);
        $result = $this->mongo_db->count('users');

        if($result == 1){
            return true;
        } else {
            return false;
        }
    }
}
?>
