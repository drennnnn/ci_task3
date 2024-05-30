<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#[\AllowDynamicProperties]


class admin_ extends CI_Model {
    
    function __construct()
    {
        $this->table = 'tbl_login';
        $this->column_order = array(null, null, 'firstname','middlename','lastname','birthdate','age','birthplace','gender','address','email','mobile','status','lastlogin','creationdate');
        $this->column_search = array('firstname','middlename','lastname','birthdate','age','birthplace','gender','address','email','mobile','status','lastlogin','creationdate');
        $this->order = array('id' => 'asc');
    } 
    Public function getAdminRows($postData) {
        $this->_get_admin_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('type', 'admin');
        $query = $this->db->get();
        return $query->result();
    }

    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->where('type', 'client');
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_admin_datatables_query($postData){
        $this->db->from($this->table);

        $i = 0;

        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }
    private function _get_datatables_query($postData){
        $this->db->from($this->table);

        $i = 0;

        foreach($this->column_search as $item){
            if($postData['search']['value']){
                if($i===0){
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if(count($this->column_search) - 1 == $i){
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

    }
    
    public function countAll() {
        $this->db->where('type', 'client');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function countAllAdmin() {
        $this->db->where('type', 'admin');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function countFilteredAdmin($postData) {
        $this->_get_datatables_query($postData);
        $this->db->where('type', 'admin');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countFiltered($postData) {
        $this->_get_datatables_query($postData);
        $this->db->where('type', 'client');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function updateUser($id, $value) {
        $this->db->set('status', $value);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }

    public function adminUpdateClientPass($id, $password) {
        $this->db->set('password', $password);
        $this->db->where('id', $id);
        $this->db->update($this->table);
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

    public function addAdmin($data) {
        $this->db->insert($this->table, $data);
    }

    public function getRank($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        $result = $query->result();
        $rank = '';
        foreach ($result as $row) {
            $rank = $row->rank;
        }
        return $rank;
    }

    public function updateAdmin($id, $value) {
        $this->db->set('status', $value);
        $this->db->where('id', $id);
        $this->db->update($this->table);
    }
}
?>