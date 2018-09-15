<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Students extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/student_model');
        $this->load->model('admin/studentcourse_model');
        $this->load->model('admin/course_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_students'));
        $this->data['pagetitle'] = 'Students';
        $this->load->helper('url_helper');
        $this->load->helper("url");
        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Students', 'admin/students');
    }
    
    public function index()
    {
       
        $this->data['breadcrumb'] = $this->breadcrumbs->show();     
        
        $this->template->admin_render('admin/students/index', $this->data);
    }

    public function profile()
    {
        $id = $this->input->get('id');
        $this->data['id']=$id;
        $this->data['students'] = $this->student_model->getStudent($id);
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/students/profile', $this->data);
    }

    public function create()
    {
        $this->breadcrumbs->unshift(2, lang('menu_students_create'), 'admin/students/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['courses'] = $this->course_model->getCourses();
        
        //FORM
            $this->data['student_id'] = array(
				'name'  => 'student_id',
				'id'    => 'student_id',
				'type'  => 'text',
                'placeholder' => 'Student ID',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('student_id'),
			);
            $this->data['student_fname'] = array(
				'name'  => 'student_fname',
				'id'    => 'student_fname',
				'type'  => 'text',
                'placeholder' => 'Last name',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('student_fname'),
			);
			$this->data['student_lname'] = array(
				'name'  => 'student_lname',
				'id'    => 'student_lname',
				'type'  => 'text',
                'placeholder' => 'Last name',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('student_lname'),
			);
            $this->data['student_mname'] = array(
				'name'  => 'student_mname',
				'id'    => 'student_mname',
				'type'  => 'text',
                'placeholder' => 'Middle name',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('student_mname'),
			);
            $this->data['student_bdate'] = array(
				'name'  => 'student_bdate',
				'id'    => 'student_bdate',
				'type'  => 'date',
                'placeholder' => 'Birth date',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('student_bdate'),
			);
        $this->template->admin_render('admin/students/create', $this->data);
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $course_id = $this->checker_model->is_valid_post('course');
            $student_id = $this->checker_model->is_valid_post('student_id');
            $student_fname = $this->checker_model->is_valid_post('student_fname');
            $student_mname = $this->checker_model->is_valid_post('student_mname');
            $student_lname = $this->checker_model->is_valid_post('student_lname');
            $student_gender = $this->checker_model->is_valid_post('student_gender');
            $student_bdate = $this->checker_model->is_valid_post('student_bdate');
            $student_bplace = $this->checker_model->is_valid_post('student_bplace');
            $student_religion = $this->checker_model->is_valid_post('student_religion');
            $student_address_street = $this->checker_model->is_valid_post('student_address_street');
            $student_address_municipality = $this->checker_model->is_valid_post('student_address_municipality');
            $student_address_barangay = $this->checker_model->is_valid_post('student_address_barangay');
            $student_address_province = $this->checker_model->is_valid_post('student_address_province');
            $student_contact_number = $this->checker_model->is_valid_post('student_contact_number');
            $student_status = $this->checker_model->is_valid_post('student_status');
            $student_spouse_name = $this->checker_model->is_valid_post('student_spouse_name');
            $student_last_school_year_attended = $this->checker_model->is_valid_post('student_last_school_year_attended');
            $student_mothers_name = $this->checker_model->is_valid_post('student_mothers_name');
            $student_fathers_name = $this->checker_model->is_valid_post('student_fathers_name');
            $student_mothers_occupation = $this->checker_model->is_valid_post('student_mothers_occupation');
            $student_fathers_occupation = $this->checker_model->is_valid_post('student_fathers_occupation');
            $student_guardian = $this->checker_model->is_valid_post('student_guardian');
            $student_bdateNew = explode('/',$student_bdate);
            
            if(true)
            {
                $data = array(
                    "student_id" => $student_id,
                    "student_fname" => $student_fname,
                    "student_mname" => $student_mname,
                    "student_lname" => $student_lname,
                    "student_gender" => $student_gender,
                    "student_bdate" => $student_bdateNew[2].'-'.$student_bdateNew[0].'-'.$student_bdateNew[1],
                    "student_bplace" => $student_bplace,
                    "student_religion" => $student_religion,
                    "student_address_street" => $student_address_street,
                    "student_address_municipality" => $student_address_municipality,
                    "student_address_barangay" => $student_address_barangay,
                    "student_address_province" => $student_address_province,
                    "student_contact_number" => $student_contact_number,
                    "student_status" => $student_status,
                    "student_spouse_name" => $student_spouse_name,
                    "student_last_school_year_attended" => $student_last_school_year_attended,
                    "student_mothers_name" => $student_mothers_name,
                    "student_fathers_name" => $student_fathers_name,
                    "student_mothers_occupation" => $student_mothers_occupation,
                    "student_fathers_occupation" => $student_fathers_occupation,
                    "student_guardian" => $student_guardian,
                    "student_admission_date" => date('Y-m-d H:i:s')
                );
                if(!$this->student_model->checkDuplicate($data))
                {
                    if($this->student_model->addStudent($data))
                    {
                        $filter=array(
                            "student_id" => $student_id,
                            "student_fname" => $student_fname,
                            "student_mname" => $student_mname,
                            "student_lname" => $student_lname
                        );
                        $s = $this->student_model->getStudent($filter);
                        $data = array(
                            'student_id' => $s['ID'],
                            'course_id' => $course_id,
                            'student_course_dateCreated' => date('Y-m-d H:i:s')
                        );
                        if($this->studentcourse_model->addStudentcourse($data))
                        {

                        }
                        $result = array('status' => 'ok', 'message' => 'Student successfully added!');
                        echo json_encode($result);
                    }
                    else
                    {
                        $result = array('status' => 'error', 'message' => 'Error in adding student!');
                        echo json_encode($result);
                    }
                }
                else
                {
                    $result = array('status' => 'duplicate', 'message' => 'Student already exist!');
                    echo json_encode($result);
                }
            }
            return;
        }
    }
    
    public function getCourse()
    {
        header('Content-Type: text/html; charset=UTF-8');
        $courses = $this->course_model->getCourses();
        echo json_encode($courses);
        return;
    }
    public function getStudent()
    {
        $student_id = $this->checker_model->is_valid_get('id');
        $students = $this->student_model->getStudent($student_id);
        echo json_encode($students);
        return;
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
                if($this->student_model->deleteStudent($id))
                {
                    $result = array('status' => 'ok', 'message' => 'Successfully deleted!');
                    echo json_encode($result);
                }
                else
                {
                    $result = array('status' => 'error', 'message' => 'Error in deleting student!');
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
            $id = $this->checker_model->is_valid_get('id');
            $student_id = $this->checker_model->is_valid_post('student_id');
            $student_fname = $this->checker_model->is_valid_post('student_fname');
            $student_mname = $this->checker_model->is_valid_post('student_mname');
            $student_lname = $this->checker_model->is_valid_post('student_lname');
            $student_gender = $this->checker_model->is_valid_post('student_gender');
            $student_bdate = $this->checker_model->is_valid_post('student_bdate');
            $student_bplace = $this->checker_model->is_valid_post('student_bplace');
            $student_religion = $this->checker_model->is_valid_post('student_religion');
            $student_address_street = $this->checker_model->is_valid_post('student_address_street');
            $student_address_municipality = $this->checker_model->is_valid_post('student_address_municipality');
            $student_address_barangay = $this->checker_model->is_valid_post('student_address_barangay');
            $student_address_province = $this->checker_model->is_valid_post('student_address_province');
            $student_contact_number = $this->checker_model->is_valid_post('student_contact_number');
            $student_status = $this->checker_model->is_valid_post('student_status');
            $student_spouse_name = $this->checker_model->is_valid_post('student_spouse_name');
            $student_last_school_year_attended = $this->checker_model->is_valid_post('student_last_school_year_attended');
            $student_mothers_name = $this->checker_model->is_valid_post('student_mothers_name');
            $student_fathers_name = $this->checker_model->is_valid_post('student_fathers_name');
            $student_mothers_occupation = $this->checker_model->is_valid_post('student_mothers_occupation');
            $student_fathers_occupation = $this->checker_model->is_valid_post('student_fathers_occupation');
            $student_guardian = $this->checker_model->is_valid_post('student_guardian');
            
            // $student_id && $student_fname && $student_mname && $student_lname && $student_gender && $student_bdate && $student_bplace && $student_religion && $student_address_street 
            // && $student_address_municipality && $student_address_barangay && $student_address_province && $student_contact_number && $student_status && $student_spouse_name && 
            // $student_last_school_year_attended && $student_mothers_name && $student_fathers_name && $student_mothers_occupation && $student_fathers_occupation && 
            // $student_guardian

            if(true)
            {
                $data = array(
                    "student_id" => $student_id,
                    "student_fname" => $student_fname,
                    "student_mname" => $student_mname,
                    "student_lname" => $student_lname,
                    "student_gender" => $student_gender,
                    "student_bdate" => '2018-01-01',
                    "student_bplace" => $student_bplace,
                    "student_religion" => $student_religion,
                    "student_address_street" => $student_address_street,
                    "student_address_municipality" => $student_address_municipality,
                    "student_address_barangay" => $student_address_barangay,
                    "student_address_province" => $student_address_province,
                    "student_contact_number" => $student_contact_number,
                    "student_status" => $student_status,
                    "student_spouse_name" => $student_spouse_name,
                    "student_last_school_year_attended" => $student_last_school_year_attended,
                    "student_mothers_name" => $student_mothers_name,
                    "student_fathers_name" => $student_fathers_name,
                    "student_mothers_occupation" => $student_mothers_occupation,
                    "student_fathers_occupation" => $student_fathers_occupation,
                    "student_guardian" => $student_guardian,
                    "student_admission_date" => '2018-01-01'
                );
                if($this->student_model->editStudent($data, $id))
                {
                    $result = array('status' => 'ok', 'message' => 'Student successfully updated!');
                    echo json_encode($result);
                }
                else
                {
                    $result = array('status' => 'error', 'message' => 'Error in updating student!');
                    echo json_encode($result);
                }
            }
            else
            {
                return "incomplete";
            }
        }
    }

    public function updatePicture()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $id = $this->checker_model->is_valid_post('id');
            $file = $this->checker_model->is_valid_post('file');

            if(true)
            {
                $data = array(
                    'student_picture' => $file
                );

                if($this->student_model->editStudent($data, $id))
                {
                    $result = array('status' => 'ok', 'message' => 'Success in ploading picture!');
                    echo json_encode($result);
                }
                else
                {
                    $result = array('status' => 'error', 'message' => 'Error in uploading picture!');
                    echo json_encode($result);
                }
            }
        }
    }
   
    public function getAll()
    {
        $data= $this->student_model->getStudents(); // Data nga gi pass
        echo '
        <table id="studentTable" class="table table-bordered" role="grid"> 
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>First name</th>
                <th>Middle name</th>
                <th>Last name</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Admission Date</th>
                <th>Action</th>
            </tr>
        ';
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>".$value['ID']."</td>
                <td>".$value['student_id']."</td>
                <td>".$value['student_fname']."</td>
                <td>".$value['student_mname']."</td>
                <td>".$value['student_lname']."</td>
                <td>".$value['student_gender']."</td>
                <td>".$value['student_status']."</td>
                <td>".$value['student_admission_date']."</td>
                <td>
                <a href='"; echo site_url('admin/students/profile/?id='.$value['ID']); echo "'"; echo " id='profile_".$value['ID']."' class='btn btn-xs bg-yellow' title='View profile? You will be redirected to new page' ><i class='fa fa-edit'></i> Profile</a>
                <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete student?' data-singleton='true' ><i class='fa fa-trash'></i> Delete</a>
                <a href='' class='btn btn-xs bg-purple' title='View grades? You will be redirected to new page'> Grades<i class='fa fa-arrow-right'></i></a>
                </td>
            </tr>
            ";
        }
        echo "</table>";
    }
}

?>