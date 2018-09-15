<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rooms extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        /* Load :: Common */
        //$this->lang->load('admin/courses');
        $this->load->model('admin/room_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_rooms'));
        $this->data['pagetitle'] = 'Rooms';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Rooms', 'admin/rooms');
    }

    public function index()
    {
        $this->data['rooms'] = $this->room_model->getRooms(); // Data nga gi pass
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        //FORM
            $this->data['room_building_name'] = array(
				'name'  => 'room_building_name',
				'id'    => 'room_building_name',
				'type'  => 'text',
                'placeholder' => 'e.g NESB Building',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('room_building_name'),
			);
			$this->data['room_number'] = array(
				'name'  => 'room_number',
				'id'    => 'room_number',
				'type'  => 'text',
                'placeholder' => 'e.g Rm. 202',
                'class' => 'form-control',
                'required' =>'',
				'value' => $this->form_validation->set_value('room_number'),
			);
            $this->data['room_capacity'] = array(
				'name'  => 'room_capacity',
				'id'    => 'room_capacity',
				'type'  => 'text',
                'placeholder' => 'e.g 35',
                'required' =>'',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('room_capacity'),
			);
        $this->template->admin_render('admin/rooms/index', $this->data);
    }

    public function getRooms()
    {
        $this->data['rooms'] = $this->room_model->getRooms();
        echo json_encode($this->data['rooms']);
        return;
    }

    public function getRoom()
    {
        header('Content-Type: application/json');
        $id = $this->checker_model->is_valid_get('id');
        $ay = $this->room_model->getRoom($id);
        echo json_encode($ay);
    }

    public function add()
    {
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            $room_building_name = $this->checker_model->is_valid_post('room_building_name');
            $room_number = $this->checker_model->is_valid_post('room_number');
            $room_capacity = $this->checker_model->is_valid_post('room_capacity');
            if($room_building_name && $room_number && $room_capacity)
            {
                $data = array(
                    "room_building_name" => $room_building_name,
                    "room_number" => $room_number,
                    "room_capacity" => $room_capacity
                );
                if(!$this->room_model->checkDuplicate($data))
                {
                    if($this->room_model->addRoom($data))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully added");
                        echo json_encode($result);
                    }
                }
                else 
                {
                    $result = array('status' => "duplicate", 'message' => "Room already exist");
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
            $room_building_name = $this->checker_model->is_valid_post('room_building_name1');
            $room_number = $this->checker_model->is_valid_post('room_number1');
            $room_capacity = $this->checker_model->is_valid_post('room_capacity1');
            $ID = $this->checker_model->is_valid_post('ID');
            if($room_building_name && $room_number && $room_capacity)
            {
                $data = array(
                    "room_building_name" => $room_building_name,
                    "room_number" => $room_number,
                    "room_capacity" => $room_capacity
                );
                if(!$this->room_model->checkDuplicate($data))
                {
                    if($this->room_model->editRoom($data,$ID))
                    {
                        $result = array('status' => "ok", 'message' => "Successfully update");
                        echo json_encode($result);
                    }
                }
                else
                {
                    $result = array('status' => "duplicate", 'message' => "Room already exist");
                    echo json_encode($result);
                }
            }
        }
    }

    public function getAll()
    {
        $this->data['rooms'] = $this->room_model->getRooms();
        echo "
        <table id='roomTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Building name</th>
                <th>Room number</th>
                <th>Room capacity</th>
                <th>Action</th>
            </tr>";
        foreach ($this->data['rooms'] as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['room_building_name'] ."</td>
                <td>". $value['room_number'] ."</td>
                <td>". $value['room_capacity'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button> &nbsp;
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete room?' data-singleton='true' data-toggle='confirmation' ><i class='fa fa-remove'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>";
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
                if($this->room_model->deleteRoom($id))
                {
                    $result = array('status' => "ok", 'message' => "Successfully deleted");
                    echo json_encode($result);
                }
            }
        }
    }

}

?>