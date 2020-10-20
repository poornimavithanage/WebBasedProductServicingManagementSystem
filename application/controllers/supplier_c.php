<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class supplier_c extends CI_Controller {

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
    
    public function supplier_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

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
                $this->load->view('psmsbackend/pages/suppliers/supplier_list',$data);
            
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

            if($user_role_id === "1"){ //admin

                //get supplier's personal details: contact
                $fieldsetSupDet = array('*');
                $whereArraySupDet = array('supp_id' => $supplier_id);        
                $resultSupDet = $this->db_model->getData($fieldsetSupDet, 'supp_details_m_tbl', $whereArraySupDet);

                $data['sup_personal_details']=$resultSupDet;

                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/detail_supplier_p',$data);
            
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

            if($user_role_id === "1"){ //admin
               
                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/add_supplier',$data);
            
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

            if($user_role_id === "1"){ //admin

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

            if($user_role_id === "1"){ //admin

                //get the all fields details related to the selected supplier id
                $fieldset = array('*');
                $whereArray = array('supp_id' => $supplier_id);        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray); // details of the selected supplier

                $data['supplier_details'] = $result;

                $data['nav'] = "suppliers"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/edit_suppliers',$data);
            
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

            if($user_role_id === "1"){ //admin

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
    public function remove_suppliers(){      

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $supplier_id = $this->input->post("supp_id_remove_form", TRUE);

                $dataArray = array(            
                    //database field name => form field name
                    'status' => "deactive"
                );        
                $whereArr = array(
                    'supp_id' => $supplier_id            
                    );
                
                $result = $this->db_model->updateData('supp_details_m_tbl', $dataArray, $whereArr);
                
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
    
    public function restore_suppliers(){  

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                $dataArray = array(            
                    //database field name => form field name
                    'status' => "active"
                );        
                $whereArr = array(
                    'supp_id' => $this->input->post("supp_id_restore_form", TRUE)            
                    );
                
                $result = $this->db_model->updateData('supp_details_m_tbl', $dataArray, $whereArr);
                
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


    // **** loading edit page function

    // **** submit edit form function



    public function supplier_purchase_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if($user_role_id === "1"){ //admin

                //selecting all the active supplier warranty
                $fieldset = array('*');
                $whereArray = "";        
                $result = $this->db_model->getData($fieldset, 'supplier_purchase_m_tbl', $whereArray);
                
                
                $data['active_supplier_warranty'] = $result; //contains active supplier warranty (associative array)
                
                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/supplier_purchase_list',$data);
            
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

            if($user_role_id === "1"){ //admin

                $updated_id = $this->get_reg_id("PUR", "Supplier_Purchase");

                $fieldset = array('*');
                $whereArray = array('status' => 'active');        
                $result = $this->db_model->getData($fieldset, 'supp_details_m_tbl', $whereArray);

                $data['sup_list'] = $result;
                $data['supplier_purchase_id'] = $updated_id;
                $data['page_msg'] = "Add new purchase";

                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/add_supplier_purchase_new',$data);
            
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

            if($user_role_id === "1"){ //admin

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
                $this->load->view('psmsbackend/pages/suppliers/add_supplier_purchase_exsisting',$data);
            
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

            if($user_role_id === "1"){ //admin

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
                }if($warranty_period === "72"){
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
                }if($company_warranty_period === "72"){
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
                            mkdir($pathPOP, 0755, TRUE);
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

            if($user_role_id === "1"){ //admin

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
                }if($warranty_period === "72"){
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
                }if($company_warranty_period === "72"){
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

            if($user_role_id === "1"){ //admin

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
                $this->load->view('psmsbackend/pages/suppliers/supplier_purchase_detail_page',$data);
            
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

            if($user_role_id === "1"){ //admin

                //get the all fields details related to the selected supplier purchase id
                $fieldset = array('*');
                $whereArray = array('supplier_purchase_id' => $supplier_purchase_id);        
                $result = $this->db_model->getData($fieldset, 'supplier_purchase_m_tbl', $whereArray); // details of the selected supplier purchase

                $data['supplier_warranty'] = $result;

                $data['nav'] = "supplier_purchase"; // this is for highligting left navigation tab (associative array) 
                $this->load->view('psmsbackend/pages/suppliers/edit_supplier_purchase_new',$data);
            
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

            if($user_role_id === "1"){ //admin

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
                }if($warranty_period === "72"){
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
                }if($company_warranty_period === "72"){
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
                            mkdir($pathPOP, 0755, TRUE);
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

    //**** Util function: ***** //
    public function get_reg_id($character,$id_type) {

        $id = 0000;

        if($character == ""){

        $fields = array("*");
        $whereArr = array("id_type" => $id_type);
        $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

        $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
        $id = ($int + 1);

        }else{

        $fields = array("*");
        $whereArr = array("id_type" => $id_type);
        $id_number = $this->db_model->getData($fields, 'id_numbers_m_tbl', $whereArr);

        $int = intval(preg_replace('/[^0-9]+/', '', $id_number[0]->id_number), 10);
        $id = "$character" . ($int + 1);

        }

        return $id;
    }

}
