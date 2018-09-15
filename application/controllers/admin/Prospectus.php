<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Prospectus extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');

        $this->load->model('admin/prospectus_model');
        $this->load->model('admin/subjectcrediting_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_courses'));
        $this->data['pagetitle'] = 'Prospectus';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Courses', 'admin/courses');
    }
    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $r1 = $this->checker_model->is_valid_post('r1');
            $r2 =$this->checker_model->is_valid_post('r2');
            $r3 = $this->checker_model->is_valid_post('r3');
            $r4 = $this->checker_model->is_valid_post('r4');
            $c_id = $this->checker_model->is_valid_post('c_id');
            $term = $this->checker_model->is_valid_post('term');

            if($this->prospectus_model->addProspectus($r1,$r2,$r3,$r4,$c_id,$term))
            {
                $sem = 'Successfully added subject to '. $term .'';
                $result = array('status' => 'ok', 'message' => $sem);
                echo json_encode($result);
            }
        }
    }
    public function editPrerequisite()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $subj_id = $this->checker_model->is_valid_post('subj_id');
            $course_id = $this->checker_model->is_valid_post('course_id');
            $subjID = $this->checker_model->is_valid_post('subjID');
            if($subj_id && $course_id && $subjID)
            {
                $data = array(
                    "prospectus_pre_requisites" => $subjID 
                );
                $filter = array(
                    'subj_id' => $subj_id,
                    'course_id' => $course_id 
                );
                if($this->prospectus_model->editProspectusPrerequisite($data,$filter))
                {
                    $data = array('status' => 'ok', 'message' => 'Successfully updated prerequisite');
                    echo json_encode($data);
                }
            }
        }
    }

    public function delete()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $id = $this->checker_model->is_valid_get('id');
            if($id)
            {
                $tempID = explode("_",$id);
                $subj_id = $tempID[0];
                $course_id = $tempID[1];
                
                $data = array('subj_id' => $subj_id, 'course_id' => $course_id);
                if($this->prospectus_model->deleteProspectus($data))
                {
                    $data = array('status' => 'ok', 'message' => 'Successfully deleted subject');
                    echo json_encode($data);
                }
            }
        }
    }
    public function edit()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $subj_id = $this->checker_model->is_valid_post('subjID');
            $course_id = $this->checker_model->is_valid_post('courseID');
            $prospectus_yearlevel = $this->checker_model->is_valid_post('level');
            $prospectus_term = $this->checker_model->is_valid_post('term');
            $old = $this->checker_model->is_valid_post('old');
            if($subj_id && $course_id && $prospectus_yearlevel && $prospectus_term)
            {
                $data = array(
                    "subj_id" => $subj_id
                );
                $filter = array(
                    "subj_id" => $old,
                    "course_id" => $course_id,
                    "prospectus_yearlevel" => $prospectus_yearlevel,
                    "prospectus_term" => $prospectus_term
                );
                if($this->prospectus_model->editProspectus($data,$filter,$course_id))
                {
                    $data = array('status' => 'ok', 'message' => 'Successfully updated prospectos');
                    echo json_encode($data);
                }
                else {
                    $data = array('status' => 'duplicate', 'message' => 'Subject already exist');
                    echo json_encode($data);
                }
            }
        }
    }

    public function getProspectus()
    {
        $id = $this->input->get('id');
        $filter = array('course_id' => $id);
        $data = $this->prospectus_model->getProspectus($filter);
        echo json_encode($data);
        return;
    }

    public function getAll()
    {
        $id = $this->input->get('id');
        $level = array('First Year','Second Year','Third Year','Forth Year');
        $term = array('First Semester', 'Second Semester', 'Summer');
        echo "
        <table id='courseTable' class='table table-bordered tftable' role='grid'> 
                
            <tr class='tr'> 
                <th class='prosTH'>Subject Code </th>
                <th class='prosTH'>Descriptive Title</th>
            
        
                <th class='prosTH'>Units(Lec)</th>
                <th class='prosTH'>Units(Lab)</th>
                
                <th class='prosTH'>Pre Requisite</th>";
                if($_SESSION['flag'] == 'evaluation'){
                    echo "
                    <th class='prosTH'>Grade</th>
                    <th class='prosTH'>Taken</th>
                    <th class='prosTH'>Credit</th>
                    <th class='prosTH'>Actions</th>
                    ";
                }
                echo "
                
            </tr>
 
        ";
        foreach ($level as $lvl => $value_lvl) {
            foreach ($term as $trm => $value_term) {
                echo "
            <tr class='tr'>
                <td colspan='100'><b><center>".$value_lvl." - ".$value_term."</center></b></td>
            </tr>
                ";
                $filter = array(
                    'course_id' => $id,
                    'prospectus_yearlevel' => $value_lvl, 
                    'prospectus_term' => $value_term
                );
                $specificProspectus = $this->prospectus_model->getProspectus($filter);
                foreach ($specificProspectus as $sp => $value_sp) {
                    // $totalUnits = $value_sp['subj_units_lec'] + $value_sp['subj_units_lab'];
                    $prerequisite = explode('-',$value_sp['Prerequisite']);
                    echo "
            <tr class='tr'><center>
                <td>".$value_sp['subj_code']."</td>
                <td>".$value_sp['subj_description']."</td>

                
            
                <td>".$value_sp['subj_units_lec']."</td>
                <td>".$value_sp['subj_units_lab']."</td>
                
                <td>".$prerequisite[0]."</td>";
                if($_SESSION['flag'] == 'evaluation'){
                    $studentID = $this->checker_model->is_valid_get('id1');
                    $filterCredit = array(
                        'student_id' => $studentID,
                        'subj_id' => $value_sp['subj_id']
                    );
                    $count = '';
                    $queryCredit = $this->subjectcrediting_model->getCredit($filterCredit);
                    $countCredit = $queryCredit->num_rows();
                    $result;$grade = '';
                    if($countCredit != 0)
                    {
                        $result = $queryCredit->row_array();
                        $count = $result['subjectcrediting_taken'];
                        $grade= $result['subjectcrediting_grade'];
                        
                    }
                    else
                    {
                        
                    }
                    echo "
                    <td>".$grade."</th>
                    <td>".$count."</th>
                    <td>";if($grade <= 3 && $grade != ''){echo 'Yes';}else if($grade == ''){ echo ""; }else{echo "No";} echo "</th>
                    <td>
                        ";
                        // IF there are credit
                        if($countCredit != 0)
                        {
                            echo "
                            <button class='btn btn-info btn-xs edit' id='credit_".$value_sp['subj_id']."_".$value_sp['subj_code']."_".$value_sp['subj_description']."'  type='button'>Credit</button> &nbsp;
                            <a class='btn btn-danger btn-xs edit' id='deleteCredit_".$value_sp['subj_id']."' type='button' data-placement='top' title='Delete credit?' data-singleton='true'>Delete</a>";
                        }
                        else 
                        {
                            echo "
                            <button class='btn btn-info btn-xs edit' id='credit_".$value_sp['subj_id']."_".$value_sp['subj_code']."_".$value_sp['subj_description']."'  type='button'>Credit</button> &nbsp;
                            <button class='btn btn-success btn-xs edit' id='deleteGrade_".$value_sp['subj_id']."' type='button' data-placement='top' title='Delete grade?' data-singleton='true'>Grade</button>";
                        }
                    echo "</th>
                    
                    ";
                }
                echo "
                </center>
            </tr>
                    ";
                }
            }
        }

        echo "
        </table>
        ";
    }

    
}

?>