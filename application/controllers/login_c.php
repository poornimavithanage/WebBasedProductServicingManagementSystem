<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Login_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function index() {

        $data['page_msg'] = "";

        $this->load->view('psmsbackend/pages/login', $data);
    }

    public function login_verification() {

        $username = $this->input->post("username", TRUE);
        $password = $this->input->post("password", TRUE);

        $password_sha1 = sha1($password);

        $fields = "*";
        $whereArr = array("username" => $username, "password" => $password_sha1);
        $data_res = $this->db_model->getData($fields, 'user_login_m_tbl', $whereArr);
//        var_dump($data_res);die;

        if (count($data_res) === 1) {

            if ($data_res[0]->login_attempt === "1") { //first time password reset
                $data['username'] = $username;
                $data['password'] = $password;

                $data['page_msg'] = "";

                $this->load->view('psmsbackend/pages/first_time_password_reset', $data);
            } else {

                $sess_array = array(
                    'user_id' => $data_res[0]->user_id,
                    'username' => $data_res[0]->username,
                    'user_role_id' => $data_res[0]->user_role_id);

                $this->session->set_userdata('logged_in', $sess_array);

                redirect('login_c/login_directory');
            }
        } else {

            $data['page_msg'] = "invalid_user";

            $this->load->view('psmsbackend/pages/login', $data);
        }
    }

    public function login_directory() {


        // var_dump($this->session->userdata('logged_in'));die;

        if ($this->session->userdata('logged_in')) {


            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];


            if ($user_role_id === "1") { //admin
                redirect('login_c/dashboard_admin');
            } else if ($user_role_id === "2") { // import officer
                redirect('login_c/dashboard_imports_manager');
            } else if ($user_role_id === "3") { //serivce manager
                redirect('login_c/dashboard_service_manager');
            } else if ($user_role_id === "4") { // technician
                redirect('login_c/dashboard_technician');
            } else if ($user_role_id === "5") { // store manager
                redirect('login_c/dashboard_storemgr');
            } else if ($user_role_id === "6") {// front desk
                redirect('login_c/dashboard_fornt_desk');
            } else if ($user_role_id === "7") {
                
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

//end of the login_directory function

    public function dashboard_admin() {
        
        if ($this->session->userdata('logged_in')) {
        
        $session_data = $this->session->userdata('logged_in');
        $user_role_id = $session_data['user_role_id'];
        $user_id = $session_data['user_id'];
        
        if ($user_role_id === "1") { //Admin

        $data['nav'] = "dashboard";
        
         ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  1st chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get he job count of pending jobs 
                $field1 = "*";
                $whereArray1 = array("current_status" => "Pending");
                $result1 = $this->db_model->getData($field1, "customer_job_tbl", $whereArray1);

                //get he job count of service Manager WIP jobs
                //$field2 = "*";
                //$whereArray2 = array("current_status" => "service Manager WIP");
                //$result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get he job count of Technician WIP jobs
                $field2 = "*";
                $whereArray2 = array("current_status" => "Technician WIP");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get the job count of Sent for estimation approval 
                $field3 = "*";
                $whereArray3 = array("current_status" => "Sent for estimation approval");
                $result3 = $this->db_model->getData($field3, "customer_job_tbl", $whereArray3);
                
                //get the job count of store manager WIP
                $field4 = "*";
                $whereArray4 = array("current_status" => "Store Manager WIP");
                $result4 = $this->db_model->getData($field4, "customer_job_tbl", $whereArray4);
                
                //get the job count of order finished
                $field5 = "*";
                $whereArray5 = array("current_status" => "Order Finished");
                $result5 = $this->db_model->getData($field5, "customer_job_tbl", $whereArray5);



                if (count($result1) === 0 && count($result2) === 0 && count($result3) === 0 && count($result4)=== 0  && count($result5)=== 0) {
                    $data['chart_1'] = "no_data";
                } else {
                    $data['chart_1'] = "yes_data";
                }
                
                $data['pending_job_count'] = count($result1);
                $data['tech_WIP_job_count'] = count($result2);
                $data['estimate_approval_pending_job_count'] = count($result3);
                $data['Store_Manager_WIP_job_count'] = count($result4);
                $data['Order_Finished_job_count'] = count($result5);
                
                      ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  2nd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                //get customer repair jobs 
                $field6 = "*";
                $whereArray6 = array("warranty_type" => "Customer Repair");
                $result6 = $this->db_model->getData($field6, "customer_job_tbl", $whereArray6);

                //get company warranty jobs
                $field7 = "*";
                $whereArray7 = array("warranty_type" => "Company Warranty");
                $result7 = $this->db_model->getData($field7, "customer_job_tbl", $whereArray7);
                
                
                
                if (count($result6) === 0 && count($result7) === 0 ) {
                    $data['chart_2'] = "no_data";
                } else {
                    $data['chart_2'] = "yes_data";
                }
                
                $data['customer_repair_job_count'] = count($result6);
                $data['company_warranty_job_count'] = count($result7);
               
                
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  3rd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                 //get front desk employees 
                $field8= "*";
                $whereArray8 = array("status" => "active");
                $result8 = $this->db_model->getData($field8, "fdo_m_new_tbl", $whereArray8);

                //get technician of employees
                $field9 = "*";
                $whereArray9 = array("status" => "active");
                $result9 = $this->db_model->getData($field9, "technician_m_new_tbl", $whereArray9);
                
                //get service manager of employees
                $field10 = "*";
                $whereArray10 = array("status" => "active");
                $result10 = $this->db_model->getData($field10, "service_mgr_m_new_tbl", $whereArray10);
                
                //get service manager of employees
                $field11 = "*";
                $whereArray11 = array("status" => "active");
                $result11 = $this->db_model->getData($field11, "store_keeper_m_new_tbl", $whereArray11);
                
//                //get service manager of employees
//                $field12 = "*";
//                $whereArray12 = array("status" => "active");
//                $result12 = $this->db_model->getData($field12, "store_keeper_m_new_tbl", $whereArray12);
                
                if (count($result8) === 0 && count($result9) === 0 && count($result10) === 0 && count($result11) === 0 ) {
                    $data['chart_3'] = "no_data";
                } else {
                    $data['chart_3'] = "yes_data";
                }
                
                $data['front_desk_employee_count'] = count($result8);
                $data['technician_count'] = count($result9);
                $data['service_manager_count'] = count($result10);
                $data['store_keeper_count'] = count($result11);
              
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  4th chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                 //get full paid jobs 
                $field12= "*";
                $whereArray12 = array("payment_status" => "Full Paid");
                $result12 = $this->db_model->getData($field12, "job_estimate_tbl", $whereArray12);

                //get pending payment jobs
                $field13 = "*";
                $whereArray13 = array("payment_status" => "Pending");
                $result13 = $this->db_model->getData($field13, "job_estimate_tbl", $whereArray13);
                
                
                if (count($result12) === 0 && count($result13) === 0 ) {
                    $data['chart_4'] = "no_data";
                } else {
                    $data['chart_4'] = "yes_data";
                }
                
                $data['full_paid_job_count'] = count($result12);
                $data['pending_job_count'] = count($result13);
                   
                
        $this->load->view('psmsbackend/pages/dashboard', $data);
        
        }else {
            $this->load->view('psmsbackend/403_error_page');
        }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function dashboard_fornt_desk() {
        
         if ($this->session->userdata('logged_in')) {
        
        $session_data = $this->session->userdata('logged_in');
        $user_role_id = $session_data['user_role_id'];
        $user_id = $session_data['user_id'];
        
        if ($user_role_id === "6") { //Front Desk Officer

        $data['nav'] = "dashboard";
        
         ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  1st chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get he job count of pending jobs 
                $field1 = "*";
                $whereArray1 = array("current_status" => "Pending");
                $result1 = $this->db_model->getData($field1, "customer_job_tbl", $whereArray1);

                //get he job count of service Manager WIP jobs
                //$field2 = "*";
                //$whereArray2 = array("current_status" => "service Manager WIP");
                //$result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get he job count of Technician WIP jobs
                $field2 = "*";
                $whereArray2 = array("current_status" => "Technician WIP");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get the job count of Sent for estimation approval 
                $field3 = "*";
                $whereArray3 = array("current_status" => "Sent for estimation approval");
                $result3 = $this->db_model->getData($field3, "customer_job_tbl", $whereArray3);
                
                //get the job count of store manager WIP
                $field4 = "*";
                $whereArray4 = array("current_status" => "Store Manager WIP");
                $result4 = $this->db_model->getData($field4, "customer_job_tbl", $whereArray4);
                
                //get the job count of order finished
                $field5 = "*";
                $whereArray5 = array("current_status" => "Order Finished");
                $result5 = $this->db_model->getData($field5, "customer_job_tbl", $whereArray5);



                if (count($result1) === 0 && count($result2) === 0 && count($result3) === 0 && count($result4)=== 0  && count($result5)=== 0) {
                    $data['chart_1'] = "no_data";
                } else {
                    $data['chart_1'] = "yes_data";
                }
                
                $data['pending_job_count'] = count($result1);
                $data['tech_WIP_job_count'] = count($result2);
                $data['estimate_approval_pending_job_count'] = count($result3);
                $data['Store_Manager_WIP_job_count'] = count($result4);
                $data['Order_Finished_job_count'] = count($result5);
                
                      ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  2nd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                //get customer repair jobs 
                $field6 = "*";
                $whereArray6 = array("warranty_type" => "Customer Repair");
                $result6 = $this->db_model->getData($field6, "customer_job_tbl", $whereArray6);

                //get company warranty jobs
                $field7 = "*";
                $whereArray7 = array("warranty_type" => "Company Warranty");
                $result7 = $this->db_model->getData($field7, "customer_job_tbl", $whereArray7);
                
                
                
                if (count($result6) === 0 && count($result7) === 0 ) {
                    $data['chart_2'] = "no_data";
                } else {
                    $data['chart_2'] = "yes_data";
                }
                
                $data['customer_repair_job_count'] = count($result6);
                $data['company_warranty_job_count'] = count($result7);
               
                
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  3rd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                 //get front desk employees 
                $field8= "*";
                $whereArray8 = array("status" => "active");
                $result8 = $this->db_model->getData($field8, "fdo_m_new_tbl", $whereArray8);

                //get technician of employees
                $field9 = "*";
                $whereArray9 = array("status" => "active");
                $result9 = $this->db_model->getData($field9, "technician_m_new_tbl", $whereArray9);
                
                //get service manager of employees
                $field10 = "*";
                $whereArray10 = array("status" => "active");
                $result10 = $this->db_model->getData($field10, "service_mgr_m_new_tbl", $whereArray10);
                
                //get service manager of employees
                $field11 = "*";
                $whereArray11 = array("status" => "active");
                $result11 = $this->db_model->getData($field11, "store_keeper_m_new_tbl", $whereArray11);
                
//                //get service manager of employees
//                $field12 = "*";
//                $whereArray12 = array("status" => "active");
//                $result12 = $this->db_model->getData($field12, "store_keeper_m_new_tbl", $whereArray12);
                
                if (count($result8) === 0 && count($result9) === 0 && count($result10) === 0 && count($result11) === 0 ) {
                    $data['chart_3'] = "no_data";
                } else {
                    $data['chart_3'] = "yes_data";
                }
                
                $data['front_desk_employee_count'] = count($result8);
                $data['technician_count'] = count($result9);
                $data['service_manager_count'] = count($result10);
                $data['store_keeper_count'] = count($result11);
              
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  4th chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                 //get full paid jobs 
                $field12= "*";
                $whereArray12 = array("payment_status" => "Full Paid");
                $result12 = $this->db_model->getData($field12, "job_estimate_tbl", $whereArray12);

                //get pending payment jobs
                $field13 = "*";
                $whereArray13 = array("payment_status" => "Pending");
                $result13 = $this->db_model->getData($field13, "job_estimate_tbl", $whereArray13);
                
                
                if (count($result12) === 0 && count($result13) === 0 ) {
                    $data['chart_4'] = "no_data";
                } else {
                    $data['chart_4'] = "yes_data";
                }
                
                $data['full_paid_job_count'] = count($result12);
                $data['pending_job_count'] = count($result13);
                   
                
        $this->load->view('psmsbackend/front_desk/dashboard_front_desk', $data);
        
        }else {
            $this->load->view('psmsbackend/403_error_page');
        }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }

    }

    public function dashboard_technician() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                
                $page_data = $this->technician_view_data();

                $tech_id = $page_data['tech_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];
                $store_parts_recieved_list = $page_data['store_parts_recieved_list'];
                $store_parts_recieved_count = $page_data['store_parts_recieved_count'];
                $store_my_completed_job_list = $page_data['store_my_completed_job_list'];
                $store_my_completed_job_count = $page_data['store_my_completed_job_count'];

                $data['tech_id'] = $tech_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $data['store_parts_recieved_count'] = $store_parts_recieved_count;
                $data['store_parts_recieved_list'] = $store_parts_recieved_list;

                $data['store_my_completed_job_list'] = $store_my_completed_job_list;
                $data['store_my_completed_job_count'] = $store_my_completed_job_count;
                $data['nav'] = "dashboard";
                
                 ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  1st chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get new jobs count of technician 
                $field1 = "*";
                $whereArray1 = array("technician_status" => "Pending");
                $result1 = $this->db_model->getData($field1, "customer_job_tbl", $whereArray1);

                //get assigned job count of technician
                $field2 = "*";
                $whereArray2 = array("job_status" => "In Progress");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get store parts received job count of technician
                $field3 = "*";
                $whereArray3 = array("store_manager_status" => "Sent to Technician");
                $result3 = $this->db_model->getData($field3, "customer_job_tbl", $whereArray3);
                
                //get technician completed job count 
                $field4 = "*";
                $whereArray4 = array("technician_status" => "Completed");
                $result4 = $this->db_model->getData($field4, "customer_job_tbl", $whereArray4);



                if (count($result1) === 0 && count($result2) === 0 && count($result3) === 0 && count($result4)=== 0) {
                    $data['chart_1'] = "no_data";
                } else {
                    $data['chart_1'] = "yes_data";
                }
                
                $data['new_job_count'] = count($result1);
                $data['assigned_to_me_job_count'] = count($result2);
                $data['store_parts_received_job_count'] = count($result3);
                $data['my_completed_job_count'] = count($result4);
                
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  2nd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                //get customer repair jobs 
                $field5 = "*";
                $whereArray5 = array("warranty_type" => "Customer Repair");
                $result5 = $this->db_model->getData($field5, "customer_job_tbl", $whereArray5);

                //get company warranty jobs
                $field6 = "*";
                $whereArray6 = array("warranty_type" => "Company Warranty");
                $result6 = $this->db_model->getData($field6, "customer_job_tbl", $whereArray6);
                
                //get supplier warranty jobs
                //$field7 = "*";
               // $whereArray7 = array("warranty_type" => "Supplier Warranty");
                //$result7 = $this->db_model->getData($field7, "customer_job_tbl", $whereArray7);
                
                if (count($result5) === 0 && count($result6) === 0 ) {
                    $data['chart_2'] = "no_data";
                } else {
                    $data['chart_2'] = "yes_data";
                }
                
                $data['customer_repair_job_count'] = count($result5);
                $data['company_warranty_job_count'] = count($result6);
                //$data['supplier_warranty_job_count'] = count($result7);
                
                
               $this->load->view('psmsbackend/technician/dashboard_technician', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function dashboard_storemgr() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $data['nav'] = "dashboard";

                //selecting all the active new jobs for store manager status
                $fieldset = array('*');
                $whereArray = array('store_manager_status' => 'New');
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                //selecting all the deactivated jobs
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('job_status' => 'In Progress');
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'customer_job_tbl', $whereArrayDeactive);

                //get the store manager data
                $fieldStoreMgrInfo = "*";
                $whereArrStoreMgrInfo = array("emp_id" => $user_id);
                $resultStoreMgrInfo = $this->db_model->getData($fieldStoreMgrInfo, "store_manager_m_tbl", $whereArrStoreMgrInfo);

                $store_manager_id = $resultStoreMgrInfo[0]->store_manager_id;

                //selecting all assigned to me jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'In Progress', 'store_manager_id' => $store_manager_id);
                $result_assignedTome = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                $data['assigned_to_me_job_count'] = count($result_assignedTome); // assigned to me job count

                $data['new_job_count'] = count($result);

                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  1st chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                //get new jobs
                $field1 = "*";
                $whereArray1 = array("store_manager_status" => "Pending");
                $result1 = $this->db_model->getData($field1, "customer_job_tbl", $whereArray1);
                
                //get sent to technician jobs
                $field2 = "*";
                $whereArray2 = array("store_manager_status" => "Sent to Technician");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);
                
                //get sent to service manager jobs
                $field3 = "*";
                $whereArray3 = array("store_manager_status" => "Sent to Service Manager");
                $result3 = $this->db_model->getData($field3, "customer_job_tbl", $whereArray3);
                
                //get completed jobs
                $field4 = "*";
                $whereArray4 = array("store_manager_status" => "Completed");
                $result4 = $this->db_model->getData($field4, "customer_job_tbl", $whereArray4);
                
                if (count($result1) === 0 && count($result2) === 0 && count($result3) === 0 && count($result4) === 0) {
                    $data['chart_1'] = "no_data";
                } else {
                    $data['chart_1'] = "yes_data";
                }
                
                $data['new_job_count'] = count($result1);
                $data['sent_to_technician_count'] = count($result2);
                $data['sent_to_service_manager_count'] = count($result3);
                $data['completed_job_count'] = count($result4);
                
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  2nd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
                //get fuses of part inventory
                $field5 = "*";
                $whereArray5 = array("category" => "FUSE");
                $result5 = $this->db_model->getData($field5, "parts_inventory_m_tbl", $whereArray5);
                
                //get controls of part inventory
                $field6 = "*";
                $whereArray6 = array("category" => "CONTROL");
                $result6 = $this->db_model->getData($field6, "parts_inventory_m_tbl", $whereArray6);
                
                //get lamps of part inventory
                $field7 = "*";
                $whereArray7 = array("category" => "LAMP");
                $result7 = $this->db_model->getData($field7, "parts_inventory_m_tbl", $whereArray7);
                
                //get lenses of part inventory
                $field8 = "*";
                $whereArray8 = array("category" => "LENS");
                $result8 = $this->db_model->getData($field8, "parts_inventory_m_tbl", $whereArray8);
                
                //get transformer of part inventory
                $field9 = "*";
                $whereArray9 = array("category" => "TRANSFORMER");
                $result9 = $this->db_model->getData($field9, "parts_inventory_m_tbl", $whereArray9);
                
                //get PCBs of part inventory
                $field10 = "*";
                $whereArray10 = array("category" => "PCB");
                $result10 = $this->db_model->getData($field10, "parts_inventory_m_tbl", $whereArray10);
                
                //get DIAPHRAMs of part inventory
                $field11 = "*";
                $whereArray11 = array("category" => "DIAPHRAM");
                $result11 = $this->db_model->getData($field11, "parts_inventory_m_tbl", $whereArray11);
                
                //get CAPASITORS of part inventory
                $field12 = "*";
                $whereArray12 = array("category" => "CAPASITORS");
                $result12 = $this->db_model->getData($field12, "parts_inventory_m_tbl", $whereArray12);
                
                //get ECA CONTROLLER of part inventory
                $field13 = "*";
                $whereArray13 = array("category" => "ECA CONTROLLER");
                $result13 = $this->db_model->getData($field13, "parts_inventory_m_tbl", $whereArray13);
                
                //get RESISTOR of part inventory
                $field14 = "*";
                $whereArray14 = array("category" => "RESISTOR");
                $result14 = $this->db_model->getData($field14, "parts_inventory_m_tbl", $whereArray14);
                
                //get TUNNEL of part inventory
                $field15 = "*";
                $whereArray15 = array("category" => "TUNNEL");
                $result15 = $this->db_model->getData($field15, "parts_inventory_m_tbl", $whereArray15);
                
                //get BALLAST of part inventory
                $field16 = "*";
                $whereArray16 = array("category" => "BALLAST");
                $result16 = $this->db_model->getData($field16, "parts_inventory_m_tbl", $whereArray16);
                
                //get TRANSISTOR of part inventory
                $field17 = "*";
                $whereArray17 = array("category" => "TRANSISTOR");
                $result17 = $this->db_model->getData($field17, "parts_inventory_m_tbl", $whereArray17);
                
                if (count($result5) === 0 && count($result6) === 0 && count($result7) === 0 && count($result8) === 0 && count($result9) === 0 
                        && count($result10) === 0 && count($result11) === 0 && count($result12) === 0 && count($result13) === 0 && count($result14) 
                        === 0 && count($result15) === 0 && count($result16) === 0 && count($result17) === 0) 
                    {
                    $data['chart_2'] = "no_data";
                } else {
                    $data['chart_2'] = "yes_data";
                }
                
                $data['fuse_count'] = count($result5);
                $data['control_count'] = count($result6);
                $data['lamp_count'] = count($result7);
                $data['lens_count'] = count($result8);
                $data['transformer_count'] = count($result9);
                $data['pcb_count'] = count($result10);
                $data['diaphram_count'] = count($result11);
                $data['capasitors_count'] = count($result12);
                $data['eca_controllers_count'] = count($result13);
                $data['resistors_count'] = count($result14);
                $data['tunnels_count'] = count($result15);
                $data['ballast_count'] = count($result16);
                $data['transistor_count'] = count($result17);
                
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  3rd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                
//                //get SP-LP-078 lamps
//                $field18 = "*";
//                $whereArray18 = array("part_no" => "SP-LP-078", "store_qty" => "$store_qty");
//                $result18 = $this->db_model->getData($field18, "parts_inventory_m_tbl", $whereArray18);
                
//                //get SP-LP-083 lamps
//                $field19 = "*";
//                $whereArray19 = array("part_no" => "SP-LP-083", "store_qty" => "$store_qty");
//                $result19 = $this->db_model->getData($field19, "parts_inventory_m_tbl", $whereArray19);
//                
//                //get SP-LP-084 lamps
//                $field20 = "*";
//                $whereArray20 = array("part_no" => "SP-LP-084", "store_qty" => "$store_qty");
//                $result20 = $this->db_model->getData($field20, "parts_inventory_m_tbl", $whereArray20);
//                
//                //get SP-LP-086 lamps
//                $field21 = "*";
//                $whereArray21 = array("part_no" => "SP-LP-086", "store_qty" => "$store_qty");
//                $result21 = $this->db_model->getData($field21, "parts_inventory_m_tbl", $whereArray21);
//                
//                //get SP-LP-087 lamps
//                $field22 = "*";
//                $whereArray22 = array("part_no" => "SP-LP-087", "store_qty" => "$store_qty");
//                $result22 = $this->db_model->getData($field22, "parts_inventory_m_tbl", $whereArray22);
//                
//                //get SP-LP-090 lamps
//                $field23 = "*";
//                $whereArray23 = array("part_no" => "SP-LP-090", "store_qty" => "$store_qty");
//                $result23 = $this->db_model->getData($field23, "parts_inventory_m_tbl", $whereArray23);
//                
//                //get SP-LP-093 lamps
//                $field24 = "*";
//                $whereArray24 = array("part_no" => "SP-LP-093", "store_qty" => "$store_qty");
//                $result24 = $this->db_model->getData($field24, "parts_inventory_m_tbl", $whereArray24);
//                
//                if (count($result18) === 0 && count($result19) === 0 && count($result20) === 0 && count($result21) === 0 
//                        && count($result22) === 0 && count($result23) === 0 && count($result24) === 0) 
//                    {
//                    $data['chart_3'] = "no_data";
//                } else {
//                    $data['chart_3'] = "yes_data";
//                }
//                
//                $data['SP-LP-078_lamps_count'] = count($result18);
//                $data['SP-LP-083_lamps_count'] = count($result19);
//                $data['SP-LP-084_lamps_count'] = count($result20);
//                $data['SP-LP-086_lamps_count'] = count($result21);
//                $data['SP-LP-087_lamps_count'] = count($result22);
//                $data['SP-LP-090_lamps_count'] = count($result23);
//                $data['SP-LP-093_lamps_count'] = count($result24);
                
                $this->load->view('psmsbackend/store_manager/dashboard_store_manager', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function dashboard_service_manager() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                

                $page_data = $this->service_manager_view_data();

                $service_manager_id = $page_data['service_manager_id'];
                $new_estimation_list = $page_data['new_estimation_list'];
                $new_estimation_count = $page_data['new_estimation_count'];
                $pending_estimation_list = $page_data['pending_estimation_list'];
                $pending_estimation_count = $page_data['pending_estimation_count'];
                $approved_estimation_list = $page_data['approved_estimation_list'];
                $approved_estimation_count = $page_data['approved_estimation_count'];
                $rejected_estimation_list = $page_data['rejected_estimation_list'];
                $rejected_estimation_count = $page_data['rejected_estimation_count'];

                $data['service_manager_id'] = $service_manager_id;
                $data['new_estimation_list'] = $new_estimation_list;
                $data['new_estimation_count'] = $new_estimation_count;
                $data['pending_estimation_list'] = $pending_estimation_list;
                $data['pending_estimation_count'] = $pending_estimation_count;
                $data['approved_estimation_list'] = $approved_estimation_list;
                $data['approved_estimation_count'] = $approved_estimation_count;
                $data['rejected_estimation_list'] = $rejected_estimation_list;
                $data['rejected_estimation_count'] = $rejected_estimation_count;
                $data['nav'] = "dashboard";



                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  1st chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get new jobs count
                $field1 = "*";
                $whereArray1 = array("job_status" => "New");
                $result1 = $this->db_model->getData($field1, "customer_job_tbl", $whereArray1);

                //get new in progress count
                $field2 = "*";
                $whereArray2 = array("job_status" => "In Progress");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArray2);


                if (count($result1) === 0 && count($result2) === 0) {
                    $data['chart_1'] = "no_data";
                } else {
                    $data['chart_1'] = "yes_data";
                }

                $data['new_job_count'] = count($result1);
                $data['in_progress__job_count'] = count($result2);



                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  2nd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get technician_wip_count
                $field3 = "*";
                $whereArray3 = array("current_status" => "Technician WIP");
                $result3 = $this->db_model->getData($field3, "customer_job_tbl", $whereArray3);

                //get sent_to_store_count
                $field4 = "*";
                $whereArray4 = array("current_status" => "Sent to Store");
                $result4 = $this->db_model->getData($field4, "customer_job_tbl", $whereArray4);

                //get store_manager_wip_count
                $field5 = "*";
                $whereArray5 = array("current_status" => "Store Manager WIP");
                $result5 = $this->db_model->getData($field5, "customer_job_tbl", $whereArray5);

                //get sent_to_technician_count
                $field6 = "*";
                $whereArray6 = array("current_status" => "Sent to Technician");
                $result6 = $this->db_model->getData($field6, "customer_job_tbl", $whereArray6);

                //get finished_not_collected_count
                $field7 = "*";
                $whereArray7 = array("current_status" => "Completed");
                $result7 = $this->db_model->getData($field7, "customer_job_tbl", $whereArray7);

                //get Order Finished  
                $field8 = "*";
                $whereArray8 = array("current_status" => "Order Finished");
                $result8 = $this->db_model->getData($field8, "customer_job_tbl", $whereArray8);

                if (count($result3) === 0 && count($result4) === 0 && count($result5) === 0 && count($result6) === 0 && count($result7) === 0 && count($result8) === 0) {
                    $data['chart_2'] = "no_data";
                } else {
                    $data['chart_2'] = "yes_data";
                }


                $data['technician_wip_count'] = count($result3);
                $data['sent_to_store_count'] = count($result4);
                $data['store_manager_wip_count'] = count($result5);
                $data['sent_to_technician_count'] = count($result6);
                $data['finished_not_collected_count'] = count($result7);
                $data['order_finished_count'] = count($result8);


                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  3rd chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////
                //get Projector job count
                $field9 = "*";
                $whereArray9 = array("category" => "Projectors");
                $result9 = $this->db_model->getData($field9, "customer_job_tbl", $whereArray9);

                //get Microphones job count
                $field10 = "*";
                $whereArray10 = array("category" => "Microphones");
                $result10 = $this->db_model->getData($field10, "customer_job_tbl", $whereArray10);

                //get Amplifiers job count
                $field11 = "*";
                $whereArray11 = array("category" => "Amplifiers");
                $result11 = $this->db_model->getData($field11, "customer_job_tbl", $whereArray11);

                //get Conference job count
                $field12 = "*";
                $whereArray12 = array("category" => "Conference");
                $result12 = $this->db_model->getData($field12, "customer_job_tbl", $whereArray12);

                if (count($result9) === 0 && count($result10) === 0 && count($result11) === 0 && count($result12) === 0) {
                    $data['chart_3'] = "no_data";
                } else {
                    $data['chart_3'] = "yes_data";
                }


                $data['projectors_count'] = count($result9);
                $data['microphones_count'] = count($result10);
                $data['amplifiers_count'] = count($result11);
                $data['conference_count'] = count($result12);



                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////////////////////////////////
                ///////////  4th chart Data //////////
                //////////////////////////////////////
                //////////////////////////////////////
                //////////////////////////////////////               
                //get the new job estimate count
                $field13 = "*";
                $whereArray13 = array("status" => "New");
                $result13 = $this->db_model->getData($field13, "job_estimate_tbl", $whereArray13);

                //get the pending job estimate count
                $field14 = "*";
                $whereArray14 = array("status" => "Pending");
                $result14 = $this->db_model->getData($field14, "job_estimate_tbl", $whereArray14);

                //get the approved job estimate count
                $field15 = "*";
                $whereArray15 = array("status" => "Approved");
                $result15 = $this->db_model->getData($field15, "job_estimate_tbl", $whereArray15);

                //get the new rejected job estimate count
                $field16 = "*";
                $whereArray16 = array("status" => "Rejected");
                $result16 = $this->db_model->getData($field16, "job_estimate_tbl", $whereArray16);

                if (count($result13) === 0 && count($result14) === 0 && count($result15) === 0 && count($result16) === 0) {
                    $data['chart_4'] = "no_data";
                } else {
                    $data['chart_4'] = "yes_data";
                }

                $data['new_estimate_count'] = count($result13);
                $data['pending_estimate_count'] = count($result14);
                $data['approved_estimate_count'] = count($result15);
                $data['rejected_estimate_count'] = count($result16);




                $this->load->view('psmsbackend/service_manager/dashboard_service_manager', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function dashboard_imports_manager() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "2") { // imports manager
                $data['nav'] = "dashboard";

                $page_data = $this->imports_manager_view_data();

                /*                 * **************************
                 *                          *
                 *                          *
                 *                          *
                 * Imports Manager view data *
                 *                          *
                 *                          *
                 *                          *
                 *                          *
                 * ************************** */

                $data['imports_manager_id'] = $page_data['imports_manager_id'];

                $data['rma_unassigned_list'] = $page_data['rma_unassigned_list'];
                $data['rma_pending_list'] = $page_data['rma_pending_list'];
                $data['rma_approved_list'] = $page_data['rma_approved_list'];
                $data['rma_onhold_list'] = $page_data['rma_onhold_list'];
                $data['rma_rejected_list'] = $page_data['rma_rejected_list'];
                $data['rma_all_list'] = $page_data['rma_all_list'];

                $data['rma_unassigned_count'] = $page_data['rma_unassigned_count'];
                $data['rma_pending_count'] = $page_data['rma_pending_count'];
                $data['rma_approved_count'] = $page_data['rma_approved_count'];
                $data['rma_onhold_count'] = $page_data['rma_onhold_count'];
                $data['rma_rejected_count'] = $page_data['rma_rejected_count'];
                $data['rma_all_count'] = $page_data['rma_all_count'];

                $data['poo_pending_list'] = $page_data['poo_pending_list'];
                $data['poo_approved_list'] = $page_data['poo_approved_list'];
                $data['poo_onhold_list'] = $page_data['poo_onhold_list'];
                $data['poo_rejected_list'] = $page_data['poo_rejected_list'];
                $data['poo_all_list'] = $page_data['poo_all_list'];

                $data['poo_pending_count'] = $page_data['poo_pending_count'];
                $data['poo_approved_count'] = $page_data['poo_approved_count'];
                $data['poo_onhold_count'] = $page_data['poo_onhold_count'];
                $data['poo_rejected_count'] = $page_data['poo_rejected_count'];
                $data['poo_all_count'] = $page_data['poo_all_count'];



                $this->load->view('psmsbackend/imports_manager/dashboard_imports_manager', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function reset_password_page_load() {

        $data['page_msg'] = "";

        $this->load->view('psmsbackend/pages/password_reset_page', $data);
    }

    public function first_time_password_reset() {

        $username = $this->input->post("username", TRUE);
        $new_password = $this->input->post("new_password", TRUE);
        $confirm_password = $this->input->post("confirm_password", TRUE);
        $old_password = $this->input->post("old_password", TRUE);

        $old_password_sha1 = sha1($old_password);

        $confirm_password_sha1 = sha1($confirm_password);

        $dataArra = array(
            'password' => $confirm_password_sha1,
            'login_attempt' => "0"
        );
        $whereArr = array('username' => $username, 'password' => $old_password_sha1);
        $result = $this->db_model->updateData('user_login_m_tbl', $dataArra, $whereArr);

        if ($result) {

            $this->load->view('psmsbackend/pages/login');
        } else {

            $data['page_msg'] = "unsuccess";

            $this->load->view('psmsbackend/pages/first_time_password_reset', $data);
        }
    }

    public function imports_manager_view_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "2") { //service manager      
                //get the service data
                $fieldImportsManagerInfo = "*";
                $whereArrimportsManagerInfo = array("emp_id" => $user_id);
                $resultImportsManagerInfo = $this->db_model->getData($fieldImportsManagerInfo, "imports_m_table", $whereArrimportsManagerInfo);

                $imports_manager_id = $resultImportsManagerInfo[0]->ima_id;

                //*************************
                //*************************
                //*************************
                //get the RMA details                
                //selecting the unassigned rma
                $fieldUnassignedRMA = array('*');
                $whereUnassignedRMA = array('status !=' => 'Rejected', 'imports_manager_id' => 'Unassigned');
                $resultUnassignedRMA = $this->db_model->getData($fieldUnassignedRMA, 'rma_tbl', $whereUnassignedRMA);

                //Selecting pending RMA
                $fieldPendingRMA = array('*');
                $wherePendingRMA = array('status' => 'New', 'imports_manager_id !=' => 'Unassigned');
                $resultPendingRMA = $this->db_model->getData($fieldPendingRMA, 'rma_tbl', $wherePendingRMA);

                //Selecting Approved RMA
                $fieldApprovedRMA = array('*');
                $whereApprovedRMA = array('status' => 'Approved', 'imports_manager_id !=' => 'Unassigned');
                $resultApprovedRMA = $this->db_model->getData($fieldApprovedRMA, 'rma_tbl', $whereApprovedRMA);

                //Selecting Onhold RMA
                $fieldOnholdRMA = array('*');
                $whereOnholdRMA = array('status' => 'Onhold', 'imports_manager_id !=' => 'Unassigned');
                $resultOnholdRMA = $this->db_model->getData($fieldOnholdRMA, 'rma_tbl', $whereOnholdRMA);

                //Selecting Rejected RMA
                $fieldRejectedRMA = array('*');
                $whereRejectedRMA = array('status' => 'Rejected');
                $resultRejectedRMA = $this->db_model->getData($fieldRejectedRMA, 'rma_tbl', $whereRejectedRMA);

                //Selecting all RMA
                $fieldAllRMA = array('*');
                $whereAllRMA = array();
                $resultAllRMA = $this->db_model->getData($fieldAllRMA, 'rma_tbl', $whereAllRMA);



                //*************************
                //*************************
                //*************************
                //get the parts on order dtails
                //Selecting pending parts on Order
                $fieldPendingPOO = array('*');
                $wherePendingPOO = array('approval_status' => 'Pending');
                $resultPendingPOO = $this->db_model->getData($fieldPendingPOO, 'parts_on_order_tbl', $wherePendingPOO);

                //Selecting Approved parts on Order
                $fieldApprovedPOO = array('*');
                $whereApprovedPOO = array('approval_status' => 'Approved');
                $resultApprovedPOO = $this->db_model->getData($fieldApprovedPOO, 'parts_on_order_tbl', $whereApprovedPOO);

                //Selecting Onhold parts on Order
                $fieldOnholdPOO = array('*');
                $whereOnholdPOO = array('approval_status' => 'Onhold');
                $resultOnholdPOO = $this->db_model->getData($fieldOnholdPOO, 'parts_on_order_tbl', $whereOnholdPOO);

                //Selecting Rejected parts on Order
                $fieldRejectedPOO = array('*');
                $whereRejectedPOO = array('approval_status' => 'Rejected');
                $resultRejectedPOO = $this->db_model->getData($fieldRejectedPOO, 'parts_on_order_tbl', $whereRejectedPOO);

                //Selecting all parts on Order
                $fieldAllPOO = array('*');
                $whereAllPOO = array();
                $resultAllPOO = $this->db_model->getData($fieldAllPOO, 'parts_on_order_tbl', $whereAllPOO);







                //to be continue...

                /*
                 * Assiciate array for sending data to imports manager view
                 */

                $data['imports_manager_id'] = $imports_manager_id;

                //***** RMA Data Set *****                
                $data['rma_unassigned_list'] = $resultUnassignedRMA;
                $data['rma_pending_list'] = $resultPendingRMA;
                $data['rma_approved_list'] = $resultApprovedRMA;
                $data['rma_onhold_list'] = $resultOnholdRMA;
                $data['rma_rejected_list'] = $resultRejectedRMA;
                $data['rma_all_list'] = $resultAllRMA;

                $data['rma_unassigned_count'] = count($resultUnassignedRMA);
                $data['rma_pending_count'] = count($resultPendingRMA);
                $data['rma_approved_count'] = count($resultApprovedRMA);
                $data['rma_onhold_count'] = count($resultOnholdRMA);
                $data['rma_rejected_count'] = count($resultRejectedRMA);
                $data['rma_all_count'] = count($resultAllRMA);


                //*****  Parts on Order Data Set *****
                $data['poo_pending_list'] = $resultPendingPOO;
                $data['poo_approved_list'] = $resultApprovedPOO;
                $data['poo_onhold_list'] = $resultOnholdPOO;
                $data['poo_rejected_list'] = $resultRejectedPOO;
                $data['poo_all_list'] = $resultAllPOO;

                $data['poo_pending_count'] = count($resultPendingPOO);
                $data['poo_approved_count'] = count($resultApprovedPOO);
                $data['poo_onhold_count'] = count($resultOnholdPOO);
                $data['poo_rejected_count'] = count($resultRejectedPOO);
                $data['poo_all_count'] = count($resultAllPOO);

                return $data;
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    /*
     * Common operations for technician view
     * navigation jobs count
     * navigation logged user data
     */

     public function technician_view_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician      
                //get the technician data
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultTechInfo = $this->db_model->getData($fieldTechInfo, "technician_m_tbl", $whereArrTechInfo);

                $tech_id = $resultTechInfo[0]->tech_id;

                //selecting all new jobs
                $fieldsetAllJobs = array('*');
                $whereArrayAllJobs = array('job_status' => 'New');
                $resultAllJobs = $this->db_model->getData($fieldsetAllJobs, 'customer_job_tbl', $whereArrayAllJobs);

                //selecting all assigned to me jobs
                $fieldsetAssignedToMeJobs = array('*');
                $whereArrayAssignedToMeJobs = array('job_status' => 'In Progress', 'technician_id' => $tech_id);
                $result_assignedTomeJobs = $this->db_model->getData($fieldsetAssignedToMeJobs, 'customer_job_tbl', $whereArrayAssignedToMeJobs);


                //selecting all store parts received jobs
                $fieldsetStorePartsRecieved = array('*');
                $whereArrayStorePartsRecieved = array('job_status' => 'In Progress', 'technician_id' => $tech_id, 'current_status' => "Sent to Technician");
                $result_StorePartsRecieved = $this->db_model->getData($fieldsetStorePartsRecieved, 'customer_job_tbl', $whereArrayStorePartsRecieved);

                //my_completed job list
                $fieldsetMyCompletedJobs = array('*');
                $whereArrayMyCompletedJobs = array('technician_id' => $tech_id, 'technician_status' => "Completed");
                $result_MyCompletedJobs = $this->db_model->getData($fieldsetMyCompletedJobs, 'customer_job_tbl', $whereArrayMyCompletedJobs);



                //to be continue...

                /*
                 * Assiciate array for sending data to view
                 */

                $data['tech_id'] = $resultTechInfo[0]->tech_id; // technician id for operations
                $data['new_job_list'] = $resultAllJobs; // all new job list
                $data['new_job_count'] = count($resultAllJobs); // all new job count
                $data['assigned_to_me_job_list'] = $result_assignedTomeJobs; // assigned to me job list
                $data['assigned_to_me_job_count'] = count($result_assignedTomeJobs); // assigned to me job count
                $data['store_parts_recieved_list'] = $result_StorePartsRecieved; // assigned to me job list
                $data['store_parts_recieved_count'] = count($result_StorePartsRecieved); // store parts recieved to me job count

                $data['store_my_completed_job_list'] = $result_MyCompletedJobs; // My Completed Job list
                $data['store_my_completed_job_count'] = count($result_MyCompletedJobs); // My Completed Job count

                return $data;
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    /*
     * Common operations for service manager view
     * navigation jobs count
     * navigation logged user data
     */

    public function service_manager_view_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { //service manager      
                //get the service data
               //get the store manager data
                $fieldServiceMgrInfo = "*";
                $whereArrServiceMgrInfo = array("emp_id" => $user_id);
                $resultServiceMgrInfo = $this->db_model->getData($fieldServiceMgrInfo, "service_manager_m_tbl", $whereArrServiceMgrInfo);
                
                $service_manager_id = $resultServiceMgrInfo[0]->mgr_id;                
                
                //selecting all new estimations
                $fieldsetAllNewEstimations = array('*');
                $whereArrayAllNewEstimations = array('status' => 'New');
                $resultAllNewEstimations = $this->db_model->getData($fieldsetAllNewEstimations, 'job_estimate_tbl', $whereArrayAllNewEstimations);
                
                //selecting all pending estimations
                $fieldsetAllPendingEstimations = array('*');
                $whereArrayAllPendingEstimations = array('status' => 'Pending');
                $resultAllPendingEstimations = $this->db_model->getData($fieldsetAllPendingEstimations, 'job_estimate_tbl', $whereArrayAllPendingEstimations);
               
                //selecting all approved estimations
                $fieldsetAllApprovedEstimations = array('*');
                $whereArrayAllApprovedEstimations = array('status' => 'Approved');
                $resultAllApprovedEstimations = $this->db_model->getData($fieldsetAllApprovedEstimations, 'job_estimate_tbl', $whereArrayAllApprovedEstimations);
               
                //selecting all rejected estimations
                $fieldsetAllRejectedEstimations = array('*');
                $whereArrayAllRejectedEstimations = array('status' => 'Rejected');
                $resultAllRejectedEstimations = $this->db_model->getData($fieldsetAllRejectedEstimations, 'job_estimate_tbl', $whereArrayAllRejectedEstimations);
               
//                //selecting all new RMA
//                $fieldsetAllNewRMA = array('*');
//                $whereArrayAllNewRMA = array('status' => 'Pending');
//                $resultAllNewRMA = $this->db_model->getData($fieldsetAllNewEstimations, 'rma_tbl', $whereArrayAllNewEstimations);
//                
//               


                //to be continue...

                /*
                 * Assiciate array for sending data to view
                 */

                $data['service_manager_id'] = $service_manager_id; // Service manager Id
                $data['new_estimation_list'] = $resultAllNewEstimations; // new estimation list
                $data['new_estimation_count'] = count($resultAllNewEstimations); // new estimation count
                $data['pending_estimation_list'] = $resultAllPendingEstimations; // pending estimation list
                $data['pending_estimation_count'] = count($resultAllPendingEstimations); // pending estimation count
                $data['approved_estimation_list'] = $resultAllApprovedEstimations; // approved estimation list
                $data['approved_estimation_count'] = count($resultAllApprovedEstimations); // approved estimation count
                $data['rejected_estimation_list'] = $resultAllRejectedEstimations; // rejected estimation list
                $data['rejected_estimation_count'] = count($resultAllRejectedEstimations); // rejected estimation count
                
                //to be continue...
                
                return $data;
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function logout() {

        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login_c/index');
    }

}
