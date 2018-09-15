<?php

class Checker_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function checkDuplicate($filter, $table)
    {
        $this->db->where($filter);
        $this->db->from($table);
        $count = $this->db->count_all_results();
        return ($count == 0) ? false:true;
    }
    
}

?>