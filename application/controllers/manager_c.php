<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class manager_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
    }
    
    public function manager_view() {
    
        //selecting all the active managers
        $fieldset = array('*');
        $whereArray = array('status' => 'active');        
        $result = $this->db_model->getData($fieldset, 'service_mgr_m_new_tbl', $whereArray);
        
        //selecting all the deactivated managers
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'service_mgr_m_new_tbl', $whereArrayDeactive);
        
        $data['active_managers'] = $result; //contains active service managers (associative array)
        $data['deactive_managers'] = $resultDeactive; //contains deactive products (associative array)
        
        $data['nav'] = "Service Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/service_mgr/manager_list',$data);
        
    }
    
    public function add_service_manager_page(){
        
        $updated_id = $this->get_reg_id("SERMGR", "Service Manager");
        
        $data['ser_mgr_id'] = $updated_id;
        $data['nav'] = "Service Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/service_mgr/add_service_manager',$data);
    }
    
  public function add_service_manager() {
        
        $updated_id = $this->get_reg_id("SERMGR", "Service Manager"); // service manager id
        $updated_emp_id = $this->get_reg_id("EMP", "Employee");  //employee id
        
        $dataArray = array(            
            //database field name => form field name
            'emp_id' => $updated_emp_id,
            'ser_mgr_id' => $updated_id,
            'ser_mgr_first_name' => $this->input->post("ser_mgr_first_name", TRUE),
            'ser_mgr_last_name' => $this->input->post("ser_mgr_last_name", TRUE),
            'ser_mgr_gender' => $this->input->post("ser_mgr_gender", TRUE),
            'ser_mgr_email' => $this->input->post("ser_mgr_email", TRUE),
            'ser_mgr_contact' => $this->input->post("ser_mgr_contact", TRUE),
            'ser_mgr_nic' => $this->input->post("ser_mgr_nic", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("service_mgr_m_new_tbl", $dataArray);
        
        $dataArrayID = array('id_number' => $updated_id);
        $whereArrID = array('id_type' => 'Service Manager');

        $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    
    public function edit_service_manager_page($ser_mgr_id) {
        
        //get the all fields details related to the selected ser_mgr_id
        $fieldset = array('*');
        $whereArray = array('ser_mgr_id' => $ser_mgr_id);
        $result = $this->db_model->getData($fieldset, 'service_mgr_m_new_tbl', $whereArray); // details of the selected service managers

        $data['ser_mgr_details'] = $result;

        $data['nav'] = "Service Manager"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/service_mgr/edit_service_manager', $data);
        
    }
    
    public function edit_service_manager() {
        
        $whereArray = array('ser_mgr_id' => $this->input->post("ser_mgr_id", TRUE));  


        $dataArray = array(            
            //database field name => form field name
            'ser_mgr_first_name' => $this->input->post("ser_mgr_first_name", TRUE),
            'ser_mgr_last_name' => $this->input->post("ser_mgr_last_name", TRUE),
            'ser_mgr_gender' => $this->input->post("ser_mgr_gender", TRUE),
            'ser_mgr_email' => $this->input->post("ser_mgr_email", TRUE),
            'ser_mgr_contact' => $this->input->post("ser_mgr_contact", TRUE),
            'ser_mgr_nic' => $this->input->post("ser_mgr_nic", TRUE),
            'status' => "active"
        );


        $result = $this->db_model->updateData('service_mgr_m_new_tbl', $dataArray, $whereArray);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    
    public function remove_service_manager(){
        
         $dataArray = array(
            //database field name => form field name
            'status' => "deactive"
        );
        $whereArr = array(
            'ser_mgr_id' => $this->input->post("ser_mgr_id_remove_form", TRUE)
        );

        $result = $this->db_model->updateData('service_mgr_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
        
    }   
                

    
    public function restore_managers(){      
                
        $dataArray = array(
            //database field name => form field name
            'status' => "active"
        );
        $whereArr = array(
            'ser_mgr_id' => $this->input->post("ser_mgr_id_restore_form", TRUE)
        );

        $result = $this->db_model->updateData('service_mgr_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
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
