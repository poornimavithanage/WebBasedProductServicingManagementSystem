<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class billing_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard', $data);
    }
    
    public function bill_m_tbl_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin     
                $fieldset = "*";
                $whereArray = "";
                $bill_all_list = $this->db_model->getData($fieldset, 'bill_m_tbl', $whereArray);

                $data['all_bill_list'] = $bill_all_list;

                $data['nav'] = "warranty_details";
                $this->load->view('psmsbackend/pages/invoices/bill_m_list_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function view_invoice_details($invoice_no) {
        
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin
//           
                
                //get bill_m_tbl details: contact
                $fieldsetbill = array('*');
                $whereArraybill = array('invoice_no' => $invoice_no);        
                $resultbill = $this->db_model->getData($fieldsetbill, 'bill_m_tbl', $whereArraybill);

                //get invoice details
                $fieldsetInv = array('*');
                $whereArrayInv = array('invoice_no' => $invoice_no);        
                $resultInvDetails = $this->db_model->getData($fieldsetInv, 'bill_line_item_m_tbl', $whereArrayInv);
                
                //get customer details
                $fieldsetCus = array('*');
                $whereArrayCus = array('customer_id' => $resultbill[0]->customer_id);        
                $resultCusDetails = $this->db_model->getData($fieldsetCus, 'customer_m_tbl', $whereArrayCus);
                
                $data['Invoice_details']=$resultInvDetails;
                $data['bill_m_details']=$resultbill;
                $data['cus_details']=$resultCusDetails;
                
                
//                var_dump($resultbill[0]->customer_id);die;
                
                $data['nav'] = "warranty_details"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/invoices/invoice_details_page',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }  
    }
