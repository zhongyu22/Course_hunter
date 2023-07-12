<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('courses_model');
        $this->load->helper('url_helper');
        }

    public function index() {
		$data['courses'] = $this->courses_model->get_course();
		$data['title'] = "Courses Demo";
		$this->load->view('template/header');
        $this->load->view('courses/index', $data);
        $this->load->view('template/footer');
	}

	public function read() {
        $this->load->view('template/header');
        $id = $this->input->post('course_id');
		$data['course_item'] = $this->courses_model->get_course($id);
        // set_cookie("search_item", $data['course_item'], 36000);
        if(empty($data['course_item'])) {
            show_404();
        }
        $data['title'] = 'Searching result for '.$id;
        $this->load->view('courses/read', $data);
        $this->load->view('template/footer');
	}

    public function show_search_result() {
        $this->load->view('template/header');
        $data['title'] = "Searching results";
        $data['courses'] = $this->courses_model->search_course($this->input->post("course_info"));
        $this->load->view('courses/search_result', $data);
        $this->load->view('template/footer');
    }

    public function load_detail($courseid) {
		$data['course_item'] = $this->courses_model->get_course($courseid);
        if ($this->courses_model->get_comments($courseid)) {
            $data['comments'] = $this->courses_model->get_comments($courseid);
        } else {
            $data['comments'] = "";
        }
        $this->load->view('template/header');
        $this->load->view('courses/detail', $data);
        $this->load->view('template/footer');
    }

    public function add_fav() {
		$this->load->model('courses_model');
		$courseid = $this->input->post("courseid");
		$username = $this->session->userdata("username");
		if ($username == NULL) {
            $data['msg'] = "Please login first!";
            $this->load->view('template/header');
            $this->load->view('fail', $data);
            $this->load->view('template/footer');
		} else if ($this->courses_model->add_fav($courseid, $username)) {
            $data['msg'] = "Favourite course added!";
            $this->load->view('template/header');
            $this->load->view('success',$data);
            $this->load->view('template/footer');
        } else {
            $data['msg'] = "You have added this course as your favourite!";
            $this->load->view('template/header');
            $this->load->view('fail', $data);
            $this->load->view('template/footer');
        }
	}

    public function remove_fav() { 
        $this->load->model("courses_model");
        $courseid = $this->input->post('courseid');
        $username = $this->session->userdata("username");
        $this->courses_model->remove_fav($courseid, $username);
        redirect('profile/index');
    }

    public function add_comment() {
        $this->load->model('courses_model');
		$courseid = $this->input->post("courseid");
		$username = $this->session->userdata("username");
        $comment = $this->input->post("comment");
        if ($username == NULL) {
            $data['msg'] = "Please login first!";
            $this->load->view('template/header');
            $this->load->view('fail', $data);
            $this->load->view('template/footer');
        } else if ($this->courses_model->add_comment($username, $courseid, $comment)) {
            $data['msg'] = "Comments added!";
            $this->load->view('template/header');
            $this->load->view('success',$data);
            $this->load->view('template/footer');
        } else {
            $data['msg'] = "Don't add repeat comments!";
            $this->load->view('template/header');
            $this->load->view('fail', $data);
            $this->load->view('template/footer');
        }
    }

    public function like_course() {
        $this->load->model('courses_model');
        $courseid = $this->input->post("courseid");
        $this->courses_model->like_course($courseid);
        $data['msg'] = "";
        $this->load->view('template/header');
        $this->load->view('success', $data);
    }




}