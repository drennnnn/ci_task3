<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]


class login_ extends CI_Model {
    
    function __construct()
    {
        $this->table = 'tbl_login';
    } 

    public function userPass($data) {
        $username = $data['username'];
        $password = $data['password'];
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get($this->table);
        $result = $query->result();
        $rowcount = $query->num_rows();
        return array('result' => $result, 'rowcount' => $rowcount);
    }

    public function lockAccount($data) {
        $username = $data['username'];
        $this->db->set('status', 'lock');
        $this->db->where('username', $username);
        $this->db->update($this->table);
    }

    public function lastlogin() {
        if ($this->session->has_userdata('id')) {
            $id = $this->session->userdata('id');
            $this->db->where('id', $id);
            $query = $this->db->get($this->table);
            $result = $query->result();
            foreach ($result as $row) {
                if ($row->lastlogin != null) {
                    date_default_timezone_set('Asia/Manila');
                    $this->db->set('lastlogin', date("Y-m-d") . ' ' . date("H:i:s"));
                    $this->db->where('id', $id);
                    $this->db->update($this->table);
                    $this->session->set_userdata('lastlogin', date("Y-m-d") . ' ' . date("H:i:s"));
                }
            }
        }
    }
}
?>