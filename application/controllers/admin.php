<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_');
    }

    public function index() {
        if ($this->session->has_userdata('type')) {
            if ($this->session->userdata('type') == "admin"){
                $this->load->view('admin');
                $this->load->view('style');
                $this->load->view('bodyadmin');
                $this->load->view('footer');
                #$this->session->sess_destroy();
            }else {
                redirect('client/index');
            }
        }else {
            redirect('login/index');
        }
    }
    function getAdmins() {
        $data = $row = array();
        $tableData = $this->admin_->getAdminRows($_POST);
        $i = $_POST['start'];
        foreach ($tableData as $data) {
            $i++;
            $button = "<div id='client-actions' style='text-align:center;'>
                        <button id='admin-account-change' class='btn btn-danger' style='margin-bottom:5px' tag='{$data->id}'>Password</button> ";
            if ($data->status == 'lock') {
                $button .= "<button id='admin-action' action='unlock' class='btn btn-primary' tag='{$data->id}'>Unlock</button></div>";
            }else {
                $button .= "<button id='admin-action' action='lock' class='btn btn-primary' tag='{$data->id}'>Lock</button></div>";
            }

            $arrangeData[] = array($i, $button, $data->firstname, $data->middlename, $data->lastname, $data->birthdate, $data->age, $data->birthplace, $data->gender, $data->address, $data->email, $data->mobile, $data->status, $data->lastlogin, $data->creationdate);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_->countAllAdmin(),
            "recordsFiltered" => $this->admin_->countFilteredAdmin($_POST),
            "data" => $arrangeData,
        );
        echo json_encode($output); 
    }
    function getList() {
        $data = $row = array();
        $tableData = $this->admin_->getRows($_POST);
        $i = $_POST['start'];
        foreach ($tableData as $data) {
            $i++;
            $button = "<div id='client-actions' style='text-align:center;'>
                        <button id='admin-change' class='btn btn-danger' style='margin-bottom:5px' tag='{$data->id}'>Password</button> ";
            if ($data->status == 'lock') {
                $button .= "<button id='action' action='unlock' class='btn btn-primary' tag='{$data->id}'>Unlock</button></div>";
            }else {
                $button .= "<button id='action' action='lock' class='btn btn-primary' tag='{$data->id}'>Lock</button></div>";
            }

            $arrangeData[] = array($i, $button, $data->firstname, $data->middlename, $data->lastname, $data->birthdate, $data->age, $data->birthplace, $data->gender, $data->address, $data->email, $data->mobile, $data->status, $data->lastlogin, $data->creationdate);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->admin_->countAll(),
            "recordsFiltered" => $this->admin_->countFiltered($_POST),
            "data" => $arrangeData,
        );
        echo json_encode($output); 
    }

    public function updateUser() {
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        $this->admin_->updateUser($id, $value);
    }

    public function updateAdmin() {
        $id = $this->input->post('id');
        $value = $this->input->post('value');
        $rank = $this->admin_->getRank($id);
        $myrank = $this->session->userdata('rank');
        $myid = $this->session->userdata('id');
        $error = '';
        #print_r($rank . ', ' . $id . ', ' . $value . ', ' . $myrank . ', ' . $myid);
        if ($myrank < $rank || $myrank == 1) {
            $this->admin_->updateAdmin($id, $value);
        }else {
            $error = "*something went wrong.";
            echo $error;
        }
    }

    public function adminUpdateClientPass() {
        $data = $this->input->post('data');
        $id = $this->input->post('id');
        $data = urldecode($data);
        $data = $this->convertFormDataToArray($data);
        $password = $data['pass'];
        #print_r($data['pass']);
        #print_r($data['conpass']);die;
        $error = $this->validatePasswordUpdateForClient($data);
        echo $error;
        if ($error == '') {
            $this->admin_->adminUpdateClientPass($id, $password);
        }
    }
    public function adminUpdateAdminPass() {
        $id = $this->input->post('id');
        $rank = $this->admin_->getRank($id);
        $myid = $this->session->userdata('id');
        $myrank = $this->session->userdata('rank');
        $formdata = $this->input->post('formdata');
        $formdata = urldecode($formdata);
        $formdata = $this->convertFormDataToArray($formdata);
        $data = array('pass' => $formdata['admin-pass'], 'conpass' => $formdata['admin-conpass']);
        $error = $this->validatePasswordUpdateForClient($data);
        echo $error;
        if ($error == '') {
            if ($id == $myid || $myid == 1 || $myrank < $rank){
                $this->admin_->adminUpdateClientPass($id, $data['conpass']);
            }else {
                echo '*something went wrong';
            }

        }
    }

    private static function validatePasswordUpdateForClient($data) {
        foreach ($data as $pass) {
            if ($pass == ''){
                return '*required fields';
            }
        }
        if(strlen($data['pass']) < 8) {
            return '*password should be more than 8 characters.';
        }
        if($data['pass'] != $data['conpass']){
            return "*password doesn't matched.";
        }
    }

    private static function convertFormDataToArray($formdata){
        $data_arr = array();
        $formdata = explode("&", $formdata);
        foreach($formdata as $row){
            if($row != ''){
                list($key, $value) = explode("=", $row);
                $key = str_replace(';', '', $key);
                if($key != "undefined") $data_arr[$key] = $value;
            }
        }
        return $data_arr;
    }

    public function addAdmin() {
        $data = $this->input->post('data');
        $data = urldecode($data);
        $data = $this->convertFormDataToArray($data);
        $error = $this->checkData($data);
        echo $error;
        $newData = array(
            'type' => 'admin',
            'username' => $data['admin-username'],
            'password' => $data['admin-password'],
            'firstname' => $data['admin-firstname'],
            'middlename' => $data['admin-middlename'],
            'lastname' => $data['admin-lastname'],
            'birthdate' => $data['admin-birthdate'],
            'age' => $data['admin-age'],
            'birthplace' => $data['admin-birthplace'],
            'gender' => $data['admin-gender'],
            'address' => $data['admin-address'],
            'email' => $data['admin-email'],
            'mobile' => $data['admin-mobile'],
            'rank' => $this->session->userdata('rank') + 1
        );
        if ($error == ''){
            $this->admin_->addAdmin($newData);
        }
        

    }

    private function checkData($formdata) {
		foreach ($formdata as $data) {
			if ($data == '')
			{
				return '*required fields';
			}
		}
		$rowusername = $this->admin_->checkUsername($formdata['admin-username']);
		if ($rowusername > 0) {
			return '*username already exist';
		}
        if (strlen($formdata['admin-password']) < 8){
            return '*password should be 8 or more characters.';

        }
		if(strlen($formdata['admin-mobile']) != 11 ) {
			return '*invalid mobile numer';
		}
		if (substr($formdata['admin-mobile'], 0, 2) != '09') {
			return '*invalid mobile number';
		}
		$rowmobile = $this->admin_->checkMobile($formdata['admin-mobile']);
		if ($rowmobile > 0) {
			return '*mobile number already exist';
		}
		if (!(str_contains($formdata['admin-email'], '@') && str_contains($formdata['admin-email'], '.com'))){
			return '*invalid email';
		}else {
			$ctr = 0;
			foreach (str_split($formdata['admin-email']) as $char)
			{
				if ($char == '@'){
					$ctr++;
				}
			}
			if ($ctr > 1) {
				return '*invalid email';
			}
            if (strpos($formdata['admin-email'], '@') == 0){
				return "*invalid email";
			}
			$split = str_split($formdata['admin-email']);
			if ($split[strpos($formdata['admin-email'], '@') - 1] == '.' || $split[strpos($formdata['admin-email'], '@') + 1] == '.' || str_contains($formdata['admin-email'], '..') || $split[0] == '.' || end($split) == '.'){
				return '*invalid email';
			}
		}
		$rowemail = $this->admin_->checkEmail($formdata['admin-email']);
		if ($rowemail > 0) {
			return '*email already exist';
		}
	}

}
?>