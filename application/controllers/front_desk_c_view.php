<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
session_start();

class Front_desk_c_view extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model', '', TRUE);
    }

    public function dashboard_front_desk() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    ////--- customer details--------/////////


    public function customer_view() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
            // 
                //selecting all the active customers
                $fieldset = array('*');
                $whereArray = array('status' => 'active');
                $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray);

                //selecting all the deactivated customers
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('status' => 'deactive');
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'customer_m_tbl', $whereArrayDeactive);

                $data['active_customers'] = $result; //contains active customers (associative array)
                $data['deactive_customers'] = $resultDeactive; //contains deactive customers (associative array)

                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/customers/customer_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function customer_detail_view($customer_id) {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
                //get customer's personal details: contact
                $fieldsetCusPerDet = array('*');
                $whereArrayCusPerDet = array('customer_id' => $customer_id);
                $resultCusPerDet = $this->db_model->getData($fieldsetCusPerDet, 'customer_m_tbl', $whereArrayCusPerDet);

                $data['cus_personal_details'] = $resultCusPerDet;

                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/customers/deatil_customer_p', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function add_customer_page() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/customers/add_customers', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function add_customers() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
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


                $result = $this->db_model->insertData("customer_m_tbl", $dataArray);

                if ($result) {

                    $dataArraId = array('id_number' => $updated_id);
                    $whereArrId = array('id_type' => "Customer");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                    $record = array('final_result' => 'success');
                    echo json_encode($record);
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

    public function edit_customers_page($customer_id) {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
                //get the all fields details related to the selected customer id
                $fieldset = array('*');
                $whereArray = array('customer_id' => $customer_id);
                $result = $this->db_model->getData($fieldset, 'customer_m_tbl', $whereArray); // details of the selected customer

                $data['customer_details'] = $result;

                $data['nav'] = "customers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/customers/edit_customers', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function edit_customers() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") {//front desk
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

                if ($result) {
                    $record = array('final_result' => 'success');
                    echo json_encode($record);
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

    //--------------supplier details--------------////////////
    
    public function supplier_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //selecting all the active supplier
                $fieldset = array('*');
                $whereArray = array('status' => 'active');        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray);
                
                //selecting all the deactivated suppliers
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('status' => 'deactive');        
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'supp_details_m_tbl', $whereArrayDeactive);
                
                $data['active_suppliers'] = $result; //contains active suppliers (associative array)
                $data['deactive_suppliers'] = $resultDeactive; //contains deactive suppliers (associative array)
                
                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/supplier_list',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }     
        
        
    }
    
    public function supplier_detail_view($supplier_id) { // get a specific supplier details(All details releted to supplier ID)
        
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //get supplier's personal details: contact
                $fieldsetSupDet = array('*');
                $whereArraySupDet = array('supp_id' => $supplier_id);        
                $resultSupDet = $this->db_model->getData($fieldsetSupDet, 'supp_details_m_tbl', $whereArraySupDet);

                $data['sup_personal_details']=$resultSupDet;

                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/detail_supplier_p',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

    }
    
    public function add_supplier_page(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO
               
                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/add_supplier',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

    }

    public function add_suppliers() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $updated_id = $this->get_reg_id("SUP", "Supplier");
        
                $dataArray = array(            
                    //database field name => form field name
                    'supp_id' => $updated_id,
                    'supp_name' => $this->input->post("supp_name", TRUE),
                    'supp_address' => $this->input->post("supp_address", TRUE),
                    'sup_contact' => $this->input->post("sup_contact", TRUE),
                    'sup_email' => $this->input->post("sup_email", TRUE),
                    'fax' => $this->input->post("fax", TRUE),
                    'category' => $this->input->post("category", TRUE),
                    'brand' => $this->input->post("brand", TRUE),
                    'status' => "active"
                );
                
                $result = $this->db_model->insertData("supp_details_m_tbl", $dataArray);
                
                if($result){            


                    $dataArrayID = array('id_number' => $updated_id);
                    $whereArrID = array('id_type' => 'Supplier');

                    $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);


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
    
    public function edit_suppliers_page($supplier_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //get the all fields details related to the selected supplier id
                $fieldset = array('*');
                $whereArray = array('supp_id' => $supplier_id);        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray); // details of the selected supplier

                $data['supplier_details'] = $result;

                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/edit_suppliers',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function edit_suppliers() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $whereArray = array('supp_id' => $this->input->post("supp_id", TRUE));  

                $dataArray = array(            
                    //database field name => form field name
                    'supp_name' => $this->input->post("supp_name", TRUE),
                    'supp_address' => $this->input->post("supp_address", TRUE),
                    'sup_contact' => $this->input->post("sup_contact", TRUE),
                    'sup_email' => $this->input->post("sup_email", TRUE),
                    'fax' => $this->input->post("fax", TRUE),
                    'category' => $this->input->post("category", TRUE),
                    'brand' => $this->input->post("brand", TRUE)
                );
                
                $result = $this->db_model->updateData('supp_details_m_tbl', $dataArray, $whereArray);
                
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
    
    public function supplier_purchase_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //selecting all the active supplier warranty
                $fieldset = array('*');
                $whereArray = "";        
                $result = $this->db_model->getData($fieldset, 'supplier_purchase_m_tbl', $whereArray);
                
                
                $data['active_supplier_warranty'] = $result; //contains active supplier warranty (associative array)
                
                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/supplier_purchase_list',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }
        
    }
    
    public function add_supplier_purchase_page_new(){


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");

                $fieldset = array('*');
                $whereArray = array('status' => 'active');        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray);

                $data['sup_list'] = $result;
                $data['supplier_purchase_id'] = $updated_id;
                $data['page_msg'] = "Add new purchase";

                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/add_supplier_purchase_new',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function add_supplier_purchase_page_exsisting(){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");

                $fieldset = array('*');
                $whereArray = array('status' => 'active');        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray);

                //get the exsisting sales order number to exsiting purchase page
                $fieldset_s_o_n = array('*');
                $whereArray_s_o_n = "";  
                $groupfield_s_o_n = "sales_order_no";
                $result_s_o_n = $this->db_model->getDataGroup($fieldset_s_o_n, 'supplier_purchase_m_tbl', $whereArray_s_o_n, $groupfield_s_o_n);

                $data['sup_sales_order'] = $result_s_o_n;

                $data['sup_list'] = $result;
                $data['supplier_purchase_id'] = $updated_id;
                $data['page_msg'] = "Add exisiting purchase";

                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/add_supplier_purchase_exsisting',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }      

        
    }

    public function get_sales_order_date($sales_order_no){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $fieldset_s_o_d = array('*');
                $whereArray_s_o_d = array("sales_order_no" => $sales_order_no);  
                $groupfield_s_o_d = "sales_date";
                $result_s_o_d = $this->db_model->getDataGroup($fieldset_s_o_d, 'supplier_purchase_m_tbl', $whereArray_s_o_d, $groupfield_s_o_d);

                //get the supplier name using supplier ID from $result_s_o_d
                $fieldset = array('*');
                $whereArray = array('supp_id' => $result_s_o_d[0]->supp_id);        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray);


                $sales_date = array('sales_date' => $result_s_o_d[0]->sales_date, 'supplier_id' => $result_s_o_d[0]->supp_id, 'supplier_name' => $result[0]->supp_name);            
                echo json_encode($sales_date);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }

        
    }
    
    public function abc(){

        $fieldset = array('*');
        $whereArray = "";    
       // $whereArray = array('sales_order_no' => 'KA1003');    
        $groupfield = "sales_order_no";
        $result = $this->db_model->getDataGroup($fieldset, 'supplier_purchase_m_tbl', $whereArray, $groupfield);

        foreach ($result as $key) {
           echo $key->sales_order_no. "<br/>";
        }
        
    }
    
    public function add_supplier_purchase_new() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");
        
                $supplier_id = $this->input->post("supplier_name", TRUE);

                $sales_order_no = $this->input->post("sales_order_no", TRUE);

                $sales_date = $this->input->post("sales_date", TRUE);

                $sales_year = substr("$sales_date", 0, -6);

                $warranty_period = $this->input->post("warranty_period", TRUE);

                $company_warranty_period = $this->input->post("company_warranty_period", TRUE);


                // ********* START:   Warranty applicable select yes-> warranty period drop down select *********//

                if($warranty_period === "3"){
                    $warranty_period_text = "3 Months";    
                }if($warranty_period === "6"){
                    $warranty_period_text = "6 Months"; 
                }if($warranty_period === "12"){
                    $warranty_period_text = "1 Year"; 
                }if($warranty_period === "24"){
                    $warranty_period_text = "2 Years"; 
                }if($warranty_period === "36"){
                    $warranty_period_text = "3 Years"; 
                }if($warranty_period === "48"){
                    $warranty_period_text = "4 Years"; 
                }if($warranty_period === "60"){
                    $warranty_period_text = "5 Years"; 
                }if($warranty_period === "62"){
                    $warranty_period_text = "6 Years"; 
                }

                 if($company_warranty_period === "3"){/////////////////////////////Company warranty start
                    $company_warranty_period_text = "3 Months";
                }if($company_warranty_period === "6"){
                    $company_warranty_period_text = "6 Months"; 
                }if($company_warranty_period === "12"){
                    $company_warranty_period_text = "1 Year"; 
                }if($company_warranty_period === "24"){
                    $company_warranty_period_text = "2 Years"; 
                }if($company_warranty_period === "36"){
                    $company_warranty_period_text = "3 Years"; 
                }if($company_warranty_period === "48"){
                    $company_warranty_period_text = "4 Years"; 
                }if($company_warranty_period === "60"){
                    $company_warranty_period_text = "5 Years"; 
                }if($company_warranty_period === "62"){
                    $company_warranty_period_text = "6 Years"; 
                }        

                $supplier_warranty_end_calculated = date('Y-m-d', strtotime("+".$warranty_period."months", strtotime($sales_date)));

                // ********* END:   Warranty applicable select yes-> warranty period drop down select *********//

                $warranty_applicable_status = $this->input->post("w_a", TRUE);

                $company_warranty_applicable_status = $this->input->post("c_w_a", TRUE);

                if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }
               
                
                $result = $this->db_model->insertData("supplier_purchase_m_tbl", $dataArray);
                
                if($result){         


                    // POP Upload Code : Start //    
                        $pathPOP = "./uploads/proof_of_purchase/" . $supplier_id ."/" . $sales_year. "/" . $sales_order_no ;
                        //$subdirectory = $path . "/profilepic/";
                        if (!is_dir($pathPOP)) { //create the folder if it's not already exists
                            mkdir($pathPOP, 0655, TRUE);
                        }

                        //var_dump($subdirectory);die;
                        $config['upload_path'] = $pathPOP;
                        $config['allowed_types'] = 'pdf|doc|png|jpg|docx';
                        $config['file_name'] = $sales_order_no;

                        $this->load->library('upload', $config);


                        if (!$this->upload->do_upload("pop")) {
                            $error = array('error' => $this->upload->display_errors());

                            //var_dump($error);die;
                            echo json_encode($error); //$error;
                        } else {
                            //$data = array('upload_data' => $this->upload->data());
                            $result = $this->upload->data();
                            $file_ext = $result['file_name'];

                           // echo json_encode($file_ext);die;
                        }
                        // POP Upload Code : End //


                    $dataArrayID = array('id_number' => $updated_id);
                    $whereArrID = array('id_type' => 'Supplier_Purchase');

                    $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);

                    $dataArrayDocumenty = array('document_name' => $file_ext);
                    $whereArrDocumenty = array('sales_order_no' => $sales_order_no);

                    $this->db_model->updateData('supplier_purchase_m_tbl', $dataArrayDocumenty, $whereArrDocumenty);

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
    
    public function add_supplier_purchase_exsisting() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");

                $supplier_id = $this->input->post("supplier_name", TRUE);

                $sales_order_no = $this->input->post("sales_order_no", TRUE);

                $sales_date = $this->input->post("sales_date", TRUE);

                $sales_year = substr("$sales_date", 0, -6);

                $warranty_period = $this->input->post("warranty_period", TRUE);

                $company_warranty_period = $this->input->post("company_warranty_period", TRUE);


                // ********* START:   Warranty applicable select yes-> warranty period drop down select *********//

                if($warranty_period === "3"){
                    $warranty_period_text = "3 Months";    
                }if($warranty_period === "6"){
                    $warranty_period_text = "6 Months"; 
                }if($warranty_period === "12"){
                    $warranty_period_text = "1 Year"; 
                }if($warranty_period === "24"){
                    $warranty_period_text = "2 Years"; 
                }if($warranty_period === "36"){
                    $warranty_period_text = "3 Years"; 
                }if($warranty_period === "48"){
                    $warranty_period_text = "4 Years"; 
                }if($warranty_period === "60"){
                    $warranty_period_text = "5 Years"; 
                }if($warranty_period === "62"){
                    $warranty_period_text = "6 Years"; 
                }

                 if($company_warranty_period === "3"){/////////////////////////////Company warranty start
                    $company_warranty_period_text = "3 Months";
                }if($company_warranty_period === "6"){
                    $company_warranty_period_text = "6 Months"; 
                }if($company_warranty_period === "12"){
                    $company_warranty_period_text = "1 Year"; 
                }if($company_warranty_period === "24"){
                    $company_warranty_period_text = "2 Years"; 
                }if($company_warranty_period === "36"){
                    $company_warranty_period_text = "3 Years"; 
                }if($company_warranty_period === "48"){
                    $company_warranty_period_text = "4 Years"; 
                }if($company_warranty_period === "60"){
                    $company_warranty_period_text = "5 Years"; 
                }if($company_warranty_period === "62"){
                    $company_warranty_period_text = "6 Years"; 
                }  



                $supplier_warranty_end_calculated = date('Y-m-d', strtotime("+".$warranty_period."months", strtotime($sales_date)));

                // ********* END:   Warranty applicable select yes-> warranty period drop down select *********//

                $warranty_applicable_status = $this->input->post("w_a", TRUE);

                $company_warranty_applicable_status = $this->input->post("c_w_a", TRUE);

                if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_id", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_id", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_id", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_id", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }
               
                
                $result = $this->db_model->insertData("supplier_purchase_m_tbl", $dataArray);
                
                if($result){         

                    $dataArrayID = array('id_number' => $updated_id);
                    $whereArrID = array('id_type' => 'Supplier_Purchase');

                    $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);


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
    
    public function supplier_purchase_detail_view($supplier_purchase_id){

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //get all supplier purchase details from table "supplier_purchase_m_tbl"
                $fieldset_s_p_tbl = array('*');
                $whereArray_s_p_tbl = array('supplier_purchase_id' => $supplier_purchase_id);        
                $result_s_p_tbl = $this->db_model->getData($fieldset_s_p_tbl, 'supplier_purchase_m_tbl', $whereArray_s_p_tbl);

                //get all supplier details from table "supp_details_m_tbl" using supp_id from $result_s_p_tbl 
                $fieldset_s = array('*');
                $whereArray_s = array('supp_id' => $result_s_p_tbl[0]->supp_id);        
                $result_s = $this->db_model->getData($fieldset_s, 'supp_details_m_tbl', $whereArray_s);

                $data['purchase_details'] = $result_s_p_tbl;
                $data['supplier_details'] = $result_s;

                $data['nav'] = "supplier_purchase";
                $this->load->view('psmsbackend/front_desk/suppliers/supplier_purchase_detail_page',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }       


    }

    public function edit_supplier_purchase_page($supplier_purchase_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                //get the all fields details related to the selected supplier purchase id
                $fieldset = array('*');
                $whereArray = array('supplier_purchase_id' => $supplier_purchase_id);        
                $result = $this->db_model->getData($fieldset, 'supplier_purchase_m_tbl', $whereArray); // details of the selected supplier purchase

                $data['supplier_warranty'] = $result;

                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/suppliers/edit_supplier_purchase_new',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }
        
    }
    
    public function edit_supplier_purchase_new() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "6"){ //FDO

                $whereArray = array('supplier_purchase_id' => $this->input->post("supplier_purchase_id", TRUE));  

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");
                
                $supplier_id = $this->input->post("supplier_name", TRUE);

                $sales_order_no = $this->input->post("sales_order_no", TRUE);

                $sales_date = $this->input->post("sales_date", TRUE);

                $sales_year = substr("$sales_date", 0, -6);

                $warranty_period = $this->input->post("warranty_period", TRUE);

                $company_warranty_period = $this->input->post("company_warranty_period", TRUE);
                
                
                // ********* START:   Warranty applicable select yes-> warranty period drop down select *********//

                if($warranty_period === "3"){
                    $warranty_period_text = "3 Months";    
                }if($warranty_period === "6"){
                    $warranty_period_text = "6 Months"; 
                }if($warranty_period === "12"){
                    $warranty_period_text = "1 Year"; 
                }if($warranty_period === "24"){
                    $warranty_period_text = "2 Years"; 
                }if($warranty_period === "36"){
                    $warranty_period_text = "3 Years"; 
                }if($warranty_period === "48"){
                    $warranty_period_text = "4 Years"; 
                }if($warranty_period === "60"){
                    $warranty_period_text = "5 Years"; 
                }if($warranty_period === "62"){
                    $warranty_period_text = "6 Years"; 
                }

                 if($company_warranty_period === "3"){/////////////////////////////Company warranty start
                    $company_warranty_period_text = "3 Months";
                }if($company_warranty_period === "6"){
                    $company_warranty_period_text = "6 Months"; 
                }if($company_warranty_period === "12"){
                    $company_warranty_period_text = "1 Year"; 
                }if($company_warranty_period === "24"){
                    $company_warranty_period_text = "2 Years"; 
                }if($company_warranty_period === "36"){
                    $company_warranty_period_text = "3 Years"; 
                }if($company_warranty_period === "48"){
                    $company_warranty_period_text = "4 Years"; 
                }if($company_warranty_period === "60"){
                    $company_warranty_period_text = "5 Years"; 
                }if($company_warranty_period === "62"){
                    $company_warranty_period_text = "6 Years"; 
                }        

                $supplier_warranty_end_calculated = date('Y-m-d', strtotime("+".$warranty_period."months", strtotime($sales_date)));

                // ********* END:   Warranty applicable select yes-> warranty period drop down select *********//

                $warranty_applicable_status = $this->input->post("w_a", TRUE);

                $company_warranty_applicable_status = $this->input->post("c_w_a", TRUE);

                if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "no"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => "N/A",
                    'company_warranty_years_text' => "N/A",
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "no" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => "0000-00-00",
                    'supplier_warranty_end' => "0000-00-00",
                    'warranty_years' => "N/A",
                    'warranty_years_text' => "N/A",
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }else if($warranty_applicable_status === "yes" && $company_warranty_applicable_status === "yes"){

                    $dataArray = array(            
                    //database field name => form field name
                    'supplier_purchase_id' => $updated_id,
                    'supp_id' => $this->input->post("supplier_name", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_date' => $this->input->post("sales_date", TRUE),
                    'sales_year' => $sales_year,
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'entered_qty' => 0,
                    'qty' => $this->input->post("qty", TRUE),
                    'warranty_applicability' => $warranty_applicable_status,
                    'company_warranty_applicability' => $company_warranty_applicable_status,
                    'supplier_warranty_start' => $sales_date,
                    'supplier_warranty_end' =>  $supplier_warranty_end_calculated,
                    'warranty_years' => $warranty_period,
                    'warranty_years_text' => $warranty_period_text,
                    'company_warranty_years' => $company_warranty_period,
                    'company_warranty_years_text' => $company_warranty_period_text,
                    'document_name' => "temp", 
                    'status' => "active"
                );

                }
               
                $result = $this->db_model->updateData('supplier_purchase_m_tbl', $dataArray, $whereArray);
                
                if($result){         


                    // POP Upload Code : Start //    
                        $pathPOP = "./uploads/proof_of_purchase/" . $supplier_id ."/" . $sales_year. "/" . $sales_order_no ;
                        //$subdirectory = $path . "/profilepic/";
                        if (!is_dir($pathPOP)) { //create the folder if it's not already exists
                            mkdir($pathPOP, 0655, TRUE);
                        }

                        //var_dump($subdirectory);die;
                        $config['upload_path'] = $pathPOP;
                        $config['allowed_types'] = 'pdf|doc|png|jpg|docx';
                        $config['file_name'] = $sales_order_no;

                        $this->load->library('upload', $config);


                        if (!$this->upload->do_upload("pop")) {
                            $error = array('error' => $this->upload->display_errors());

                            //var_dump($error);die;
                            echo json_encode($error); //$error;
                        } else {
                            //$data = array('upload_data' => $this->upload->data());
                            $result = $this->upload->data();
                            $file_ext = $result['file_name'];

                           // echo json_encode($file_ext);die;
                        }
                        // POP Upload Code : End //


                    $dataArrayID = array('id_number' => $updated_id);
                    $whereArrID = array('id_type' => 'Supplier_Purchase');

                    $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);

                    $dataArrayDocumenty = array('document_name' => $file_ext);
                    $whereArrDocumenty = array('sales_order_no' => $sales_order_no);

                    $this->db_model->updateData('supplier_purchase_m_tbl', $dataArrayDocumenty, $whereArrDocumenty);

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
    
    //////////---------------------view serial nos------------------///////////////
    public function serialno_view() {
    
        
        //selecting all the active serial nos
        $fieldset = array('*');
        $whereArray = array('status' => 'Verified');        
        $result = $this->db_model->getData($fieldset, 'supplier_product_sno_m_tbl', $whereArray);
        
        //selecting all the deactivated serial nos
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'supplier_product_sno_m_tbl', $whereArrayDeactive);
        
        $data['active_serialnos'] = $result; //contains active serial nos (associative array)
        $data['deactive_serialnos'] = $resultDeactive; //contains deactive serial nos (associative array)
        
        $data['nav'] = "serial nos"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/front_desk/serial_no/serialno_list',$data);
        
    }
    
    ////////////---------------view invoice details-------------------///////////
    
    public function bill_m_tbl_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO    
                $fieldset = "*";
                $whereArray = "";
                $bill_all_list = $this->db_model->getData($fieldset, 'bill_m_tbl', $whereArray);

                $data['all_bill_list'] = $bill_all_list;

                $data['nav'] = "warranty_details";
                $this->load->view('psmsbackend/front_desk/invoices/bill_m_list_page', $data);
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

            if($user_role_id === "6"){ //FDO
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
                $this->load->view('psmsbackend/front_desk/invoices/invoice_details_page',$data);
            
            }else{
            
                $this->load->view('psmsbackend/403_error_page');
            }


        }else {

            $this->load->view('psmsbackend/401_error_page');
        }  
    }
    
    ///--------------------parts inventory---------------------------////////////////
    
    public function parts_inventory_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO   
                $fieldset = "*";
                $whereArray = "";
                $parts_all_list = $this->db_model->getData($fieldset, 'parts_inventory_m_tbl', $whereArray);

                $data['all_parts_list'] = $parts_all_list;

                $data['nav'] = "parts_inventory";
                $this->load->view('psmsbackend/front_desk/parts_inventory/parts_inventory_list_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    /////////////// ----get jobs-------------////////////////////////
    public function jobentry_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
//selecting all the new jobs
                $fieldset = array('*');
                $whereArray = array('job_status' => 'New');
                $result = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);

