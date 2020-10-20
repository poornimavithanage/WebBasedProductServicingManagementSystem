<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class fdo_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard', $data);
    }

    public function random() {

        $this->load->helper('string');
        echo random_string('numeric', 7);
    }

    public function fdo_view() {

        //selecting all the active FDOs
        $fieldset = array('*');
        $whereArray = array('status' => 'active');
        $result = $this->db_model->getData($fieldset, 'fdo_m_new_tbl', $whereArray);

        //selecting all the deactivated FDOs
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'fdo_m_new_tbl', $whereArrayDeactive);

        $data['active_FDOs'] = $result; //contains active FDOs (associative array)
        $data['deactive_FDOs'] = $resultDeactive; //contains deactive FDOs (associative array)

        $data['nav'] = "FDO"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/fdo/fdo_list', $data);
    }

    public function add_fdo_page() {

        $updated_id = $this->get_reg_id("FDO", "Front_Desk_Officer");

        $data['fdo_id'] = $updated_id;
        $data['nav'] = "FDO"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/fdo/add_fdo', $data);
    }
    
    public function add_fdo() {

        $updated_id = $this->get_reg_id("FDO", "Front_Desk_Officer"); //front desk office id
        $updated_emp_id = $this->get_reg_id("EMP", "Employee");  //employee id

        $dataArray = array(
            //database field name => form field name
            'emp_id' => $updated_emp_id,
            'fdo_id' => $updated_id,
            'fdo_first_name' => $this->input->post("fdo_first_name", TRUE),
            'fdo_last_name' => $this->input->post("fdo_last_name", TRUE),
            'fdo_gender' => $this->input->post("fdo_gender", TRUE),
            'fdo_email' => $this->input->post("fdo_email", TRUE),
            'fdo_contact' => $this->input->post("fdo_contact", TRUE),
            'fdo_nic' => $this->input->post("fdo_nic", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("fdo_m_new_tbl", $dataArray);

        $dataArrayID = array('id_number' => $updated_id);
        $whereArrID = array('id_type' => 'Front_Desk_Officer');

        $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }
        
    
    public function edit_fdo_page($fdo_id) {

        //get the all fields details related to the selected fdo id
        $fieldset = array('*');
        $whereArray = array('fdo_id' => $fdo_id);
        $result = $this->db_model->getData($fieldset, 'fdo_m_new_tbl', $whereArray); // details of the selected fdo

        $data['fdo_details'] = $result;

        $data['nav'] = "FDO"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/fdo/edit_fdo', $data);
    }

    public function edit_fdo() {

        $whereArray = array('fdo_id' => $this->input->post("fdo_id", TRUE));


        $dataArray = array(
            //database field name => form field name
            'fdo_first_name' => $this->input->post("fdo_first_name", TRUE),
            'fdo_last_name' => $this->input->post("fdo_last_name", TRUE),
            'fdo_gender' => $this->input->post("fdo_gender", TRUE),
            'fdo_email' => $this->input->post("fdo_email", TRUE),
            'fdo_contact' => $this->input->post("fdo_contact", TRUE),
            'fdo_nic' => $this->input->post("fdo_nic", TRUE),
            'status' => "active"
        );


        $result = $this->db_model->updateData('fdo_m_new_tbl', $dataArray, $whereArray);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function remove_fdo() {

        $dataArray = array(
            //database field name => form field name
            'status' => "deactive"
        );
        $whereArr = array(
            'fdo_id' => $this->input->post("fdo_id_remove_form", TRUE)
        );

        $result = $this->db_model->updateData('fdo_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function restore_fdo() {

        $dataArray = array(
            //database field name => form field name
            'status' => "active"
        );
        $whereArr = array(
            'fdo_id' => $this->input->post("fdo_id_restore_form", TRUE)
        );

        $result = $this->db_model->updateData('fdo_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    //**** Util function: ***** //
    public function get_reg_id($character, $id_type) {
        
        $id = 0000;
        

        if ($character == "") {

            $fields = array("*");
            $whereArr = array("id_type" => $id_type);
            $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

            $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
            $id = ($int + 1);
        } else {

            $fields = array("*");
            $whereArr = array("id_type" => $id_type);
            $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

            $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
            $id = "$character" . ($int + 1);
        }

        return $id;
    }

}
