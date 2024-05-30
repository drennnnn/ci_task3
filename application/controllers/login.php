<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_');
	}

	public function index() {
		if ($this->session->has_userdata('type')) {
			redirect('admin/index');
		}else {
			$this->load->view('login');
			$this->load->view('style');
			$this->load->view('bodylogin');
			$this->load->view('footer');
		}
	}

	public function login() {
		$data = urldecode($this->input->post('data'));
		$data = $this->convertFormDataToArray($data);
		$query = $this->login_->userPass($data);
		#echo $query['rowcount'];
		#print_r($query['result']);
		$result = $query['result'];
		if ($query['rowcount'] > 0) {
			foreach ($result as $row) {
				if ($row->status == 'lock') {
					echo '*your account is lock';
					return;
				}
				$session = array(
					'id' => $row->id, 
					'type' => $row->type, 
					'username' => $row->username, 
					'password' => $row->password, 
					'firstname' => $row->firstname, 
					'middlename' => $row->middlename, 
					'lastname' => $row->lastname, 
					'birthdate' => $row->birthdate, 
					'age' => $row->age, 
					'birthplace' => $row->birthplace, 
					'gender' => $row->gender, 
					'address' => $row->address, 
					'email' => $row->email, 
					'mobile' => $row->mobile, 
					'status' => $row->status, 
					'lastlogin' => $row->lastlogin, 
					'rank' => $row->rank,
					'creationdate' => $row->creationdate, 
				);
				$this->session->set_userdata($session);
			}
			$this->login_->lastlogin();
			
		}else {
			if ($this->session->has_userdata('error')) {
				if ($this->session->userdata('error') == 4) {
					$this->login_->lockAccount($data);
					echo "*something went wrong. please try again later";
					$this->session->unset_userdata('error');
					return;
				}else {
					$ctr = $this->session->userdata('error') + 1;
					$this->session->set_userdata('error', $ctr);
				}
			}else {
				$ctr = 1;
				$this->session->set_userdata('error', $ctr);
			}
			echo '*Incorrect Username or Password';
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
}
