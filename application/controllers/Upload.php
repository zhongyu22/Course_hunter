<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Upload extends CI_Controller {

// Load Library.
function __construct() {
parent::__construct();
$this->load->library('image_lib');
$this->load->helper('url');
}

// View "manipulation_view" Page.
public function index() {
    $this->load->view('template/header');
    $this->load->view('manipulation_view');
    $this->load->view('template/footer');
}

// Perform manipuation on image ("resize" or "watermark".)
public function value() {
    $this->load->model('file_model');
    $this->load->view('template/header');
    if ($this->input->post("submit")) {
    // Use "upload" library to select image, and image will store in root directory "uploads" folder.
    $config = array(
    'upload_path' => './uploads/',
    'allowed_types' => "gif|jpg|png|jpeg|pdf"
    );
    $this->load->library('upload', $config);
    if ($this->upload->do_upload()) {
        //If image upload in folder, set also this value in "$image_data".
        $image_data = $this->upload->data();
    }

    switch ($this->input->post("mode")) {
    case "resize":
    //"$image_data" contains information about upload image, so this array pass in function for manipulation.
    $data['upload_data'] = $image_data;
    $this->resize($image_data);
    $this->load->view('upload_success', $data);
    $this->file_model->upload($image_data['file_name'], $image_data['full_path'], $this->session->userdata('username')); // write into database
    break;

    case "watermark":
    //"$image_data" contains information about upload image, so this array pass in function for manipulation.
    $data['upload_data'] = $image_data;
    $this->water_marking($image_data);
    $this->load->view('upload_success', $data);
    $this->file_model->upload($image_data['file_name'], $image_data['full_path'], $this->session->userdata('username')); //write into database
    break;

    default:
    // If select no option in above given, then this will alert you message.
    echo "<script type='text/javascript'> alert('Please select any option which you want to operate'); </script>";
    $this->load->view('manipulation_view');
    break;
    }
    }
    }

// Resize Manipulation.
public function resize($image_data) {
$config['image_library'] = 'gd2';
$config['source_image'] = $image_data['full_path'];
$config['width'] = $this->input->post('width');
$config['height'] = $this->input->post('height');

$this->image_lib->initialize($config);

$this->image_lib->resize();

}


// Water Mark Manipulation.
public function water_marking($image_data) {
$config['image_library'] = 'gd2';
$config['source_image'] = $image_data['full_path'];
$config['wm_text'] = $this->input->post('text');
$config['wm_type'] = 'text';
$config['wm_font_path'] = './system/fonts/texb.ttf';
$config['wm_font_size'] = '15';
$config['wm_font_color'] = '#EE244A';
$config['wm_hor_alignment'] = 'center';

//send config array to image_lib's  initialize function
$this->image_lib->initialize($config);
$this->image_lib->watermark();
}


  // File upload
  public function fileupload(){
    $this->load->model('file_model');
    if(!empty($_FILES['file']['name'])){
 
      // Set preference
      $config['upload_path'] = './uploads/'; 
      $config['allowed_types'] = 'jpg|jpeg';
      $config['max_size'] = '10240'; // max_size in kb
      $config['file_name'] = $_FILES['file']['name'];
 
      //Load upload library
      $this->load->library('upload',$config); 
 
      // File upload
      if($this->upload->do_upload('file')){
        // Get data about the file
        $uploadData = $this->upload->data();
        $this->file_model->upload($uploadData['file_name'], $uploadData['full_path'], $this->session->userdata('username')); // write into database
      }
    }
  }
}
?>

<!-- Reference: https://www.formget.com/codeigniter-image-library/ -->