<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]


class client_ extends CI_Model {
    
    function __construct()
    {
        $this->table = 'tbl_login';
    } 

    public function changePass($data) {
        date_default_timezone_set('Asia/Manila');
        $id =  $this->session->userdata('id');
        $this->db->set('password', $data['conpass']);
        $this->db->set('lastlogin', date("Y-m-d") . ' ' . date("H:i:s"));
        $this->db->where('id', $id);
        $this->db->update($this->table,);
        $this->session->set_userdata('password', $data['conpass']);
        $this->session->set_userdata('lastlogin', date("Y-m-d") . ' ' . date("H:i:s"));
    }

}
?>