//selecting all the in progress jobs
                $fieldsetDeactive = array('*');
                $whereArrayDeactive = array('job_status' => 'In Progress');
                $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'customer_job_tbl', $whereArrayDeactive);

                $data['active_jobs'] = $result; //contains active jobs (associative array)
                $data['deactive_jobs'] = $resultDeactive; //contains deactive jobs (associative array)

                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/job_card_list', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

      public function add_jobs_page_cus_search() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $updated_id = $this->get_reg_id("", "Job");

                $data['active_job_cus'] = "NO";
                $data['active_job_cus_yes'] = "";

                $data['job_id'] = $updated_id;

//get customer name/customer id /customer nic / customer contact
                $fieldCustomer = array('*');
                $whereCustomer = "";
                $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                $fieldInvoice = array('*');
                $whereInvoice = "";
                $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                $data['customer_info'] = $resultCustomer;
                $data['invoice_info'] = $resultInvoice;


                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    // this function is related to the customer search option panel form submit******************IMPORTANT
    public function load_add_job_with_customer() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $search_type = $this->input->post("search_type", TRUE);
                $search_value1 = $this->input->post("search_value1", TRUE);
                $search_value2 = $this->input->post("search_value2", TRUE);
                $search_value3 = $this->input->post("search_value3", TRUE);
                $search_value4 = $this->input->post("search_value4", TRUE);
                $search_value5 = $this->input->post("search_value5", TRUE);
                $search_value6 = $this->input->post("search_value6", TRUE);

