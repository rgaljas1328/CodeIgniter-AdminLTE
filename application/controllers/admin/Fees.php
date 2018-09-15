<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fees extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('assessor/tuition_model');
        $this->load->model('assessor/miscelleneous_model');
        $this->load->model('assessor/mandatory_model');
        $this->load->model('common/checker_model');
        $this->load->library('session');
        $this->page_title->push(lang('menu_fees'));
        
        $this->load->helper('url_helper');
        $this->load->helper("url");
        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Fees', 'admin/fees');
    }

    public function tuitions()
    {
        $this->data['pagetitle'] = 'Tuitions';
        $this->data['breadcrumb'] = $this->breadcrumbs->show();     
        $this->template->admin_render('assessor/tuitions/index', $this->data);
    }
    public function mandatories()
    {
        $this->data['pagetitle'] = 'Mandatories';
        $this->data['breadcrumb'] = $this->breadcrumbs->show();     
        $this->template->admin_render('assessor/mandatories/index', $this->data);
    }
    public function miscelleneous()
    {
        $this->data['pagetitle'] = 'Miscelleneous';
        $this->data['breadcrumb'] = $this->breadcrumbs->show();     
        $this->template->admin_render('assessor/miscelleneous/index', $this->data);
    }

    public function editTuition()
    {
        $ID = $this->checker_model->is_valid_post('ID');
        $tuition_description = $this->checker_model->is_valid_post('description1');
        $tuition_amount = $this->checker_model->is_valid_post('amount1');
        if($tuition_amount && $tuition_description && $ID)
        {
            $data = array(
                'tuition_description' => $tuition_description,
                'tuition_amount' => $tuition_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'tuition'))
            {
                if($this->tuition_model->editTuition($data,$ID))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully edited tuition');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Tuition already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function addTuition()
    {
        $tuition_description = $this->checker_model->is_valid_post('description');
        $tuition_amount = $this->checker_model->is_valid_post('amount');
        if($tuition_amount && $tuition_description)
        {
            $data = array(
                'tuition_description' => $tuition_description,
                'tuition_amount' => $tuition_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'tuition'))
            {
                if($this->tuition_model->addTuition($data))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully added tuition');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Tuition already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function getAllTuition()
    {
        $data = $this->tuition_model->getTuitions();
        echo "
        <table id='tuitionsTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['tuition_description'] ."</td>
                <td>". $value['tuition_amount'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete tuition?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }
    public function deleteTuition()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            if($this->tuition_model->deleteTuition($filter))
            {
                $results = array('status' => 'ok', 'message' => 'Successfully deleted tuition');
                echo json_encode($results);
            }
            else {
                $results = array('status' => 'error', 'message' => 'Error deleting tuition');
                echo json_encode($results);
            }
        }
        else {
            return;
        }
    }
    public function getTuition()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            $data = $this->tuition_model->getTuition($filter);
            echo json_encode($data);
            return;
        }
        else
        {
            return;
        }
    }

    public function addMiscelleneous()
    {
        $miscelleneous_description = $this->checker_model->is_valid_post('description');
        $miscelleneous_amount = $this->checker_model->is_valid_post('amount');
        if($miscelleneous_description && $miscelleneous_amount)
        {
            $data = array(
                'miscelleneous_description' => $miscelleneous_description,
                'miscelleneous_amount' => $miscelleneous_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'miscelleneous'))
            {
                if($this->miscelleneous_model->addMiscelleneous($data))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully added miscelleneous');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Miscelleneous already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function editMiscelleneous()
    {
        $ID = $this->checker_model->is_valid_post('ID');
        $miscelleneous_description = $this->checker_model->is_valid_post('description1');
        $miscelleneous_amount = $this->checker_model->is_valid_post('amount1');
        if($miscelleneous_description && $miscelleneous_amount && $ID)
        {
            $data = array(
                'miscelleneous_description' => $miscelleneous_description,
                'miscelleneous_amount' => $miscelleneous_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'miscelleneous'))
            {
                if($this->miscelleneous_model->editMiscelleneous($data,$ID))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully added miscelleneous');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Miscelleneous already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function deleteMiscelleneous()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            if($this->miscelleneous_model->deleteMiscelleneous($filter))
            {
                $results = array('status' => 'ok', 'message' => 'Successfully deleted miscelleneous');
                echo json_encode($results);
            }
            else {
                $results = array('status' => 'error', 'message' => 'Error deleting miscelleneous');
                echo json_encode($results);
            }
        }
        else {
            return;
        }
    }
    public function getMiscelleneouses()
    {
        $data = $this->miscelleneous_model->getMiscelleneouses();
        echo "
        <table id='miscelleneousTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['miscelleneous_description'] ."</td>
                <td>". $value['miscelleneous_amount'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete miscelleneous?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }
    public function getMiscelleneous()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            $data = $this->miscelleneous_model->getMiscelleneous($filter);
            echo json_encode($data);
            return;
        }
        else
        {
            return;
        }
    }

    public function addMandatory()
    {
        $mandatory_description = $this->checker_model->is_valid_post('description');
        $mandatory_amount = $this->checker_model->is_valid_post('amount');
        if($mandatory_description && $mandatory_amount)
        {
            $data = array(
                'mandatory_description' => $mandatory_description,
                'mandatory_amount' => $mandatory_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'mandatory'))
            {
                if($this->mandatory_model->addMandatory($data))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully added mandatory');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Mandatory already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function editMandatory()
    {
        $ID = $this->checker_model->is_valid_post('ID');
        $mandatory_description = $this->checker_model->is_valid_post('description1');
        $mandatory_amount = $this->checker_model->is_valid_post('amount1');
        if($mandatory_description && $mandatory_amount)
        {
            $data = array(
                'mandatory_description' => $mandatory_description,
                'mandatory_amount' => $mandatory_amount
            );
            if(!$this->checker_model->checkDuplicate($data, 'mandatory'))
            {
                if($this->mandatory_model->editMandatory($data,$ID))
                {
                    $results = array('status' => 'ok', 'message' => 'Successfully edited mandatory');
                    echo json_encode($results);
                }
            }
            else {
                $results = array('status' => 'duplicate', 'message' => 'Mandatory already exist');
                echo json_encode($results);
            }
        }
        else
        {
            return;
        }
    }
    public function deleteMandatory()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            if($this->mandatory_model->deleteMandatory($filter))
            {
                $results = array('status' => 'ok', 'message' => 'Successfully deleted mandatory');
                echo json_encode($results);
            }
            else {
                $results = array('status' => 'error', 'message' => 'Error deleting mandatory');
                echo json_encode($results);
            }
        }
        else {
            return;
        }
    }
    public function getMandatory()
    {
        $id = $this->checker_model->is_valid_get('id');
        if($id)
        {
            $filter = array(
                'ID' => $id
            );
            $data = $this->mandatory_model->getMandatory($filter);
            echo json_encode($data);
            return;
        }
        else
        {
            return;
        }
    }
    public function getAllMandatories()
    {
        $data = $this->mandatory_model->getMandatories();
        echo "
        <table id='mandatoriesTable' class='table table-bordered' role='grid'>
                               
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        ";
        foreach ($data as $key => $value) {
            echo "
            <tr>
                <td>". $value['ID'] ."</td>
                <td>". $value['mandatory_description'] ."</td>
                <td>". $value['mandatory_amount'] ."</td>
                <td>
                    <button class='btn btn-warning btn-xs edit' id='edit_".$value['ID']."'  type='button'><i class='fa fa-edit'></i> Edit</button>
                    <a href='#' class='btn btn-xs btn-danger' id='delete_".$value['ID']."' data-placement='top' title='Delete mandatory?' data-singleton='true'><i class='fa fa-trash'></i> Delete</a>
                </td>
            </tr>";
        }
        echo "
        </table>
        ";
    }
    
   
}

?>