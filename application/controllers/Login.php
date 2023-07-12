<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	
	public function index()
	{
		$data['error']= "";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password))//check username and password correct
				{
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					redirect("welcome"); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			redirect("welcome"); //if user already logined show main page
		}
		$this->load->view('template/footer');
	}


	public function check_login()
	{
		$this->load->model('user_model');		//load user model
		$data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or passwrod!! </div> ";
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('template/header');
		$username = $this->input->post('username'); //getting username from login form
		$password = $this->input->post('password'); //getting password from login form
		$remember = $this->input->post('remember'); //getting remember checkbox from login form
		if(!$this->session->userdata('logged_in')){	//Check if user already login
			if ( $this->user_model->login($username, $password) )//check username and password
			{
				$user_data = array( 
					'username' => $username,
					'logged_in' => true 	//create session variable
				);
				if($remember) { // if remember me is activated create cookie
					set_cookie("username", $username, '600'); //set cookie username
					set_cookie("password", $password, '600'); //set cookie password
					set_cookie("remember", $remember, '600'); //set cookie remember
				}	
				$this->session->set_userdata($user_data); //set user status to login in session
				redirect('login'); // direct user home page
			}else
			{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{
			{
				redirect('welcome'); //if user already logined direct user to home page
			}
		$this->load->view('template/footer');
		}
	}

	
	public function logout()
	{
		$this->session->unset_userdata('logged_in'); //delete login status
		// set_cookie("username", $username, '-300'); //set cookie username
		// set_cookie("password", $password, '-300'); //set cookie password
		set_cookie("remember", $remember, '-300'); //set cookie remember
		// delete_cookie("username_display");
		redirect('welcome'); // redirect user back to homepage
	}

	public function forgot () {
		$this->load->view("template/header");
		$this->load->view('forgot');
	}


	public function send_reset_link() {
		$this->load->library('email');
		$this->load->model("user_model");
		$token = rand(10000000,99999999);
		$email = $this->input->post("email");
		if ($this->user_model->check_email_exists($email)) {  // return false is exists
			$data["msg"] = "This email is not registered.";
			$this->load->view('template/header');
			$this->load->view('fail', $data);
		} else {
		$this->user_model->save_token($email, $token);

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
        $this->email->subject('Reset Password');
		$message = "Click the link to reset your password: "."https://infs3202-6f6a6362.uqcloud.net/course_hunter/login/checkToken/".$token;
		$this->email->message($message);
        $this->email->send(); 

		$data["msg"] = "The reset link has been sent to your email address, please check.";
		$this->load->view("template/header");
		$this->load->view("success", $data); 
		}

	}


	public function checkToken($token) { //allow user to reset psw is token is in database
		$this->load->model("user_model");
		$email = $this->user_model->check_token($token); //if token exists, will return the email address
		if ($email) {
			$data["email"] = $email;
			$this->load->view("template/header");
			$this->load->view("reset_password", $data);
			$this->load->view("template/footer");
		} else {
			$data["msg"] = "Wrong token.";
			$this->load->view("template/header");
			$this->load->view("fail", $data);
		}
	}

	public function resetPassword() {
		$this->load->model("user_model");
		$email = $this->input->post("email");
		$new_password = $this->input->post("password");
		$this->user_model->resetPassword($email, $new_password);
		$data["msg"] = "Reset password successfully! Log in with your new passsword.";
		$this->load->view("template/header");
		$this->load->view("success", $data);
	}






}
?>