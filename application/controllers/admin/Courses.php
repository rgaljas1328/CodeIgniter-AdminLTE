<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Courses extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/course_model');
        $this->load->model('admin/subject_model');
        $this->load->model('admin/prospectus_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_courses'));
        $this->data['pagetitle'] = 'Courses';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Courses', 'admin/courses');
    }

    public function index()
    {
        $this->data['courses'] = $this->course_model->getCourses(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        //FORM
            $this->data['course_code'] = array(
				'name'  => 'course_code',
				'id'    => 'course_code',
				'type'  => 'text',
                'placeholder' => 'e.g BS-IT',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('course_code'),
			);
			$this->data['course_description'] = array(
				'name'  => 'course_description',
				'id'    => 'course_description',
				'type'  => 'text',
                'placeholder' => 'Course Description',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('course_description'),
			);
            $this->data['course_year'] = array(
				'name'  => 'course_year',
				'id'    => 'course_year',
				'type'  => 'text',
                'placeholder' => 'Course Year',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('course_year'),
			);



        
        $this->template->admin_render('admin/courses/index', $this->data);
    }

    public function prospectus()
    {
        $this->session->set_userdata('flag', '');
        $id = $this->input->get("id");
        $this->data['id'] = $id;
        $this->data['courses'] = $this->course_model->getCourse($id); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/courses/prospectus', $this->data);
    }
    public function addprospectus()
    {
        $id = $this->input->get("id");
        $this->data['id'] = $id;
        $this->data['pagetitle'] = 'Add prospectus';
        $this->data['courses'] = $this->course_model->getCourse($id); // Data nga gi passffff
        $filter = array(
            'course_id' => $id
        );
        $this->data['prospectus'] = $this->prospectus_model->getProspectus($filter);
        $this->data['subjects'] = $this->subject_model->getSubjects(); 
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/courses/addprospectus', $this->data);
    }

    public function editprospectus()
    {
        $id = $this->input->get("id");
        $this->data['id'] = $id;
        $this->data['pagetitle'] = 'Edit prospectus';
        $this->data['courses'] = $this->course_model->getCourse($id); // Data nga gi passffff
        $filter = array(
            'course_id' => $id
        );
        $this->data['prospectus'] = $this->prospectus_model->getProspectus($filter);
        $this->data['subjects'] = $this->subject_model->getSubjects(); 
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/courses/editprospectus', $this->data);
    }


    public function deleteprospectus()
    {
        $id = $this->input->get("id");
        $this->data['id'] = $id;
        $this->data['pagetitle'] = 'Delete prospectus';
        $this->data['courses'] = $this->course_model->getCourse($id); // Data nga gi passffff
        $filter = array(
            'course_id' => $id
        );
        $this->data['prospectus'] = $this->prospectus_model->getProspectus($filter);
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/courses/deleteprospectus', $this->data);
    }
    
    public function addselection()
    {
        $rown = $this->input->get("GETrowNum");
        $classN = $this->input->get("className");
        $AA = $this->input->get("AA");
        $this->data['subjects'] = $this->subject_model->getSubjects(); 

        $className= "SelectedOnRow".$classN."_".$AA;
        $id = "SelectedOnRow".$classN.$rown;
        $hide = "'#".$id."'";
        echo '
        <div class="row" style="margin-top:5px; " id="'.$id.'">
            <div class="col-md-2" id="closeButton">
                <button class="btn btn-danger btn-sm" onclick="$('.$hide.').hide(200);$(this).hide(200)"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
            <div class="col-md-10" id="subjectOption">
                <select class="'. $className.'" style="width:100%; height:31px; border-radius:2px;">
				    <option hidden></option>';
                foreach ($this->data['subjects'] as $key => $value) {
                    echo '
                    <option value="'. $value['ID'].'">'.$value['subj_code'].' - '.$value['subj_description'].'</option>
                    ';
                }
        echo '
                </select>
            </div>
        </div>
        ';
        return;
    }
    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $course_code = $this->is_valid_post('course_code');
            $course_description = $this->is_valid_post('course_description');
            $course_year = $this->is_valid_post('course_year');
            $departmentid = $this->is_valid_post('departmentid');
            if($course_code && $course_description && $course_year && $departmentid) 
            {
                $data = array(
                    "course_code" => $course_code,
                    "course_description" => $course_description,
                    "course_year" => $course_year,
                    "departmentid" => $departmentid
                );
                if(!$this->checker_model->checkDuplicate($data,'course'))
                {
                    if($this->course_model->addCourse($data))
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

    public function edit()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $ID = $this->checker_model->is_valid_post('ID');
            $course_code = $this->checker_model->is_valid_post('course_code1');
            $course_description = $this->checker_model->is_valid_post('course_description1');
            $course_year = $this->checker_model->is_valid_post('course_year1');
            $departmentid = $this->checker_model->is_valid_post('departmentid1');
            if($course_code && $course_description && $course_year)
            {
                
                $data = array(
                    "course_code" => $course_code,
                    "course_description" => $course_description,
                    "course_year" => $course_year,
                    "departmentid" => $departmentid
                );
                if(!$this->course_model->checkDuplicate($data))
                {
                    if($this->course_model->editCourse($data,$ID))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully update");
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
                if($this->course_model->deleteCourse($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }

  
    public function getCourse()
    {
        header('Content-Type: application/json');
        $id = $this->input->get('id');
        $c = $this->course_model->getCourse($id);
        echo json_encode($c);
    }
    public function getAll()
    {
        $data = $this->course_model->getCourses(); // Data nga gi pass
        echo "
        <table id='courseTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Description</th>
                <th>Year</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['course_code'] ."</td>
                <td>". $value['course_description'] ."</td>
                <td>". $value['course_year'] ."</td>
                <td>". $value['Department'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete course?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>
                    <a href='"; echo site_url('admin/courses/prospectus/?id='.$value['ID']); echo "'"; echo " id='".$value['ID']."' class='btn btn-xs bg-purple' title='View prospectus? You will be redirected to new page'>PROSPECTUS <i class='fa fa-arrow-right'></i></a>
                    
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }
}

?>