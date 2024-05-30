<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('register_');
	}
	public function index()
	{
		if ($this->session->has_userdata('type')) {
			redirect('admin/index');
		}else {
			$this->load->view('register');
			$this->load->view('style');
			$this->load->view('bodyregister');
			$this->load->view('footer');
		}
	}

	public function validateData() {
		$formdata = $this->input->post('data');
		$formdata = urldecode($formdata);
		$formdata = $this->convertFormDataToArray($formdata);
		$error = $this->checkData($formdata);
		$formdata['password'] = strtoupper($formdata['lastname']);
		if ($error == '') {
			$this->register_->newUser($formdata);
		}else {
			echo $error;
		}
	}

	private function checkData($formdata) {
		foreach ($formdata as $data) {
			if ($data == '')
			{
				return '*required fields';
			}
		}
		$rowusername = $this->register_->checkUsername($formdata['username']);
		if ($rowusername > 0) {
			return '*username already exist';
		}
		if(strlen($formdata['mobile']) != 11 ) {
			return '*invalid mobile numer';
		}
		if (substr($formdata['mobile'], 0, 2) != '09') {
			return '*invalid mobile number';
		}
		$rowmobile = $this->register_->checkMobile($formdata['mobile']);
		if ($rowmobile > 0) {
			return '*mobile number already exist';
		}
		if (!(str_contains($formdata['email'], '@') && str_contains($formdata['email'], '.com'))){
			return '*invalid email';
		}else {
			$ctr = 0;
			foreach (str_split($formdata['email']) as $char)
			{
				if ($char == '@'){
					$ctr++;
				}
			}
			if ($ctr > 1) {
				return '*invalid email';
			}
			if (strpos($formdata['email'], '@') == 0){
				return "*invalid email";
			}
			$split = str_split($formdata['email']);
			if ($split[strpos($formdata['email'], '@') - 1] == '.' || $split[strpos($formdata['email'], '@') + 1] == '.' || str_contains($formdata['email'], '..') || $split[0] == '.' || end($split) == '.'){
				return '*invalid email';
			}
		}
		$rowemail = $this->register_->checkEmail($formdata['email']);
		if ($rowemail > 0) {
			return '*email already exist';
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
	
	public function calculateAge() {
        $birthdate = $this->input->post('birthdate');
        $age = $this->get_age($birthdate);
        echo json_encode(array('age' => $age));
    }

    private function get_age($birthdate) {
        $birthDate = new DateTime($birthdate);
        $today = new DateTime('today');
        $age = $birthDate->diff($today)->y;
        return $age;
    }
}
