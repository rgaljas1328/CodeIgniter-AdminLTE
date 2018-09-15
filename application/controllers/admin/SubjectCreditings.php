<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubjectCreditings extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/subjectcrediting_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_subjectcreditings'));
        $this->data['pagetitle'] = 'Subject Crediting';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Subject Crediting', 'admin/subjectcreditings');
    }
    public function add()
    {
        $student_id = $this->checker_model->is_valid_post('studentID');
        $subj_id = $this->checker_model->is_valid_post('subjID');
        $grade =$this->checker_model->is_valid_post('grade');
        $taken = $this->checker_model->is_valid_post('taken');
        
        if($student_id && $subj_id && $grade)
        {
            $data = array(
                'subj_id' => $subj_id,
                'student_id' => $student_id,
                'subjectcrediting_grade' => $grade,
                'subjectcrediting_taken' => $taken,
                'creditedBy' => 1,
                'dateofCredit' => date('Y-m-d')

            );
            $filter = array(
                'subj_id' => $subj_id,
                'student_id' => $student_id
            );
            $query = $this->subjectcrediting_model->getCredit($filter);
            $count = $query->num_rows();
            if($count === 0)
            {
                $this->subjectcrediting_model->addCredit($data);
                $result = array('status' => "ok", 'message' => "Successfully added");
                echo json_encode($result);
            }
            else
            {
                
                $newData = array(
                    'subjectcrediting_grade' => $grade,
                    'subjectcrediting_taken' => $taken,
                    'creditedBy' => 1,
                    'dateofCredit' => date('Y-m-d')
                );

                $this->subjectcrediting_model->editCredit($newData,$filter);
                $result = array('status' => "ok", 'message' => "Successfully edited");
                echo json_encode($result);
            }
            
            return;
        }
        else {
            return;
        }
    }
    public function delete()
    {
        $student_id = $this->is_valid_get('student_id');
        $subj_id = $this->is_valid_get('subj_id');
        if($student_id && $subj_id){
            $filter = array(
                'student_id' => $student_id,
                'subj_id' => $subj_id
            );
            $this->subjectcrediting_model->deleteCredit($filter);
            $result = array('status' => "ok", 'message' => "Successfully deleted");
            echo json_encode($result);
        }
    }
    public function getCredit(){
        $student_id = $this->is_valid_get('id');
        $subj_id = $this->is_valid_get('subj_id');
        if($student_id && $subj_id)
        {
            $filter = array(
                'student_id' => $student_id,
                'subj_id' => $subj_id
            );
            $result = $this->subjectcrediting_model->getCredit($filter);
            $data = $result->row_array();
            echo json_encode($data);
            return;
        }
    }
    
}

?>