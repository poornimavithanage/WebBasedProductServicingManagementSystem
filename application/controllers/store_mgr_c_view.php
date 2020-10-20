<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Store_mgr_c_view extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function dashboard_storemgr() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "5") { // store manager
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

//            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $data['page_msg'] = "";

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/store_manager/jobs/job_card_list_new', $data);
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

            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->get('var1'); // job id
                $store_mgr_id = $this->input->get('var2'); // store mgr id


                $dataFieldsUpdate1 = array("store_manager_id" => $store_mgr_id, "job_status" => "In Progress", "store_manager_status" => "Store Manager WIP", "current_status" => "Store Manager WIP");
                $whereArrUpdate1 = array("job_id" => $job_id);

                $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                if ($resultUpdate1) {

                    $dataFieldsUpdate = array('store_manager_id' => $store_mgr_id);
                    $whereArrUpdate = array('job_id' => $job_id);
                    $resultUpdate = $this->db_model->updatedata("job_repair_info_tbl", $dataFieldsUpdate, $whereArrUpdate);

                    //job history table update unit
                    $whereArrJobCusInfo = array('job_id' => $job_id);
                    $resultJobCusInfo = $this->db_model->getData("*", "customer_job_tbl", $whereArrJobCusInfo);

                    $date = date('Y-m-d');

                    $dataArrayJobHistory = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobCusInfo[0]->customer_id,
                        'job_date' => $resultJobCusInfo[0]->job_date,
                        'status' => 'Store Manager WIP', // internal use only
                        'final_status' => 'In Progress', // customer visible
                        'status_change_date' => $date
                    );

                    $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);

                    redirect("store_mgr_c_view/load_store_manager_job_form_page/" . $job_id . "");
                } else {

                    $data['page_msg'] = "unsucces";
                    $data['nav'] = "jobs";
                    $this->load->view('psmsbackend/technician/jobs/job_card_list_new', $data);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function load_store_mgr_job_form_page_method($job_id) { //update
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                //get the supplier purchase details for RMA process and Parts on Oder
                $fieldSupplierPurchaseInfo = "*";
                $whereArrSupplierPurchaseInfo = array("sales_order_no" => $resultJobInfo[0]->sales_order_no);
                $resultSupplierPurchaseInfo = $this->db_model->getData($fieldSupplierPurchaseInfo, "supplier_purchase_m_tbl", $whereArrSupplierPurchaseInfo);

                //get the supplier details for RMA process and Parts on Oder
                $fieldSupplierInfo = "*";
                $whereArrSupplierInfo = array("supp_id" => $resultSupplierPurchaseInfo[0]->supp_id);
                $resultSupplierInfo = $this->db_model->getData($fieldSupplierInfo, "supp_details_m_tbl", $whereArrSupplierInfo);



                $fields1 = '*';
                $wherefieldtablefrom1 = array("job_repair_info_tbl.job_id" => $job_id);
                $tablefrom1 = 'job_repair_info_tbl';
                $tablejoin1 = 'parts_inventory_m_tbl';
                $tablejoincondition1 = 'job_repair_info_tbl.part_ref_code = parts_inventory_m_tbl.part_ref_code';
                $resultJobRepairInfo = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = array("store_status" => "Available");
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                $data['job_info'] = $resultJobInfo;
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['parts_info'] = $resultPartsInfo;
                $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                $data['supplier_info'] = $resultSupplierInfo;





                $data['nav'] = "jobs";

                $this->load->view('psmsbackend/store_manager/jobs/store_manager_job_card_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //******************************* New Method for Store Manager,  Not Available and Availabe status *******************************\\

    public function onholdForm() { ###2
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];


                $onhold_note = $this->input->post('onhold_note');
                $onhold_note_2 = $this->input->post('onhold_note_2');
                $customer_id = $this->input->post('customer_id');
                $job_id = $this->input->post('job_id');

                $field_cus_details = "*";
                $whereArr_cus_details = array("customer_id" => $customer_id);
                $result_cus_details = $this->db_model->getData($field_cus_details, "customer_m_tbl", $whereArr_cus_details);


                if ($onhold_note === "Other") {

                    $onhold_note = $onhold_note_2;
                }


                $connected = @fsockopen("www.google.lk", 80);
                //website, port  (try 80 or 443)
                if ($connected) {

                    $sms_message = "- Welcome to STAV - <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Your job no " . $job_id . " is on hold due to the " . $onhold_note . ". <br/><br/>Please contact us for further clarifications. <br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";

                    $user = "94776790257";
                    $password = "2626";
                    $text = urlencode($sms_message);
                    $to = $result_cus_details[0]->contact_no;


                    $baseurl = "http://www.textit.biz/sendmsg";
                    $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
                    $ret = file($url);

                    $res = explode(":", $ret[0]);

                    $dataFieldsUpdate1 = array("current_status" => "On Hold");
                    $whereArrUpdate1 = array("job_id" => $job_id);
                    $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table
                    
                    //job history table update unit
                    $whereArrJobCusInfo = array('job_id' => $job_id);
                    $resultJobCusInfo = $this->db_model->getData("*", "customer_job_tbl", $whereArrJobCusInfo);

                    $date = date('Y-m-d');

                    $dataArrayJobHistory = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobCusInfo[0]->customer_id,
                        'job_date' => $resultJobCusInfo[0]->job_date,
                        'status' => 'Store Manager WIP', // internal use only
                        'final_status' => 'On Hold', // customer visible
                        'status_change_date' => $date
                    );

                    $result1 = $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);
                    
                    
                } else {
                    $record = array('final_result' => 'unsuccess');
                    echo json_encode($record);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    //******************************* New Method for Store Manager, Company Repair All Available *******************************\\

    public function company_repair_form_submit() { //update
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);
                $onhold_note = $this->input->post("onhold_note", TRUE);
                $onhold_note_2 = $this->input->post("onhold_note_2", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $availability = $this->input->post("availability", TRUE);
                $rma_applicability = $this->input->post("rma_applicability", TRUE);
                $order_type = $this->input->post("order_type", TRUE);


                for ($i = 0; $i < count($part_ref_code); $i++) {

                    if ($availability[$i] === "Available") {

                        $parts_inventory_where_array[] = array(
                            'part_ref_code' => $part_ref_code[$i]
                        );

                        $fieldJobInfor = "*";
                        $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));


                        $parts_inventory_qty_update_array[] = array(
                            'part_ref_code' => $part_ref_code[$i],
                            'part_no' => $part_no[$i],
                            'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty[$i],
                            'closing_stock_value' => $resultJobInfor[$i][0]->average_cost_price * ($resultJobInfor[$i][0]->store_qty - $qty[$i])
                        );
                    }
                }


                $this->db->update_batch('parts_inventory_m_tbl', $parts_inventory_qty_update_array, 'part_ref_code');

                $dataFieldsUpdate_all_available = array("job_status" => "In Progress", "store_manager_status" => "Sent to Technician", "technician_status" => "Technician WIP", "current_status" => "Sent to Technician");
                $whereArrUpdate_all_available = array("job_id" => $job_id);

                $resultUpdate_all_available = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate_all_available, $whereArrUpdate_all_available);

                $date = date('Y-m-d');

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $job_history_details = array(
                    'job_id' => $job_id,
                    'customer_id' => $resultJobInfo[0]->customer_id,
                    'job_date' => $resultJobInfo[0]->job_date,
                    'status' => "Sent to Technician",
                    'final_status' => "In Progress",
                    'status_change_date' => $date
                );


                $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                $var = array("final_result" => "success");
                echo json_encode($var);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_store_manager_job_form_page($job_id) { //with assigned to me job page (store manager)
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;



                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                //get the supplier purchase details for RMA process and Parts on Oder
                $fieldSupplierPurchaseInfo = "*";
                $whereArrSupplierPurchaseInfo = array("sales_order_no" => $resultJobInfo[0]->sales_order_no);
                $resultSupplierPurchaseInfo = $this->db_model->getData($fieldSupplierPurchaseInfo, "supplier_purchase_m_tbl", $whereArrSupplierPurchaseInfo);

                //get the supplier details for RMA process and Parts on Oder
                $fieldSupplierInfo = "*";
                $whereArrSupplierInfo = array("supp_id" => $resultSupplierPurchaseInfo[0]->supp_id);
                $resultSupplierInfo = $this->db_model->getData($fieldSupplierInfo, "supp_details_m_tbl", $whereArrSupplierInfo);

                //get the job_repair details from the job_reapir_inof_tbl 
//                $fieldJobRepairInfo = "*";
//                $whereArrJobRepairInfo = array("store_manager_id" => $store_m_id, "job_id" => $job_id);
//                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);
                //get the job_repair details from the job_reapir_inof_tbl 
                $fields1 = '*';
                $wherefieldtablefrom1 = array("job_repair_info_tbl.job_id" => $job_id);
                $tablefrom1 = 'job_repair_info_tbl';
                $tablejoin1 = 'parts_inventory_m_tbl';
                $tablejoincondition1 = 'job_repair_info_tbl.part_ref_code = parts_inventory_m_tbl.part_ref_code';
                $resultJobRepairInfo = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);


