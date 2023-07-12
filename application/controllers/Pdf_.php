<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pdf_ extends CI_Controller {

   function __construct(){
       parent::__construct(); 
      } 
   
   public function index() {
      $this->load->library('Pdf');
      $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
      $pdf->AddPage('P', 'A4');
      $html = '<html>
      <head></head>
      <body>
      <h1>Receipt</h1>
      <table border="1">
      <tr><th>name</th>
      <th>company</th></tr>
      <tr>
      <td>hello</td>
      <td>xx technologies</td>
      </tr>
      </table>
      </body>
      </html>';      
      $pdf->writeHTML($html, true, false, true, false, '');     
      $pdf->Output();

}

      public function print_course() {
         $this->load->library('Pdf');
         $this->load->model('courses_model');
         $courseid = $this->input->post('print');
         $course_item = $this->courses_model->get_course($courseid);
         $coursename = $course_item['coursename'];

         //generate pdf file
         $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
         $pdf->AddPage('P', 'A4');
         $html = '<h1>'.
                 $course_item['coursename'].
                 '</h1>'.
                 '<br>'.
                 '<h2>Course Code: '.
                 $course_item['id'].
                 '</h2>'.
                 '<h2>Course Staff: '.
                 $course_item['staff'].
                 '</h2>'.
                 '<h2>Course Intro: '.
                 $course_item['intro'].
                 '</h2>'.
                 '<h2>Price: A$'.
                 $course_item['price'].
                 '</h2>'.
                 '<br><br>@copyright: Course Hunter Team';

         $pdf->writeHTML($html, true, false, true, false, '');     
         $pdf->Output();
 
      }

}

