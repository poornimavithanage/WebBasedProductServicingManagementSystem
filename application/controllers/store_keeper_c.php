<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class store_keeper_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
    }
    
    public function store_keeper_view() {
    
        //selecting all the active store keepers
        $fieldset = array('*');
        $whereArray = array('status' => 'active');        
        $result = $this->db_model->getData($fieldset, 'store_keeper_m_new_tbl', $whereArray);
        
        //selecting all the deactivated store keepers
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'store_keeper_m_new_tbl', $whereArrayDeactive);
        
        $data['active_store_keepers'] = $result; //contains active store keepers (associative array)
        $data['deactive_store_keepers'] = $resultDeactive; //contains deactive store keepers (associative array)
        
        $data['nav'] = "Store Keeper"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/store_keeper/store_keeper_list',$data);
        
    }
    
    public function add_store_keeper_page(){
        
        $updated_id = $this->get_reg_id("STMGR", "Store Manager");
        
        $data['store_keeper_id'] = $updated_id;
        $data['nav'] = "Store Keeper"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/store_keeper/add_store_keepers',$data);
    }
    
    public function add_store_keepers() {
        
        $updated_id = $this->get_reg_id("STMGR", "Store Manager"); //store keeper id 
        $updated_emp_id = $this->get_reg_id("EMP", "Employee");  //employee id
        
        $dataArray = array(            
            //database field name => form field name
            'emp_id' => $updated_emp_id,
            'store_keeper_id' => $updated_id,
            'store_keeper_first_name' => $this->input->post("store_keeper_first_name", TRUE),
            'store_keeper_last_name' => $this->input->post("store_keeper_last_name", TRUE),
            'store_keeper_gender' => $this->input->post("store_keeper_gender", TRUE),
            'store_keeper_email' => $this->input->post("store_keeper_email", TRUE),
            'store_keeper_contact' => $this->input->post("store_keeper_contact", TRUE),
            'store_keeper_nic' => $this->input->post("store_keeper_nic", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("store_keeper_m_new_tbl", $dataArray);
        
        $dataArrayID = array('id_number' => $updated_id);
        $whereArrID = array('id_type' => 'Store Manager');

        $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    
    public function edit_store_keeper_page($store_keeper_id) {
        
        //get the all fields details related to the selected fdo id
        $fieldset = array('*');
        $whereArray = array('store_keeper_id' => $store_keeper_id);        
        $result = $this->db_model->getData($fieldset, 'store_keeper_m_new_tbl', $whereArray); // details of the selected fdo

        $data['store_keeper_details'] = $result;

        $data['nav'] = "Store Keeper"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/store_keeper/edit_store_keepers',$data);

        
    }
    
    public function edit_store_keepers() {
        
        $whereArray = array('store_keeper_id' => $this->input->post("store_keeper_id", TRUE));  


        $dataArray = array(            
            //database field name => form field name
            'store_keeper_first_name' => $this->input->post("store_keeper_first_name", TRUE),
            'store_keeper_last_name' => $this->input->post("store_keeper_last_name", TRUE),
            'store_keeper_gender' => $this->input->post("store_keeper_gender", TRUE),
            'store_keeper_email' => $this->input->post("store_keeper_email", TRUE),
            'store_keeper_contact' => $this->input->post("store_keeper_contact", TRUE),
            'store_keeper_nic' => $this->input->post("store_keeper_nic", TRUE),
        );


        $result = $this->db_model->updateData('store_keeper_m_new_tbl', $dataArray, $whereArray);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }
    public function remove_store_keepers(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "deactive"
        );        
        $whereArr = array(
            'store_keeper_id' => $this->input->post("store_keeper_id_remove_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('store_keeper_m_new_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }
    
    public function restore_store_keepers(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "active"
        );        
        $whereArr = array(
            'store_keeper_id' => $this->input->post("store_keeper_id_restore_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('store_keeper_m_new_tbl', $dataArray, $whereArr);
        
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
