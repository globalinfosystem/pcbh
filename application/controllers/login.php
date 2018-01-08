<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends SB_controller {

    protected $_key = 'id';
    protected $_class = 'page';
    protected $layout = "layouts/main";
    private $hatron;

    function __construct() {
        parent::__construct();
        $this->layout = 'login/index';
        $this->load->library('session');
		$this->load->model('Page_model');
    }

    function index() {
        $this->load->helper('security');
        if (!empty($_SESSION['user'])) {
            redirect('account');
        }

        $data = array();
        $this->load->helper('form');
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('type', 'Select user type want to login ', 'required');
			$this->form_validation->set_rules('username', 'Username ', 'trim|required');
            $this->form_validation->set_rules('admin_password', 'Password ', 'trim|required');
			$this->form_validation->set_rules('captcha', 'Captcha ', 'trim|required');
            $this->form_validation->set_error_delimiters('<div style="color: red;">', '</div>');
            if ($this->form_validation->run()) {
				
				$captcha = base64_decode(base64_decode(trim($this->input->post('captcha'))));
				$captchatext = base64_decode(base64_decode(trim($this->input->post('captchatext'))));
				if (trim($captcha) != trim($captchatext)) {
					$this->session->set_flashdata('error', 'Ops Something went wrong. Please check captcha!');
					 $this->session->set_flashdata('type', $_POST['type']);
					redirect('login', 301);
					exit();
				}
			
                if (!empty($_POST['type']) && $_POST['type'] == 1) {
                    $user_details_array = $this->Page_model->login(trim($this->input->post('username')), base64_decode(base64_decode(trim($this->input->post('admin_password')))), $this->input->post('type'));
                    if (!empty($user_details_array)) {
                        $_SESSION['user'] =  $user_details_array;
                        $_SESSION['acountType'] =  $_POST['type'];
                        redirect('account', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Error in Admin Login <br/>Wrong Username and password !!!');
                        $this->session->set_flashdata('type', '1');
                        redirect('login');
                    }
				}
                if (!empty($_POST['type']) && $_POST['type'] == 2) {
                    $user_details_array = $this->Page_model->login(trim($this->input->post('username')), base64_decode(base64_decode(trim($this->input->post('admin_password')))), $this->input->post('type'));
                    if (!empty($user_details_array)) {
                        $_SESSION['user'] =  $user_details_array;
                        $_SESSION['acountType'] =  $_POST['type'];
                         redirect('account', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Error in Admin Login <br/>Wrong Username and password !!!');
                        $this->session->set_flashdata('type', '1');
                        redirect('login');
                    }
                }
				//////// start litracy and society login /////////
				if (!empty($_POST['type'])) {
                    $user_details_array = $this->Page_model->login(trim($this->input->post('username')), base64_decode(base64_decode(trim($this->input->post('admin_password')))), $this->input->post('type'));
                    if (!empty($user_details_array)) {
                        $_SESSION['user'] =  $user_details_array;
                         redirect('account', 'refresh');
                    } else {
                        $this->session->set_flashdata('error', 'Error in Admin Login <br/>Wrong Username and password !!!');
                        redirect('login');
                    }
                }
				//////// end litracy and society login /////////
            }
            $data['error'] = 'Error Processing Login !!!';
        }

        $this->load->view($this->layout, $data);
    }

    function logout() {
			unset($_SESSION['acountType']);
        session_destroy();
        redirect('login', 'refresh');
    }

    function logoutApp() {
        redirect('http://hrmsdemo.gravitasoft.com/Login/emplogout');
    }

    function adminlogout() {
        $this->session->unset_userdata('admin');
        redirect('auth/adminlogin', 'refresh');
    }

    function redirection($url) {
        return "<script>window.location.href={$url}</script>";
    }

}
