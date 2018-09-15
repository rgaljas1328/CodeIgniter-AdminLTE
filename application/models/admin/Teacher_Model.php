<?php
class Teacher_Model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }
        public function getTeachers()
        {
            $this->db->select('*');
            $result = $this->db->get('`teacher`');
            return $result->result_array();
        }

        public function addTeacher($data)
        {
            $this->db->insert('teacher', $data);
            return  $this->db->affected_rows() > 0;
        }

        public function getMaxID()
        {
            $this->db->select_max('`ID`');
            $result = $this->db->get('`teacher`');
            return $result->row();
        }

        public function countTeachers()
        {
            $this->db->select('*');
            $result = $this->db->get('`teacher`');
            return $result->num_rows();
        }

        



        
    }

?>