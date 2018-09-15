<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubjectOfferings extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/subjectoffering_model');
        $this->load->model('admin/academicyear_model');
        $this->load->model('admin/room_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_courses'));
        $this->data['pagetitle'] = 'Subject Offerings';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Subject Offerings', 'admin/subjectofferings');
    }

    public function index()
    {
        // $this->data['subjectofferings'] = $this->subjectoffering_model->getSubjectOfferings(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/subjectofferings/index', $this->data);
    }
    public function create()
    {
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->template->admin_render('admin/subjectofferings/create', $this->data);
    }

    public function getSubjectOffering()
    {
        $id = $this->input->get("id");
        $query = $this->subjectoffering_model->getSubjectOffering($id);
        echo json_encode($query);
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
                if($this->subjectoffering_model->deleteSubjectOffering($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }
    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $subj_id = $this->checker_model->is_valid_post('subject');
            $room_id = $this->checker_model->is_valid_post('room');
            $instructor_id = $this->checker_model->is_valid_post('instructor');
            $section = $this->checker_model->is_valid_post('section');
            $slot = $this->checker_model->is_valid_post('slot');
            $timein = $this->checker_model->is_valid_post('timein');
            $timeout = $this->checker_model->is_valid_post('timeout');
            $days = implode("-", $this->checker_model->is_valid_post('day'));
            $term = "";
            $level = "";
            if($subj_id && $room_id && $instructor_id)
            {
                
                $academicyearID = $this->academicyear_model->getActiveAcademicYear();
                
                $h = 0;
                $IN = explode(' ', $timein);
                $timein = $IN[0];
                if($IN[1] == 'PM')
                {
                    $IN2 = explode(':', $timein); 
                    $h= ($IN2[0] != 12) ? 12 + $IN2[0] : $IN2[0];
                    $timein = $h.':'.$IN2[1];
                }
                $OUT = explode(' ', $timeout);
                $timeout = $OUT[0];
                if($OUT[1] == 'PM')
                {
                    $OUT2 = explode(':', $timeout); 
                    $h= ($OUT2[0] != 12) ? 12 + $OUT2[0] : $OUT2[0];
                    $timeout = $h.':'.$OUT2[1];
                }
                
                $data = array(
                    'academicyear_id' => $academicyearID['ID'],
                    'subjectoffering_status' => 'Active',
                    'subj_id' => $subj_id,
                    'room_id' => $room_id,
                    'instructor_id' => $instructor_id,
                    'subjectoffering_section' => $section,
                    'subjectoffering_slots' => $slot,
                    'subjectoffering_timein' => $timein,
                    'subjectoffering_timeout' => $timeout,
                    'subjectoffering_days' => $days
                );
                if($this->checking($data) != false)
                {
                    echo json_encode($this->checking($data));
                }
                else 
                {
                    if($this->subjectoffering_model->add($data))
                    {
                        $result = array(
                            'status' => 'ok',
                            'message' => 'Successfully added'
                        );
                        echo json_encode($result);
                    }
                }
            }
        }
    }

    public function checking($data)
    {
        $tempTimeIN = explode(':', $data['subjectoffering_timein']);
        $result = array();
        $iter = 0;
        $statusOK = true;
        if($data['subjectoffering_timein'] >= $data['subjectoffering_timeout'] || $tempTimeIN[0] < 06)
        {
            $result[$iter] = "Time in is not larger than time out.";
            $iter++;
            $result[$iter] = "Time in is not lower than 6 AM.";
            $iter++;
            
        }
        if($data["subjectoffering_slots"] > 100)
        {
            $result[$iter] = "Slot is to big";
            $iter++;
        }
        $roomDetails = $this->room_model->getRoom($data['room_id']);
        if($roomDetails['room_capacity'] < $data["subjectoffering_slots"])
        {
            $result[$iter] = "Slots is bigger than the required slots";
            $iter++;
        }
        
        return ($iter != 0) ? $result:false;
    }
    

    public function getAll()
    {
       $data = $this->subjectoffering_model->getSubjectOfferings();
       $output ='';
        $output.='
        <table id="subjectofferingTable" class="table table-bordered" role="grid"> 
            <tr>
                <th>Subject Code</th>
                <th>Description</th>
                <th>Time</th>
                <th>Room</th>
                <th>Days</th>
                <th>Section</th>
                <th>Year</th>
                <th>Term</th>
                <th>Instructor</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        ';
        foreach ($data as $key => $value) {
            $output.='
            <tr>
                <td>'.$value['subj_code'].'</td>
                <td>'.$value['subj_description'].'</td>
                <td>'.$value['subjectoffering_timein'].'-'.$value['subjectoffering_timeout'].'</td>
                <td>'.$value['room_building_name'].'</td>
                <td>'.$value['subjectoffering_days'].'</td>
                <td>'.$value['subjectoffering_section'].'</td>
                <td>'.$value['academicyear_year'].'</td>
                <td>'.$value['academicyear_term'].'</td>
                <td>'.$value['instructor_name'].'</td>
                <td>'.$value['subjectoffering_status'].'</td>
                <td>
                    <button class="btn btn-warning btn-xs edit" id="edit_'.$value['ID'].'"  type="button"><i class="fa fa-edit"></i> Edit</button>
                    <a href="#" class="btn btn-xs btn-danger" id="delete_'.$value['ID'].'" data-placement="top" title="Delete course?" data-singleton="true"><i class="fa fa-trash"></i> Delete</a>
                </td>
            </tr>
            ';
        }
        $output.='</table>';
        echo $output;

    }
}

?>