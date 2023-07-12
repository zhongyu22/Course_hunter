<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Courses_model extends CI_Model {

    public function get_course($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('courses');
            return $query->result_array();
        }

        $query = $this->db->get_where('courses',
                                    array(
                                       'id' => $id));
        return $query->row_array();
                                
    }

    public function search_course($query = "") {
        if ($query === "") {
            return;
        } else {
            $this->db->select("*");
            $this->db->from("courses");
            $this->db->like('id', $query);
            $this->db->or_like('coursename', $query);
            $this->db->or_like('staff', $query);
            $this->db->order_by('coursename', 'DESC');
            return $this->db->get()->result_array();
        }
    }

    public function check_course_exist($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('courses');
        if($result->num_rows() == 1){
            return false;
        } else {
            return true;
        }
    }

    public function add_course($id, $coursename, $staffname, $intro) {
        $data = array(
            'id' => $id,
            'coursename' => $coursename,
            'staff' => $staffname,
            'intro' => $intro
        );
        return $this->db->insert('courses', $data);
    }

    public function add_fav($courseid, $username) {
        $this->db->where('courseid', $courseid);
        $this->db->where('username', $username);
        $result = $this->db->get('favourites');
        if ($result->num_rows() == 1) {
            return false;
        } else {
            $data = array(
            'courseid' => $courseid,
            'username' => $username
        );
        return $this->db->insert('favourites', $data);
        }
    }
    
    public function remove_fav($courseid, $username) {
        $this->db->delete('favourites', array('courseid' => $courseid,
                                              'username' => $username ));
    }

    public function add_comment($username, $courseid, $comment) {
        $this->db->where('courseid', $courseid);
        $this->db->where('username', $username);
        $this->db->where('comment', $comment); 
        $result = $this->db->get('comments'); 
        if ($result->num_rows() == 1) {
            return false;
        } else {
            $data = array(
                'username' => $username,
                'courseid' => $courseid,
                'comment' => $comment
            );
            return $this->db->insert('comments', $data);
        }
    }

    public function get_comments($courseid) {
        $this->db->where('courseid', $courseid);
        $result = $this->db->get('comments');
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    public function get_favourites($username) {
        $this->db->where('username', $username);
        $result = $this->db->get('favourites');
        if ($result->num_rows() == 0) {
            return false;
        } else {
            return $result->result_array();
        }
    }

    function fetch_comments($query)
    {
        if($query == '')
        {
            return null;
        } else {
            $this->db->select("*");
            $this->db->from("files");
            $this->db->like('filename', $query);
            $this->db->or_like('username', $query);
            $this->db->order_by('filename', 'DESC');
            return $this->db->get();
        }
    }

    public function like_course($courseid) {
        $this->db->select('likes');
        $this->db->from('courses');
        $this->db->where('id', $courseid);
        $old_likes = $this->db->get()->row()->likes;
        $new_likes = (int)$old_likes + 1;

        $data = array(
            'likes' => $new_likes
        );
        $this->db->where('id', $courseid);
        $this->db->update('courses', $data);
    }

    public function buy_course($username, $courseid) {
        $this->db->select('*');
        $this->db->from('courses');
        $this->db->where('id', $courseid);
        $result = $this->db->get()->row();
        $coursename = $result->coursename;

    }



    
 }