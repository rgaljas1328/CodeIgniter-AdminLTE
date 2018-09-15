<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Instructors extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/instructor_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_instructors'));
        $this->data['pagetitle'] = 'Instructors';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Instructors', 'admin/instructors');
    }

    public function index()
    {
        $this->data['instructors'] = $this->instructor_model->getInstructors(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        //FORM
            $this->data['instructor_name'] = array(
				'name'  => 'instructor_name',
				'id'    => 'instructor_name',
				'type'  => 'text',
                'placeholder' => 'Instructor name',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('instructor_name'),
			);
			$this->data['instructor_address'] = array(
				'name'  => 'instructor_address',
				'id'    => 'instructor_address',
				'type'  => 'text',
                'placeholder' => 'Address',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('instructor_address'),
			);
            $this->data['instructor_position'] = array(
				'name'  => 'instructor_position',
				'id'    => 'instructor_position',
				'type'  => 'text',
                'placeholder' => 'Position',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('instructor_position'),
			);
            $this->data['instructor_specialization'] = array(
				'name'  => 'instructor_specialization',
				'id'    => 'instructor_specialization',
				'type'  => 'text',
                'placeholder' => 'Specialization',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('instructor_specialization'),
			);
            $this->data['instructor_email_address'] = array(
				'name'  => 'instructor_email_address',
				'id'    => 'instructor_email_address',
				'type'  => 'email',
                'placeholder' => 'Specialization',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('instructor_email_address'),
			);


        
        $this->template->admin_render('admin/instructors/index', $this->data);
    }

    public function getInstructors()
    {
        $data = $this->instructor_model->getInstructors();
        echo json_encode($data);
        return;
    }

    public function getInstructor()
    {
        header('Content-Type: application/json');
        $id = $this->input->get('id');
        $c = $this->instructor_model->getInstructor($id);
        echo json_encode($c);
    }

    public function getAll()
    {
        $data = $this->instructor_model->getInstructors(); // Data nga gi pass
        echo "
        <table id='instructorTable' class='table table-bordered' role='grid'>                
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Position</th>
                <th>Gender</th>
                <th>Civil Status</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['instructor_name'] ."</td>
                <td>". $value['instructor_address'] ."</td>
                <td>". $value['instructor_position'] ."</td>
                <td>". $value['instructor_gender'] ."</td>
                <td>". $value['instructor_civil_status'] ."</td>
                <td>". $value['instructor_email_address'] ."</td>
                <td>". $value['instructor_specialization'] ."</td>
                <td>". $value['instructor_employment_status'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='left' title='Delete instructor?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $instructor_name = $this->checker_model->is_valid_post('instructor_name');
            $instructor_address = $this->checker_model->is_valid_post('instructor_address');
            $instructor_position = $this->checker_model->is_valid_post('instructor_position');
            $instructor_gender = $this->checker_model->is_valid_post('instructor_gender');
            $instructor_civil_status = $this->checker_model->is_valid_post('instructor_civil_status');
            $instructor_email_address = $this->checker_model->is_valid_post('instructor_email_address');
            $instructor_specialization = $this->checker_model->is_valid_post('instructor_specialization');
            $instructor_employment_status = $this->checker_model->is_valid_post('instructor_employment_status');

            if($instructor_name && $instructor_address && $instructor_position && $instructor_gender && $instructor_civil_status && $instructor_email_address && $instructor_specialization && $instructor_employment_status)
            {
                $data = array(
                    "instructor_name" => $instructor_name,
                    "instructor_address" => $instructor_address,
                    "instructor_position" => $instructor_position,
                    "instructor_gender" => $instructor_gender,
                    "instructor_civil_status" => $instructor_civil_status,
                    "instructor_email_address" => $instructor_email_address,
                    "instructor_specialization" => $instructor_specialization,
                    "instructor_employment_status" => $instructor_employment_status
                );
                if($this->instructor_model->addInstructor($data))
                {
                    return;
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
                if($this->instructor_model->deleteInstructor($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted!");
                    echo json_encode($result);
                }
                else
                {
                    $result = array('status' => "error", 'message' => "Error in deleting instructor!");
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
            $id = $this->checker_model->is_valid_post('ID');
            $Name = $this->checker_model->is_valid_post('Name');
            $Address = $this->checker_model->is_valid_post('Address');
            $Position = $this->checker_model->is_valid_post('Position');
            $Gender = $this->checker_model->is_valid_post('Gender');
            $civil_status = $this->checker_model->is_valid_post('civil_status');
            $Email = $this->checker_model->is_valid_post('Email');
            $Specialization = $this->checker_model->is_valid_post('Specialization');
            $employment_status = $this->checker_model->is_valid_post('employment_status');
            //diri padayon0
            if($id && $Name && $Address && $Position && $Gender && $civil_status && $Email && $Specialization && $employment_status)
            {
                $data = array(
                    'ID' => $id,
                    'instructor_name' => $Name,
                    'instructor_address' => $Address,
                    'instructor_position' => $Position,
                    'instructor_gender' => $Gender,
                    'instructor_civil_status' => $civil_status,
                    'instructor_email_address' => $Email,
                    'instructor_specialization' => $Specialization,
                    'instructor_employment_status' => $employment_status
                );

                if($this->instructor_model->editInstructor($data, $id))
                {
                    $result = array('status' => "ok", 'message' => "Changes saved!");
                    echo json_encode($result);
                }
                else
                {
                    $result = array('status' => "error", 'message' => "Error in saving changes!");
                    echo json_encode($result);
                }
            }
        }
    }

   
}
?>