//                var_dump($resultJobRepairInfo);die;
                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = array("store_status" => "Available");
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                $data['job_info'] = $resultJobInfo;
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['parts_info'] = $resultPartsInfo;
                $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                $data['supplier_info'] = $resultSupplierInfo;

                $data['nav'] = "jobs";

                $this->load->view('psmsbackend/store_manager/jobs/store_manager_job_card_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function estimation_approved_form_load_page($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;



                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                //get the supplier purchase details for RMA process and Parts on Oder
                $fieldSupplierPurchaseInfo = "*";
                $whereArrSupplierPurchaseInfo = array("sales_order_no" => $resultJobInfo[0]->sales_order_no);
                $resultSupplierPurchaseInfo = $this->db_model->getData($fieldSupplierPurchaseInfo, "supplier_purchase_m_tbl", $whereArrSupplierPurchaseInfo);

                //get the supplier details for RMA process and Parts on Oder
                $fieldSupplierInfo = "*";
                $whereArrSupplierInfo = array("supp_id" => $resultSupplierPurchaseInfo[0]->supp_id);
                $resultSupplierInfo = $this->db_model->getData($fieldSupplierInfo, "supp_details_m_tbl", $whereArrSupplierInfo);

                //get the job_repair details from the job_reapir_inof_tbl 
//                $fieldJobRepairInfo = "*";
//                $whereArrJobRepairInfo = array("store_manager_id" => $store_m_id, "job_id" => $job_id);
//                $resultJobRepairInfo = $this->db_model->getData($fieldJobRepairInfo, "job_repair_info_tbl", $whereArrJobRepairInfo);
                //get the job_repair details from the job_reapir_inof_tbl 
                $fields1 = '*';
                $wherefieldtablefrom1 = array("job_repair_info_tbl.job_id" => $job_id);
                $tablefrom1 = 'job_repair_info_tbl';
                $tablejoin1 = 'parts_inventory_m_tbl';
                $tablejoincondition1 = 'job_repair_info_tbl.part_ref_code = parts_inventory_m_tbl.part_ref_code';
                $resultJobRepairInfo = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);


