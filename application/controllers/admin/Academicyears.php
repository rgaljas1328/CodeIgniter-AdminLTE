<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Academicyears extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/academicyear_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_academicyears'));
        $this->data['pagetitle'] = 'Academic Years';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Academic Years', 'admin/academicyears');
    }

    public function index()
    {
        $this->data['ay']= $this->academicyear_model->getAcademicYears(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        //FORM
            $this->data['academicyear_year'] = array(
				'name'  => 'academicyear_year',
				'id'    => 'academicyear_year',
				'type'  => 'number',
                'placeholder' => 'From',
                'disabled' =>'',
                'data-mask' => '',
                'required' =>'',
                'class' => 'form-control input-lg',
				'value' => $this->form_validation->set_value('academicyear_year'),
			);
            $this->data['academicyear_year2'] = array(
				'name'  => 'academicyear_year2',
				'id'    => 'academicyear_year2',
				'type'  => 'number',
                'placeholder' => 'To',
                'data-mask' => '',
                'required' =>'',
                
                'class' => 'form-control input-lg',
				'value' => $this->form_validation->set_value('academicyear_year'),
			);

        $this->template->admin_render('admin/academicyears/index', $this->data);
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $academicyear_year = $this->checker_model->is_valid_post('academicyear_year2')-1 . '-'. $this->checker_model->is_valid_post('academicyear_year2') ;
            $academicyear_term = $this->checker_model->is_valid_post('academicyear_term');
            $academicyear_status ="Active";
            if($academicyear_year && $academicyear_term)
            {
                $data = array(
                    "academicyear_year" => $academicyear_year,
                    "academicyear_term" => $academicyear_term,
                    "academicyear_status" => $academicyear_status
                );
                if(!$this->academicyear_model->checkDuplicate($data))
                {
                    if($this->academicyear_model->addAcademicYear($data))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully added");
                        echo json_encode($result);
                    }
                }
                else {
                    $result = array('status' => "duplicate", 'message' => "Academic year already exist");
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
            $academicyear_year = $this->checker_model->is_valid_post('academicyear_yearto')-1 . '-'. $this->checker_model->is_valid_post('academicyear_yearto') ;
            $academicyear_term = $this->checker_model->is_valid_post('academicyear_termedit');    
            $academicyear_status = $this->checker_model->is_valid_post('academicyear_status1');
            $ID = $this->checker_model->is_valid_post('ID');
            if($academicyear_year && $academicyear_term && $academicyear_status)
            {
                $data = array(
                    
                    "academicyear_year" => $academicyear_year,
                    "academicyear_term" => $academicyear_term,
                    "academicyear_status" => $academicyear_status
                );
                if(!$this->academicyear_model->checkDuplicate($data))
                {
                    if($this->academicyear_model->editAcademicYear($data,$ID))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully updated");
                        echo json_encode($result);
                    }
                }
                else {
                    $result = array('status' => "duplicate", 'message' => "Academic year already exist");
                    echo json_encode($result);
                }
            }
        }
    }

    public function delete(){
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $id = $this->checker_model->is_valid_get('id');
            if($id)
            {
                if($this->academicyear_model->deleteAcademicYear($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }



    public function getAll()
    {
       
        $output ='';
        $ays= $this->academicyear_model->getAcademicYears(); // Data nga gi pass
        echo "
        <table id='academicyearTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Year</th>
                <th>Term</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            ";

        foreach ($ays as $key => $value) {
            echo "
            <tr>
                <td>".$value['ID']."</td>
                <td>".$value['academicyear_year']."</td>
                <td>".$value['academicyear_term']."</td>
                <td>".$value['academicyear_status']."</td>
                <td>
                    <button id='edit_".$value['ID']."' class='btn btn-warning btn-xs edit' type='button'><i class='fa fa-edit'></i> Edit</button> &nbsp;
                    <a href='#' id='delete_".$value['ID']."' class='btn btn-xs btn-danger' data-placement='top' title='Delete academic year?' data-singleton='true'><i class='fa fa-remove'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>";
        echo $output;
        return;
    }

    public function getAcademicYear()
    {
        header('Content-Type: application/json');
        $id = $this->checker_model->is_valid_get('id');
        $ay = $this->academicyear_model->getAY($id);
        echo json_encode($ay);
    }
}
?>