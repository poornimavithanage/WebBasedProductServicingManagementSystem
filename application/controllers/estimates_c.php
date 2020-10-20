<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class estimates_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
    }
    
    public function estimates_view() {
    
        //selecting all the active estimates
        $fieldset = array('*');
        $whereArray = array('status' => 'active');        
        $result = $this->db_model->getData($fieldset, 'job_estimate_tbl', $whereArray);
        
        //selecting all the deactivated estimates
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'job_estimate_tbl', $whereArrayDeactive);
        
        $data['active_estimates'] = $result; //contains active estimates (associative array)
        $data['deactive_estimates'] = $resultDeactive; //contains deactive estimates (associative array)
        
        $data['nav'] = "Estimates"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/estimate_list',$data);
        
    }
    
    public function add_estimates() {
        
        $dataArray = array(            
            //database field name => form field name
            'job_estimate_id' => $this->input->post("ID", TRUE),
            'job_id' => $this->input->post("Job No", TRUE),
            'customer_id' => $this->input->post("Customer Name", TRUE),
            'make' => $this->input->post("Make", TRUE),
            'model' => $this->input->post("Model", TRUE),
            'serial_no' => $this->input->post("Serial No", TRUE),
            'estimate_desc' => $this->input->post("Estimate Particulars", TRUE),
            'est_inspect_fee' => $this->input->post("Inspection Fee", TRUE),
            'repair_cost' => $this->input->post("Cost", TRUE),
            'tax' => $this->input->post("Tax Value", TRUE),
            'total' => $this->input->post("Total", TRUE),
            'est_send_date' => $this->input->post("Sent on", TRUE),
            'est_expire_date' => $this->input->post("Expires on", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("job_estimate_tbl", $dataArray);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    
    public function remove_estimates(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "deactive"
        );        
        $whereArr = array(
            'job_estimate_id' => $this->input->post("job_estimate_id_remove_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('job_estimate_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }
    
    public function restore_estimates(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "active"
        );        
        $whereArr = array(
            'job_estimate_id' => $this->input->post("job_estimate_id_restore_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('job_estimate_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }

}

