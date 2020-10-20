<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Technician_c_view extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function dashboard_technician() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "4") { //technician
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function job_new_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

//            var_dump($user_id);die;
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

                $data['page_msg'] = "";

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/technician/jobs/job_card_list_new', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //new job unassigned
    public function new_job_detail_view($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

//            var_dump($user_id);die;
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

                $data['page_msg'] = "";


//                //get the job_repair details from the job_reapir_inof_tbl 
//                $fieldJobRepairInfo = "*";
//                $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
//                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);
                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $data['job_repair_info'] = $resultJobInfo;








                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/technician/jobs/new_job_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function assign_job_to_me() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $date = date("Y-m-d");

            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                $job_id = $this->input->get('var1'); // job id
                $tech_id = $this->input->get('var2'); // tech id


                $dataFieldsUpdate = array("technician_id" => $tech_id, "job_status" => "In Progress", "technician_status" => "Technician WIP", "current_status" => "Technician WIP");
                $whereArrUpdate = array("job_id" => $job_id);

                $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);

                if (count($resultUpdate) === 0) {

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

                    $data['page_msg'] = "unsucces";

                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id);
                    $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                    $data['job_repair_info'] = $resultJobInfo;



                    $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
//                    $this->load->view('psmsbackend/technician/jobs/job_card_list_new', $data);


                    $this->load->view('psmsbackend/technician/jobs/new_job_detail_view_page', $data);
                } else {

                    $msg = "ok"; // for successfully added 
                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id);
                    $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                    $job_history_details = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobInfo[0]->customer_id,
                        'job_date' => $resultJobInfo[0]->job_date,
                        'status' => "Technician WIP",
                        'final_status' => "In Progress",
                        'status_change_date' => $date
                    );

//                    $dataFieldsUpdate = array(
//                        'status' => "Technician WIP",
//                        'final_status' => "Working Progress",
//                        'status_change_date' => $date);
//                    $whereArrUpdate = array('job_id' => $job_id);
//                    $result_customer_job_history_info = $this->db_model->updatedata("customer_job_history_tbl", $dataFieldsUpdate, $whereArrUpdate);

                    $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                    $this->load_technician_job_form_page_method($job_id, $msg);
