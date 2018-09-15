<?php

class Access_Model extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
    }
    public function getAccess()
    {
        $this->db->select('*');
        $res = $this->db->get('access');
        return $res->result_array();
    }

    public function countAccess()
    {
        $this->db->select('*');
        $res = $this->db->get('access');
        return $res->num_rows();
    }

    public function addAccess($data)
    {
        $this->db->insert('access', $data);
        return  $this->db->affected_rows() > 0;
    }
    
}


?>