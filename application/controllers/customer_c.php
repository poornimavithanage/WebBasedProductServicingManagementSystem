<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class customer_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

        if ($this->session->userdata('logged_in')) {

        $session_data = $this->session->userdata('logged_in');
        $user_role_id = $session_data['user_role_id'];

        if($user_role_id === "1"){ //admin        
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
        }else{
        
            $this->load->view('psmsbackend/403_error_page');
        }

        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function customer_view() { // get all active customers 

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                //selecting all the active customers
                $fieldset = array('*'); //SELECT *
                $whereArray = array('status' => 'active');    //WHERE status ="active"    
                $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray);
                
                //selecting all the deactivated customers
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('status' => 'deactive');        
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'customer_m_tbl', $whereArrayDeactive);
                
                $data['active_customers'] = $result; //contains active customers (associative array)
                $data['deactive_customers'] = $resultDeactive; //contains deactive customers (associative array)
                
                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/customers/customer_list',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }  
        
        
    }

    public function customer_detail_view($customer_id) { // get a specific customer details(All details releted to customer ID)
        
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                //get customer's personal details: contact
                $fieldsetCusPerDet = array('*');
                $whereArrayCusPerDet = array('customer_id' => $customer_id);        
                $resultCusPerDet = $this->db_model->getData($fieldsetCusPerDet, 'customer_m_tbl', $whereArrayCusPerDet);

                //get customer's job details
                $fieldsetCusPerJob = array('*');
                $whereArrayCusPerJob = array('customer_id' => $customer_id);        
                $resultCusPerJob = $this->db_model->getData($fieldsetCusPerJob, 'customer_job_tbl', $whereArrayCusPerJob);

                $data['cus_job_details']=$resultCusPerJob;
                $data['cus_personal_details']=$resultCusPerDet;
                
                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/customers/deatil_customer_p',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }        

    }

    public function add_customer_page(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/customers/add_customers',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function add_customers() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $updated_id = $this->get_reg_id("CUS", "Customer");
        
                $dataArray = array(            
                    //database field name => form field name
                    'customer_id' => $updated_id,
                    'title' => $this->input->post("title", TRUE),
                    'cus_name' => $this->input->post("cus_name", TRUE),
                    'cus_address' => $this->input->post("address", TRUE),
                    'contact_no' => $this->input->post("contact_no", TRUE),
                    'contact_no1' => $this->input->post("contact_no1", TRUE),
                    'NIC' => $this->input->post("NIC", TRUE),
                    'fax' => $this->input->post("fax", TRUE),
                    'email' => $this->input->post("email", TRUE),
                    'status' => "active"
                );
                
                $tableName = "customer_m_tbl";

                $result = $this->db_model->insertData($tableName, $dataArray);
                
                if($result){

                    $dataArraId = array('id_number' => $updated_id);
                    $whereArrId = array('id_type' => "Customer");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);
                                
                    $record = array('final_result' => 'success');            
                    echo json_encode($record);
                }else{
                    $record = array('final_result' => 'unsuccess');            
                    echo json_encode($record);            
                }
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }        
        
    }
    
    public function edit_customers_page($customer_id) {
        
        //get the all fields details related to the selected customer id
        $fieldset = array('*');
        $whereArray = array('customer_id' => $customer_id);        
        $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray); // details of the selected customer

        $data['customer_details'] = $result;

        $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/customers/edit_customers',$data);

    }


    public function edit_customers() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $whereArray = array('customer_id' => $this->input->post("customer_id", TRUE));  

                $dataArray = array(            
                    //database field name => form field name
                    'title' => $this->input->post("title", TRUE),
                    'cus_name' => $this->input->post("cus_name", TRUE),
                    'cus_address' => $this->input->post("cus_address", TRUE),
                    'contact_no' => $this->input->post("contact_no", TRUE),
                    'contact_no1' => $this->input->post("contact_no1", TRUE),
                    'NIC' => $this->input->post("NIC", TRUE),
                    'fax' => $this->input->post("fax", TRUE),
                    'email' => $this->input->post("email", TRUE)
                );

                $result = $this->db_model->updateData('customer_m_tbl', $dataArray, $whereArray);
                
                if($result){            
                    $record = array('final_result' => 'success');            
                    echo json_encode($record);
                }else{
                    $record = array('final_result' => 'unsuccess');            
                    echo json_encode($record);
                    
                }
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }                
        
    }

    public function remove_customers(){ 

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $dataArray = array(            
                //database field name => form field name
                    'status' => "deactive"
                );        
                $whereArr = array(
                    'customer_id' => $this->input->post("customer_id_remove_form", TRUE)            
                    );
                
                $result = $this->db_model->updateData('customer_m_tbl', $dataArray, $whereArr);
                
                if($result){            
                    $record = array('final_result' => 'success');            
                    echo json_encode($record);
                }else{
                    $record = array('final_result' => 'unsuccess');            
                    echo json_encode($record);
                    
                }
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }                     
        
    }
    
    public function restore_customers(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $dataArray = array(            
                    //database field name => form field name
                    'status' => "active"
                );        
                $whereArr = array(
                    'customer_id' => $this->input->post("customer_id_restore_form", TRUE)            
                    );
                
                $result = $this->db_model->updateData('customer_m_tbl', $dataArray, $whereArr);
                
                if($result){            
                    $record = array('final_result' => 'success');            
                    echo json_encode($record);
                }else{
                    $record = array('final_result' => 'unsuccess');            
                    echo json_encode($record);
                    
                }
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }       
        
    }


   

         // *****  Uitility Method for getting the Reg/User/ect IDs: Common Function ***** //
    public function get_reg_id($character, $id_type) {

        $fields = array("*");
        $whereArr = array("id_type" => $id_type);
        $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

        $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
        $id = "$character" . ($int + 1);
        return $id;

}


}