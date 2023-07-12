<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller {
    public function index() {
    $this->load->view('template/header');
    }

    public function do_pay() {
        $this->load->view('template/header');
        $this->load->model('courses_model');
        $courseid = $this->input->post('buy');
        $course_item = $this->courses_model->get_course($courseid);
        $data['price'] = $course_item['price'];
        $this->load->view('pay', $data);
        $this->load->view('template/footer');
    }
}


