<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Customer_web_portal_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function login_page() {

        $data['page_msg'] = "";

        $this->load->view('psmsfrontend/pages/login', $data);
    }

    public function login_verification() {

        $username = $this->input->post("username", TRUE);
        $password = $this->input->post("password", TRUE);


        $password_sha1 = sha1($password);

        $fields = "*";
        $whereArr = array("username" => $username, "password" => $password_sha1);
        $data_res = $this->db_model->getData($fields, 'user_login_m_tbl', $whereArr);


        if (count($data_res) === 1) {

            $sess_array = array(
                'user_id' => $data_res[0]->user_id,
                'username' => $data_res[0]->username,
                'user_role_id' => $data_res[0]->user_role_id);

            $this->session->set_userdata('logged_in', $sess_array);

            redirect('customer_web_portal_c/customer_web_portal_dashboard');
        } else {

            $data['page_msg'] = "invalid_user";
            $this->load->view('psmsfrontend/pages/login', $data);
        }
    }

    public function reset_password_request_page() {


        $data['page_msg'] = "";
        $this->load->view('psmsfrontend/pages/reset_password_request_page', $data);
    }

    public function reset_password_request() {

        $username = $this->input->post("username", TRUE);

        $fields = "*";
        $whereArr = array("username" => $username);
        $data_res = $this->db_model->getData($fields, 'user_login_m_tbl', $whereArr);



        if (count($data_res) === 1) {


            $this->load->helper('string');
            $customer_temp_password = random_string('numeric', 6);



            $dataArrayCustomerLoginUpdate = array(
                'temp_password' => $customer_temp_password
            );
            $whereArrIdUpdate = array('username' => $data_res[0]->username);

            $result_update = $this->db_model->updateData('user_login_m_tbl', $dataArrayCustomerLoginUpdate, $whereArrIdUpdate);


            if ($result_update) {

                $fields1 = "*";
                $whereArr1 = array("email" => $data_res[0]->username);
                $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);

                $connected = @fsockopen("www.google.lk", 80);
                //website, port  (try 80 or 443)
                if ($connected) {

                    $sms_message = "- STAV Password Reset- <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Please use this code for password reset<br/> Code:  " . $customer_temp_password . ". <br/><br/>Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";


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


                        $data['page_msg'] = "success";
                        $data['username'] = $username;
                        $this->load->view('psmsfrontend/pages/password_verification_check_form_page', $data);
                    } else {

                        $data['page_msg'] = "unsuccess_sms";
                        $this->load->view('psmsfrontend/pages/reset_password_request_page', $data);
                    }
                } else {
                    $data['page_msg'] = "unsuccess_sms";
                    $this->load->view('psmsfrontend/pages/reset_password_request_page', $data);
                }
            } else {

                $data['page_msg'] = "unsuccess";
                $this->load->view('psmsfrontend/pages/reset_password_request_page', $data);
            }
        } else {

            $data['page_msg'] = "invalid_user";
            $this->load->view('psmsfrontend/pages/reset_password_request_page', $data);
        }
    }

    public function password_verification_code_submit() {

        $username = $this->input->post("username", TRUE);
        $verification_code = $this->input->post("verification_code", TRUE);


        $fields = "*";
        $whereArr = array("username" => $username, "temp_password" => $verification_code);
        $data_res = $this->db_model->getData($fields, 'user_login_m_tbl', $whereArr);

        if ($data_res) {

            $data['page_msg'] = "success";
            $data['username'] = $username;
            $this->load->view('psmsfrontend/pages/new_password_submit_page', $data);
        } else {
            $data['page_msg'] = "invalid_code";
            $data['username'] = $username;
            $this->load->view('psmsfrontend/pages/password_verification_check_form_page', $data);
        }
    }

    public function new_password_submit() {

        $username = $this->input->post("new_username", TRUE);
        $new_password = $this->input->post("new_password", TRUE);

        $password_sha = sha1($new_password);

        $dataArrayCustomerLoginUpdate = array(
            'password' => $password_sha
        );
        $whereArrIdUpdate = array('username' => $username);

        $result_update = $this->db_model->updateData('user_login_m_tbl', $dataArrayCustomerLoginUpdate, $whereArrIdUpdate);

        $fields1 = "*";
        $whereArr1 = array("email" => $username);
        $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


        if ($result_update) {

            $connected = @fsockopen("www.google.lk", 80);
            //website, port  (try 80 or 443)
            if ($connected) {

                $sms_message = "- STAV Password Reset- <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Your password has been successfully reseted, Your new password is <br/> " . $new_password . ". <br/><br/>Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";


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


                    $data['page_msg'] = "success";
                    $this->load->view('psmsfrontend/pages/login', $data);
                } else {

                    $data['page_msg'] = "unsuccess_sms";
                    $this->load->view('psmsfrontend/pages/new_password_submit_page', $data);
                }
            } else {
                $data['page_msg'] = "unsuccess_sms";
                $this->load->view('psmsfrontend/pages/new_password_submit_page', $data);
            }
        } else {
            $data['page_msg'] = "unsuccess";
            $this->load->view('psmsfrontend/pages/new_password_submit_page', $data);
        }
    }

    public function customer_web_portal_dashboard() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            $fields1 = "*";
            $whereArr1 = array("customer_id" => $user_id);
            $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


            if ($user_role_id === "7") { //customer
                //get the customer details
                $fieldsCusDetails = array('*');
                $whereArrayCusDetails = array('customer_id' => $result_cus_details[0]->customer_id);
                $resultCusDetails = $this->db_model->getData($fieldsCusDetails, 'customer_m_tbl', $whereArrayCusDetails);

                //get all New jobs
                $fieldsNewJob = array('*');
                $whereArrayNewJob = array('customer_id' => $result_cus_details[0]->customer_id, 'job_status' => "New");
                $resultNewJob = $this->db_model->getData($fieldsNewJob, 'customer_job_tbl', $whereArrayNewJob);

                //get all in progress jobs jobs
                $fieldsInProgressJob = array('*');
                $whereArrayInProgressJob = array('customer_id' => $result_cus_details[0]->customer_id, 'job_status' => "In Progress");
                $resultInProgressJob = $this->db_model->getData($fieldsInProgressJob, 'customer_job_tbl', $whereArrayInProgressJob);


                //get the all finished not collected jobs
                $fieldsFinishedNotCollected = array('*');
                $whereArrayFinishedNotCollected = array('customer_id' => $result_cus_details[0]->customer_id, 'job_status' => "Finished not collected");
                $resultFinishedNotCollected = $this->db_model->getData($fieldsFinishedNotCollected, 'customer_job_tbl', $whereArrayFinishedNotCollected);


                //get the closed jobs
                $fieldsOrderFinished = array('*');
                $whereArrayOrderFinished = array('customer_id' => $result_cus_details[0]->customer_id, 'job_status' => "Order Finished");
                $resultOrderFinished = $this->db_model->getData($fieldsOrderFinished, 'customer_job_tbl', $whereArrayOrderFinished);
//                get the all closed jobs
//                $fields1 = '*';
//                $wherefieldtablefrom1 = array("customer_job_tbl.customer_id" => $result_cus_details[0]->customer_id, "customer_job_history_tbl.final_status" => "Order Finished");
//                $tablefrom1 = 'customer_job_tbl';
//                $tablejoin1 = 'customer_job_history_tbl';
//                $tablejoincondition1 = 'customer_job_tbl.customer_id = customer_job_history_tbl.customer_id';
//                $resultOrderFinished = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);
                //get all Pending estimation jobs
                $fieldsPendingEstimations = array('*');
                $whereArrayPendingEstimations = array('customer_id' => $result_cus_details[0]->customer_id, 'status' => "Pending");
                $resultPendingEstimations = $this->db_model->getData($fieldsPendingEstimations, 'job_estimate_tbl', $whereArrayPendingEstimations);



                $data['customer_details'] = $resultCusDetails;
                $data['in_progress_jobs'] = $resultInProgressJob;
                $data['new_jobs'] = $resultNewJob;
                $data['finished_not_collected'] = $resultFinishedNotCollected;
                $data['closed_jobs'] = $resultOrderFinished;
                $data['pending_estimation'] = $resultPendingEstimations;


                $this->load->view('psmsfrontend/pages/customer_web_portal_dashboard', $data);
            } else {

                $this->load->view('psmsfrontend/403_error_page');
            }
        } else {

            $this->load->view('psmsfrontend/401_error_page');
        }
    }

    public function job_estimate_pdf($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            $fields1 = "*";
            $whereArr1 = array("customer_id" => $user_id);
            $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


            if ($user_role_id === "7") { //customer
                $fields1 = array('*');
                $whereArray1 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res1 = $this->db_model->getData($fields1, 'customer_job_history_tbl', $whereArray1);

                $fields2 = array('*');
                $whereArray2 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res2 = $this->db_model->getData($fields2, 'customer_job_tbl', $whereArray2);


                ///get the warranty informations
                $fields3 = array('*');
                $whereArray3 = array('serial_no' => $res2[0]->serial_no);
                $salesOrderDetails_result = $this->db_model->getData($fields3, 'supplier_product_sno_m_tbl', $whereArray3);

                $fields4 = array('*');
                $whereArray4 = array('sales_order_no' => $salesOrderDetails_result[0]->sales_order_no, 'category' => $salesOrderDetails_result[0]->category, 'make' => $salesOrderDetails_result[0]->make, 'model' => $salesOrderDetails_result[0]->model);
                $warranty_info_details = $this->db_model->getData($fields4, 'supplier_purchase_m_tbl', $whereArray4);

                $fields5 = array('*');
                $whereArray5 = array('serial_no' => $res2[0]->serial_no);
                $bill_line_item_details = $this->db_model->getData($fields5, 'bill_line_item_m_tbl', $whereArray5);


                $warranty_end_date = date('Y-m-d', strtotime("+" . $warranty_info_details[0]->warranty_years . "months", strtotime($bill_line_item_details[0]->invoice_date)));



                ////////////////////////////////////////////////////////////////////////
                $fields6 = array('*');
                $whereArray6 = array('job_id' => $job_id);
                $job_estimate = $this->db_model->getData($fields6, 'job_estimate_tbl', $whereArray6);



//                $data['job_info_1'] = $res1;
                $data['cus_job_info'] = $res2;
                $data['invoice_no'] = $bill_line_item_details[0]->invoice_no;
                $data['invoice_date'] = $bill_line_item_details[0]->invoice_date;
                $data['warranty_end_date'] = $warranty_end_date;
                $data['job_estimate'] = $job_estimate;

                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);


                $fieldCusInfo = "*";
                $whereArrCusInfo = array('customer_id' => $resultJobInfo[0]->customer_id);
                $resultCusnfo = $this->db_model->getData($fieldCusInfo, "customer_m_tbl", $whereArrCusInfo);


                $data['job_info'] = $resultJobInfo;
                $data['cus_info'] = $resultCusnfo;


                $htmldata = $this->load->view('psmsfrontend/pages/customer_web_portal/job_estimations/job_estimation_pdf', $data, TRUE);


                //Load MPDF From Library
                $this->load->library('mmpdf');
                $mmpdf = $this->mmpdf->load();
                //$mmpdf->SetHTMLHeader();
                $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

                $mmpdf->WriteHTML($htmldata);

                $path = "./uploads/customer_webportal/job_estimations/" . $job_id . "/";
                if (!is_dir($path)) { //create the folder if it's not already exists
                    mkdir($path, 0755, TRUE);
                }

                $mmpdf->Output($path . "job_estimation-.$job_id.pdf", 'F'); // save to folder in server 

                $mmpdf->Output("job_estimation-.$job_id.pdf", 'I'); // save to folder in server 
            } else {

                $this->load->view('psmsfrontend/403_error_page');
            }
        } else {

            $this->load->view('psmsfrontend/401_error_page');
        }
    }

    public function new_job_detail_view_page($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            $fields1 = "*";
            $whereArr1 = array("customer_id" => $user_id);
            $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


            if ($user_role_id === "7") { //customer
                $fields1 = array('*');
                $whereArray1 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res1 = $this->db_model->getData($fields1, 'customer_job_history_tbl', $whereArray1);

                $fields2 = array('*');
                $whereArray2 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res2 = $this->db_model->getData($fields2, 'customer_job_tbl', $whereArray2);


                ///get the warranty informations
                $fields3 = array('*');
                $whereArray3 = array('serial_no' => $res2[0]->serial_no);
                $salesOrderDetails_result = $this->db_model->getData($fields3, 'supplier_product_sno_m_tbl', $whereArray3);

                $fields4 = array('*');
                $whereArray4 = array('sales_order_no' => $salesOrderDetails_result[0]->sales_order_no, 'category' => $salesOrderDetails_result[0]->category, 'make' => $salesOrderDetails_result[0]->make, 'model' => $salesOrderDetails_result[0]->model);
                $warranty_info_details = $this->db_model->getData($fields4, 'supplier_purchase_m_tbl', $whereArray4);

                $fields5 = array('*');
                $whereArray5 = array('serial_no' => $res2[0]->serial_no);
                $bill_line_item_details = $this->db_model->getData($fields5, 'bill_line_item_m_tbl', $whereArray5);


                $warranty_end_date = date('Y-m-d', strtotime("+" . $warranty_info_details[0]->warranty_years . "months", strtotime($bill_line_item_details[0]->invoice_date)));


                $data['job_info'] = $res1;
                $data['cus_job_info'] = $res2;
                $data['invoice_no'] = $bill_line_item_details[0]->invoice_no;
                $data['invoice_date'] = $bill_line_item_details[0]->invoice_date;
                $data['warranty_end_date'] = $warranty_end_date;


                $this->load->view('psmsfrontend/pages/customer_web_portal/new_job_detail_page', $data);
            } else {

                $this->load->view('psmsfrontend/403_error_page');
            }
        } else {

            $this->load->view('psmsfrontend/401_error_page');
        }
    }

    public function job_detail_view_page($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            $fields1 = "*";
            $whereArr1 = array("customer_id" => $user_id);
            $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


            if ($user_role_id === "7") { //customer
                $fields1 = array('*');
                $whereArray1 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res1 = $this->db_model->getData($fields1, 'customer_job_history_tbl', $whereArray1);

                $fields2 = array('*');
                $whereArray2 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res2 = $this->db_model->getData($fields2, 'customer_job_tbl', $whereArray2);


                ///get the warranty informations
                $fields3 = array('*');
                $whereArray3 = array('serial_no' => $res2[0]->serial_no);
                $salesOrderDetails_result = $this->db_model->getData($fields3, 'supplier_product_sno_m_tbl', $whereArray3);

                $fields4 = array('*');
                $whereArray4 = array('sales_order_no' => $salesOrderDetails_result[0]->sales_order_no, 'category' => $salesOrderDetails_result[0]->category, 'make' => $salesOrderDetails_result[0]->make, 'model' => $salesOrderDetails_result[0]->model);
                $warranty_info_details = $this->db_model->getData($fields4, 'supplier_purchase_m_tbl', $whereArray4);

                $fields5 = array('*');
                $whereArray5 = array('serial_no' => $res2[0]->serial_no);
                $bill_line_item_details = $this->db_model->getData($fields5, 'bill_line_item_m_tbl', $whereArray5);


                $warranty_end_date = date('Y-m-d', strtotime("+" . $warranty_info_details[0]->warranty_years . "months", strtotime($bill_line_item_details[0]->invoice_date)));


                $data['job_info'] = $res1;
                $data['cus_job_info'] = $res2;
                $data['invoice_no'] = $bill_line_item_details[0]->invoice_no;
                $data['invoice_date'] = $bill_line_item_details[0]->invoice_date;
                $data['warranty_end_date'] = $warranty_end_date;


                $this->load->view('psmsfrontend/pages/customer_web_portal/job_detail_view_page', $data);
            } else {

                $this->load->view('psmsfrontend/403_error_page');
            }
        } else {

            $this->load->view('psmsfrontend/401_error_page');
        }
    }

    public function job_estimation_detail_form_page($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            $fields1 = "*";
            $whereArr1 = array("customer_id" => $user_id);
            $result_cus_details = $this->db_model->getData($fields1, 'customer_m_tbl', $whereArr1);


            if ($user_role_id === "7") { //customer
//                $job_id = $this->input->get('var1');
                $fields1 = array('*');
                $whereArray1 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res1 = $this->db_model->getData($fields1, 'customer_job_history_tbl', $whereArray1);

                $fields2 = array('*');
                $whereArray2 = array('job_id' => $job_id, 'customer_id' => $result_cus_details[0]->customer_id);
                $res2 = $this->db_model->getData($fields2, 'customer_job_tbl', $whereArray2);


                ///get the warranty informations
                $fields3 = array('*');
                $whereArray3 = array('serial_no' => $res2[0]->serial_no);
                $salesOrderDetails_result = $this->db_model->getData($fields3, 'supplier_product_sno_m_tbl', $whereArray3);

                $fields4 = array('*');
                $whereArray4 = array('sales_order_no' => $salesOrderDetails_result[0]->sales_order_no, 'category' => $salesOrderDetails_result[0]->category, 'make' => $salesOrderDetails_result[0]->make, 'model' => $salesOrderDetails_result[0]->model);
                $warranty_info_details = $this->db_model->getData($fields4, 'supplier_purchase_m_tbl', $whereArray4);

                $fields5 = array('*');
                $whereArray5 = array('serial_no' => $res2[0]->serial_no);
                $bill_line_item_details = $this->db_model->getData($fields5, 'bill_line_item_m_tbl', $whereArray5);


                $warranty_end_date = date('Y-m-d', strtotime("+" . $warranty_info_details[0]->warranty_years . "months", strtotime($bill_line_item_details[0]->invoice_date)));



                ////////////////////////////////////////////////////////////////////////
                $fields6 = array('*');
                $whereArray6 = array('job_id' => $job_id);
                $job_estimate = $this->db_model->getData($fields6, 'job_estimate_tbl', $whereArray6);



                $data['job_info'] = $res1;
                $data['cus_job_info'] = $res2;
                $data['invoice_no'] = $bill_line_item_details[0]->invoice_no;
                $data['invoice_date'] = $bill_line_item_details[0]->invoice_date;
                $data['warranty_end_date'] = $warranty_end_date;
                $data['job_estimate'] = $job_estimate;


                $this->load->view('psmsfrontend/pages/customer_web_portal/job_estimations/job_estimation_detail_page', $data);
            } else {

                $this->load->view('psmsfrontend/403_error_page');
            }
        } else {

            $this->load->view('psmsfrontend/401_error_page');
        }
    }

    public function customer_job_estimation_submit() {

        $job_id = $this->input->post('job_id', TRUE);
        $approval_status = $this->input->post('approval_status', TRUE);

        $dataFieldsUpdate = array('status' => $approval_status);
        $whereArrUpdate = array('job_id' => $job_id);
        $resultUpdate = $this->db_model->updatedata("job_estimate_tbl", $dataFieldsUpdate, $whereArrUpdate);


        if ($approval_status === "Approved") {

            $current_status = "Estimation Approved";

            $dataFieldsUpdate1 = array('current_status' => $current_status, 'service_manager_status' => 'Completed', 'store_manager_status' => "Store Manager WIP");
            $whereArrUpdate1 = array('job_id' => $job_id);
            $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1);

            //get the job infomation
            $fieldJobInfo = "*";
            $whereArrJobInfo = array("job_id" => $job_id);
            $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);

            $date = date('Y-m-d');
            $job_history_details = array(
                'job_id' => $job_id,
                'customer_id' => $resultJobInfo[0]->customer_id,
                'job_date' => $resultJobInfo[0]->job_date,
                'status' => "Estimation Approved",
                'final_status' => "In Progress",
                'status_change_date' => $date
            );

            $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

            if ($resultUpdate1 && $result_customer_job_history_info && $resultUpdate) {

                $var = array("final_result" => "success", "status" => $approval_status);
                echo json_encode($var);
            } else {

                $var = array("final_result" => "unsuccess");
                echo json_encode($var);
            }
        } else {
            $current_status = "Estimation Rejected";

            //get the job infomation
            $fieldJobEst = "*";
            $whereArrJobEst = array("job_id" => $job_id);
            $resultJobEst = $this->db_model->getData($fieldJobEst, "job_estimate_tbl", $whereArrJobEst);

            $vat = $resultJobEst[0]->tax_vat;
            $nbt = $resultJobEst[0]->tax_nbt;

            $total_value = (1000 + $vat + $nbt);


            $dataFieldsUpdate = array('est_inspect_fee' => $total_value);
            $whereArrUpdate = array('job_id' => $job_id);
            $resultUpdate = $this->db_model->updatedata("job_estimate_tbl", $dataFieldsUpdate, $whereArrUpdate);

            //get the job infomation
            $fieldJobInfo = "*";
            $whereArrJobInfo = array("job_id" => $job_id);
            $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);


            $date = date('Y-m-d');
            $job_history_details = array(
                'job_id' => $job_id,
                'customer_id' => $resultJobInfo[0]->customer_id,
                'job_date' => $resultJobInfo[0]->job_date,
                'status' => "Estimation Rejected",
                'final_status' => "Estimation Rejected, Not Collected",
                'status_change_date' => $date
            );

            $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

            $dataFieldsUpdate1 = array('job_status' => 'Estimation Rejected, Not Collected', 'current_status' => $current_status, 'service_manager_status' => 'Completed', 'store_manager_status' => "Completed", 'technician_status' => 'Completed', 'imports_manager_status' => 'Completed');
            $whereArrUpdate1 = array('job_id' => $job_id);
            $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1);

            if ($resultUpdate1 && $result_customer_job_history_info && $resultUpdate) {

                $var = array("final_result" => "success", "status" => $approval_status);
                echo json_encode($var);
            } else {

                $var = array("final_result" => "unsuccess");
                echo json_encode($var);
            }
        }

//        $dataFieldsUpdate1 = array('current_status' => $approval_status);
//        $whereArrUpdate1 = array('job_id' => $job_id);
//        $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate, $whereArrUpdate);
    }

    public function job_progress() {
        $data['nav'] = "jobs";


        $fields1 = array('*');
        $whereArray1 = array('job_id' => "35015", 'customer_id' => $result_cus_details[0]->customer_id);
        $res1 = $this->db_model->getData($fields1, 'customer_job_history_tbl', $whereArray1);

        $fields2 = array('*');
        $whereArray2 = array('job_id' => "35015", 'customer_id' => $result_cus_details[0]->customer_id);
        $res2 = $this->db_model->getData($fields2, 'customer_job_tbl', $whereArray2);

        $data['job_info'] = $res1;
        $data['cus_job_info'] = $res2;


//        var_dump($res);



        $this->load->view('psmsfrontend/pages/customer_web_portal/job_progress_page', $data);
    }

}
