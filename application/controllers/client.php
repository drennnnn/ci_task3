<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class client extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('client_');
    }

    public function index() {
        if ($this->session->has_userdata('type')) {
            if ($this->session->userdata('type') == "client"){
                $lastlogin = $this->session->userdata('lastlogin');
                if ($lastlogin == null) {
                    $this->load->view('password');
                    $this->load->view('style');
                    $this->load->view('changepassword');
                    $this->load->view('footer');
                }else {
                    $this->load->view('client');
                    $this->load->view('style');
                    $this->load->view('bodyclient');
                    $this->load->view('footer');
                    #$this->session->sess_destroy();
                }
            }else {
                redirect('admin/index');
            }
        }else {
            redirect('login/index');
        }
    }

    public function changePass() {
        $data = $this->input->post('data');
        $data = urldecode($data);
        $data = $this->convertFormDataToArray($data);
        $error = $this->checkErrors($data);
        if ($error == '') {
            $this->client_->changePass($data);
        }else {
            echo $error;
        }
    }

    private function checkErrors($formdata) {
        foreach ($formdata as $data) {
			if ($data == '')
			{
				return '*required fields';
			}
		}
        if ($formdata['oldpass'] != $this->session->userdata('password')) {
            return '*incorrect password';
        }
        if (strlen($formdata['newpass']) < 8) {
            return '*new password should be 8 characters and above';
        }
        if ($formdata['newpass'] != $formdata['conpass']) {
            return "*new password doesn't matched";
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
    
    public function clientChangePass() {
        $this->session->set_userdata('lastlogin', null);
    }

    public function logout() {
        $this->session->sess_destroy();
    }
}
?>