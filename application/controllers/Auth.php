<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller 
{

	function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model('common/checker_model');
        $this->load->model('admin/teacher_model');
        $this->load->model('auth/access_model');
        $this->load->library('session');
	}

	function index()
	{
        if(!$this->isNoAccount()){            
            
            if($this->isLogin())
            {
                $data['login_status'] = true;
                $this->template->auth_render('auth/login', $this->data);
            }
            else
            {
                redirect('auth/login', 'refresh');
            }
        }
        else 
        {
            redirect('auth/create', 'refresh');
        }
	}


    function login()
	{
        if(!$this->isNoAccount())
        {
        	if($this->isLogin())
        	{
        		$data['login_status'] = true;
        		$this->data = array_push($data['login_status']);
                $this->template->auth_render('auth/login', $this->data);
                var_dump($this->data);
        	}
        	else
        	{
        		$data = false;
        		array_push($this->data,$data['login_status']);
        		$this->template->auth_render('auth/login', $this->data);
        		var_dump($this->data);
        	}
            
        }
        else 
        {
            redirect('auth/create', 'refresh');
        }
   }

   function create()
   {
        $username = $this->is_valid_post('username');
        $password = $this->is_valid_post('password');
        $teacher_name = $this->is_valid_post('teacher_name');
        $teacher_address = $this->is_valid_post('teacher_address');
        $teacher_position = $this->is_valid_post('teacher_position');

        if($username && $password && $teacher_name && $teacher_address && $teacher_position)
        {
            

            $dataTeacher = array(
                'teacher_name' => $teacher_name,
                'teacher_address' => $teacher_address,
                'teacher_position' => $teacher_position,
                'teacher_employment_status' => 'Active'
            );
            if($this->teacher_model->addTeacher($dataTeacher)){
                $maxTeacherID = $this->teacher_model->getMaxID();
                $dataAccess = array(
                    'teacher_id' => $maxTeacherID->ID,
                    'access_username' => $username,
                    'access_password' => md5($password),
                    'access_type' => 'Administrator',
                    'access_status' => 'Active' 
                );
                if($this->access_model->addAccess($dataAccess))
                {
                    $this->Created();
                }
            }
        }
        else
        {

            if(!$this->isNoAccount())
            {
                redirect('auth/login', 'refresh');
            }
            else 
            {
                $this->template->auth_render('auth/create', $this->data);
            }
        }
   }

    function logout($src = NULL)
	{
        $accSessions = array('access_username', 'access_password');
        $this->session->unset_userdata($array_items);
        redirect('auth/login', 'refresh');        
    }




    function isLogin()
    {
        return (isset($_SESSION['access_username']) && isset($_SESSION['access_password'])) ? true:false;
    }
    
    function isNoAccount()
    {
        $teacherCount = $this->teacher_model->countTeachers();
        $accessCount = $this->access_model->countAccess();
        return ($teacherCount == 0 || $accessCount == 0) ? true : false;
    }

}