//                var_dump($resultJobRepairInfo);die;
                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = array("store_status" => "Available");
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                $data['job_info'] = $resultJobInfo;
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['parts_info'] = $resultPartsInfo;
                $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                $data['supplier_info'] = $resultSupplierInfo;

                $data['nav'] = "jobs";

                $this->load->view('psmsbackend/store_manager/jobs/estimation_approved_form_load_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function send_to_technician_estimation_approved_job() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);
                $onhold_note = $this->input->post("onhold_note", TRUE);
                $onhold_note_2 = $this->input->post("onhold_note_2", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $availability = $this->input->post("availability", TRUE);
                $rma_applicability = $this->input->post("rma_applicability", TRUE);
                $order_type = $this->input->post("order_type", TRUE);


                for ($i = 0; $i < count($part_ref_code); $i++) {

                    if ($availability[$i] === "Available") {



                        $parts_inventory_where_array[] = array(
                            'part_ref_code' => $part_ref_code[$i]
                        );

                        $fieldJobInfor = "*";
                        $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));


                        $parts_inventory_qty_update_array[] = array(
                            'part_ref_code' => $part_ref_code[$i],
                            'part_no' => $part_no[$i],
                            'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty[$i],
                            'closing_stock_value' => $resultJobInfor[$i][0]->average_cost_price * ($resultJobInfor[$i][0]->store_qty - $qty[$i])
                        );
                    }
                }


                $this->db->update_batch('parts_inventory_m_tbl', $parts_inventory_qty_update_array, 'part_ref_code');

                $dataFieldsUpdate_all_available = array("job_status" => "In Progress", "store_manager_status" => "Sent to Technician", "technician_status" => "Technician WIP", "current_status" => "Sent to Technician");
                $whereArrUpdate_all_available = array("job_id" => $job_id);

                $resultUpdate_all_available = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate_all_available, $whereArrUpdate_all_available);

                $date = date('Y-m-d');

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                $job_history_details = array(
                    'job_id' => $job_id,
                    'customer_id' => $resultJobInfo[0]->customer_id,
                    'job_date' => $resultJobInfo[0]->job_date,
                    'status' => "Sent to Technician",
                    'final_status' => "In Progress",
                    'status_change_date' => $date
                );


                $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                $var = array("final_result" => "success");
                echo json_encode($var);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function send_for_rma() { //if job is supplier warranty and RMA Okay.  send for RMA: intially send to serivce manager for approval
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);
                $onhold_note = $this->input->post("onhold_note", TRUE);
                $onhold_note_2 = $this->input->post("onhold_note_2", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $availability = $this->input->post("availability", TRUE);
                $rma_applicability = $this->input->post("rma_applicability", TRUE);
                $order_type = $this->input->post("order_type", TRUE);

                //for parts on order
                $requesting_qty = 0;
                $qty_by_technician = $qty;
                $store_qty = $this->input->post("store_qty", TRUE);
                $service_mgr_note = "";
                $approval_status = "Pending";
                $updated_ppo_id = $this->get_reg_id("#", "PPO");


                if ($onhold_note === "Other") {
                    $new_onhold_note = $onhold_note_2;
                } else {
                    $new_onhold_note = $onhold_note;
                }


                $special_order_array = array();
                $rma_order_array = array();
                $estimation_order_array = array();
                $estimation_parts_on_order_array = array();

                $parts_update_array = array();


                for ($i = 0; $i < count($part_ref_code); $i++) {

                    if ($availability[$i] != "Available") {

                        $status_availability = "not_available";

                        if ($order_type[$i] === "Special Order") {
                            $special_order_array[] = array(
                                'job_id' => $job_id,
                                'job_created_date' => $job_created_date,
                                'job_assigned_date' => $job_assigned_date,
                                'customer_id' => $customer_id,
                                'job_created_date' => $job_created_date,
                                'warranty_type' => $warranty_type,
                                'category' => $category,
                                'make' => $make,
                                'model' => $model,
                                'serial_no' => $serial_no,
                                'problem_description' => $problem_description,
                                'onhold_note' => $new_onhold_note,
                                'onhold_note_2' => $new_onhold_note,
                                'pop_no' => $pop_no,
                                'supplier_id' => $supplier_id,
                                'supplier_name' => $supplier_name,
                                'address' => $address,
                                'email' => $email,
                                'phone_no' => $phone_no,
                                'fax_no' => $fax_no,
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'part_description' => $part_description[$i],
                                'qty' => $qty[$i],
                                'availability' => $availability[$i],
                                'rma_applicability' => $rma_applicability[$i],
                                'order_type' => $order_type[$i]
                            );
                        } else if ($order_type[$i] === "RMA") {

                            $rma_order_array[] = array(
                                'job_id' => $job_id,
                                'rma_no' => "#RMA",
                                'imports_manager_id' => "Unassigned",
                                'category' => $category,
                                'make' => $make,
                                'model' => $model,
                                'serial_no' => $serial_no,
                                'problem_description' => $problem_description,
                                'pop_no' => $pop_no,
                                'pop_date' => $pop_date,
                                'supplier_id' => $supplier_id,
                                'supplier_name' => $supplier_name,
                                'address' => $address,
                                'email' => $email,
                                'phone_no' => $phone_no,
                                'fax_no' => $fax_no,
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'part_description' => $part_description[$i],
                                'qty' => $qty[$i],
                                'status' => "Pending"
                            );
                        } else if ($order_type[$i] === "Customer Repair") {
                            $estimation_order_array[] = array(
                                'job_id' => $job_id,
                                'job_created_date' => $job_created_date,
                                'job_assigned_date' => $job_assigned_date,
                                'customer_id' => $customer_id,
                                'job_created_date' => $job_created_date,
                                'warranty_type' => $warranty_type,
                                'category' => $category,
                                'make' => $make,
                                'model' => $model,
                                'serial_no' => $serial_no,
                                'problem_description' => $problem_description,
                                'onhold_note' => $new_onhold_note,
                                'onhold_note_2' => $new_onhold_note,
                                'pop_no' => $pop_no,
                                'supplier_id' => $supplier_id,
                                'supplier_name' => $supplier_name,
                                'address' => $address,
                                'email' => $email,
                                'phone_no' => $phone_no,
                                'fax_no' => $fax_no,
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'part_description' => $part_description[$i],
                                'qty' => $qty[$i],
                                'availability' => $availability[$i],
                                'rma_applicability' => $rma_applicability[$i],
                                'order_type' => $order_type[$i]
                            );
                        } else if ($order_type[$i] === "Customer Repair + Parts on Order") {
                            $estimation_parts_on_order_array[] = array(
                                'job_id' => $job_id,
                                'job_created_date' => $job_created_date,
                                'job_assigned_date' => $job_assigned_date,
                                'customer_id' => $customer_id,
                                'job_created_date' => $job_created_date,
                                'warranty_type' => $warranty_type,
                                'category' => $category,
                                'make' => $make,
                                'model' => $model,
                                'serial_no' => $serial_no,
                                'problem_description' => $problem_description,
                                'onhold_note' => $new_onhold_note,
                                'onhold_note_2' => $new_onhold_note,
                                'pop_no' => $pop_no,
                                'supplier_id' => $supplier_id,
                                'supplier_name' => $supplier_name,
                                'address' => $address,
                                'email' => $email,
                                'phone_no' => $phone_no,
                                'fax_no' => $fax_no,
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'part_description' => $part_description[$i],
                                'qty' => $qty[$i],
                                'availability' => $availability[$i],
                                'rma_applicability' => $rma_applicability[$i],
                                'order_type' => $order_type[$i]
                            );
                        }
                    } // else if(){
                    //
                    
                    $status_availability = "available";


                    //
                    //}
                }

                for ($i = 0; $i < count($part_ref_code); $i++) {
                    if ($availability[$i] != "Available") {
                        if ($order_type[$i] === "Special Order") {

                            $parts_update_array[] = array(
                                'part_ref_code' => $part_ref_code[$i],
                                'job_id' => $job_id,
                                'special_indicator' => "Job Pending"
                            );
                        }
                    }
                }

                for ($i = 0; $i < count($part_ref_code); $i++) {
                    if ($availability[$i] != "Available") {
                        if ($order_type[$i] === "Special Order") {

                            $parts_repair_info_update_array_special[] = array(
                                'part_ref_code' => $part_ref_code[$i],
                                'job_id' => $job_id,
                                'pending_status' => "Yes",
                                'order_type' => $order_type[$i]
                            );
                        }
                    }
                }

                for ($i = 0; $i < count($part_ref_code); $i++) {
                    if ($availability[$i] != "Available") {
                        if ($order_type[$i] === "RMA") { /// changed removed  || $order_type[$i] === "Special Order"
                            $parts_repair_info_update_array_rma[] = array(
                                'part_ref_code' => $part_ref_code[$i],
//                                'job_id' => $job_id,
                                'pending_status' => "Yes",
                                'order_type' => $order_type[$i]
                            );
                        }
                    }
                }

                $test = array('job_id', 'part_ref_code');


                for ($i = 0; $i < count($part_ref_code); $i++) {
                    if ($availability[$i] != "Available") {
                        if ($order_type[$i] === "Special Order") {

                            $parts_on_order_array[] = array(
                                'ppo_no' => $updated_ppo_id,
                                'job_id' => $job_id,
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'part_description' => $part_description[$i],
                                'store_qty' => $store_qty[$i],
                                'requesting_qty' => $requesting_qty,
                                'qty_by_technician' => $qty_by_technician[$i],
                                'service_mgr_note' => $service_mgr_note,
                                'approval_status' => $approval_status
                            );
                        }
                    }
                }

                if ($status_availability === "not_available") {

                    $date = date('Y-m-d');

                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id);
                    $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                    $job_history_details = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobInfo[0]->customer_id,
                        'job_date' => $resultJobInfo[0]->job_date,
                        'status' => "Sent to Service Manager"
                        ,
                        'final_status' => "In Progress",
                        'status_change_date' => $date
                    );

                    $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                    //insert customer job history table


                    if (!empty($special_order_array)) {

                        if (!empty($special_order_array)) {
                            $this->db->update_batch('parts_inventory_m_tbl', $parts_update_array, 'part_ref_code');
                            $return_up = $this->db->affected_rows() > 0;
//                            var_dump($return_up);
                        }if (!empty($parts_on_order_array)) {
                            $result_parts_on_order = $this->db->insert_batch('parts_on_order_tbl', $parts_on_order_array);

                            $dataArraId = array('id_number' => $updated_ppo_id);
                            $whereArrId = array('id_type' => "PPO");

                            $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);
//                            var_dump($result_parts_on_order);
                        }
                    }if (!empty($rma_order_array)) {

                        $result_rma_info = $this->db->insert_batch('rma_tbl', $rma_order_array);
//                        var_dump($result_rma_info);
                    }if (!empty($estimation_order_array)) {
//                        var_dump($estimation_order_array);
                    }if (!empty($estimation_parts_on_order_array)) {
//                        var_dump($estimation_parts_on_order_array);
                    }if (!empty($special_order_array) || !empty($rma_order_array) || !empty($estimation_order_array) || !empty($estimation_parts_on_order_array)) {
                        $dataFieldsUpdate = array("job_status" => "In Progress", "store_manager_status" => "Sent to Service Manager", "service_manager_status" => "New", "current_status" => "Sent to Service Manager");
                        $whereArrUpdate = array("job_id" => $job_id);

                        $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);
                    }if (!empty($special_order_array) || !empty($rma_order_array) || !empty($estimation_parts_on_order_array)) {
//                    $this->db->update_batch('job_repair_info_tbl', $parts_repair_info_update_array_special, $test);
//                    $return_up = $this->db->affected_rows() > 0;
//                    var_dump($return_up);
                        $this->db->where('job_id', $job_id);
                        $this->db->update_batch('job_repair_info_tbl', $parts_repair_info_update_array_rma, 'part_ref_code');
                        $return_up = $this->db->affected_rows() > 0;
//                        var_dump($return_up);
                    }

                    $var = array("final_result" => "success");
                    echo json_encode($var);
                } else { // all parts available
                    for ($i = 0; $i < count($part_ref_code); $i++) {

                        if ($availability[$i] === "Available") {

                            if ($order_type[$i] === "RMA") {

                                $rma_order_array_all_available[] = array(
                                    'job_id' => $job_id,
                                    'rma_no' => "#RMA",
                                    'imports_manager_id' => "Unassigned",
                                    'category' => $category,
                                    'make' => $make,
                                    'model' => $model,
                                    'serial_no' => $serial_no,
                                    'problem_description' => $problem_description,
                                    'pop_no' => $pop_no,
                                    'pop_date' => $pop_date,
                                    'supplier_id' => $supplier_id,
                                    'supplier_name' => $supplier_name,
                                    'address' => $address,
                                    'email' => $email,
                                    'phone_no' => $phone_no,
                                    'fax_no' => $fax_no,
                                    'part_ref_code' => $part_ref_code[$i],
                                    'part_no' => $part_no[$i],
                                    'part_description' => $part_description[$i],
                                    'qty' => $qty[$i],
                                    'status' => "Pending"
                                );
                            }

                            $parts_inventory_where_array[] = array(
                                'part_ref_code' => $part_ref_code[$i]
                            );

                            $fieldJobInfor = "*";
                            $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));


                            $parts_inventory_qty_update_array[] = array(
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty[$i],
                                'closing_stock_value' => $resultJobInfor[$i][0]->average_cost_price * ($resultJobInfor[$i][0]->store_qty - $qty[$i])
                            );
                        }
                    }

