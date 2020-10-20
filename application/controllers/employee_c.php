<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class employee_c extends CI_Controller {

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

    public function test(){

        if(extension_loaded('openssl')){
            echo "OK";
        }else{
            echo "NOT OK";
        }

        // echo !extension_loaded('openssl')?"Not Available":"Available";
    }
    
    public function employee_view() { // get all active employees 

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                //selecting all the active employees
                $fieldset = array('*');
                $whereArray = array('status' => 'active');        
                $result = $this->db_model->getData($fieldset, 'employee_m_tbl', $whereArray);
                
                //selecting all the deactivated employees
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('status' => 'deactive');        
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'employee_m_tbl', $whereArrayDeactive);
                
                $data['active_employees'] = $result; //contains active employees (associative array)
                $data['deactive_employees'] = $resultDeactive; //contains deactive employees (associative array)
                
                $data['nav'] = "Employee"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/employee/employee_list',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }  
        
        
    }

    public function employee_detail_view($emp_id) { // get a specific employee details(All details releted to emp ID)
        
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                //get employees personal details: contact
                $fieldsetEmpPerDet = array('*');
                $whereArrayEmpPerDet = array('emp_id' => $emp_id);        
                $resultEmpPerDet = $this->db_model->getData($fieldsetEmpPerDet, 'employee_m_tbl', $whereArrayEmpPerDet);

                $data['emp_personal_details']=$resultEmpPerDet;

                $data['nav'] = "Employee"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/employee/deatil_employee_p',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }        

    }

    public function add_employee_page(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $data['nav'] = "Employee"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/employee/add_employees',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function add_employees() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $updated_id = $this->get_reg_id("EMP", "Employee");

                //generate the employe password
                $this->load->helper('string');
                
                $password_employe = random_string('alpha', 8);
                $password_employe_sha1 = sha1($password_employe);


                $employee_name = $this->input->post("emp_name", TRUE);
                $contact_no = $this->input->post("contact_1", TRUE);
                $email = $this->input->post("email", TRUE);
                $employee_type = $this->input->post("emp_type", TRUE);
        
                $dataArray = array(            
                    //database field name => form field name
                    'emp_id' => $updated_id,
                    'emp_type' => $this->input->post("emp_type", TRUE),
                    'emp_name' => $this->input->post("emp_name", TRUE),
                    'email' => $this->input->post("email", TRUE),
                    'contact_1' => $this->input->post("contact_1", TRUE),
                    'contact_2' => $this->input->post("contact_2", TRUE),
                    'NIC' => $this->input->post("NIC", TRUE),
                    'Address' => $this->input->post("Address", TRUE),
                    'status' => "active"
                );


                if($employee_type === "Front Desk Officer"){

                    $updated_Front_Desk_Officer_id = $this->get_reg_id("FDO", "Front_Desk_Officer");

                    $dataFields_front_desk = array(
                                        'user_id' =>  $updated_Front_Desk_Officer_id,
                                        'user_role_id' => '6',
                                        'username' => $email,
                                        'password' => $password_employe_sha1, 
                                        'temp_password' => 'aaaaa',
                                        'login_attempt' => "1",
                                        'status' => "1"
                                        );

                    $dataFields_fdotbl = array(
                                        'emp_id' => $updated_id,
                                        'fdo_id' =>  $updated_Front_Desk_Officer_id,
                                        'fdo_name' => $employee_name,
                                        'fdo_contact' => $contact_no,
                                        'status' => "1"
                                        );

                    $result_front_desk = $this->db_model->insertData("user_login_m_tbl", $dataFields_front_desk);

                    $result_front_desk_tbl = $this->db_model->insertData("fdo_m_tbl", $dataFields_fdotbl);

                    
                    $dataArraId = array('id_number' => $updated_Front_Desk_Officer_id);
                    $whereArrId = array('id_type' => "Front_Desk_Officer");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);


                }else if($employee_type === "Technician"){

                    $updated_Technician_id = $this->get_reg_id("TEC", "Technician");

                    $dataFields_technician = array(
                                        'user_id' =>  $updated_Technician_id,
                                        'user_role_id' => '4',
                                        'username' => $email,
                                        'password' => $password_employe_sha1, 
                                        'temp_password' => 'aaaaa',
                                        'login_attempt' => "1",
                                        'status' => "1"
                                        );

                    $dataFields_technician_tbl = array(
                                        'emp_id' => $updated_id,
                                        'tech_id' =>  $updated_Technician_id,
                                        'tech_name' => $employee_name,
                                        'tech_contact' => $contact_no,
                                        'status' => "1"
                                        );

                    $result_technician = $this->db_model->insertData("user_login_m_tbl", $dataFields_technician);

                    $result_technician_tbl = $this->db_model->insertData("technician_m_tbl", $dataFields_technician_tbl);

                    $dataArraId = array('id_number' => $updated_Technician_id);
                    $whereArrId = array('id_type' => "Technician");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                }else if($employee_type === "Store Keeper"){

                    $updated_store_manager_id = $this->get_reg_id("STMGR", "Store Manager");

                    $dataFields_store_manager = array(
                                        'user_id' =>  $updated_store_manager_id,
                                        'user_role_id' => '5',
                                        'username' => $email,
                                        'password' => $password_employe_sha1, 
                                        'temp_password' => 'aaaaa',
                                        'login_attempt' => "1",
                                        'status' => "1"
                                        );

                    $dataFields_store_manager_tbl = array(
                                        'emp_id' => $updated_id,
                                        'store_manager_id' =>  $updated_store_manager_id,
                                        'store_manager_name' => $employee_name,
                                        'store_manager_contact' => $contact_no,
                                        'status' => "1"
                                        );


                    $result_store_manager = $this->db_model->insertData("user_login_m_tbl", $dataFields_store_manager);

                    $result_store_manager_tbl = $this->db_model->insertData("store_manager_m_tbl", $dataFields_store_manager_tbl);

                    $dataArraId = array('id_number' => $updated_store_manager_id);
                    $whereArrId = array('id_type' => "Store Manager");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                }else if($employee_type === "Imports Officer"){

                    $updated_imports_manager_id = $this->get_reg_id("IMPMGR", "Imports Manager");

                    $dataFields_imports_manager = array(
                                        'user_id' =>  $updated_imports_manager_id,
                                        'user_role_id' => '2',
                                        'username' => $email,
                                        'password' => $password_employe_sha1, 
                                        'temp_password' => 'aaaaa',
                                        'login_attempt' => "1",
                                        'status' => "1"
                                        );

                    $dataFields_imports_manager_tbl = array(
                                        'emp_id' => $updated_id,
                                        'ima_id' =>  $updated_imports_manager_id,
                                        'ima_name' => $employee_name,
                                        'ima_contact' => $contact_no,
                                        'ima_status' => "1"
                                        );

                    $result_imports_manager = $this->db_model->insertData("user_login_m_tbl", $dataFields_imports_manager);

                    $result_imports_manager_tbl = $this->db_model->insertData("imports_m_table", $dataFields_imports_manager_tbl);

                    $dataArraId = array('id_number' => $updated_imports_manager_id);
                    $whereArrId = array('id_type' => "Imports Manager");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                }else if($employee_type === "Service Manager"){

                    $updated_service_manager_id = $this->get_reg_id("SERMGR", "Service Manager");

                    $dataFields_service_manager = array(
                                        'user_id' =>  $updated_service_manager_id,
                                        'user_role_id' => '3',
                                        'username' => $email,
                                        'password' => $password_employe_sha1, 
                                        'temp_password' => 'aaaaa',
                                        'login_attempt' => "1",
                                        'status' => "1"
                                        );

                    $dataFields_service_manager_tbl = array(
                                        'emp_id' => $updated_id,
                                        'mgr_id' =>  $updated_service_manager_id,
                                        'mgr_name' => $employee_name,
                                        'mgr_contact' => $contact_no,
                                        'status' => "1"
                                        );

                    $result_service_manager = $this->db_model->insertData("user_login_m_tbl", $dataFields_service_manager);
                    $result_service_manager_tbl = $this->db_model->insertData("service_manager_m_table", $dataFields_service_manager_tbl);

                    $dataArraId = array('id_number' => $updated_service_manager_id);
                    $whereArrId = array('id_type' => "Service Manager");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                }else {

                }


                $result = $this->db_model->insertData("employee_m_tbl", $dataArray);


                
                if($result){

                    $dataArraId = array('id_number' => $updated_id);
                    $whereArrId = array('id_type' => "Employee");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);


                    $sms_message = "- Welcome to PSMS - <br/><br/> You have been successfully registered, System has emailed login creadentail details. Please complete your login. <br/><br/> your username : ".$email."" ;


                    $user = "94776790257";
                    $password = "2626";
                    $text = urlencode($sms_message);
                    $to = $contact_no;


                    $baseurl ="http://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
                    $ret = file($url);


                    $res= explode(":",$ret[0]);


                    // load the My_PHPMailer library : Student Email
                    $this->load->library('My_PHPMailer');

                    $date = date("Y/m/d");
                    $body_message = " - Welcome to the PSMS -  <br/><br/> Please use below login creadentials to login to the system <br/><br/> Username :". $email ." <br/> Password :". $password_employe . "";

                    $maildata["subject"] = "Username and Password";
                    $maildata["recepients"] = array(array('email' => $email));

                    $maildata["mailbody"] = $body_message;
                    $maildata["date"] = $date;
                    $maildata["altmailbody"] = "Swedish Trading Audio Visual (Pvt) Ltd. - Administration<br/><br/>";

                    $mail = new My_PHPMailer();
                    $abc = $mail->sendcustomemail($maildata);

                    //var_dump($abc);die;

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
    
    public function edit_employee_page($emp_id) {
        
        //get the all fields details related to the selected emp id
        $fieldset = array('*');
        $whereArray = array('emp_id' => $emp_id);        
        $result = $this->db_model->getData($fieldset, 'employee_m_tbl', $whereArray); // details of the selected employee

        $data['employee_details'] = $result;

        $data['nav'] = "Employee"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/employee/edit_employees',$data);

    }


    public function edit_employees() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $whereArray = array('emp_id' => $this->input->post("emp_id", TRUE));  

                $dataArray = array(            
                    //database field name => form field name
                    'emp_type' => $this->input->post("emp_type", TRUE),
                    'emp_name' => $this->input->post("emp_name", TRUE),
                    'email' => $this->input->post("email", TRUE),
                    'contact_1' => $this->input->post("contact_1", TRUE),
                    'contact_2' => $this->input->post("contact_2", TRUE),
                    'NIC' => $this->input->post("NIC", TRUE),
                    'Address' => $this->input->post("Address", TRUE),
                );

                $result = $this->db_model->updateData('employee_m_tbl', $dataArray, $whereArray);
                
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

    public function remove_employees(){ 

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $dataArray = array(            
                //database field name => form field name
                    'status' => "deactive"
                );        
                $whereArr = array(
                    'emp_id' => $this->input->post("emp_id_remove_form", TRUE)            
                    );
                
                $result = $this->db_model->updateData('employee_m_tbl', $dataArray, $whereArr);
                
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
    
    public function restore_employees(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $dataArray = array(            
                    //database field name => form field name
                    'status' => "active"
                );        
                $whereArr = array(
                    'emp_id' => $this->input->post("emp_id_restore_form", TRUE)            
                    );
                
                $result = $this->db_model->updateData('employee_m_tbl', $dataArray, $whereArr);
                
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