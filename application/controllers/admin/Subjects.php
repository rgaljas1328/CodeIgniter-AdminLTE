<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subjects extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/subject_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_subjects'));
        $this->data['pagetitle'] = 'Subjects';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Subjects', 'admin/subjects');
    }

    public function index()
    {
        $this->data['subjects'] = $this->subject_model->getSubjects(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        //FORM
            $this->data['subj_code'] = array(
				'name'  => 'subj_code',
				'id'    => 'subj_code',
				'type'  => 'text',
                'placeholder' => 'e.g. CSC 102',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('subj_code'),
			);
			$this->data['subj_description'] = array(
				'name'  => 'subj_description',
				'id'    => 'subj_description',
				'type'  => 'text',
                'placeholder' => 'e.g. Database Systems',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('subj_description'),
			);
            $this->data['subj_units_lec'] = array(
				'name'  => 'subj_units_lec',
				'id'    => 'subj_units_lec',
				'type'  => 'text',
                'placeholder' => 'Units (Lecture)',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('subj_units_lec'),
			);
            $this->data['subj_units_lab'] = array(
				'name'  => 'subj_units_lab',
				'id'    => 'subj_units_lab',
				'type'  => 'text',
                'placeholder' => 'Units (Laboratory)',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('subj_units_lab'),
			);
        $this->template->admin_render('admin/subjects/index', $this->data);
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $subj_code = $this->checker_model->is_valid_post('subj_code');
            $subj_description = $this->checker_model->is_valid_post('subj_description');
            $subj_units_lec = $this->checker_model->is_valid_post('subj_units_lec');
            $subj_units_lab = $this->checker_model->is_valid_post('subj_units_lab');
            $departmentid = $this->checker_model->is_valid_post('departmentid');
            if($subj_code && $subj_description && $subj_units_lec)
            {
                $data = array(
                    "subj_code" => $subj_code,
                    "subj_description" => $subj_description,
                    "subj_units_lec" => $subj_units_lec,
                    "subj_units_lab" => $subj_units_lab,
                    "departmentid" => $departmentid
                );
                if(!$this->subject_model->checkDuplicate($data))
                {
                    if($this->subject_model->addSubject($data))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully added");
                        echo json_encode($result);
                    }
                }
                else 
                {
                    $result = array('status' => "duplicate", 'message' => "Subject already exist");
                    echo json_encode($result);
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
            $subj_code = $this->checker_model->is_valid_post('subj_code1');
            $subj_description = $this->checker_model->is_valid_post('subj_description1');
            $subj_units_lec = $this->checker_model->is_valid_post('subj_units_lec1');
            $subj_units_lab = $this->checker_model->is_valid_post('subj_units_lab1');
            $departmentid = $this->checker_model->is_valid_post('departmentid1');
            $ID = $this->checker_model->is_valid_post('ID');
            if($subj_code && $subj_description && $subj_units_lec)
            {
                $data = array(
                    "subj_code" => $subj_code,
                    "subj_description" => $subj_description,
                    "subj_units_lec" => $subj_units_lec,
                    "subj_units_lab" => $subj_units_lab,
                    "departmentid" => $departmentid
                );
                if(!$this->subject_model->checkDuplicate($data))
                {
                    if($this->subject_model->editSubject($data,$ID))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully update");
                        echo json_encode($result);
                    }
                }
                else 
                {
                    $result = array('status' => "duplicate", 'message' => "Subject already exist");
                    echo json_encode($result);
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
                if($this->subject_model->deleteSubject($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }

   
    public function getAll()
    {
        $this->data['subjects'] = $this->subject_model->getSubjects(); // Data nga gi pass
        echo "
        <table id='subjectTable' class='table table-bordered dataTable' role='grid'>
            
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Units (Lecture)</th>
                    <th>Units (Laboratory)</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            ";
        foreach ($this->data['subjects'] as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['subj_code'] ."</td>
                <td>". $value['subj_description'] ."</td>
                <td>". $value['subj_units_lec'] ."</td>
                <td>". $value['subj_units_lab'] ."</td>
                <td>". $value['Department'] ."</td>
                <td>
                    
                <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button> &nbsp;
                <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete subject?' data-singleton='true'><i class='fa fa-remove'></i> Delete</a>
                </td>
            </tr>
            ";
        }

        echo "
        </table>
        ";
    }


    public function getSubject()
    {
        $ID = $this->input->get('id');
        $filter = array('ID' => $ID);
        $data = $this->subject_model->getSubject($filter);
        echo json_encode($data);
        return;
    }
}

?>