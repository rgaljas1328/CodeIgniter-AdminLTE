<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Controller extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->page_title->push(lang('menu_controller'));
        $this->data['pagetitle'] = 'Control Subjects';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Controller', 'admin/Controller');
    }

    public function index()
    {
        $this->breadcrumbs->unshift(2, 'Search Student', 'admin/Controller');

        $this->data['pagetitle'] = 'Search Student';

        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        $this->template->admin_render('controller/index', $this->data);
        
    }

    public function assign()
    {
        $param = $this->input->post('studentid');

        if (!empty($param))
        {
            $this->session->set_userdata('studentid_to_enroll', $param);
            echo 1;
            return;
        }

        echo 0;
        return;
    }

    public function assign_callback()
    {
        if (!empty($this->session->userdata('studentid_to_enroll')))
        {
            $this->breadcrumbs->unshift(2, 'Control Subject', 'admin/Controller');

            $this->data['pagetitle'] = 'Control Student Subjects';

            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            $this->template->admin_render('controller/assign', $this->data);
        
            return 1;
        }

        echo "Something went wrong!";
        return 0;
    }
}