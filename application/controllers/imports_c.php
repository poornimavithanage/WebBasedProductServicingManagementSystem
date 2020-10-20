<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class imports_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
    }
    
    public function imports_officer_view() {
    
        //selecting all the active imports officers
        $fieldset = array('*');
        $whereArray = array('status' => 'active');        
        $result = $this->db_model->getData($fieldset, 'imports_mgr_m_new_tbl', $whereArray);
        
        //selecting all the deactivated imports officers
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'imports_mgr_m_new_tbl', $whereArrayDeactive);
        
        $data['active_importsofficers'] = $result; //contains active imports officers (associative array)
        $data['deactive_importsofficers'] = $resultDeactive; //contains deactive imports officers(associative array)
        
        $data['nav'] = "Imports Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/Imports_officer/importsofficer_list',$data);
        
    }
    
    public function add_imports_officer_page(){
        
        $updated_id = $this->get_reg_id("IMPMGR", "Imports Manager");
        
        $data['imp_id'] = $updated_id;
        $data['nav'] = "Imports Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/Imports_officer/add_imports_officer',$data);
    }
    
    public function add_imports_officer() {
        
        $updated_id = $this->get_reg_id("IMPMGR", "Imports Manager");// imports officer id
        $updated_emp_id = $this->get_reg_id("EMP", "Employee");  //employee id
        $dataArray = array(            
            //database field name => form field name
            'emp_id' => $updated_emp_id,
            'imp_id' => $updated_id,
            'imp_first_name' => $this->input->post("imp_first_name", TRUE),
            'imp_last_name' => $this->input->post("imp_last_name", TRUE),
            'imp_gender' => $this->input->post("imp_gender", TRUE),
            'imp_email' => $this->input->post("imp_email", TRUE),
            'imp_contact' => $this->input->post("imp_contact", TRUE),
            'imp_nic' => $this->input->post("imp_nic", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("imports_mgr_m_new_tbl", $dataArray);
        
        $dataArrayID = array('id_number' => $updated_id);
        $whereArrID = array('id_type' => 'Imports Manager');

        $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    
    public function edit_imports_officer_page($imp_id) {
        
        //get the all fields details related to the selected imp_id
        $fieldset = array('*');
        $whereArray = array('imp_id' => $imp_id);        
        $result = $this->db_model->getData($fieldset, 'imports_mgr_m_new_tbl', $whereArray); // details of the selected imp_id

        $data['imp_details'] = $result;

        $data['nav'] = "Imports Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/Imports_officer/edit_imports_officer',$data);

        
    }
    
    public function edit_imports_officer() {
        
        $whereArray = array('imp_id' => $this->input->post("imp_id", TRUE));  


        $dataArray = array(            
            //database field name => form field name
            'imp_first_name' => $this->input->post("imp_first_name", TRUE),
            'imp_last_name' => $this->input->post("imp_last_name", TRUE),
            'imp_gender' => $this->input->post("imp_gender", TRUE),
            'imp_email' => $this->input->post("imp_email", TRUE),
            'imp_contact' => $this->input->post("imp_contact", TRUE),
            'imp_nic' => $this->input->post("imp_nic", TRUE),
        );


        $result = $this->db_model->updateData('imports_mgr_m_new_tbl', $dataArray, $whereArray);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    public function remove_imports_officer(){      
                
          $dataArray = array(
            //database field name => form field name
            'status' => "deactive"
        );
        $whereArr = array(
            'imp_id' => $this->input->post("imp_id_remove_form", TRUE)
        );

        $result = $this->db_model->updateData('imports_mgr_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }
    
    public function restore_imports_officer(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "active"
        );        
        $whereArr = array(
            'imp_id' => $this->input->post("imp_id_restore_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('imports_mgr_m_new_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }
    
        
     //**** Util function: ***** //
    public function get_reg_id($character,$id_type) {

        $id = 0000;

        if($character == ""){

        $fields = array("*");
        $whereArr = array("id_type" => $id_type);
        $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

        $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
        $id = ($int + 1);

        }else{

        $fields = array("*");
        $whereArr = array("id_type" => $id_type);
        $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

        $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
        $id = "$character" . ($int + 1);

        }

        return $id;
    }

}
