<?php
    
    class Department_Model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }
        public function getDepartments()
        {
            $result = $this->db->get('`department`');
            return $result->result_array();
            
        }

        public function getDepartment($id)
        {
            $this->db->where('`ID`', $id);
            $query = $this->db->get('`department`');
            return $query->row_array();
        }
        public function addDepartment($data)
        {
            $this->db->insert('department', $data);
            return  $this->db->affected_rows() > 0;
        }

        public function editDepartment($data,$ID)
        {
            $this->db->where('ID', $ID);
            $this->db->update('department', $data);
            return $this->db->affected_rows() > 0;
        }

        public function deleteDepartment($id)
        {
            $this->db->where('id', $id);
            $this->db->delete('department');
            return  $this->db->affected_rows() > 0;
        }

        public function checkDuplicate($data)
        {
            $this->db->where($data);
            $this->db->from('department');
            $count = $this->db->count_all_results();
            return ($count == 0) ? false:true;
        }
    }

?>