<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Imports_manager_c_view extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function dashboard_imports_manager() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "2") { // imports manager
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function unassigned_rma_list() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "2") { // imports manager
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


                //**************************************************//


                $data['page_msg'] = "";
                $data['nav'] = "RMA";


                $this->load->view('psmsbackend/imports_manager/rma/rma_unassigned_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function pending_rma_list() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "2") { // imports manager
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


                //**************************************************//


                $data['page_msg'] = "";
                $data['nav'] = "RMA";


                $this->load->view('psmsbackend/imports_manager/rma/rma_pending_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    
    public function approved_rma_list() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "2") { // imports manager
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


                //**************************************************//


                $data['page_msg'] = "";
                $data['nav'] = "RMA";


                $this->load->view('psmsbackend/imports_manager/rma/rma_approved_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //page display when view button click on unassign rma list
    public function view_rma() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "2") { // imports manager
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


                //**************************************************//
                //get the single rma details by job id

                $job_id = $this->input->get('var1'); // job id
                $imports_manager_id = $this->input->get('var2'); // imports manager id
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
                $wherefieldtablefrom1 = array("job_repair_info_tbl.job_id" => $job_id, "job_repair_info_tbl.order_type" => "RMA");
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

                $data['nav'] = "RMA";
                $data['page_msg'] = "";
                
//                var_dump($resultJobRepairInfo);die;

                $this->load->view('psmsbackend/imports_manager/rma/imports_manager_rma_assign_to_me_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //assign, unassigned rma 
    public function assign_job_to_me($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "2") { // imports manager
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

                $imports_manager_id = $page_data['imports_manager_id'];

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


                //**************************************************//


                $dataFieldsUpdate1 = array("imports_manager_id" => $imports_manager_id, "job_status" => "In Progress", "imports_manager_status" => "Imports Manager WIP", "current_status" => "Imports Manager WIP");
                $whereArrUpdate1 = array("job_id" => $job_id);

                $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                $dataFieldsUpdate2 = array("imports_manager_id" => $imports_manager_id);
                $whereArrUpdate2 = array("job_id" => $job_id);

                $resultUpdate2 = $this->db_model->updatedata("rma_tbl", $dataFieldsUpdate2, $whereArrUpdate2); // update customer job table


                if ($resultUpdate1 && $resultUpdate2) {

                    $dataFieldsUpdate = array('imports_manager_id' => $imports_manager_id);
                    $whereArrUpdate = array('job_id' => $job_id, 'order_type' => 'RMA');
                    $resultUpdate3 = $this->db_model->updatedata("job_repair_info_tbl", $dataFieldsUpdate, $whereArrUpdate);


                    //job history table update unit
                    $whereArrJobCusInfo = array('job_id' => $job_id);
                    $resultJobCusInfo = $this->db_model->getData("*", "customer_job_tbl", $whereArrJobCusInfo);

                    $date = date('Y-m-d');

                    $dataArrayJobHistory = array(
                        'job_id' => $job_id,
                        'customer_id' => $resultJobCusInfo[0]->customer_id,
                        'job_date' => $resultJobCusInfo[0]->job_date,
                        'status' => 'Imports Manager WIP', // internal use only
                        'final_status' => 'In Progress', // customer visible
                        'status_change_date' => $date
                    );

                    $resultUpdate4 = $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);
//                    redirect("store_mgr_c_view/load_store_manager_job_form_page/" . $job_id . "");

                    $record = array("final_result" => "success");
                    echo json_encode($record);
                } else {

                    $record = array("final_result" => "unsuccess");
                    echo json_encode($record);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    /*
     * Common operations for imports manager view
     * navigation jobs count
     * navigation logged user data
     */

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