//                    var_dump($parts_inventory_qty_update_array);

                    $rma_order_array_all_available = array();
                    $parts_inventory_qty_update_array = array();


                    for ($i = 0; $i < count($part_ref_code); $i++) {

                        if ($availability[$i] === "Available") {

                            if ($order_type[$i] === "RMA") {

                                $rma_order_array_all_available_one_rec = array(
                                    'job_id' => $job_id,
                                    'rma_no' => "#RMA",
                                    'imports_manager_id' => "Unassigned",
                                    'category' => $category,
                                    'make' => $make,
                                    'model' => $model,
                                    'serial_no' => $serial_no,
                                    'problem_description' => $problem_description,
                                    'pop_no' => $pop_no,
                                    'pop_date' => $pop_date,
                                    'supplier_id' => $supplier_id,
                                    'supplier_name' => $supplier_name,
                                    'address' => $address,
                                    'email' => $email,
                                    'phone_no' => $phone_no,
                                    'fax_no' => $fax_no,
                                    'part_ref_code' => $part_ref_code[$i],
                                    'part_no' => $part_no[$i],
                                    'part_description' => $part_description[$i],
                                    'qty' => $qty[$i],
                                    'status' => "Pending"
                                );
                            }

                            $parts_inventory_where_array[] = array(
                                'part_ref_code' => $part_ref_code[$i]
                            );

                            $fieldJobInfor = "*";
                            $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));