//    public function sales_warranty_view() {
//
//        //selecting all the active sales warranty
//        $fieldset = array('*');
//        $whereArray = "";
//        $result = $this->db_model->getData($fieldset, 'billing_tbl', $whereArray);
//
//
//        $data['active_customer_warranty'] = $result; //contains active warranty (associative array)
//
//        $data['nav'] = "warranty_details"; // this is for highligting left navigation tab (associative array) 
//        $this->load->view('psmsbackend/pages/invoices/sales_warranty_list', $data);
//    }
//
//    public function import_bill_data_save_1() {
//
//        $updated_id = $this->get_reg_id("WAR", "Warranty_Card");
//
//        $fieldset = array('*');
//        $whereArray = array('status' => 'active');
//        $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray);
//
//        $data['cus_list'] = $result;
//        $data['bill_id'] = $updated_id;
//        $data['page_msg'] = "Add new warranty";
//
//        $data['nav'] = "warranty_details"; // this is for highligting left navigation tab (associative array) 
//        $this->load->view('psmsbackend/pages/invoices/add_sales_warranty_new', $data);
//    }
//
//    public function add_sales_warranty_page_existing() {
//
//        $updated_id = $this->get_reg_id("WAR", "Warranty_Card");
//
//        $fieldset = array('*');
//        $whereArray = array('status' => 'active');
//        $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray);
//
//        //get the exsisting invoice number to exsiting warranty page
//        $fieldset_inv_n = array('*');
//        $whereArray_inv_n = "";
//        $groupfield_inv_n = "invoice_id";
//        $result_inv_n = $this->db_model->getDataGroup($fieldset_inv_n, 'billing_tbl', $whereArray_inv_n, $groupfield_inv_n);
//
//        $data['cus_inoice_no'] = $result_inv_n;
//
//        $data['cus_list'] = $result;
//        $data['bill_id'] = $updated_id;
//        $data['page_msg'] = "Add existing warranty";
//
//        $data['nav'] = "warranty_details"; // this is for highligting left navigation tab (associative array) 
//        $this->load->view('psmsbackend/pages/invoices/add_sales_warranty_existing', $data);
//    }

    public function import_bill_data_page() {


        $data['page_msg'] = "Import Bill Data From CSV";

        $data['nav'] = "warranty_details"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/invoices/import_bill_data_page', $data);
    }

    public function import_bill() {

        $this->load->library('csvimport');
        $file_data = $this->csvimport->get_array($_FILES["bill"]["tmp_name"]);
        foreach ($file_data as $row) {
            $data[] = array(
                'invoice_no' => $row["INVOICE_NO"],
                'invoice_date' => $row["INVOICE_DATE"],
                'total_amount' => $row["TOTAL_AMOUNT"],
                'customer_id' => $row["CUSTOMER_ID"]
            );
        }

        $result = $this->db_model->insertExcel('bill_m_tbl', $data);
        
        if ($result) {
            $var = array("final_result" => "success");
            echo json_encode($var);
        } else {
            $var = array("final_result" => "unsuccess");
            echo json_encode($var);
        }
    }
    
    
    public function import_bill_line_item() {

        $this->load->library('csvimport');
        $file_data = $this->csvimport->get_array($_FILES["bill_line_item"]["tmp_name"]);
        foreach ($file_data as $row) {
            $data[] = array(
                'invoice_no' => $row["INVOICE_NO"],
                'bill_line_item_no' => $row["BILL_LINE_ITEM_NO"],
                'category' => $row["CATEGORY"],
                'make' => $row["MAKE"],
                'model' => $row["MODEL"],
                'serial_no' => $row["SERIAL_NO"],
                'invoice_date' => $row["INVOICE_DATE"],
            );
        }

        $result = $this->db_model->insertExcel('bill_line_item_m_tbl', $data);

        if ($result) {
            $var = array("final_result" => "success");
            echo json_encode($var);
        } else {
            $var = array("final_result" => "unsuccess");
            echo json_encode($var);
        }
    }

    public function get_invoiced_date($invoice_id) {

        $fieldset_inv_no_d = array('*');
        $whereArray_inv_no_d = array("invoice_no" => $invoice_id);
        $groupfield_inv_no_d = "invoice_date";
        $result_inv_no_d = $this->db_model->getDataGroup($fieldset_inv_no_d, 'billing_tbl', $whereArray_inv_no_d, $groupfield_inv_no_d);

        //get the customer name using customer ID from $result_inv_no_d
        $fieldset = array('*');
        $whereArray = array('customer_id' => $result_inv_no_d[0]->customer_id);
        $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray);


        $invoice_date = array('invoice_date' => $result_inv_no_d[0]->invoice_date, 'customer_id' => $result_inv_no_d[0]->customer_id, 'customer_name' => $result[0]->cus_name);
        echo json_encode($invoice_date);
    }

    public function abc() {

        $fieldset = array('*');
        $whereArray = "";
        // $whereArray = array('invoice_no' => 'KA1003');    
        $groupfield = "invoice_id";
        $result = $this->db_model->getDataGroup($fieldset, 'billing_tbl', $whereArray, $groupfield);

        foreach ($result as $key) {
            echo $key->invoice_id . "<br/>";
        }
    }

    public function add_sales_warranty_new() {

        $updated_id = $this->get_reg_id("WAR", "Warranty_Card");

        $customer_id = $this->input->post("customer_name", TRUE);

        $invoice_id = $this->input->post("invoice_no", TRUE);

        $invoice_date = $this->input->post("invoice_date", TRUE);

        $purchase_year = substr("$invoice_date", 0, -6);

        $warranty_period = $this->input->post("warranty_period", TRUE);


        // ********* START:   Warranty applicable select yes-> warranty period drop down select *********//

        if ($warranty_period === "3") {
            $warranty_period_text = "3 Months";
        }if ($warranty_period === "6") {
            $warranty_period_text = "6 Months";
        }if ($warranty_period === "12") {
            $warranty_period_text = "1 Year";
        }if ($warranty_period === "24") {
            $warranty_period_text = "2 Years";
        }if ($warranty_period === "36") {
            $warranty_period_text = "3 Years";
        }if ($warranty_period === "48") {
            $warranty_period_text = "4 Years";
        }if ($warranty_period === "60") {
            $warranty_period_text = "5 Years";
        }if ($warranty_period === "72") {
            $warranty_period_text = "6 Years";
        } else {
            
        }

        $sales_warranty_end_calculated = date('Y-m-d', strtotime("+" . $warranty_period . "months", strtotime($invoice_date)));

        // ********* END:   Warranty applicable select yes-> warranty period drop down select *********//

        $warranty_applicable_status = $this->input->post("w_a", TRUE);

        if ($warranty_applicable_status === "yes") {

            $dataArray = array(
                //database field name => form field name
                'bill_id' => $updated_id,
                'invoice_id' => $this->input->post("invoice_id", TRUE),
                'cus_id' => $this->input->post("cus_id", TRUE),
                'invoice_date' => $this->input->post("invoice_date", TRUE),
                'purchase_year' => $purchase_year,
                'make' => $this->input->post("make", TRUE),
                'model' => $this->input->post("model", TRUE),
                'serial_no' => $this->input->post("serial_no", TRUE),
                'bill_amount' => $this->input->post("bill_amount", TRUE),
                'warranty_applicability' => $warranty_applicable_status,
                'warranty_start' => $invoice_date,
                'warranty_end' => $sales_warranty_end_calculated,
                'warranty_years' => $warranty_period,
                'warranty_years_text' => $warranty_period_text,
                'status' => "active"
            );
        } else {

            $dataArray = array(
                //database field name => form field name
                'bill_id' => $updated_id,
                'invoice_id' => $this->input->post("invoice_id", TRUE),
                'cus_id' => $this->input->post("cus_id", TRUE),
                'invoice_date' => $this->input->post("invoice_date", TRUE),
                'purchase_year' => $purchase_year,
                'make' => $this->input->post("make", TRUE),
                'model' => $this->input->post("model", TRUE),
                'serial_no' => $this->input->post("serial_no", TRUE),
                'bill_amount' => $this->input->post("bill_amount", TRUE),
                'warranty_applicability' => $warranty_applicable_status,
                'warranty_start' => "0000-00-00",
                'warranty_end' => "0000-00-00",
                'warranty_years' => "N/A",
                'warranty_years_text' => "N/A",
                'status' => "active"
            );
        }
    }

    public function add_sales_warranty_exsisting() {

        $updated_id = $this->get_reg_id("WAR", "Warranty_Card");

        $customer_id = $this->input->post("customer_name", TRUE);

        $invoice_id = $this->input->post("invoice_no", TRUE);

        $invoice_date = $this->input->post("invoice_date", TRUE);

        $purchase_year = substr("$invoice_date", 0, -6);

        $warranty_period = $this->input->post("warranty_period", TRUE);


        // ********* START:   Warranty applicable select yes-> warranty period drop down select *********//

        if ($warranty_period === "3") {
            $warranty_period_text = "3 Months";
        }if ($warranty_period === "6") {
            $warranty_period_text = "6 Months";
        }if ($warranty_period === "12") {
            $warranty_period_text = "1 Year";
        }if ($warranty_period === "24") {
            $warranty_period_text = "2 Years";
        }if ($warranty_period === "36") {
            $warranty_period_text = "3 Years";
        }if ($warranty_period === "48") {
            $warranty_period_text = "4 Years";
        }if ($warranty_period === "60") {
            $warranty_period_text = "5 Years";
        }if ($warranty_period === "72") {
            $warranty_period_text = "6 Years";
        } else {
            
        }

        $sales_warranty_end_calculated = date('Y-m-d', strtotime("+" . $warranty_period . "months", strtotime($invoice_date)));

        // ********* END:   Warranty applicable select yes-> warranty period drop down select *********//

        $warranty_applicable_status = $this->input->post("w_a", TRUE);

        if ($warranty_applicable_status === "yes") {

            $dataArray = array(
                //database field name => form field name
                'bill_id' => $updated_id,
                'invoice_id' => $this->input->post("invoice_id", TRUE),
                'cus_id' => $this->input->post("cus_name", TRUE),
                'invoice_date' => $this->input->post("invoice_date", TRUE),
                'purchase_year' => $purchase_year,
                'make' => $this->input->post("make", TRUE),
                'model' => $this->input->post("model", TRUE),
                'serial_no' => $this->input->post("serial_no", TRUE),
                'bill_amount' => $this->input->post("bill_amount", TRUE),
                'warranty_applicability' => $warranty_applicable_status,
                'warranty_start' => $invoice_date,
                'warranty_end' => $sales_warranty_end_calculated,
                'warranty_years' => $warranty_period,
                'warranty_years_text' => $warranty_period_text,
                'status' => "active"
            );
        } else {

            $dataArray = array(
                //database field name => form field name
                'bill_id' => $updated_id,
                'invoice_id' => $this->input->post("invoice_id", TRUE),
                'cus_id' => $this->input->post("cus_name", TRUE),
                'invoice_date' => $this->input->post("invoice_date", TRUE),
                'purchase_year' => $purchase_year,
                'make' => $this->input->post("make", TRUE),
                'model' => $this->input->post("model", TRUE),
                'serial_no' => $this->input->post("serial_no", TRUE),
                'bill_amount' => $this->input->post("bill_amount", TRUE),
                'warranty_applicability' => $warranty_applicable_status,
                'warranty_start' => "0000-00-00",
                'warranty_end' => "0000-00-00",
                'warranty_years' => "N/A",
                'warranty_years_text' => "N/A",
                'status' => "active"
            );
        }


        $result = $this->db_model->insertData("billing_tbl", $dataArray);

        if ($result) {

            $dataArrayID = array('id_number' => $updated_id);
            $whereArrID = array('id_type' => 'Warranty_Card');

            $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);


            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function customer_purchase_detail_view($bill_id) {

        //get all customer purchase details from table "billing_tbl"
        $fieldset_b_tbl = array('*');
        $whereArray_b_tbl = array('bill_id' => $bill_id);
        $result_b_tbl = $this->db_model->getData($fieldset_b_tbl, 'billing_tbl', $whereArray_b_tbl);

        //get all customer details from table "customer_m_tbl" using cus_id from $result_b_tbl 
        $fieldset_c = array('*');
        $whereArray_c = array('cus_id' => $result_b_tbl[0]->cus_id);
        $result_c = $this->db_model->getData($fieldset_c, 'customer_m_tbl', $whereArray_c);

        $data['purchase_details'] = $result_b_tbl;
        $data['customer_details'] = $result_c;

        $data['nav'] = "warranty_details";
        $this->load->view('psmsbackend/pages/invoices/customer_purchase_detail_page', $data);
    }

//**** Util function: ***** //
    public function get_reg_id($character, $id_type) {

        $id = 0000;

        if ($character == "") {

            $fields = array("*");
            $whereArr = array("id_type" => $id_type);
            $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

            $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
            $id = ($int + 1);
        } else {

            $fields = array("*");
            $whereArr = array("id_type" => $id_type);
            $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

            $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
            $id = "$character" . ($int + 1);
        }

        return $id;
    }

}
