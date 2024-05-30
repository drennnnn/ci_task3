<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]


class register_ extends CI_Model {
    
    function __construct()
    {
        $this->table = 'tbl_login';
    } 

    public function checkUsername($username) {
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
    public function checkMobile($mobile) {
        $this->db->where('mobile', $mobile);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
    public function checkEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
    public function newUser($formdata) {
        $this->db->insert($this->table, $formdata);
    }
}
?>