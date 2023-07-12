<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function index() {
        $data["error"] = '';

        $this->load->view("template/header");
        if (!$this->session->userdata('logged_in'))//check if user already login
		{	
			if (get_cookie('remember')) { // check if user activate the "remember me" feature  
				$username = get_cookie('username'); //get the username from cookie
                $data["username"] = $username;
				$password = get_cookie('password'); //get the username from cookie
				if ( $this->user_model->login($username, $password) )//check username and password correct
				{
					$user_data = array(
						'username' => $username,
						'logged_in' => true 	//create session variable
					);
					$this->session->set_userdata($user_data); //set user status to login in session
					// $this->load->view('profile_view', $data); //if user already logined show main page
				}
			}else{
				$this->load->view('login', $data);	//if username password incorrect, show error msg and ask user to login
			}
		}else{ 
			$username = $this->session->userdata('username');
			$this->load->model('user_model');
			$data["user_item"] = $this->user_model->get_user($username);
			// $data["verified"] = $this->user_model->check_if_verified($username);
			$this->load->model('courses_model');
			$data['favourites'] = $this->courses_model->get_favourites($username);
		}
		$this->load->view('profile_view', $data); 

		if ($data["user_item"]["identity"] == 'staff') {
			$this->load->view('courses/add_course', $data);
		}
		$this->load->view('template/footer');
    }

	public function change_email() {
		$this->load->model('user_model');
		$data["error"] = '';
		$username = $this->session->userdata('username');
		$new_email = $this->input->post("new_email");
		if ($this->user_model->check_email_exists($new_email)) {
			$this->user_model->change_email($username, $new_email);
			redirect('profile');
		} else {
			echo "<script type='text/javascript'> alert('The email address has been registered. Try another one.'); </script>";
			$this->index();
		}
	}

	public function add_course() {
		$this->load->model('courses_model');
		$data["error"] = "";
		// $id, $coursename, $staffname, $intro
		$id = $this->input->post("course_id");
		$coursename = $this->input->post("course_name");
		$intro = $this->input->post("course_intro");
		$staff = $this->input->post("course_staff");

		if ($this->courses_model->check_course_exist($id)) {
			$this->courses_model->add_course($id, $coursename, $staff, $intro);
			$this->index();
		} else {
			$data["error"] =  "Course already exists. Try another course id!";
			$this->load->view("template/header");
			$this->load->view("courses/add_course", $data);	  
		}	
    }

	public function show_favourites($username) {
		$this->load->model('courses_model');
		$data['favourites'] = $this->courese_model->get_favourites($username);
		$this->load->view('favourites', $data);

	}




}