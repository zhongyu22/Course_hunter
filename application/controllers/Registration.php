<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
    public function index() {
        // create a cpatcha number
        $this->load->helper('captcha');
        $word = strval(rand(1000,9999));
        $vals = array(
		    'word'			=> $word,
			'img_path'		=> '/var/www/htdocs/course_hunter/captcha/',
			'img_url'		=> base_url().'captcha/',
			'font_path'     => '/var/www/htdocs/course_hunter/system/fonts/texb.ttf',
			'img_width'     => '150',
			'img_height'    => 30,
			'expiration'    => 300,
		);
        $cap = create_captcha($vals);
		$data['image'] = $cap['image'];
        $data['cap_word'] = $cap['word'];
        set_cookie("cap_word", $cap['word'], "300");
		// $data['cap'] = $cap;

        $data["error"] = '';
        $this->load->view('template/header');
        $this->load->view('registration', $data);
		$this->load->view('template/footer');
    }

    public function check_reg() {
        $this->load->helper('form');
        $this->load->model('registration_model');
        $this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from registration form
        $email = $this->input->post('email');
		$password = $this->input->post('password'); //getting password from registration form
		$confirm_psw = $this->input->post('confirm_psw'); //getting remember checkbox from registration form
        $cap_word = $this->input->post('cap_word');

        if ($cap_word <> get_cookie('cap_word')) {
            $data["error"] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect captcha. </div>".
            '<a href='.base_url()."registration".'> Click here to continue</a>';
            $data['image'] = "";
            $data['cap_word'] = "";
            $this->load->view('registration', $data);
        } else {
            if (strlen($password) < 6) { 
                $data["error"] = "<div class=\"alert alert-danger\" role=\"alert\"> Password too short! Must more than 5 characters!</div> ".'<a href='.base_url()."registration".'> Click here to continue</a>';
                $data['image'] = "";
                $data['cap_word'] = "";
                $this->load->view('registration', $data);
            } else if($password <> $confirm_psw) {
                $data["error"] = "<div class=\"alert alert-danger\" role=\"alert\"> Password not the same! </div> ".'<a href='.base_url()."registration".'> Click here to continue</a>';
                $data['image'] = "";
                $data['cap_word'] = "";
                $this->load->view('registration', $data);
            } else  {
                if ($this->registration_model->do_registration($username, $email, $password)) {
                    $data["error"] = "";
                    $this->send_verify_email($email);
                    $data["code"] = get_cookie("code");
                    $this->load->view('register_success', $data); 
                    $this->load->view('login');
                } else {
                    $data['image'] = "";
                    $data['cap_word'] = "";
                    $data["error"] = "<div class=\"alert alert-danger\" role=\"alert\"> Username or email has been registered! Try another one. </div> ".'<a href='.base_url()."registration".'> Click here to continue</a>';
                    $this->load->view('registration', $data);
                }
            }
            $this->load->view('template/footer');
        }

    }


    public function send_verify_email($email) {

        $this->load->library('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mailhub.eait.uq.edu.au',
            'smtp_port' => 25,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwarp' => TRUE,
            'starttls' => true,
            'newline' => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from('zhongyu.sun@uqconnect.edu.au', 'Course Hunter Team'); 
        $this->email->to($email);
        // $this->email->cc('zhongyu.sun@uqconnect.edu.au');
        $this->email->subject('Email Verification');

        $code = rand(10000,99999);
        set_cookie("code", $code, '600');
        set_cookie("email", $email, '600');
        $message = "Your verification code is ".$code;

        $this->email->message($message);
        $this->email->send();       
    }

    public function check_code() {
        $this->load->view("template/header");
        $this->load->model('user_model');
        $code = $this->input->post("code");
        $email = $this->input->post("email");
        if (get_cookie('code')) {
            if ($code == get_cookie('code')) {
                $data["error"] = "Verify successfully, please log in.";
                $this->user_model->confirm_email(get_cookie("email"));
                $this->load->view("login", $data);
            } else {
                $data["error"] = "Wrong code. Try again.";
                $this->load->view("register_success", $data);
            }            
        } else {
            $data["msg"] = "Verification expired, go to profile and resend code.";
            $this->load->view("fail", $data);
        }
    }

    public function send_verfication_in_profile($email) {
        $this->send_verify_email($email);
        redirect('profile');

    }

}