// echo $search_value6;
// echo $search_type;die;

                if ($search_type == "cus_name" && (!empty($search_value1))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $fields1 = '*';
                    $wherefieldtablefrom1 = array("customer_m_tbl.cus_name" => $search_value1);
                    $tablefrom1 = 'customer_m_tbl';
                    $tablejoin1 = 'bill_m_tbl';
                    $tablejoincondition1 = 'customer_m_tbl.customer_id = bill_m_tbl.customer_id';

                    $result1 = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

// var_dump($result1);die; 
//inner if condition
                    if (empty($result1)) {

// var_dump("result1 is empty");die;

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result1;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if ($search_type == "cus_id" && (!empty($search_value2))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;


                    $fields2 = '*';
                    $wherefieldtablefrom2 = array("customer_m_tbl.customer_id" => $search_value2);
                    $tablefrom2 = 'customer_m_tbl';
                    $tablejoin2 = 'bill_m_tbl';
                    $tablejoincondition2 = 'customer_m_tbl.customer_id = bill_m_tbl.customer_id';

                    $result2 = $this->db_model->join($fields2, $wherefieldtablefrom2, $tablefrom2, $tablejoin2, $tablejoincondition2);

//inner if condition
                    if (empty($result2)) {

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result2;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if ($search_type == "nic" && (!empty($search_value3))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $fields3 = '*';
                    $wherefieldtablefrom3 = array("customer_m_tbl.NIC" => $search_value3);
                    $tablefrom3 = 'customer_m_tbl';
                    $tablejoin3 = 'bill_m_tbl';
                    $tablejoincondition3 = 'customer_m_tbl.customer_id = bill_m_tbl.customer_id';

                    $result3 = $this->db_model->join($fields3, $wherefieldtablefrom3, $tablefrom3, $tablejoin3, $tablejoincondition3);


//inner if condition
                    if (empty($result3)) {

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result3;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if ($search_type == "contact_no" && (!empty($search_value4))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $fields4 = '*';
                    $wherefieldtablefrom4 = array("customer_m_tbl.contact_no" => $search_value4);
                    $tablefrom4 = 'customer_m_tbl';
                    $tablejoin4 = 'bill_m_tbl';
                    $tablejoincondition4 = 'customer_m_tbl.customer_id = bill_m_tbl.customer_id';

                    $result4 = $this->db_model->join($fields4, $wherefieldtablefrom4, $tablefrom4, $tablejoin4, $tablejoincondition4);

//inner if condition
                    if (empty($result4)) {

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result4;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if ($search_type == "invoice_no" && (!empty($search_value5))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $fields5 = '*';
                    $wherefieldtablefrom5 = array("bill_m_tbl.invoice_no" => $search_value5);
                    $tablefrom5 = 'bill_m_tbl';
                    $tablejoin5 = 'customer_m_tbl';
                    $tablejoincondition5 = 'bill_m_tbl.customer_id = customer_m_tbl.customer_id';

                    $result5 = $this->db_model->join($fields5, $wherefieldtablefrom5, $tablefrom5, $tablejoin5, $tablejoincondition5);

//inner if condition
                    if (empty($result5)) {

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result5;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if ($search_type == "serial_no" && (!empty($search_value6))) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $fields6 = '*';
                    $wherefieldtablefrom6 = array("bill_line_item_m_tbl.serial_no" => $search_value6);
                    $tablefrom6 = 'bill_line_item_m_tbl,customer_m_tbl';
                    $tablejoin6 = 'bill_m_tbl';
                    $tablejoincondition6 = 'bill_line_item_m_tbl.invoice_no = bill_m_tbl.invoice_no AND bill_m_tbl.customer_id = customer_m_tbl.customer_id';

                    $result6 = $this->db_model->join($fields6, $wherefieldtablefrom6, $tablefrom6, $tablejoin6, $tablejoincondition6);

// echo json_encode($result6);die;
//inner if condition
                    if (empty($result6)) {

                        $data['active_job_cus'] = "no_cus";
                        $data['active_job_cus_yes'] = "";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    } else {

                        $data['active_job_cus'] = $result6;
                        $data['active_job_cus_yes'] = "yes_cus";
                        $data['nav'] = "jobs";
                        $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                    }
                } else if (empty($search_value1) || empty($search_value2) || empty($search_value3) || empty($search_value4) || empty($search_value5) || empty($search_value6)) {

//get customer name/customer id /customer nic / customer contact
                    $fieldCustomer = array('*');
                    $whereCustomer = "";
                    $resultCustomer = $this->db_model->getData($fieldCustomer, 'customer_m_tbl', $whereCustomer);

//get all invoice numbers
                    $fieldInvoice = array('*');
                    $whereInvoice = "";
                    $resultInvoice = $this->db_model->getData($fieldInvoice, 'bill_m_tbl', $whereInvoice);

                    $data['customer_info'] = $resultCustomer;
                    $data['invoice_info'] = $resultInvoice;

                    $data['active_job_cus'] = "no_cus";
                    $data['active_job_cus_yes'] = "";
                    $data['nav'] = "jobs";
                    $this->load->view('psmsbackend/front_desk/jobs/add_job_card_search_customer', $data);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    public function add_job_card_page() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $customer_id = $this->input->get('var1'); //customer_id
                $invoice_no = $this->input->get('var2'); //invoice no
                $invoice_date = $this->input->get('var3'); //invoice date
//get the job id number from util function
                $updated_id = $this->get_reg_id("", "job");
                $data['job_id'] = $updated_id;

                $data['invoice_no'] = $invoice_no;
                $data['invoice_date'] = $invoice_date;

//get customer's personal details: contact
                $fieldsetCusDetails = array('*');
                $whereArrayCusDetails = array('customer_id' => $customer_id);
                $resultCusDetails = $this->db_model->getData($fieldsetCusDetails, 'customer_m_tbl', $whereArrayCusDetails);
                $data['cus_personal_details'] = $resultCusDetails;

                //getting the serial number for job card to display in dropdown view[2019-10-27]
                $fieldsetSerialDetails = array('*');
                $whereArraySerialDetails = array('invoice_no' => $invoice_no);
                $resultSerialDetails = $this->db_model->getData($fieldsetSerialDetails, 'bill_line_item_m_tbl', $whereArraySerialDetails);
                $data['serial_number_details'] = $resultSerialDetails;


                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/add_job_card', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function get_invoice_warranty_info() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin
                $invoice_no = $this->input->get('var1'); // Invoice no
                $serial_no = $this->input->get('var2'); // Serial no


                $fields_1 = "*";
                $whereArr_1 = array("serial_no" => $serial_no, "invoice_no" => $invoice_no);
                $result_1 = $this->db_model->getData($fields_1, "bill_line_item_m_tbl", $whereArr_1);


                if (count($result_1) === 0) {

                    $record = array('result' => "no_data");
                    echo json_encode($record);

////////////////////////////////////////
                } else {

                    $fields_2 = "*";
                    $whereArr_2 = array("serial_no" => $result_1[0]->serial_no, "category" => $result_1[0]->category, "make" => $result_1[0]->make, "model" => $result_1[0]->model);

                    $result_2 = $this->db_model->getData($fields_2, "supplier_product_sno_m_tbl", $whereArr_2);


                    $fields_3 = "*";
                    $whereArr_3 = array("sales_order_no" => $result_2[0]->sales_order_no, "category" => $result_2[0]->category, "make" => $result_2[0]->make, "model" => $result_2[0]->model);

                    $result_3 = $this->db_model->getData($fields_3, "supplier_purchase_m_tbl", $whereArr_3);

//*** get the days count for the warranty active : high impact ***//

                    $warranty_type_msg = "";

// get the supplier date difference
                    $now_date = strtotime(date("Y-m-d")); //current date: job created date - convert to seconds

                    $supplier_warranty_end_date_time = strtotime($result_3[0]->supplier_warranty_end); //sup_end
                    $supplier_time_diff = ($supplier_warranty_end_date_time - $now_date); //time diff of supplier warranty

                    $supplier_numberDays = $supplier_time_diff / 86400; // convert to days - or +

                    $supplier_warranty_days = $supplier_numberDays; //*** final out put : supplier warranty days count to current date - or +
//get the company date difference
                    $company_warranty_end_date_time = strtotime(date('Y-m-d', strtotime("+" . $result_3[0]->company_warranty_years . "months", strtotime($result_1[0]->invoice_date)))); // calculate the company warranty end date with the invoice date using company warranty years  and converted to the seconds

                    $company_time_diff = ($company_warranty_end_date_time - $now_date); // time diff company warranty

                    $company_numberDays = $company_time_diff / 86400; // convert to days - or +

                    $company_warranty_days = $company_numberDays; //*** final out put : supplier warranty days count to current date - or +                  
//******  warranty selection logic : high imapct  ******//  

                    if ($result_3[0]->warranty_applicability === "yes") { //Main IF Point : checking the supplier waranty yes/no
//Main IF->sub main IF
                        if ($supplier_warranty_days > 0) { // supplier warranty yes and active
                            $warranty_type_msg = "Supplier Warranty";

//Main IF->sub main ELSE
                        } else if ($supplier_warranty_days < 0) { // supplier warranty yes and de-active and looking for the company warranty yes/no - active deactive in next inner if/else 
//sub main else/if - if
                            if ($result_3[0]->company_warranty_applicability === "yes") { // inner if checking the company waranty yes/no
                                if ($company_warranty_days > 0) { // company warranty yes and active
                                    $warranty_type_msg = "Company Warranty";
                                } else if ($company_warranty_days < 0) { // company warranty yes and de-active 
                                    $warranty_type_msg = "Customer Repair";
                                }
                            } else if ($result_3[0]->company_warranty_applicability === "no") { // company warranty no
                                $warranty_type_msg = "Customer Repair";
                            } else {

                                $warranty_type_msg = "Customer Repair";
                            }
                        }
                    } else if ($result_3[0]->warranty_applicability === "no") { //Main ELSE Point : checking the supplier waranty yes/no
//sub main else/if - if
                        if ($result_3[0]->company_warranty_applicability === "yes") { // inner if checking the company waranty yes/no
                            if ($company_warranty_days > 0) { // company warranty yes and active
                                $warranty_type_msg = "Company Warranty";
                            } else if ($company_warranty_days < 0) { // company warranty yes and de-active 
                                $warranty_type_msg = "Customer Repair";
                            }
                        } else if ($result_3[0]->company_warranty_applicability === "no") { // company warranty no
                            $warranty_type_msg = "Customer Repair";
                        } else {

                            $warranty_type_msg = "Customer Repair";
                        }
                    }

//********** Check for the existing job which is not equal to Completed (jobs status New / In Progress)    **********//


                    $field_check_serial = "*";
                    $whereArr_check_serial = array("serial_no" => $serial_no);

                    $result_check_serial = $this->db_model->getData($field_check_serial, "customer_job_tbl", $whereArr_check_serial);

                    $res_count = count($result_check_serial);

                    $serial_check_status = "";

                    $job_id_exisiting = "";

                    for ($i = 0; $i < $res_count; $i++) {

                        if ($result_check_serial[$i]->job_status != "Complete") {

                            $serial_check_status = "serial_not_okay";

                            $job_id_exisiting = $result_check_serial[$i]->job_id;

                            break;
                        } else {

                            continue;
                        }
                    }

//$serial_check_status = "serial_okay";


                    $record = array('info' => $result_3, "warranty_info" => $warranty_type_msg, "serial_check" => $serial_check_status, "job_id" => $job_id_exisiting, "serial_no" => $serial_no);

                    echo json_encode($record);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function add_jobs() {


        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $updated_job_id = $this->get_reg_id("", "job");

// $job_id = $this->input->post("job_id", TRUE);
                $customer_id = $this->input->post("customer_id", TRUE);

                $dataArray = array(
//database field name => form field name
                    'job_id' => $updated_job_id,
                    'customer_id' => $this->input->post("customer_id", TRUE),
                    'invoice_no' => $this->input->post("invoice_no", TRUE),
                    'job_date' => $this->input->post("job_date", TRUE),
                    'serial_no' => $this->input->post("serial_no", TRUE),
                    'category' => $this->input->post("category", TRUE),
                    'make' => $this->input->post("make", TRUE),
                    'model' => $this->input->post("model", TRUE),
                    'problem_description' => $this->input->post("problem_description", TRUE),
                    'warranty_type' => $this->input->post("warranty_type", TRUE),
                    'sales_order_no' => $this->input->post("sales_order_no", TRUE),
                    'sales_order_date' => $this->input->post("sales_order_date", TRUE),
                    'technician_id' => "Tech000",
                    'store_manager_id' => "STMGR000",
                    'service_manager_id' => "SERMGR000",
                    'imports_manager_id' => "IMPMGR000",
                    'job_status' => "New",
                    'technician_status' => "Pending",
                    'store_manager_status' => "Pending",
                    'service_manager_status' => "Pending",
                    'imports_manager_status' => "Pending",
                    'sms_status' => "Not Sent",
                    'current_status' => "Pending"
                );

                $result = $this->db_model->insertData("customer_job_tbl", $dataArray);

                $field_cus_details = "*";
                $whereArr_cus_details = array("customer_id" => $customer_id);
                $result_cus_details = $this->db_model->getData($field_cus_details, "customer_m_tbl", $whereArr_cus_details);

                $field_cus_login_details = "*";
                $whereArr_cus_login_details = array("user_id" => $customer_id);
                $result_cus_login_details = $this->db_model->getData($field_cus_login_details, "user_login_m_tbl", $whereArr_cus_login_details);


                if (count($result_cus_login_details) === 1) { // exsisting customer generate new password and update
                    $this->load->helper('string');
                    $customer_password = random_string('numeric', 6);
                    $customer_email = $result_cus_details[0]->email;

                    $customer_password_sha = sha1($customer_password);

                    $dataArrayCustomerLogin = array(
                        'password' => $customer_password_sha
                    );
                    $whereArrId = array("user_id" => $customer_id);

                    $resultId = $this->db_model->updateData('user_login_m_tbl', $dataArrayCustomerLogin, $whereArrId);


                    if ($result) {

                        $dataArraId = array('id_number' => $updated_job_id);
                        $whereArrId = array('id_type' => "Job");

                        $resultId = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                        $connected = @fsockopen("www.google.lk", 80);
                        //website, port  (try 80 or 443)
                        if ($connected) {

                            $sms_message = "- Welcome to STAV - <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Job has created for you. Your Job no is " . $updated_job_id . ". <br/><br/>Please visit our Customer Web Portal to view your job progress. <br/> www.psms.com/index.php/customer_portal_c/login<br/><br/>Username :  " . $customer_email . "<br/>Password : " . $customer_password . "<br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";



                            $user = "94776790257";
                            $password = "2626";
                            $text = urlencode($sms_message);
                            $to = $result_cus_details[0]->contact_no;


                            $baseurl = "http://www.textit.biz/sendmsg";
                            $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
                            $ret = file($url);


                            $res = explode(":", $ret[0]);


                            //add the email function [2019-10-27]
                            // load the My_PHPMailer library : customer Email
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

                                $date = date('Y-m-d');

                                $dataArrayJobHistory = array(
                                    'job_id' => $updated_job_id,
                                    'customer_id' => $this->input->post("customer_id", TRUE),
                                    'job_date' => $this->input->post("job_date", TRUE),
                                    'status' => 'New',
                                    'final_status' => 'In Progress',
                                    'status_change_date' => $date
                                );

                                $res_test = $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);


                                $record = array('final_result' => 'success', 'job_id' => $updated_job_id);
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

                        echo "not saved";
                    }
                } else { // if customer is new for job
                    $this->load->helper('string');
                    $customer_password = random_string('numeric', 6);
                    $customer_email = $result_cus_details[0]->email;



                    $dataArrayCustomerLogin = array(
                        'user_id' => $customer_id,
                        'user_role_id' => 7,
                        'username' => $customer_email,
                        'password' => sha1($customer_password),
                        'temp_password' => "aaaaa",
                        'login_attempt' => "0",
                        'status' => "1",
                    );

                    $result1 = $this->db_model->insertData("user_login_m_tbl", $dataArrayCustomerLogin);


                    if ($result & $result1) {

                        $dataArraId = array('id_number' => $updated_job_id);
                        $whereArrId = array('id_type' => "Job");

                        $resultId = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);

                        $connected = @fsockopen("www.google.lk", 80);
                        //website, port  (try 80 or 443)
                        if ($connected) {

                            $sms_message = "- Welcome to STAV - <br/><br/> Dear " . $result_cus_details[0]->title . " " . $result_cus_details[0]->cus_name . ", <br/><br/>Job has created for you. Your Job no is " . $updated_job_id . ". <br/><br/>Please visit our Customer Web Portal to view your job progress. <br/> www.psms.com/index.php/customer_portal_c/login<br/><br/>Username :  " . $customer_email . "<br/>Password : " . $customer_password . "<br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";



                            $user = "94776790257";
                            $password = "2626";
                            $text = urlencode($sms_message);
                            $to = $result_cus_details[0]->contact_no;


                            $baseurl = "http://www.textit.biz/sendmsg";
                            $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
                            $ret = file($url);


                            $res = explode(":", $ret[0]);

                            //add the email function [2019-10-27]
                            // load the My_PHPMailer library : customer Email
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

                                $date = date('Y-m-d');

                                $dataArrayJobHistory = array(
                                    'job_id' => $updated_job_id,
                                    'customer_id' => $this->input->post("customer_id", TRUE),
                                    'job_date' => $this->input->post("job_date", TRUE),
                                    'status' => 'New',
                                    'final_status' => 'In Progress',
                                    'status_change_date' => $date
                                );

                                $res_test = $this->db_model->insertData("customer_job_history_tbl", $dataArrayJobHistory);


                                $record = array('final_result' => 'success', 'job_id' => $updated_job_id);
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

                        echo "not saved";
                    }
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function generate_job_card($job_id) {
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $fieldJobInfo = "*";
                $whereArrJobInfo = array("job_id" => $job_id);
                $resultJobInfo = $this->db_model->getData($fieldJobInfo, "customer_job_tbl", $whereArrJobInfo);


                $fieldCusInfo = "*";
                $whereArrCusInfo = array('customer_id' => $resultJobInfo[0]->customer_id);
                $resultCusnfo = $this->db_model->getData($fieldCusInfo, "customer_m_tbl", $whereArrCusInfo);


                $data['job_info'] = $resultJobInfo;
                $data['cus_info'] = $resultCusnfo;
                $data['nav'] = "jobs";
                $data['page_msg'] = "";


                //invoice pdf generation and save the pdf to the files_pdf/student_invoice folder
                $htmldata = $this->load->view('psmsbackend/front_desk/jobs/job_card_pdf', $data, TRUE);

                //Load MPDF From Library
                $this->load->library('mmpdf');
                $mmpdf = $this->mmpdf->load();
                //$mmpdf->SetHTMLHeader();
                $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

                $mmpdf->WriteHTML($htmldata);

                $path = "./uploads/customer/job_card/" . $job_id . "/";
                if (!is_dir($path)) { //create the folder if it's not already exists
                    mkdir($path, 0755, TRUE);
                }

                $mmpdf->Output($path . "$job_id.pdf", 'F'); // save to folder in server 

                $mmpdf->Output("$job_id.pdf", 'I'); // save to folder in server 
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function testsms() {

        $sms_message = "- Welcome to STAV";



        $user = "94776790257";
        $password = "2626";
        $text = urlencode($sms_message);
        $to = "0776790257";


        $baseurl = "http://www.textit.biz/sendmsg";
        $url = "$baseurl/?id=$user&pw=$password&to=$to&text=$text&echo=Y";
        $ret = file($url);


        $res = explode(":", $ret[0]);

        var_dump(trim($res[0]) == "OK");
    }
    
    public function finished_not_collected_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $page_msg = $this->input->get('var1'); // job id



                $field = "*";
                $whereArr = array("job_status" => "Finished not collected");
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);





                $data['finished_not_collected_list'] = $result;
                $data['page_msg'] = "$page_msg";
                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_jobs', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function view_job_finished_not_collected() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->get('var1'); //job_id
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
                $data['page_msg'] = "";

                $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_job_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function send_sms_finished_not_collected($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $field = "*";
                $whereArr = array("job_id" => $job_id);
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);


//                var_dump($result[0]->customer_id);die;

                if (count($result) === 1) {

                    $fieldCustomer = "*";
                    $whereArrCustomer = array("customer_id" => $result[0]->customer_id);
                    $resultCustomer = $this->db_model->getData($fieldCustomer, "customer_m_tbl", $whereArrCustomer);

                    $sms_message = "- STAV Job Update - <br/><br/> Dear " . $resultCustomer[0]->title . " " . $resultCustomer[0]->cus_name . ", <br/><br/>Your job no " . $job_id . " is completed. <br/><br/>Please visit our service center to collect. For more information, please go to Customer Web Portal. <br/> www.psms.com/index.php/customer_portal<br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";

                    $user = "94776790257";
                    $password = "2626";
                    $text = urlencode($sms_message);
                    $to = $resultCustomer[0]->contact_no;

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
                    $maildata["recepients"] = array(array('email' => $resultCustomer[0]->email));

                    $maildata["mailbody"] = $body_message;
                    $maildata["date"] = $date;
                    $maildata["altmailbody"] = "Swedish Trading Audio Visual (Pvt) Ltd. - Administration<br/><br/>";

                    $mail = new My_PHPMailer();
                    $abc = $mail->sendcustomemail($maildata);


                    if (trim($res[0]) == "OK") {


                        $dataFieldsUpdate1 = array("sms_status" => "Sent");
                        $whereArrUpdate1 = array("job_id" => $job_id);

                        $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                        $field = "*";
                        $whereArr = array("job_status" => "Finished not collected");
                        $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);

                        $data['finished_not_collected_list'] = $result;
                        $data['page_msg'] = "sms_success";
                        $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                        $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_jobs', $data);
                    } else {
                        $field = "*";
                        $whereArr = array("job_status" => "Finished not collected");
                        $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);

                        $data['finished_not_collected_list'] = $result;
                        $data['page_msg'] = "sms_unsuccess";
                        $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                        $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_jobs', $data);
                    }
                } else {
                    $field = "*";
                    $whereArr = array("job_status" => "Finished not collected");
                    $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);

                    $data['finished_not_collected_list'] = $result;
                    $data['page_msg'] = "job_not_found";
                    $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                    $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_jobs', $data);
                }
            } else {
                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function order_finished($job_id) {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $field = "*";
                $whereArr = array("job_id" => $job_id);
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);


                if (count($result) === 1) {

                    $fieldCustomer = "*";
                    $whereArrCustomer = array("customer_id" => $result[0]->customer_id);
                    $resultCustomer = $this->db_model->getData($fieldCustomer, "customer_m_tbl", $whereArrCustomer);

                    $sms_message = "- STAV Job Update - <br/><br/> Dear " . $resultCustomer[0]->title . " " . $resultCustomer[0]->cus_name . ", <br/><br/>Your job no " . $job_id . " is closed. <br/><br/>For more information, please go to Customer Web Portal. <br/> www.psms.com/index.php/customer_portal<br/><br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";

                    $user = "94776790257";
                    $password = "2626";
                    $text = urlencode($sms_message);
                    $to = $resultCustomer[0]->contact_no;

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
                    $maildata["recepients"] = array(array('email' => $resultCustomer[0]->email));

                    $maildata["mailbody"] = $body_message;
                    $maildata["date"] = $date;
                    $maildata["altmailbody"] = "Swedish Trading Audio Visual (Pvt) Ltd. - Administration<br/><br/>";

                    $mail = new My_PHPMailer();
                    $abc = $mail->sendcustomemail($maildata);

                    if (trim($res[0]) == "OK") {


                        $dataFieldsUpdate1 = array("job_status" => "Order Finished", "current_status" => "Order Finished");
                        $whereArrUpdate1 = array("job_id" => $job_id);

                        $resultUpdate1 = $this->db_model->updatedata("customer_job_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table
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
                            'final_status' => "Order Finished",
                            'status_change_date' => $date
                        );

                        $result_customer_job_history_info = $this->db_model->insertData("customer_job_history_tbl", $job_history_details);

                        $page_msg = "order_finished_success";

                        redirect("front_desk_c_view/finished_not_collected_list?var1=" . $page_msg . "");
                    } else {
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
                        $data['page_msg'] = "sms_unsuccess";

                        $this->load->view('psmsbackend/front_desk/jobs/finished_not_collected_job_detail_view_page', $data);
                    }
                } else {
                    
                }
            } else {
                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function order_finished_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $page_msg = $this->input->get('var1'); // job id



                $field = "*";
                $whereArr = array("job_status" => "Order Finished");
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);
                $data['order_finished_list'] = $result;

                //###9
                //getting the paid estimation rejected list to display in order finsihed
                $fields1 = '*';
                $wherefieldtablefrom1 = array("job_estimate_tbl.payment_status" => "Full Paid", "customer_job_tbl.current_status" => "Estimation Rejected");
                $tablefrom1 = 'job_estimate_tbl';
                $tablejoin1 = 'customer_job_tbl';
                $tablejoincondition1 = 'job_estimate_tbl.job_id = customer_job_tbl.job_id';

                $result1 = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);
                $data['order_finished_estimation_reject_paid_list'] = $result1;


                $data['page_msg'] = "$page_msg";
                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/order_finished_jobs', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function view_job_order_finished() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->get('var1'); //job_id
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
                $this->load->view('psmsbackend/front_desk/jobs/order_finished_job_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
        public function job_estimation_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $page_msg = $this->input->get('var1'); // job id

                $field = "*";
                $whereArr = "";
                $result = $this->db_model->getData($field, "job_estimate_tbl", $whereArr);

                $data['job_estimations'] = $result;
                $data['page_msg'] = "$page_msg";
                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/job_estimations', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function on_hold_jobs_list() {###7
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $page_msg = $this->input->get('var1'); // job id

                $field = "*";
                $whereArr = array('current_status' => "On Hold");
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);

                $data['job_on_hold'] = $result;
                $data['page_msg'] = "$page_msg";
                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/job_on_hold', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function on_hold_reject_job_list() {###6
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $page_msg = $this->input->get('var1'); // job id

                $field = "*";
                $whereArr = array('job_status' => "Reject");
                $result = $this->db_model->getData($field, "customer_job_tbl", $whereArr);

                $data['job_reject'] = $result;

                $field2 = "*";
                $whereArr2 = array('current_status' => "Estimation Rejected");
                $result2 = $this->db_model->getData($field2, "customer_job_tbl", $whereArr2);

                $data['job_reject_est'] = $result2;

                $data['page_msg'] = "$page_msg";
                $data['nav'] = "jobs"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/front_desk/jobs/rejected_jobs', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function view_on_hold_job_detail_page() { ###3
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->get('var1'); //job_id
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
                $this->load->view('psmsbackend/front_desk/jobs/on_hold_job_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function view_reject_detail_page() { ###8
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->get('var1'); //job_id
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
                $this->load->view('psmsbackend/front_desk/jobs/rejected_job_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function send_on_hold_job_sms() { ###4
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->post('job_id', TRUE);
                $customer_id = $this->input->post('customer_id', TRUE);
                $sms_note = $this->input->post('sms_note', TRUE);

                $fieldJobInfo = "*";
                $whereArrJobInfo = array("customer_id" => $customer_id);
                $resultCustometInfo = $this->db_model->getData($fieldJobInfo, "customer_m_tbl", $whereArrJobInfo);

                $connected = @fsockopen("www.google.lk", 80);
                //website, port  (try 80 or 443)
                if ($connected) {

                    $sms_message = "- Job Status Update - <br/><br/> Dear " . $resultCustometInfo[0]->title . " " . $resultCustometInfo[0]->cus_name . ", <br/>" . $sms_note . "<br/> Thank you.  <br/><br/> - STAV Service Team - <br/>Hotline: 0112740100<br/>Web: www.psms.com ";

                    $user = "94776790257";
                    $password = "2626";
                    $text = urlencode($sms_message);
                    $to = $resultCustometInfo[0]->contact_no;


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
                } else {
                    $record = array('final_result' => 'connection_unsuccess');
                    echo json_encode($record);
                }
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function reject_status_update() { ###5
        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->post('job_id', TRUE);
                $customer_id = $this->input->post('customer_id', TRUE);
                $reject_status = $this->input->post('reject_status', TRUE);

                //update user login m tbl
                $dataArrayCustomerLogin = array(
                    'password' => "Reset",
                    'temp_password' => "Reset"
                );
                $whereArrId1 = array("user_id" => $customer_id);
                $result1 = $this->db_model->updateData('user_login_m_tbl', $dataArrayCustomerLogin, $whereArrId1);

                //update customer job tbl
                $dataArrayCustometJob = array(
                    'technician_id' => "NA",
                    'store_manager_id' => "NA",
                    'service_manager_id' => "NA",
                    'imports_manager_id' => "NA",
                    'job_status' => "Reject",
                    'technician_status' => "NA",
                    'store_manager_status' => "NA",
                    'service_manager_status' => "NA",
                    'imports_manager_status' => "NA",
                    'current_status' => "NA",
                    'current_status' => $reject_status,
                );
                $whereArrId2 = array("job_id" => $job_id);
                $result2 = $this->db_model->updateData('customer_job_tbl', $dataArrayCustometJob, $whereArrId2);

                //update customer job history tbl
                $dataArrayCustometJobHistory = array(
                    'customer_id' => "NA"
                );
                $whereArrId3 = array("job_id" => $job_id);
                $result3 = $this->db_model->updateData('customer_job_history_tbl', $dataArrayCustometJobHistory, $whereArrId3);

                //update repair info tbl
                $dataArrayCustometRepairInfo = array(
                    'tech_id' => "NA",
                    'store_manager_id' => "NA",
                    'service_manager_id' => "NA",
                    'imports_manager_id' => "NA"
                );
                $whereArrId4 = array("job_id" => $job_id);
                $result4 = $this->db_model->updateData('job_repair_info_tbl', $dataArrayCustometRepairInfo, $whereArrId4);

//                $record = array('$result1: ' => $result1, '$result2: ' => $result2, '$result3: ' => $result3, '$result4: ' => $result4);
//                echo json_encode($record);

                if ($result1 === true && $result2 === true && $result3 === true && $result4 === true) {

                    $record = array('final_result' => 'success');
                    echo json_encode($record);
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
    
    public function view_job_estimation_detail_page() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $job_id = $this->input->get('var1'); //job_id
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

                $data['job_estimation_info'] = $result;


                $data['parts_inventory'] = $resultJobPartsInfo;
                $data['job_info'] = $resultJobInfo;
                $data['nav'] = "jobs";
                $data['job_repair_info'] = $resultJobRepairInfo;
                $data['page_msg'] = "";
                $this->load->view('psmsbackend/front_desk/jobs/job_estimation_detail_view_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }
    
    public function payment_status_update_job_estimation() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $invoice_no = $this->input->post('invoice_no', TRUE);
                $receipt_no = $this->input->post('receipt_no', TRUE);
                $job_id = $this->input->post('job_id', TRUE);

                $dataFieldsUpdate1 = array("payment_status" => "Full Paid", 'invoice_no' => $invoice_no, 'receipt_no' => $receipt_no);
                $whereArrUpdate1 = array("job_id" => $job_id);
                $resultUpdate1 = $this->db_model->updatedata("job_estimate_tbl", $dataFieldsUpdate1, $whereArrUpdate1); // update customer job table

                if ($resultUpdate1) {

                    $var = array('final_result' => 'success');
                    echo json_encode($var);
                } else {
                    $var = array('final_result' => 'unsuccess');
                    echo json_encode($var);
                }
            } else {
                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

    //********* End:    Front Desk Officer Job Functions     *********//
    // *****  Uitility Method for getting the Reg/User/ect IDs: Common Function ***** //
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

    public function barcode() {

        $this->load->helper('string');
        $item_serial = random_string('nozero', 13);

//barcord generation for staff id
        $code = "$item_serial";
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
//$code = time() . $code; // timestamp-code

        $path1 = "./uploads/barcode/" . $code . "/";
//$subdirectory = $path . "/profilepic/";
        if (!is_dir($path1)) { //create the folder if it's not already exists
            mkdir($path1, 0755, TRUE);
        }
        imagepng($file, "$path1$code.jpg");
    }

    public function mytest() {

        $fields1 = '*';
                $wherefieldtablefrom1 = array("job_estimate_tbl.payment_status" => "Full Paid", "customer_job_tbl.current_status" => "Estimation Rejected");
                $tablefrom1 = 'job_estimate_tbl';
                $tablejoin1 = 'customer_job_tbl';
                $tablejoincondition1 = 'job_estimate_tbl.job_id = customer_job_tbl.job_id';

                $result1 = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);





        var_dump($result1);
    }

////---------reports-------------------/////////////
    
    public function job_report_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $data['nav'] = "Job Report";
                $this->load->view('psmsbackend/front_desk/reports/job_reports', $data);
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }
    
    public function get_the_report_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $from = date('Y-m-d', strtotime($this->input->post('from')));
                $to = date('Y-m-d', strtotime($this->input->post('to')));
                $status = $this->input->post('status');

                $fieldset = array('*');
                $whereArray = array('current_status' => '');
                $status_job = $this->db_model->getData($fieldset, 'customer_job_tbl', $whereArray);


                $fields1 = '*';
                $wherefieldtablefrom1 = array("customer_job_tbl.current_status" => $status, "customer_job_tbl.job_date BETWEEN '$from' AND '$to'" => "");
                $tablefrom1 = 'customer_job_tbl';
                $tablejoin1 = 'customer_m_tbl';
                $tablejoincondition1 = 'customer_job_tbl.customer_id = customer_m_tbl.customer_id';

                $result1 = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);

//                var_dump($result1);die;


                if (count($result1) > 0) {

                    $var = array('final_result' => 'success', 'from' => $from, 'to' => $to, 'status' => $status);
                    echo json_encode($var);
                } else {
                    $var = array('final_result' => 'unsuccess');
                    echo json_encode($var);
                }
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }

    public function generate_report_pdf() {

        $from = $this->input->get('var1');
        $to = $this->input->get('var2');
        $status = $this->input->get('var3');




        $fields1 = '*';
        $wherefieldtablefrom1 = array("customer_job_tbl.current_status" => $status, "customer_job_tbl.job_date BETWEEN '$from' AND '$to'" => "");
        $tablefrom1 = 'customer_job_tbl';
        $tablejoin1 = 'customer_m_tbl';
        $tablejoincondition1 = 'customer_job_tbl.customer_id = customer_m_tbl.customer_id';

        $result1 = $this->db_model->join($fields1, $wherefieldtablefrom1, $tablefrom1, $tablejoin1, $tablejoincondition1);


        $data['job_report_data'] = $result1;
        $data['report_job_status'] = $status;
        $data['jobs_count'] = count($result1);



        $htmldata = $this->load->view('psmsbackend/front_desk/reports/pdf/Job_status_date_range_report_pdf', $data, TRUE);

        //Load MPDF From Library
        $this->load->library('mmpdf');
        $mmpdf = $this->mmpdf->load();
        //$mmpdf->SetHTMLHeader();
        $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

        $mmpdf->WriteHTML($htmldata);

        $mmpdf->Output("$status-jobs_report.pdf", 'I'); // save to folder in server
    }

    public function stock_inventory_report_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $data['nav'] = "Stock Inventory";
                $this->load->view('psmsbackend/front_desk/reports/stock_inventory_reports', $data);
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }

    public function get_the_stock_inventory_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $category = $this->input->post('category');

                $fieldset1 = array('*');
                $whereArray1 = array('category' => $category);
                $category_stock = $this->db_model->getData($fieldset1, 'parts_inventory_m_tbl', $whereArray1);





//                var_dump($result1);die;


                if (count($category_stock) > 0) {

                    $var = array('final_result' => 'success', 'category' => $category);
                    echo json_encode($var);
                } else {
                    $var = array('final_result' => 'unsuccess');
                    echo json_encode($var);
                }
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }

    public function generate_stock_inventory_category_pdf() {


        $category = $this->input->get('var1');




        $fieldset1 = array('*');
        $whereArray1 = array('category' => $category);
        $category_stock = $this->db_model->getData($fieldset1, 'parts_inventory_m_tbl', $whereArray1);


        $data['stock_category_wise_data'] = $category_stock;
        $data['report_stock_category'] = $category;
        $data['category_count'] = count($category_stock);



        $htmldata = $this->load->view('psmsbackend/front_desk/reports/pdf/stock_category_wise_pdf', $data, TRUE);

        //Load MPDF From Library
        $this->load->library('mmpdf');
        $mmpdf = $this->mmpdf->load();
        //$mmpdf->SetHTMLHeader();
        $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

        $mmpdf->WriteHTML($htmldata);

        $mmpdf->Output("$category-stock_category_report.pdf", 'I'); // save to folder in server
    }
    
    public function get_the_stock_inventory_qty_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "6") { //FDO
                $qty = $this->input->post('qty');





                $var = array('final_result' => 'success', 'qty' => $qty);
                echo json_encode($var);
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }

    public function generate_stock_qty_pdf() {


        $qty = $this->input->get('var1');

        if ($qty === "zero_qty") {

            $fieldset1 = array('*');
            $whereArray1 = "";
            $inventory_info = $this->db_model->getData($fieldset1, 'parts_inventory_m_tbl', $whereArray1);

            $data['zero_qty_info'] = $inventory_info;

//        var_dump($inventory_info);die;
            $htmldata = $this->load->view('psmsbackend/front_desk/reports/pdf/zero_parts_inventory_pdf', $data, TRUE);



        //Load MPDF From Library
        $this->load->library('mmpdf');
        $mmpdf = $this->mmpdf->load();
        //$mmpdf->SetHTMLHeader();
        $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

        $mmpdf->WriteHTML($htmldata);

        $mmpdf->Output("zero_qty_parts_list.pdf", 'I'); // save to folder in server
            
            
            
            //generate the min level qty
        } else if ($qty === "min_level_qty") {

            $fieldset1 = array('*');
            $whereArray1 = "";
            $inventory_info = $this->db_model->getData($fieldset1, 'parts_inventory_m_tbl', $whereArray1);

            $data['min_level_qty_info'] = $inventory_info;
            $htmldata = $this->load->view('psmsbackend/front_desk/reports/pdf/min_level_parts_inventory_pdf', $data, TRUE);



            //Load MPDF From Library
        $this->load->library('mmpdf');
        $mmpdf = $this->mmpdf->load();
        //$mmpdf->SetHTMLHeader();
        $mmpdf->SetFooter('|{PAGENO}|' . date(DATE_RFC822));

        $mmpdf->WriteHTML($htmldata);

            $mmpdf->Output("min_level_qty_parts_list.pdf", 'I'); // save to folder in server
        }



        $fieldset1 = array('*');
        $whereArray1 = array('qty' => $qty);
        $qty = $this->db_model->getData($fieldset1, 'parts_inventory_m_tbl', $whereArray1);


        $data['qty'] = $qty;
        //$data['report_stock_category'] = $category;
        $data['qty_count'] = count($qty);
    }
}
