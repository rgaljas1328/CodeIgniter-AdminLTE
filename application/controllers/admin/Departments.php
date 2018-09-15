<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Departments extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        $this->load->model('admin/department_model');
        $this->load->model('admin/subject_model');
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
        $this->template->admin_render('admin/departments/index', $this->data);
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $description = $this->checker_model->is_valid_post('description');
            
            if($description)
            {
                $data = array(
                    "Department" => $description
                );
                if(!$this->department_model->checkDuplicate($data))
                {
                    if($this->department_model->addDepartment($data))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully added");
                        echo json_encode($result);
                    }
                }
                else {
                    $result = array('status' => "duplicate", 'message' => "Course already exist");
                    echo json_encode($result);
                }
            }
        }
    }
    public function getDepartment()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ID = $this->checker_model->is_valid_get('id');
            $data = $this->department_model->getDepartment($ID);
            echo json_encode($data);
            return;
        }
    }
    public function getDepartments()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $data = $this->department_model->getDepartments();
            echo json_encode($data);
            return;
        }
    }
    public function getSubjects()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $departmentid = $this->checker_model->is_valid_get('id');
            $filter = array('departmentid' => $departmentid );
            $data = $this->subject_model->getSubject($filter);
            echo json_encode($data);
            return;
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
            $description = $this->checker_model->is_valid_post('description1');
            $ID = $this->checker_model->is_valid_post('ID');
            
            if($description)
            {
                $data = array(
                    "Department" => $description
                );
                if(!$this->department_model->checkDuplicate($data))
                {
                    if($this->department_model->editDepartment($data,$ID))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully added");
                        echo json_encode($result);
                    }
                }
                else {
                    $result = array('status' => "duplicate", 'message' => "Course already exist");
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
                if($this->department_model->deleteDepartment($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }
    public function getAll()
    {
        $this->data['department'] = $this->department_model->getDepartments();
        
        echo "
        <table class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($this->data['department'] as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['Department'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                   
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete department?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>                    
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }

    

    
}

?>