//                            var_dump($resultJobInfor[$i][0]->store_qty);

                            $parts_inventory_qty_update_array[] = array(
                                'part_ref_code' => $part_ref_code[$i],
                                'part_no' => $part_no[$i],
                                'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty[$i],
                                'closing_stock_value' => $resultJobInfor[$i][0]->average_cost_price * ($resultJobInfor[$i][0]->store_qty - $qty[$i])
                            );
                        }
                    }




                    $dataFieldsUpdate_all_available = array("job_status" => "In Progress", "store_manager_status" => "Sent to Technician", "technician_status" => "Technician WIP", "current_status" => "Sent to Technician");
                    $whereArrUpdate_all_available = array("job_id" => $job_id);

                    $resultUpdate_all_available = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate_all_available, $whereArrUpdate_all_available);

                    $date = date('Y-m-d');

                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id);
                    $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                    $job_history_details = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobInfo[0]->customer_id,
                        'job_date' => $resultJobInfo[0]->job_date,
                        'status' => "Sent to Technician",
                        'final_status' => "In Progress",
                        'status_change_date' => $date
                    );


                    $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                    if (count($rma_order_array_all_available) > 1) {


                        $result_rma_info = $this->db->insert_batch('rma_tbl', $rma_order_array_all_available);
                    } else if (count($rma_order_array_all_available) === 1) {
                        $result_rma_info = $this->db_model->insertData("rma_tbl", $rma_order_array_all_available_one_rec);
                    }


                    $this->db->update_batch('parts_inventory_m_tbl', $parts_inventory_qty_update_array, 'part_ref_code');
                    //database code if all available

                    $var = array("final_result" => "success");
                    echo json_encode($var);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function job_supplier_warranty_submit() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);
                $onhold_note = $this->input->post("onhold_note", TRUE);
                $onhold_note_2 = $this->input->post("onhold_note_2", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty_by_technician = $this->input->post("qty", TRUE);
                $availability = $this->input->post("availability", TRUE);
                $rma_applicability = $this->input->post("rma_applicability", TRUE);
                $order_type = $this->input->post("order_type", TRUE);
                $store_qty = $this->input->post("store_qty", TRUE);


                $updated_ppo_id = $this->get_reg_id("#", "PPO");

                if ($onhold_note === "Other") {
                    $new_onhold_note = $onhold_note_2;
                } else {
                    $new_onhold_note = $onhold_note;
                }
//                var_dump(count($part_ref_code));


                $rma_order_array_not_available = array();
                $rma_order_array_available = array();
                $special_order_array_not_available = array();
                $special_order_array_not_availablee_one_part = array();

                if ($warranty_type === "Supplier Warranty") {

                    for ($i = 0; $i < count($part_ref_code); $i++) {

                        if ($availability[$i] === "Available") {

                            if ($order_type[$i] === "RMA") {

                                $rma_order_array_available[] = array(
                                    'job_id' => $job_id,
                                    'rma_no' => "#RMA",
                                    'imports_manager_id' => "Unassigned",
                                    'category' => $category,
                                    'make' => $make,
                                    'model' => $model,
                                    'serial_no' => $serial_no,
                                    'problem_description' => $problem_description,
                                    'pop_no' => $pop_no,
                                    'pop_date' => $pop_date,
                                    'supplier_id' => $supplier_id,
                                    'supplier_name' => $supplier_name,
                                    'address' => $address,
                                    'email' => $email,
                                    'phone_no' => $phone_no,
                                    'fax_no' => $fax_no,
                                    'part_ref_code' => $part_ref_code[$i],
                                    'part_no' => $part_no[$i],
                                    'part_description' => $part_description[$i],
                                    'qty' => $qty_by_technician[$i],
                                    'status' => "Pending"
                                );
                            }
                        } else if ($availability[$i] != "Available") {


                            if ($order_type[$i] === "RMA") {

                                $rma_order_array_not_available[] = array(
                                    'job_id' => $job_id,
                                    'rma_no' => "#RMA",
                                    'imports_manager_id' => "Unassigned",
                                    'category' => $category,
                                    'make' => $make,
                                    'model' => $model,
                                    'serial_no' => $serial_no,
                                    'problem_description' => $problem_description,
                                    'pop_no' => $pop_no,
                                    'pop_date' => $pop_date,
                                    'supplier_id' => $supplier_id,
                                    'supplier_name' => $supplier_name,
                                    'address' => $address,
                                    'email' => $email,
                                    'phone_no' => $phone_no,
                                    'fax_no' => $fax_no,
                                    'part_ref_code' => $part_ref_code[$i],
                                    'part_no' => $part_no[$i],
                                    'part_description' => $part_description[$i],
                                    'qty' => $qty_by_technician[$i],
                                    'status' => "Pending"
                                );
                            } else if ($order_type[$i] === "Special Order") {

                                $special_order_array_not_available[] = array(
                                    'job_id' => $job_id,
                                    'job_created_date' => $job_created_date,
                                    'job_assigned_date' => $job_assigned_date,
                                    'customer_id' => $customer_id,
                                    'job_created_date' => $job_created_date,
                                    'warranty_type' => $warranty_type,
                                    'category' => $category,
                                    'make' => $make,
                                    'model' => $model,
                                    'serial_no' => $serial_no,
                                    'problem_description' => $problem_description,
                                    'onhold_note' => $new_onhold_note,
                                    'onhold_note_2' => $new_onhold_note,
                                    'pop_no' => $pop_no,
                                    'supplier_id' => $supplier_id,
                                    'supplier_name' => $supplier_name,
                                    'address' => $address,
                                    'email' => $email,
                                    'phone_no' => $phone_no,
                                    'fax_no' => $fax_no,
                                    'part_ref_code' => $part_ref_code[$i],
                                    'part_no' => $part_no[$i],
                                    'part_description' => $part_description[$i],
                                    'qty' => $qty_by_technician[$i],
                                    'availability' => $availability[$i],
                                    'rma_applicability' => $rma_applicability[$i],
                                    'order_type' => $order_type[$i]
                                );
                            }
                        }
                    }




                    /// if there is only one repair part for the entier job
                    ////////////////////////////////////////   
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    //                                    //
                    ////////////////////////////////////////
                    ///////////////////////// Available ////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////

                    if (count($rma_order_array_available) > 1) {


                        $result_rma = $this->db->insert_batch('rma_tbl', $rma_order_array_available);


                        $date = date('Y-m-d');
                        //get the job infomation
                        $fieldJobInfo = "*";
                        $whereArrJobInfo = array("job_id" => $job_id);
                        $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

                        $job_history_details = array(
                            'job_id' => $job_id,
                            'customer_id' => $resultJobInfo[0]->customer_id,
                            'job_date' => $resultJobInfo[0]->job_date,
                            'status' => "Sent to Technician"
                            ,
                            'final_status' => "In Progress",
                            'status_change_date' => $date
                        );

                        $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                        $dataFieldsUpdate = array("job_status" => "In Progress", "store_manager_status" => "Sent to Technician", "current_status" => "Sent to Technician");
                        $whereArrUpdate = array("job_id" => $job_id);

                        $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);


                        //parts inventory update
                    } else if (count($rma_order_array_available) === 1) {

                        for ($i = 0; $i < count($part_ref_code); $i++) {

                            if ($availability[$i] === "Available") {


                                if ($order_type[$i] === "RMA") {

                                    $rma_order_array_available_one_part = array(
                                        'job_id' => $job_id,
                                        'rma_no' => "#RMA",
                                        'imports_manager_id' => "Unassigned",
                                        'category' => $category,
                                        'make' => $make,
                                        'model' => $model,
                                        'serial_no' => $serial_no,
                                        'problem_description' => $problem_description,
                                        'pop_no' => $pop_no,
                                        'pop_date' => $pop_date,
                                        'supplier_id' => $supplier_id,
                                        'supplier_name' => $supplier_name,
                                        'address' => $address,
                                        'email' => $email,
                                        'phone_no' => $phone_no,
                                        'fax_no' => $fax_no,
                                        'part_ref_code' => $part_ref_code[$i],
                                        'part_no' => $part_no[$i],
                                        'part_description' => $part_description[$i],
                                        'qty' => $qty_by_technician[$i],
                                        'status' => "Pending"
                                    );
                                }
                            }
                        }



                        $result_rma = $this->db_model->insertData("rma_tbl", $rma_order_array_available_one_part);


                        //parts inventory update
                    } //count
                    ///////////////////////// Not Available ////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////
                    ////////////////////////////////////////////////////////////

                    if (count($rma_order_array_not_available) > 1) {

                        $result_rma = $this->db->insert_batch('rma_tbl', $rma_order_array_not_available);
                    } else if (count($rma_order_array_not_available) === 1) {

                        for ($i = 0; $i < count($part_ref_code); $i++) {

                            if ($availability[$i] != "Available") {


                                if ($order_type[$i] === "RMA") {

                                    $rma_order_array_not_available_one_part = array(
                                        'job_id' => $job_id,
                                        'rma_no' => "#RMA",
                                        'imports_manager_id' => "Unassigned",
                                        'category' => $category,
                                        'make' => $make,
                                        'model' => $model,
                                        'serial_no' => $serial_no,
                                        'problem_description' => $problem_description,
                                        'pop_no' => $pop_no,
                                        'pop_date' => $pop_date,
                                        'supplier_id' => $supplier_id,
                                        'supplier_name' => $supplier_name,
                                        'address' => $address,
                                        'email' => $email,
                                        'phone_no' => $phone_no,
                                        'fax_no' => $fax_no,
                                        'part_ref_code' => $part_ref_code[$i],
                                        'part_no' => $part_no[$i],
                                        'part_description' => $part_description[$i],
                                        'qty' => $qty_by_technician[$i],
                                        'status' => "Pending"
                                    );
                                }
                            }
                        }

                        $result_rma = $this->db_model->insertData("rma_tbl", $rma_order_array_not_available_one_part);
                    } // count


                    if (count($special_order_array_not_available) > 1) {

                        $result_parts_on_order = $this->db->insert_batch('parts_on_order_tbl', $special_order_array_not_available);
                    } else {

                        for ($i = 0; $i < count($part_ref_code); $i++) {

                            if ($availability[$i] != "Available") {

                                if ($order_type[$i] === "Special Order") {

                                    $special_order_array_not_availablee_one_part = array(
                                        'job_id' => $job_id,
                                        'job_created_date' => $job_created_date,
                                        'job_assigned_date' => $job_assigned_date,
                                        'customer_id' => $customer_id,
                                        'job_created_date' => $job_created_date,
                                        'warranty_type' => $warranty_type,
                                        'category' => $category,
                                        'make' => $make,
                                        'model' => $model,
                                        'serial_no' => $serial_no,
                                        'problem_description' => $problem_description,
                                        'onhold_note' => $new_onhold_note,
                                        'onhold_note_2' => $new_onhold_note,
                                        'pop_no' => $pop_no,
                                        'supplier_id' => $supplier_id,
                                        'supplier_name' => $supplier_name,
                                        'address' => $address,
                                        'email' => $email,
                                        'phone_no' => $phone_no,
                                        'fax_no' => $fax_no,
                                        'part_ref_code' => $part_ref_code,
                                        'part_no' => $part_no,
                                        'part_description' => $part_description,
                                        'qty' => $qty_by_technician,
                                        'availability' => $availability,
                                        'rma_applicability' => $rma_applicability,
                                        'order_type' => $order_type
                                    );
                                }
                            }
                        }

                        $result_parts_on_order = $this->db_model->insertData("parts_on_order_tbl", $special_order_array_not_availablee_one_part);
                    }// count
//                    for ($i = 0; $i < count($part_ref_code); $i++) {
//
//                        if ($availability[$i] === "Available") {
//
//                            if ($order_type[$i] === "RMA") {
//
//                                $parts_available[] = array(
//                                    'job_id' => $job_id
//                                );
//                            }
//                        }
//                    }
//
//                    if (count($part_ref_code) === count($parts_available)) {
//
//
//                        if (count($part_ref_code) > 1) {
//
//                            for ($i = 0; $i < count($part_ref_code); $i++) {
//
//                                if ($availability[$i] === "Available") {
//
//
//                                    $parts_inventory_where_array[] = array(
//                                        'part_ref_code' => $part_ref_code[$i]
//                                    );
//
//                                    $fieldJobInfor = "*";
//                                    $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));
//
////                            var_dump($resultJobInfor[$i][0]->store_qty);
//
//                                    $parts_inventory_qty_update_array[] = array(
//                                        'part_ref_code' => $part_ref_code[$i],
//                                        'part_no' => $part_no[$i],
//                                        'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty_by_technician[$i]
//                                    );
//                                }
//                            }
//
//                            $this->db->update_batch('parts_inventory_m_tbl', $parts_inventory_qty_update_array, 'part_ref_code');
//                        } else  if (count($part_ref_code) === 1){
//                            
//                            for ($i = 0; $i < count($part_ref_code); $i++) {
//
//                                if ($availability[$i] === "Available") {
//
//
//                                    $parts_inventory_where_array = array(
//                                        'part_ref_code' => $part_ref_code[$i]
//                                    );
//
//                                    $fieldJobInfor = "*";
//                                    $resultJobInfor[] = ($this->db_model->getData($fieldJobInfor, "parts_inventory_m_tbl", $parts_inventory_where_array[$i]));
//
//                                    $parts_inventory_qty_update_array = array(
//                                        'part_ref_code' => $part_ref_code[$i],
//                                        'part_no' => $part_no[$i],
//                                        'store_qty' => $resultJobInfor[$i][0]->store_qty - $qty_by_technician[$i]
//                                    );
//                                }
//                            }
//                            
//                            $resultUpdate = $this->db_model->updatedata("parts_inventory_m_tbl", $parts_inventory_where_array, $parts_inventory_qty_update_array);
//                            
//                        }
//                    } else {
//                        
//                    }
                } else {
                    echo "Not a Supplier Warranty";
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function job_estimate_submit() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->post("job_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $job_assigned_date = $this->input->post("job_assigned_date", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);
                $job_created_date = $this->input->post("job_created_date", TRUE);
                $warranty_type = $this->input->post("warranty_type", TRUE);
                $category = $this->input->post("category", TRUE);
                $make = $this->input->post("make", TRUE);
                $model = $this->input->post("model", TRUE);
                $serial_no = $this->input->post("serial_no", TRUE);
                $problem_description = $this->input->post("problem_description", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);
                $part_ref_code = $this->input->post("part_ref_code", TRUE);
                $part_no = $this->input->post("part_no", TRUE);
                $part_description = $this->input->post("part_description", TRUE);
                $qty = $this->input->post("qty", TRUE);
                $availability = $this->input->post("availability", TRUE);
                $rma_applicability = $this->input->post("rma_applicability", TRUE);
                $order_type = $this->input->post("order_type", TRUE);

                if ($warranty_type === "Customer Repair") {

                    $availableCount = 0;
                    $notAvailableCount = 0;

                    for ($i = 0; $i < count($part_ref_code); $i++) {

                        if ($availability[$i] === "Available") {

                            $availableCount +=1;
                        } else if ($availability[$i] != "Available") {

                            $notAvailableCount +=1;
                        }
                    }

                    if (count($part_ref_code) == $availableCount) { // All Available 
                        $updated_job_estimate_id = $this->get_reg_id("JE", "Job Estimate");

                        $job_estimate_table_data = array(
                            'job_estimate_id' => $updated_job_estimate_id,
                            'job_id' => $job_id,
                            'customer_id' => $customer_id,
                            'category' => $category,
                            'make' => $make,
                            'model' => $model,
                            'serial_no' => $serial_no,
                            'estimate_desc' => "",
                            'est_inspect_fee' => 0.00,
                            'all_parts_cost' => 0.00,
                            'parts_markup_cost' => 0.00, //calculated in service manager view
                            'parts_markup_limit' => 0, // %
                            'total_parts_markup_cost_final' => 0.00, //calculated in service manager view
                            'labour_cost' => 0.00,
                            'tax_vat' => 0.00, //calculated in service manager view
                            'tax_nbt' => 0.00, //calculated in service manager view
                            'tax_vat_limit' => 0, //calculated in service manager view %
                            'tax_nbt_limit' => 0, //calculated in service manager view %
                            'total_job_cost' => 0.00, //calculated in service manager view
                            'est_send_date' => "0000-00-00",
                            'est_expire_date' => "0000-00-00",
                            'payment_status' => "Pending",
                            'invoice_no' => "0000",
                            'receipt_no' => "0000",
                            'status' => "New", // New - New estimate request to Serivce Manager //// Pending Customer Approval -  when service manager completed the esitamtion and send to customer ////    Approved - customer approved  ///  rejected -  Customer rejected    //   Not Economical -- Serivice Manager  ///  Beyond the repair  
                            'status_view' => "New"
                        );


                        $result_job_estimation = $this->db_model->insertData("job_estimate_tbl", $job_estimate_table_data);

                        $dataFieldsUpdate_all_available = array("job_status" => "In Progress", "store_manager_status" => "Sent to Service Manager", "current_status" => "Sent to Service Manager");
                        $whereArrUpdate_all_available = array("job_id" => $job_id);
                        $resultUpdate_all_available = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate_all_available, $whereArrUpdate_all_available);

                        $date = date('Y-m-d');
                        $job_history_details = array(
                            'job_id' => $job_id,
                            'customer_id' => $customer_id,
                            'job_date' => $job_created_date,
                            'status' => "Pending Estimation",
                            'final_status' => "In Progress",
                            'status_change_date' => $date
                        );

                        $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                        $dataArraId1 = array('id_number' => $updated_job_estimate_id);
                        $whereArrId1 = array('id_type' => "Job Estimate");

                        $result_update_id_numbers1 = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId1, $whereArrId1);

                        if ($result_job_estimation && $resultUpdate_all_available && $result_customer_job_history_info && $result_update_id_numbers1) {

                            $record = array('final_result' => "success");
                            echo json_encode($record);
                        } else {
                            $record = array('final_result' => "unsuccess");
                            echo json_encode($record);
                        }
                    } else { // One or more not available
                    }
                } else {
                    echo "únable to proceed";
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

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->get('var1'); //job id
                $result_msg = $this->input->get('var2'); //successmsg

                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $data['page_msg'] = "";

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                // var_dump($result_msg);die;                           
                if ($result_msg == "success") {
                    $data['page_msg'] = "sent_to_store_manager";
                } else {
                    $data['page_msg'] = "";
                }


                $data['job_id'] = $job_id;

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/store_manager/jobs/job_card_list_assigned_to_me', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function view_job_detail_page() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { // store manager
                $job_id = $this->input->get('var1'); //job id

                $page_data = $this->store_manager_view_data();

                $store_m_id = $page_data['store_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['store_m_id'] = $store_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

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


                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/store_manager/jobs/job_detail_view_store_manager', $data);
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

    public function store_manager_view_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "5") { //store manager      
                //get the technician data
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultStoreManagerInfo = $this->db_model->getData($fieldTechInfo, "store_manager_m_tbl", $whereArrTechInfo);

                $store_m_id = $resultStoreManagerInfo[0]->store_manager_id;

                //selecting all new jobs
                $fieldsetAllJobs = array('*');
                $whereArrayAllJobs = array('store_manager_status' => 'New');
                $resultAllJobs = $this->db_model->getData($fieldsetAllJobs, 'customer_job_tbl', $whereArrayAllJobs);

                //selecting all assigned to me jobs
                $fieldsetAssignedToMeJobs = array('*');
                $whereArrayAssignedToMeJobs = array('store_manager_status' => 'Store Manager WIP', 'store_manager_id' => $store_m_id);
                $result_assignedTomeJobs = $this->db_model->getData($fieldsetAssignedToMeJobs, 'customer_job_tbl', $whereArrayAssignedToMeJobs);

                //to be continue...

                /*
                 * Assiciate array for sending data to view
                 */

                $data['store_m_id'] = $resultStoreManagerInfo[0]->store_manager_id; // technician id for operations
                $data['new_job_list'] = $resultAllJobs; // all new job list
                $data['new_job_count'] = count($resultAllJobs); // all new job count
                $data['assigned_to_me_job_list'] = $result_assignedTomeJobs; // assigned to me job list
                $data['assigned_to_me_job_count'] = count($result_assignedTomeJobs); // assigned to me job count

                return $data;
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

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
