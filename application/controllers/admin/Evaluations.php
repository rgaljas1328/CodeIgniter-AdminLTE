<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Evaluations extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        $this->load->model('chairman/evaluation_model');
        $this->load->model('admin/student_model');
        $this->load->model('admin/studentcourse_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_departments'));
        $this->data['pagetitle'] = 'Departments';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Departments', 'admin/departments');
    }

    
    public function index()
    {
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->session->set_userdata('flag', 'evaluation');
        $this->template->admin_render('admin/evaluations/index', $this->data);
    }
    
    public function searchStudent()
    {
        $search = $this->input->get('search');  
        $filter1 = array(
            'FullName' => $search
        );
        $filter2 = array(
            'student_id' => $search  
        );
        // $this->session->set_userdata('flag','asdas');
        $result = $this->student_model->searchStudent($filter1,$filter2);
        
        $row = '';
        foreach ($result as $key => $value) {
            $row.= '
                <tr>
                    <td>'.$value['FullName'].'</td>
                    <td style="width: 40px"><button id="view_'.$value['ID'].'" class="btn btn-xs bg-purple">Proceed <i class="fa fa-arrow-right"></i></button></td>
                </tr>
            ';
        }
        echo $row;
        return;
    }
    public function proceedtoEvaluation()
    {
        $student_id = $this->input->get('student_id');
        $filter = array(
            'ID' => $student_id
        );
        $student_courseDetails = $this->studentcourse_model->getStudentcourse($filter);
        echo json_encode($student_courseDetails);
        return;
    }

    
    
}

?>