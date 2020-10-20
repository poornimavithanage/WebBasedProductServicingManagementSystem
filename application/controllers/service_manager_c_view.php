<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Service_manager_c_view extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function dashboard_storemgr() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "3") { // store manager
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

    public function new_estimation_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "3") { // store manager
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
                $data['nav'] = "estimations";

                $this->load->view('psmsbackend/service_manager/estimations/new_estimation_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function view_estimation_detail_page() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "3") { // service manager
                $job_id = $this->input->get('var1');
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
                $data['nav'] = "estimations";

                //get the job infomation
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id); //
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

                $parts_cost = $this->db_model->join_sum('closing_stock_value', $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

                $parts_cost_double = number_format((float) $parts_cost[0]->average_cost_price, 2, '.', ''); //final
                //get the Pricing infomation
                $fieldPricingInfo_Markup = "*";
                $whereArrPricingInfo_Markup = array("type" => "Markup");
                $resultPricingInfo_Markup = $this->db_model->getData($fieldPricingInfo_Markup, "pricing_info_m_tbl", $whereArrPricingInfo_Markup);

                //get the Pricing infomation
                $fieldPricingInfo_VAT = "*";
                $whereArrPricingInfo_VAT = array("type" => "VAT");
                $resultPricingInfo_VAT = $this->db_model->getData($fieldPricingInfo_VAT, "pricing_info_m_tbl", $whereArrPricingInfo_VAT);

                //get the Pricing infomation
                $fieldPricingInfo_NBT = "*";
                $whereArrPricingInfo_NBT = array("type" => "NBT");
                $resultPricingInfo_NBT = $this->db_model->getData($fieldPricingInfo_NBT, "pricing_info_m_tbl", $whereArrPricingInfo_NBT);

                //get the job_estimate_tbl
                $fieldEstimation = "*";
                $whereArrEstimation = array("job_id" => $job_id);
                $resultEstimation = $this->db_model->getData($fieldEstimation, "job_estimate_tbl", $whereArrEstimation);

                $markup_value = $resultPricingInfo_Markup[0]->value; //final %
                $vat_value = $resultPricingInfo_VAT[0]->value; //final %
                $nbt_value = $resultPricingInfo_NBT[0]->value; //final %

                $markup_cost = $parts_cost_double * $markup_value / 100;

                $markup_cost_double = number_format((float) $markup_cost, 2, '.', ''); //final

                $total_parts_cost = number_format((float) $markup_cost_double + $parts_cost_double, 2, '.', ''); //final

                $data['estimation'] = $resultEstimation;
                $data['parts_cost'] = $parts_cost_double;
                $data['markup_value'] = $markup_value;
                $data['vat_value'] = $vat_value;
                $data['nbt_value'] = $nbt_value;
                $data['markup_cost'] = $markup_cost_double;
                $data['total_parts_cost'] = $total_parts_cost;

                $t = $markup_cost_double + $parts_cost_double;

//                var_dump($parts_cost_double);
//                var_dump($markup_cost_double);
//                var_dump($total_parts_cost);
//
//                var_dump($resultJobRepairInfo);
                //get the Parts infomation
                $fieldPartsInfo = "*";
                $whereArrPartsInfo = array("store_status" => "Available");
                $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                $data['job_info'] = $resultJobInfo;
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['parts_info'] = $resultPartsInfo;
                $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                $data['supplier_info'] = $resultSupplierInfo;

                $data['page_msg'] = "";
                
                //var_dump($resultPartsInfo);die;

                $this->load->view('psmsbackend/service_manager/estimations/estimation_assign_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function generate_estimation_pdf($job_id) {

        //get the job infomation
        $fieldJobInfo = "*";
        $whereArrJobInfo = array("job_id" => $job_id); //
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

        $parts_cost = $this->db_model->join_sum('closing_stock_value', $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

        $parts_cost_double = number_format((float) $parts_cost[0]->average_cost_price, 2, '.', ''); //final
        //get the Pricing infomation
        $fieldPricingInfo_Markup = "*";
        $whereArrPricingInfo_Markup = array("type" => "Markup");
        $resultPricingInfo_Markup = $this->db_model->getData($fieldPricingInfo_Markup, "pricing_info_m_tbl", $whereArrPricingInfo_Markup);

        //get the Pricing infomation
        $fieldPricingInfo_VAT = "*";
        $whereArrPricingInfo_VAT = array("type" => "VAT");
        $resultPricingInfo_VAT = $this->db_model->getData($fieldPricingInfo_VAT, "pricing_info_m_tbl", $whereArrPricingInfo_VAT);

        //get the Pricing infomation
        $fieldPricingInfo_NBT = "*";
        $whereArrPricingInfo_NBT = array("type" => "NBT");
        $resultPricingInfo_NBT = $this->db_model->getData($fieldPricingInfo_NBT, "pricing_info_m_tbl", $whereArrPricingInfo_NBT);

        //get the job_estimate_tbl
        $fieldEstimation = "*";
        $whereArrEstimation = array("job_id" => $job_id);
        $resultEstimation = $this->db_model->getData($fieldEstimation, "job_estimate_tbl", $whereArrEstimation);

        $markup_value = $resultPricingInfo_Markup[0]->value; //final %
        $vat_value = $resultPricingInfo_VAT[0]->value; //final %
        $nbt_value = $resultPricingInfo_NBT[0]->value; //final %

        $markup_cost = $parts_cost_double * $markup_value / 100;

        $markup_cost_double = number_format((float) $markup_cost, 2, '.', ''); //final

        $total_parts_cost = number_format((float) $markup_cost_double + $parts_cost_double, 2, '.', ''); //final

        $data['estimation'] = $resultEstimation;
        $data['parts_cost'] = $parts_cost_double;
        $data['markup_value'] = $markup_value;
        $data['vat_value'] = $vat_value;
        $data['nbt_value'] = $nbt_value;
        $data['markup_cost'] = $markup_cost_double;
        $data['total_parts_cost'] = $total_parts_cost;


//                var_dump($resultEstimation);die;
        //get the Parts infomation
        $fieldPartsInfo = "*";
        $whereArrPartsInfo = array("store_status" => "Available");
        $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

        $data['job_info'] = $resultJobInfo;
        $data['job_repair_info'] = $resultJobRepairInfo;
        $data['parts_info'] = $resultPartsInfo;
        $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
        $data['supplier_info'] = $resultSupplierInfo;
        $data['job_id'] = $job_id;


        $htmldata = $this->load->view('psmsbackend/service_manager/estimations/pdf/estimation_parts_detail_pdf', $data, TRUE);


        //Load MPDF From Library
        $this->load->library('mmpdf');
        $mmpdf = $this->mmpdf->load();
        //$mmpdf->SetHTMLHeader();
        $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

        $mmpdf->WriteHTML($htmldata);

        $mmpdf->Output("$job_id-job_estimate.pdf", 'I'); // save to folder in server
    }

    public function assign_job_to_me() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "3") { // service manager
                $job_id = $this->input->get('var1');
                $service_manager_id = $this->input->get('var2');



                $dataFieldsUpdate1 = array("service_manager_id" => $service_manager_id, "job_status" => "In Progress", "service_manager_status" => "Service Manager WIP", "current_status" => "service Manager WIP");
                $whereArrUpdate1 = array("job_id" => $job_id);

                $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                if ($resultUpdate1) {



                    $dataFieldsUpdate = array('service_manager_id' => $service_manager_id);
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
                        'status' => 'Service Manager WIP', // internal use only
                        'final_status' => 'In Progress', // customer visible
                        'status_change_date' => $date
                    );


                    $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);

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
                    $data['nav'] = "estimations";

                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id); //
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

                    $parts_cost = $this->db_model->join_sum('closing_stock_value', $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

                    $parts_cost_double = number_format((float) $parts_cost[0]->average_cost_price, 2, '.', ''); //final
                    //get the Pricing infomation
                    $fieldPricingInfo_Markup = "*";
                    $whereArrPricingInfo_Markup = array("type" => "Markup");
                    $resultPricingInfo_Markup = $this->db_model->getData($fieldPricingInfo_Markup, "pricing_info_m_tbl", $whereArrPricingInfo_Markup);

                    //get the Pricing infomation
                    $fieldPricingInfo_VAT = "*";
                    $whereArrPricingInfo_VAT = array("type" => "VAT");
                    $resultPricingInfo_VAT = $this->db_model->getData($fieldPricingInfo_VAT, "pricing_info_m_tbl", $whereArrPricingInfo_VAT);

                    //get the Pricing infomation
                    $fieldPricingInfo_NBT = "*";
                    $whereArrPricingInfo_NBT = array("type" => "NBT");
                    $resultPricingInfo_NBT = $this->db_model->getData($fieldPricingInfo_NBT, "pricing_info_m_tbl", $whereArrPricingInfo_NBT);

                    $markup_value = $resultPricingInfo_Markup[0]->value; //final %
                    $vat_value = $resultPricingInfo_VAT[0]->value; //final %
                    $nbt_value = $resultPricingInfo_NBT[0]->value; //final %

                    $markup_cost = $parts_cost_double * $markup_value / 100;

                    $markup_cost_double = number_format((float) $markup_cost, 2, '.', ''); //final

                    $total_parts_cost = number_format((float) $markup_cost_double + $parts_cost_double, 2, '.', ''); //final

                    $data['parts_cost'] = $parts_cost_double;
                    $data['markup_value'] = $markup_value;
                    $data['vat_value'] = $vat_value;
                    $data['nbt_value'] = $nbt_value;
                    $data['markup_cost'] = $markup_cost_double;
                    $data['total_parts_cost'] = $total_parts_cost;

                    $t = $markup_cost_double + $parts_cost_double;

                    //get the Parts infomation
                    $fieldPartsInfo = "*";
                    $whereArrPartsInfo = array("store_status" => "Available");
                    $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                    //get the job_estimate_tbl
                    $fieldEstimation = "*";
                    $whereArrEstimation = array("job_id" => $job_id);
                    $resultEstimation = $this->db_model->getData($fieldEstimation, "job_estimate_tbl", $whereArrEstimation);
                    
                    


                    $data['estimation'] = $resultEstimation;
                    $data['job_info'] = $resultJobInfo;
                    $data['job_repair_info'] = $resultJobRepairInfo;
                    $data['parts_info'] = $resultPartsInfo;
                    $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                    $data['supplier_info'] = $resultSupplierInfo;




                    $data['page_msg'] = "success";

                    $this->load->view('psmsbackend/service_manager/estimations/estimation_assign_page', $data);
                } else {

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
                    $data['nav'] = "estimations";

                    //get the job infomation
                    $fieldJobInfo = "*";
                    $whereArrJobInfo = array("job_id" => $job_id); //
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

                    $parts_cost = $this->db_model->join_sum('closing_stock_value', $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

                    $parts_cost_double = number_format((float) $parts_cost[0]->average_cost_price, 2, '.', ''); //final
                    //get the Pricing infomation
                    $fieldPricingInfo_Markup = "*";
                    $whereArrPricingInfo_Markup = array("type" => "Markup");
                    $resultPricingInfo_Markup = $this->db_model->getData($fieldPricingInfo_Markup, "pricing_info_m_tbl", $whereArrPricingInfo_Markup);

                    //get the Pricing infomation
                    $fieldPricingInfo_VAT = "*";
                    $whereArrPricingInfo_VAT = array("type" => "VAT");
                    $resultPricingInfo_VAT = $this->db_model->getData($fieldPricingInfo_VAT, "pricing_info_m_tbl", $whereArrPricingInfo_VAT);

                    //get the Pricing infomation
                    $fieldPricingInfo_NBT = "*";
                    $whereArrPricingInfo_NBT = array("type" => "NBT");
                    $resultPricingInfo_NBT = $this->db_model->getData($fieldPricingInfo_NBT, "pricing_info_m_tbl", $whereArrPricingInfo_NBT);

                    $markup_value = $resultPricingInfo_Markup[0]->value; //final %
                    $vat_value = $resultPricingInfo_VAT[0]->value; //final %
                    $nbt_value = $resultPricingInfo_NBT[0]->value; //final %

                    $markup_cost = $parts_cost_double * $markup_value / 100;

                    $markup_cost_double = number_format((float) $markup_cost, 2, '.', ''); //final

                    $total_parts_cost = number_format((float) $markup_cost_double + $parts_cost_double, 2, '.', ''); //final

                    $data['parts_cost'] = $parts_cost_double;
                    $data['markup_value'] = $markup_value;
                    $data['vat_value'] = $vat_value;
                    $data['nbt_value'] = $nbt_value;
                    $data['markup_cost'] = $markup_cost_double;
                    $data['total_parts_cost'] = $total_parts_cost;

                    $t = $markup_cost_double + $parts_cost_double;

//                var_dump($parts_cost_double);
//                var_dump($markup_cost_double);
//                var_dump($total_parts_cost);
//
//                var_dump($resultJobRepairInfo);
                    //get the Parts infomation
                    $fieldPartsInfo = "*";
                    $whereArrPartsInfo = array("store_status" => "Available");
                    $resultPartsInfo = $this->db_model->getData($fieldPartsInfo, "parts_inventory_m_tbl", $whereArrPartsInfo);

                    //get the job_estimate_tbl
                    $fieldEstimation = "*";
                    $whereArrEstimation = array("job_id" => $job_id);
                    $resultEstimation = $this->db_model->getData($fieldEstimation, "job_estimate_tbl", $whereArrEstimation);

                    $data['estimation'] = $resultEstimation;

                    $data['job_info'] = $resultJobInfo;
                    $data['job_repair_info'] = $resultJobRepairInfo;
                    $data['parts_info'] = $resultPartsInfo;
                    $data['supplier_purchase_info'] = $resultSupplierPurchaseInfo;
                    $data['supplier_info'] = $resultSupplierInfo;



                    $data['page_msg'] = "unsuccess";
                    $data['nav'] = "jobs";
                    $this->load->view('psmsbackend/service_manager/estimations/estimation_assign_page', $data);
                }

//                $this->load->view('psmsbackend/service_manager/estimations/estimation_assign_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function send_estimation() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

//            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                $date = date("Y-m-d");


                $job_id = $this->input->post('job_id', TRUE);
                $customer_id = $this->input->post('customer_id', TRUE);
                $page_data = $this->service_manager_view_data();

                $service_manager_id = $page_data['service_manager_id'];

                $fieldUpdate = array(
                    'estimate_desc' => $this->input->post('estimate_desc', TRUE),
                    'all_parts_cost' => $this->input->post('all_parts_cost', TRUE),
                    'parts_markup_cost' => $this->input->post('parts_markup_cost', TRUE),
                    'parts_markup_limit' => $this->input->post('parts_markup_limit', TRUE),
                    'total_parts_markup_cost_final' => $this->input->post('total_parts_markup_cost_final', TRUE),
                    'labour_cost' => $this->input->post('labour_cost', TRUE),
                    'tax_vat' => $this->input->post('tax_vat', TRUE),
                    'tax_nbt' => $this->input->post('tax_nbt', TRUE),
                    'tax_vat_limit' => $this->input->post('tax_vat_limit', TRUE),
                    'tax_nbt_limit' => $this->input->post('tax_nbt_limit', TRUE),
                    'total_job_cost' => $this->input->post('total_job_cost', TRUE),
                    'est_send_date' => $date,
                    'status' => "Pending"
                );

                $whereArray = array('job_id' => $job_id);

                $result = $this->db_model->updateData('job_estimate_tbl', $fieldUpdate, $whereArray);


                if ($result) {

                    $dataFieldsUpdate1 = array("service_manager_id" => $service_manager_id, "job_status" => "In Progress", "service_manager_status" => "Sent for estimation approval", "current_status" => "Sent for estimation approval");
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
                        'status' => 'Sent for estimation approval', // internal use only
                        'final_status' => 'Pending Estimation Approval', // customer visible
                        'status_change_date' => $date
                    );

                    $resultUpdate2 = $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);

                    $field_cus_details = "*";
                    $whereArr_cus_details = array("customer_id" => $customer_id);
                    $result_cus_details = $this->db_model->getData($field_cus_details, "customer_m_tbl", $whereArr_cus_details);



                    if ($resultUpdate1 && $resultUpdate2) {


                        $sms_message = "- STAV Job Update - <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Job estimation is sent for job " . $job_id . " to you. <br/><br/>Please visit our Customer Web Portal to approve or reject estimation to proceed further. <br/> www.psms.com/index.php/customer_portal<br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";

                        $user = "94776790257";
                        $password = "2626";
                        $text = urlencode($sms_message);
                        $to = $result_cus_details[0]->contact_no;


                        $baseurl = "http://www.textit.biz/sendmsg";
                        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
                        $ret = file($url);


                        $res = explode(":", $ret[0]);
                        
                        //add the email function [2019-10-27]
                            // load the My_PHPMailer library : Student Email
                            $this->load->library('My_PHPMailer');

                            $date = date("Y/m/d");
                            $body_message = $sms_message;
                            $maildata["subject"] = "Job Created";
                            $maildata["recepients"] = array(array('email' => $result_cus_details[0]->email));

                            $maildata["mailbody"] = $body_message;
                            $maildata["date"] = $date;
                            $maildata["altmailbody"] = "Swedish Trading Audio Visual (Pvt) Ltd. - Administration<br/><br/>";

                            $mail = new My_PHPMailer();
                            $abc = $mail->sendcustomemail($maildata);

                        if (trim($res[0]) == "OK") {

                            $record = array('final_result' => 'success');
                            echo json_encode($record);
                        } else {
                            $record = array('final_result' => 'unsuccess');
                            echo json_encode($record);
                        }
                    } else {
                        $record = array('final_result' => 'unsuccess');
                        echo json_encode($record);
                    }
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

    public function pending_estimation_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "3") { // store manager
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

                $data['tech_id'] = $service_manager_id;
                $data['new_estimation_list'] = $new_estimation_list;
                $data['new_estimation_count'] = $new_estimation_count;
                $data['pending_estimation_list'] = $pending_estimation_list;
                $data['pending_estimation_count'] = $pending_estimation_count;
                $data['approved_estimation_list'] = $approved_estimation_list;
                $data['approved_estimation_count'] = $approved_estimation_count;
                $data['rejected_estimation_list'] = $rejected_estimation_list;
                $data['rejected_estimation_count'] = $rejected_estimation_count;
                $data['nav'] = "estimations";

                $this->load->view('psmsbackend/service_manager/estimations/pending_estimation_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function estimation_chart() {


        //get the job_estimate_tbl
        $fieldEstimation1 = "*";
        $whereArrEstimation1 = array("status" => "New");
        $resultEstimation1 = $this->db_model->getData($fieldEstimation1, "job_estimate_tbl", $whereArrEstimation1);

        //get the job_estimate_tbl
        $fieldEstimation2 = "*";
        $whereArrEstimation2 = array("status" => "Pending");
        $resultEstimation2 = $this->db_model->getData($fieldEstimation2, "job_estimate_tbl", $whereArrEstimation2);


        $new_count = count($resultEstimation1);
        $pending_count = count($resultEstimation2);

//        var_dump($pending_count);die;


        $var = array("new_count" => $new_count, "pending_count" => $pending_count);

//          $var = array($new_count,$pending_count);

        echo json_encode($var);
    }

    public function sms() {



        $sms_message = "Hello Hi";

        $user = "94776790257";
        $password = "2626";
        $text = urlencode($sms_message);
        $to = "0776790257";


        $baseurl = "http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
        $ret = file($url);


        $res = explode(":", $ret[0]);

        if (trim($res[0]) == "OK") {

            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function jobs_view() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

//            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                $page_data = $this->service_manager_view_data();

                $store_m_id = $page_data['service_m_id'];
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
                $this->load->view('psmsbackend/service_manager/jobs/job_card_list_new', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function assign_job_to_me2() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                $job_id = $this->input->get('var1'); // job id
                $service_mgr_id = $this->input->get('var2'); // tech id


                $dataFieldsUpdate1 = array("service_manager_id" => $service_mgr_id, "job_status" => "In Progress", "service_manager_status" => "Service Manager WIP", "current_status" => "service Manager WIP");
                $whereArrUpdate1 = array("job_id" => $job_id);

                $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                if ($resultUpdate1) {

                    $dataFieldsUpdate = array('service_manager_id' => $service_mgr_id);
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
                        'status' => 'Service Manager WIP', // internal use only
                        'final_status' => 'In Progress', // customer visible
                        'status_change_date' => $date
                    );

                    $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);

                    redirect("service_manager_c_view/load_service_manager_job_form_page/" . $job_id . "");
                } else {

                    $data['page_msg'] = "unsucces";
                    $data['nav'] = "jobs";
                    $this->load->view('psmsbackend/service_manager/jobs/job_card_list_new', $data);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_service_manager_job_form_page($job_id) { //with assigned to me job page (service manager)
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                $page_data = $this->service_manager_view_data();

                $service_m_id = $page_data['service_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['service_m_id'] = $service_m_id;
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

                $this->load->view('psmsbackend/service_manager/jobs/service_manager_job_card_form', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function job_card_form_submit() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
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
                $approval_status = $this->input->post("approval_status", TRUE);
                $priority_level = $this->input->post("priority_level", TRUE);
                $pop_no = $this->input->post("pop_no", TRUE);
                $pop_date = $this->input->post("pop_date", TRUE);
                $supplier_id = $this->input->post("supplier_id", TRUE);
                $supplier_name = $this->input->post("supplier_name", TRUE);
                $address = $this->input->post("address", TRUE);
                $email = $this->input->post("email", TRUE);
                $phone_no = $this->input->post("phone_no", TRUE);
                $fax_no = $this->input->post("fax_no", TRUE);

                //parts on order section
                $poo_part_ref_code = $this->input->post("poo_part_ref_code", TRUE);
                $poo_part_no = $this->input->post("poo_part_no", TRUE);
                $poo_part_description = $this->input->post("poo_part_description", TRUE);
                $poo_qty = $this->input->post("poo_qty", TRUE); //requested qty
                $poo_store_qty = $this->input->post("poo_store_qty", TRUE);
                $poo_requesting_qty = $this->input->post("poo_requesting_qty", TRUE);
                $poo_note = $this->input->post("poo_note", TRUE);

                //RMA section
                $rma_part_ref_code = $this->input->post("rma_part_ref_code", TRUE);
                $rma_part_no = $this->input->post("rma_part_no", TRUE);
                $rma_part_description = $this->input->post("rma_part_description", TRUE);
                $rma_qty = $this->input->post("rma_qty", TRUE); //requested qty
                $rma_store_qty = $this->input->post("rma_store_qty", TRUE);
                $rma_note = $this->input->post("rma_note", TRUE);

                $poo_history_id = $this->get_reg_id("POOH", "poo_history_id");
                $approved_date = date("Y-m-d");
                $sent_date = "0000-00-00";
                $received_date = "0000-00-00";

                //get the service data
                $fieldServiceManagerInfo = "*";
                $whereArrServiceManagerInfo = array("emp_id" => $user_id);
                $resultServiceManagerInfo = $this->db_model->getData($fieldServiceManagerInfo, "service_manager_m_tbl", $whereArrServiceManagerInfo);

                $service_manager_id = $resultServiceManagerInfo[0]->mgr_id;
                $imports_manager_id = "";


                //updating the rma_tbl
                for ($i = 0; $i < count($rma_part_ref_code); $i++) {

                    $rma_data[] = array(
                        'part_ref_code' => $rma_part_ref_code[$i],
                        'status' => $approval_status,
                        'service_mgr_note' => $rma_note[$i]
                    );
                }

                $rma_data_single = array(
                    'part_ref_code' => $rma_part_ref_code[0],
                    'status' => $approval_status,
                    'service_mgr_note' => $rma_note[0]
                );
                $rma_whereArr = array('job_id' => $job_id, 'part_ref_code' => $rma_part_ref_code[0]);

                if (count($rma_data) > 1) {
                    $this->db->where('job_id', $job_id);
                    $this->db->update_batch('rma_tbl;', $rma_data, 'part_ref_code');
                } else if (count($rma_data) === 1) {
                    $this->db_model->updateData('rma_tbl', $rma_data_single, $rma_whereArr);
                }

                //Updating the customer_job_tbl
                $dataFieldsUpdate = array("job_status" => "In Progress", "service_manager_status" => "Send to Imports Manager", "imports_manager_status" => "New", "current_status" => "Send to Imports Manager");
                $whereArrUpdate = array("job_id" => $job_id);
                $resultUpdate = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);


                //Updating the parts_on_order_tbl
                for ($x = 0; $x < count($poo_part_ref_code); $x++) {

                    $poo_data[] = array(
                        'part_ref_code' => $poo_part_ref_code[$x],
                        'approval_status' => $approval_status,
                        'requesting_qty' => $poo_requesting_qty[$x],
                        'service_mgr_note' => $poo_note[$x]
                    );
                }

                $poo_data_single = array(
                    'part_ref_code' => $poo_part_ref_code[0],
                    'approval_status' => $approval_status,
                    'requesting_qty' => $poo_requesting_qty[0],
                    'service_mgr_note' => $poo_note[0]
                );
                $poo_whereArr = array('job_id' => $job_id, 'part_ref_code' => $poo_part_ref_code[0]);

                if (count($poo_data) > 1) {
                    $this->db->where('job_id', $job_id);
                    $this->db->update_batch('parts_on_order_tbl;', $poo_data, 'part_ref_code');
                } else if (count($poo_data) === 1) {
                    $this->db_model->updateData('parts_on_order_tbl', $poo_data_single, $poo_whereArr);
                }


                //Updating the job_repair_info_tbl
                for ($y = 0; $y < count($poo_part_ref_code); $y++) {

                    $poo_job_repair_info_data[] = array(
                        'part_ref_code' => $poo_part_ref_code[$y],
                        'requesting_qty' => $poo_requesting_qty[$y]
                    );
                }

                $poo_job_repair_info_data_single = array(
                    'part_ref_code' => $poo_part_ref_code[0],
                    'requesting_qty' => $poo_requesting_qty[0]
                );
                $poo_job_repair_info_whereArr = array('job_id' => $job_id, 'part_ref_code' => $poo_part_ref_code[0]);

                if (count($poo_job_repair_info_data) > 1) {
                    $this->db->where('job_id', $job_id);
                    $this->db->update_batch('job_repair_info_tbl;', $poo_job_repair_info_data, 'part_ref_code');
                } else if (count($poo_job_repair_info_data) === 1) {
                    $this->db_model->updateData('job_repair_info_tbl', $poo_job_repair_info_data_single, $poo_job_repair_info_whereArr);
                }


                //Inserting the parts_on_order_history_tbl
                for ($y = 0; $y < count($poo_part_ref_code); $y++) {

                    $poo_history_data[] = array(
                        'poo_history_id' => $poo_history_id,
                        'part_ref_code' => $poo_part_ref_code[$y],
                        'part_no' => $poo_requesting_qty[$y],
                        'part_description' => $poo_part_description[$y],
                        'store_qty_level' => $poo_store_qty[$y],
                        'requesting_qty_level' => $poo_requesting_qty[$y],
                        'approved_date' => $approved_date,
                        'sent_date' => $sent_date,
                        'received_date' => $received_date,
                        'service_manager_id' => $service_manager_id,
                        'imports_manager_id' => $imports_manager_id,
                        'supplier_id' => $supplier_id,
                        'job_id' => $job_id,
                        'priority_level' => $priority_level
                    );
                }


                $poo_history_data_single = array(
                    'poo_history_id' => $poo_history_id,
                    'part_ref_code' => $poo_part_ref_code[0],
                    'part_no' => $poo_requesting_qty[0],
                    'part_description' => $poo_part_description[0],
                    'store_qty_level' => $poo_store_qty[0],
                    'requesting_qty_level' => $poo_requesting_qty[0],
                    'approved_date' => $approved_date,
                    'sent_date' => $sent_date,
                    'received_date' => $received_date,
                    'service_manager_id' => $service_manager_id,
                    'imports_manager_id' => $imports_manager_id,
                    'supplier_id' => $supplier_id,
                    'job_id' => $job_id,
                    'priority_level' => $priority_level
                );

                if (count($poo_history_data) > 1) {

                    //get the service data
                    $fieldPooHistoryInfo = "*";
                    $whereArrPooHistoryInfo = array("job_id" => $job_id);
                    $resultPooHistoryInfo = $this->db_model->getData($fieldPooHistoryInfo, "parts_on_order_history_tbl", $whereArrPooHistoryInfo);
                    $poo_history_id_for_update = $resultPooHistoryInfo[0]->poo_history_id;

                    if (count($resultPooHistoryInfo) > 0) {


                        //Inserting the parts_on_order_history_tbl for UPDATE
                        for ($y = 0; $y < count($poo_part_ref_code); $y++) {

                            $poo_history_data_for_update[] = array(
                                'poo_history_id' => $poo_history_id_for_update,
                                'part_ref_code' => $poo_part_ref_code[$y],
                                'part_no' => $poo_requesting_qty[$y],
                                'part_description' => $poo_part_description[$y],
                                'store_qty_level' => $poo_store_qty[$y],
                                'requesting_qty_level' => $poo_requesting_qty[$y],
                                'approved_date' => $approved_date,
                                'sent_date' => $sent_date,
                                'received_date' => $received_date,
                                'service_manager_id' => $service_manager_id,
                                'imports_manager_id' => $imports_manager_id,
                                'supplier_id' => $supplier_id,
                                'job_id' => $job_id,
                                'priority_level' => $priority_level
                            );
                        }

                        $this->db->where('job_id', $job_id);
                        $this->db->update_batch('parts_on_order_history_tbl;', $poo_history_data_for_update, 'part_ref_code');
                    } else {
                        $this->db->insert_batch('parts_on_order_history_tbl;', $poo_history_data);
                    }
                } else if (count($poo_history_data) === 1) {

                    //get the service data
                    $fieldPooHistoryInfo = "*";
                    $whereArrPooHistoryInfo = array("job_id" => $job_id);
                    $resultPooHistoryInfo = $this->db_model->getData($fieldPooHistoryInfo, "parts_on_order_history_tbl", $whereArrPooHistoryInfo);


                    if (count($resultPooHistoryInfo) > 0) {

                        $poo_history_id_for_update = $resultPooHistoryInfo[0]->poo_history_id;

                        //Inserting the parts_on_order_history_tbl for UPDATE
                        $poo_history_data_single_for_update = array(
                            'requesting_qty_level' => $poo_requesting_qty[0]
                        );

                        $where = array('job_id' => $job_id, 'part_ref_code' => $poo_part_ref_code[0]);
                        $this->db_model->updateData('parts_on_order_history_tbl;', $poo_history_data_single_for_update, $where);
                    } else {
                        $this->db_model->insertData('parts_on_order_history_tbl', $poo_history_data_single);
                    }
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

            if ($user_role_id === "3") { // service manager
                $job_id = $this->input->get('var1'); //job id
                $result_msg = $this->input->get('var2'); //successmsg

                $page_data = $this->service_manager_view_data();

                $service_m_id = $page_data['service_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['service_m_id'] = $service_m_id;
                $data['new_job_list'] = $new_job_list;
                $data['new_job_count'] = $new_job_count;
                $data['assigned_to_me_job_list'] = $assigned_to_me_job_list;
                $data['assigned_to_me_job_count'] = $assigned_to_me_job_count;

                $data['page_msg'] = "";

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                // var_dump($result_msg);die;                           
                if ($result_msg == "success") {
                    $data['page_msg'] = "sent_to_service_manager";
                } else {
                    $data['page_msg'] = "";
                }


                $data['job_id'] = $job_id;

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/service_manager/jobs/job_card_list_assigned_to_me', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function load_service_mgr_job_form_page_method($job_id) { //Assigned to me Page Update button
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "3") { // service manager
                $page_data = $this->service_manager_view_data();

                $service_m_id = $page_data['service_m_id'];
                $new_job_list = $page_data['new_job_list'];
                $new_job_count = $page_data['new_job_count'];
                $assigned_to_me_job_list = $page_data['assigned_to_me_job_list'];
                $assigned_to_me_job_count = $page_data['assigned_to_me_job_count'];

                $data['service_m_id'] = $service_m_id;
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

                $this->load->view('psmsbackend/service_manager/jobs/service_manager_job_card_form', $data);
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

}