//                    redirect("technician_c_view/load_technician_job_form_page/" . $job_id . "");
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_technician_job_form_page_method($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
//                $job_id = $this->input->get('var1'); // job id
                $msg1 = $this->input->get('var2'); // msg

                /** get all the navigation data + other common data * */
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

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);
                
               
                $data['job_info'] = $resultJobInfo;

                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = array("store_status" => "Available");
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);
                
                //get the job_repair details from the job_reapir_inof_tbl 
                $fieldJobRepairInfo = "*";
                $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                
                $data['parts_info'] = $resultPartsInfo;

                $data['page_msg'] = 'success';

                $data['repiar_info'] = $resultJobRepairInfo;
                
                // echo $job_id;
                $data['nav'] = "jobs";

                $this->load->view('psmsbackend/technician/jobs/technician_job_card_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_technician_job_form_page_method_update($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultTechInfo = $this->db_model->getData($fieldTechInfo, "technician_m_tbl", $whereArrTechInfo);

                $tech_id = $resultTechInfo[0]->tech_id;


                //get the job_repair details from the job_reapir_inof_tbl 
                $fieldJobRepairInfo = "*";
                $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                $fieldJobPartsInfo = "*";
                $whereArrJobPartsInfo = array();
                $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                $data['parts_inventory'] = $resultJobPartsInfo;

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



                $data['nav'] = "jobs";



                $data['job_repair_info'] = $resultJobRepairInfo;

                $this->load->view('psmsbackend/technician/jobs/technician_load_assigned_jobs_update_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function technician_job_card_form_update() { //2019-12-30 ###1

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

                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);

                $actual_defect = $this->input->post("actual_defect", TRUE);
                $solution = $this->input->post("solution", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $remarks = $this->input->post("remarks", TRUE);

                //delete old job repair info related to job_id and tech id and save the new updated info
                $whereArray = array("tech_id" => $tech_id, "job_id" => $job_id);
                $result = $this->db_model->deleteData("job_repair_info_tbl", $whereArray);

                if ($result) {

                    for ($i = 0; $i < count($actual_defect); $i++) {

                        $job_repair_info_data[] = array(
                            'job_id' => $job_id,
                            'tech_id' => $tech_id,
                            'created_date' => $job_assigned_date,
                            'assigned_date' => $job_assigned_date,
                            'customer_id' => $customer_id,
                            'warranty_type' => $warranty_type,
                            'category' => $category,
                            'make' => $make,
                            'model' => $model,
                            'serial_no' => $serial_no,
                            'problem_description' => $problem_description,
                            "actual_defect" => $actual_defect[$i],
                            "solution" => $solution[$i],
                            "part_ref_code" => $part_ref_code[$i],
                            "part_no" => $part_no[$i],
                            "part_description" => $part_description[$i],
                            "qty" => $qty[$i],
                            "remarks" => $remarks[$i],
                            'out_of_stock_status' => "0",
                            'pending_status' => "0",
                            'order_type' => "0"
                        );
                    }/// end of the for loop


                    $result_job_repair_info = $this->db->insert_batch('job_repair_info_tbl', $job_repair_info_data);

                    if ($result_job_repair_info) {

                        redirect("technician_c_view/job_card_list_assigned_to_me_page?var1='" . $job_id . "'&var2=updated");
                    } else {

                        echo "Deleted but not insert";
                    }
                } else {

                    echo "Not deleted and not insert";
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_technician_job_form_page($job_id) { //old method 
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                //selecting all the active jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'New');
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                //get the technician data
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultTechInfo = $this->db_model->getData($fieldTechInfo, "technician_m_tbl", $whereArrTechInfo);

                $tech_id = $resultTechInfo[0]->tech_id;

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);


                //selecting all the assigned to jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'In Progress', 'technician_id' => $tech_id);
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                $data['assigned_to_me_job_count'] = count($result); // assigned to me job count

                $data['active_jobs'] = $result; //contains active jobs (associative array)
                $data['new_job_count'] = count($result); // new job count
                $data['tech_id'] = $resultTechInfo[0]->tech_id;
                $data['job_info'] = $resultJobInfo;

                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = "";
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                $data['parts_info'] = $resultPartsInfo;


                // echo $job_id;
                $data['nav'] = "jobs";

                $this->load->view('psmsbackend/technician/jobs/technician_job_card_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function technician_job_card_form_save() {

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

                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);

                $actual_defect = $this->input->post("actual_defect", TRUE);
                $solution = $this->input->post("solution", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $remarks = $this->input->post("remarks", TRUE);

                // var_dump($actual_defect[1]);die;
                $job_assigned_date_new = date('Y-m-d');


                for ($i = 0; $i < count($actual_defect); $i++) {



                    $job_repair_info_data[] = array(
                        'job_id' => $job_id,
                        'tech_id' => $tech_id,
                        'store_manager_id' => "STMGR000",
                        'service_manager_id' => "SERMGR000",
                        'imports_manager_id' => "IMPMGR000",
                        'created_date' => $job_created_date,
                        'assigned_date' => $job_assigned_date_new,
                        'customer_id' => $customer_id,
                        'warranty_type' => $warranty_type,
                        'category' => $category,
                        'make' => $make,
                        'model' => $model,
                        'serial_no' => $serial_no,
                        'problem_description' => $problem_description,
                        "actual_defect" => $actual_defect[$i],
                        "solution" => $solution[$i],
                        "part_ref_code" => $part_ref_code[$i],
                        "part_no" => $part_no[$i],
                        "part_description" => $part_description[$i],
                        "qty" => $qty[$i],
                        "remarks" => $remarks[$i],
                        'out_of_stock_status' => "0",
                        'pending_status' => "0",
                        'order_type' => "0",
                        'requesting_qty' => "0"
                    );
                }/// end of the for loop


                $result_job_repair_info = $this->db->insert_batch('job_repair_info_tbl', $job_repair_info_data);

                if ($result_job_repair_info) {

                    redirect("technician_c_view/technician_job_card_form_after_save_page/" . $job_id . "");
                } else {
                    
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function get_part_details($part_ref_code) {

        //get the Parts infomation
        $fieldPartsInfo = "*";
        $whereArrPartsInfo = array('part_ref_code' => $part_ref_code);
        $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

        $part_ref_code = $resultPartsInfo[0]->part_ref_code;
        $part_no = $resultPartsInfo[0]->part_no;
        $description = $resultPartsInfo[0]->description;

        $var = array("part_ref_code" => $part_ref_code, "part_no" => $part_no, "description" => $description);
        echo json_encode($var);
    }

    public function technician_job_card_form_after_save_page($job_id) {

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

                //selecting all the assigned to me jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'In Progress', 'technician_id' => $tech_id);
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                $data['assigned_to_me_job_count'] = count($result); // assigned to me job count
                //
                //get the job_repair details from the job_reapir_inof_tbl 
                $fieldJobRepairInfo = "*";
                $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                $fieldJobPartsInfo = "*";
                $whereArrJobPartsInfo = array();
                $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                $data['parts_inventory'] = $resultJobPartsInfo;

//                var_dump($resultJobPartsInfo);die;
                //selecting all the active jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'New');
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                $data['new_job_count'] = count($result); // new job count
                $data['nav'] = "jobs";
                $data['job_repair_info'] = $resultJobRepairInfo;

//                var_dump($resultJobRepairInfo);die;

                $this->load->view('psmsbackend/technician/jobs/technician_job_card_form_after_save', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //edit update page
    public function technician_job_card_form_save_changes() {

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

                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);

                $actual_defect = $this->input->post("actual_defect", TRUE);
                $solution = $this->input->post("solution", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $remarks = $this->input->post("remarks", TRUE);

                //delete old job repair info related to job_id and tech id and save the new updated info
                $whereArray = array("tech_id" => $tech_id, "job_id" => $job_id);
                $result = $this->db_model->deleteData("job_repair_info_tbl", $whereArray);

                if ($result) {

                    for ($i = 0; $i < count($actual_defect); $i++) {

                        $job_repair_info_data[] = array(
                            'job_id' => $job_id,
                            'tech_id' => $tech_id,
                            'store_manager_id' => "STMGR000",
                            'service_manager_id' => "SERMGR000",
                            'imports_manager_id' => "IMPMGR000",
                            'created_date' => $job_assigned_date,
                            'assigned_date' => $job_assigned_date,
                            'customer_id' => $customer_id,
                            'warranty_type' => $warranty_type,
                            'category' => $category,
                            'make' => $make,
                            'model' => $model,
                            'serial_no' => $serial_no,
                            'problem_description' => $problem_description,
                            "actual_defect" => $actual_defect[$i],
                            "solution" => $solution[$i],
                            "part_ref_code" => $part_ref_code[$i],
                            "part_no" => $part_no[$i],
                            "part_description" => $part_description[$i],
                            "qty" => $qty[$i],
                            "remarks" => $remarks[$i],
                            'out_of_stock_status' => "0",
                            'pending_status' => "0",
                            'order_type' => "0",
                            'requesting_qty' => "0"
                        );
                    }/// end of the for loop


                    $result_job_repair_info = $this->db->insert_batch('job_repair_info_tbl', $job_repair_info_data);

                    if ($result_job_repair_info) {

                        redirect("technician_c_view/technician_job_card_form_after_save_page/" . $job_id . "");
                    } else {

                        echo "Deleted but not insert";
                    }
                } else {

                    echo "Not deleted and not insert";
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function technician_job_card_form_delete() {


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

                $job_id = $this->input->get('var1'); //job id
                //delete old job repair info related to job_id and tech id and save the new updated info
                $whereArray = array("tech_id" => $tech_id, "job_id" => $job_id);
                $result = $this->db_model->deleteData("job_repair_info_tbl", $whereArray);

                if ($result) {

//                    redirect("technician_c_view/load_technician_job_form_page/" . $job_id . "");
                    
                    redirect("technician_c_view/job_card_list_assigned_to_me_page");
                } else {

                    echo "Unable to delete the job repair info";
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function send_to_store_manager() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                $job_id = $this->input->get('var1'); //job id
                //get the technician data
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultTechInfo = $this->db_model->getData($fieldTechInfo, "technician_m_tbl", $whereArrTechInfo);

                $tech_id = $resultTechInfo[0]->tech_id;

                $dataFieldsUpdate = array("job_status" => "In Progress", "technician_status" => "Sent to Store", "store_manager_status" => "New", "current_status" => "Sent to Store");
                $whereArrUpdate = array("job_id" => $job_id);

                $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);

                //job history table update unit
                $whereArrJobCusInfo = array('job_id' => $job_id);
                $resultJobCusInfo = $this->db_model->getData("*", "customer_job_tbl", $whereArrJobCusInfo);

                $date = date('Y-m-d');

                $dataArrayJobHistory = array(
                    'job_id' => $job_id,
                    'customer_id' => $resultJobCusInfo[0]->customer_id,
                    'job_date' => $resultJobCusInfo[0]->job_date,
                    'status' => 'Sent to Store', // internal use only
                    'final_status' => 'In Progress', // customer visible
                    'status_change_date' => $date
                );

                $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);

                if ($resultUpdate) {


                    redirect("technician_c_view/job_card_list_assigned_to_me_page?var1='" . $job_id . "'&var2=success");
                } else {

                    echo " Unable to send to store manager";
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //after store manager sent the parts to technician (All parts available.) technician wip
    public function technician_wip() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician
                $job_id = $this->input->get('var1'); //job id
                $tech_id = $this->input->get('var2'); //tech_id

                $page_data = $this->technician_view_data();

//                $tech_id = $page_data['tech_id'];
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
                $data['job_id'] = $job_id;


                $dataFieldsUpdate = array("technician_id" => $tech_id, "job_status" => "In Progress", "technician_status" => "Technician WIP", "current_status" => "Technician WIP");
                $whereArrUpdate = array("job_id" => $job_id);

                $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $date = date("Y-m-d");

                $job_history_details = array(
                    'job_id' => $job_id,
                    'customer_id' => $resultJobInfo[0]->customer_id,
                    'job_date' => $resultJobInfo[0]->job_date,
                    'status' => "Technician WIP",
                    'final_status' => "In Progress",
                    'status_change_date' => $date
                );


                $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                if ($resultUpdate && $result_customer_job_history_info) {

                    $data['page_msg'] = "success";


                    //get the job_repair details from the job_reapir_inof_tbl 
                    $fieldJobRepairInfo = "*";
                    $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
                    $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                    $fieldJobPartsInfo = "*";
                    $whereArrJobPartsInfo = array();
                    $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                    $data['parts_inventory'] = $resultJobPartsInfo;

                    $data['nav'] = "jobs";
                    $data['job_repair_info'] = $resultJobRepairInfo;

                    $this->load->view('psmsbackend/technician/jobs/technician_job_complete_update_form', $data);
                } else {
                    $data['page_msg'] = "unsuccess";
                    $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                    $this->load->view('psmsbackend/technician/jobs/job_card_list_store_parts_recieved_page', $data);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //after parts recieved from stores and status changed to technician WIP : technician change the job status to complete.  (Job is almost complete and cusomer to collete)
    public function complete_job_form_submit($job_id) {

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

                $data['job_id'] = $job_id;
                $data['nav'] = "jobs";


                $dataFieldsUpdate = array("technician_id" => $tech_id, "job_status" => "Finished not collected", "technician_status" => "Completed", "store_manager_status" => "Completed", "current_status" => "Completed");
                $whereArrUpdate = array("job_id" => $job_id);

                $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $date = date("Y-m-d");

                $job_history_details = array(
                    'job_id' => $job_id,
                    'customer_id' => $resultJobInfo[0]->customer_id,
                    'job_date' => $resultJobInfo[0]->job_date,
                    'status' => "Completed",
                    'final_status' => "Finished not collected",
                    'status_change_date' => $date
                );


                $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);


                if ($resultUpdate && $result_customer_job_history_info) {

                    $data['page_msg'] = "success";


                    $this->load->view('psmsbackend/technician/jobs/job_completed_alert_page', $data);
                } else {

                    //get the job_repair details from the job_reapir_inof_tbl 
                    $fieldJobRepairInfo = "*";
                    $whereArrJobRepairInfo = array("tech_id" => $tech_id, "job_id" => $job_id);
                    $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);


                    $fieldJobPartsInfo = "*";
                    $whereArrJobPartsInfo = array();
                    $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                    $data['parts_inventory'] = $resultJobPartsInfo;
                    $data['job_repair_info'] = $resultJobRepairInfo;


                    $data['page_msg'] = "complete_unsuccess";
                    $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                    $this->load->view('psmsbackend/technician/jobs/technician_job_complete_update_form', $data);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function job_card_list_assigned_to_me_page() {

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



                $job_id = $this->input->get('var1'); //job id
                $result_msg = $this->input->get('var2'); //successmsg
                //selecting all the active jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'New');
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

                //selecting all assigned to me jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'In Progress', 'technician_id' => $tech_id);
                $result_assignedTome = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);
                
                //selecting job_repair_ino
                $fieldset2 = "*";
                $whereArray2 = "";
                $result_repair_info = $this->db_model->getData($fieldset2, 'job_repair_info_tbl', $whereArray2);
                
                $data['repair_info'] = $result_repair_info;
                $data['assigned_to_me_jobs'] = $result_assignedTome; //contains assigned to me jobs

                $data['assigned_to_me_job_count'] = count($result_assignedTome); // assigned to me job count
                $data['new_job_count'] = count($result); // new job count
                // var_dump($result_msg);die;                           
                if ($result_msg == "success") {
                    $data['page_msg'] = "sent_to_store_manager";
                } else if ($result_msg === "updated") {
                    $data['page_msg'] = "updated";
                } else {
                    $data['page_msg'] = "";
                }


                $data['job_id'] = $job_id;

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/technician/jobs/job_card_list_assigned_to_me', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    
    public function job_assigned_to_me_detail_view($job_id) {

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
                
                
                $fieldJobRepairInfo = "*";
                $whereArrJobRepairInfo = array("job_id" => $job_id);
                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $fieldJobPartsInfo = "*";
                $whereArrJobPartsInfo = array();
                $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                $field = "*";
                $whereArr = array("job_id" => $job_id);
                $result = $this->db_model->getData($field, "job_estimate_tbl", $whereArr);

                $estimation_job_count = count($result);

                $data['estimation_job_count'] = $estimation_job_count;
                $data['estimation_info'] = $result;
                $data['parts_inventory'] = $resultJobPartsInfo;
                $data['job_info'] = $resultJobInfo;
                $data['nav'] = "jobs";
                $data['job_repair_info'] = $resultJobRepairInfo;
                
                
                
                $this->load->view('psmsbackend/technician/jobs/job_assigned_to_me_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }










        //get the job_repair details from the job_reapir_inof_tbl 
    }

    public function job_card_list_store_parts_recieved_page() {

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

                $data['page_msg'] = "none";


                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/technician/jobs/job_card_list_store_parts_recieved_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function my_completed_job_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

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


                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/technician/jobs/my_completed_job_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function view_my_completed_job() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "4") { //technician
                $job_id = $this->input->get('var1'); //job_id

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




                //get the job_repair details from the job_reapir_inof_tbl 
                $fieldJobRepairInfo = "*";
                $whereArrJobRepairInfo = array("job_id" => $job_id);
                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);

                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $fieldJobPartsInfo = "*";
                $whereArrJobPartsInfo = array();
                $resultJobPartsInfo = $this->db_model->getData($fieldJobPartsInfo, "parts_inventory_m_tbl", $whereArrJobPartsInfo);

                $data['parts_inventory'] = $resultJobPartsInfo;
                $data['job_info'] = $resultJobInfo;
                $data['nav'] = "jobs";
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['page_msg'] = "";

                $this->load->view('psmsbackend/technician/jobs/my_completed_job_detail_view', $data);
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

}
