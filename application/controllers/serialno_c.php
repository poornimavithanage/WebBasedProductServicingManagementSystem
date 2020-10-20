<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class serialno_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {
        
        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard',$data);
        
    }
    
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
        $this->load->view('psmsbackend/pages/serial_no/serialno_list',$data);
        
    }


    public function add_serial_nos_page_sales_order_search() {


        //get the exsisting sales order number to exsiting purchase page
        $fieldset_s_o_n = array('*');
        $whereArray_s_o_n = "";  
        $groupfield_s_o_n = "sales_order_no";
        $result_s_o_n = $this->db_model->getDataGroup($fieldset_s_o_n, 'supplier_purchase_m_tbl', $whereArray_s_o_n, $groupfield_s_o_n);

        $data['sup_sales_order'] = $result_s_o_n;

        $data['page_block'] = "fresh";

        $data['nav'] = "serial nos"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page_sales_order_search',$data);
    }


    //load the purchase order items after sales order number search
    public function load_add_serial_no_with_sales_order_no(){

         $sales_order_no_search_tab = $this->input->post("sales_order_no", TRUE);    

          $var1 = $this->input->get('var1');//sales_order_no   


          if(empty($sales_order_no_search_tab)){

            $sales_order_no = $var1;

          }else if(empty($var1)){

            $sales_order_no = $sales_order_no_search_tab;

          }
          
          if(empty($sales_order_no)){        


            //get the exsisting sales order number to exsiting purchase page
            $fieldset_s_o_n = array('*');
            $whereArray_s_o_n = "";  
            $groupfield_s_o_n = "sales_order_no";
            $result_s_o_n = $this->db_model->getDataGroup($fieldset_s_o_n, 'supplier_purchase_m_tbl', $whereArray_s_o_n, $groupfield_s_o_n);
            
            $data['sup_sales_order'] = $result_s_o_n;    

            $data['page_block'] = "no_result";
            $data['nav'] = "serial nos";
            $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page_sales_order_search',$data);
        }else{

        //get the exsisting sales order number to exsiting purchase page
        $fieldset_s_o_n = array('*');
        $whereArray_s_o_n = "";  
        $groupfield_s_o_n = "sales_order_no";
        $result_s_o_n = $this->db_model->getDataGroup($fieldset_s_o_n, 'supplier_purchase_m_tbl', $whereArray_s_o_n, $groupfield_s_o_n);
        
        $data['sup_sales_order'] = $result_s_o_n;    

        // selecting all the active serial nos
        $fieldset = array('*');
        $whereArray = array('sales_order_no' => $sales_order_no);        
        $result = $this->db_model->getData($fieldset, 'supplier_purchase_m_tbl', $whereArray);

        // foreach ($result as $key) {
        //     var_dump ($key->category);
        // }
        // die;

        $data['sales_order_nos_g'] = $result;
        
        $data['page_block'] = "yes_result";
        $data['nav'] = "serial nos";
        $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page_sales_order_search',$data);
        }
   
    }


     public function add_serial_nos_page() {
        
        $var1 = $this->input->get('var1');//sales_order_no
        $var2 = $this->input->get('var2');//category
        $var3 = $this->input->get('var3');//make
        $var4 = $this->input->get('var4');//model
        $var5 = $this->input->get('var5');//total qty
        $var6 = $this->input->get('var6');//entered qty
        
        $data['sales_order_no'] = $var1;
        $data['category'] = $var2;
        $data['make'] = $var3;
        $data['model'] = $var4;
        $data['total_qty'] = $var5;
        $data['entered_qty'] = $var6;

        $data['page_msg'] = "no";

        $data['nav'] = "serial nos";
        $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page',$data);
        
    }


    public function add_serial_no(){

        $sales_order_no = $this->input->post("sales_order_no", TRUE);
        $category = $this->input->post("category", TRUE);
        $make = $this->input->post("make", TRUE);
        $model = $this->input->post("model", TRUE);
        $serial_no = $this->input->post("serial_no", TRUE);   


        //validation: check existing serial no
        $fieldsetSerialNo = "*";
        $whereArraySerialNo = array('sales_order_no' => $sales_order_no, 'category' => $category, 'make' => $make, 'model' => $model, 'serial_no' => $serial_no);   
        $CheckSerialNo = $this->db_model->getData($fieldsetSerialNo, 'supplier_product_sno_m_tbl', $whereArraySerialNo);

        $test = count($CheckSerialNo);

        //outter if
        if(count($CheckSerialNo) === 0 ){//no duplicate serial no


            //update the entered qty
            $fieldsetEnterdQty = array('*');
            $whereArrayEnterdQty = array('sales_order_no' => $sales_order_no, 'category' => $category, 'make' => $make, 'model' => $model);        
            $resultEnterdQty = $this->db_model->getData($fieldsetEnterdQty, 'supplier_purchase_m_tbl', $whereArrayEnterdQty);
            
            $new_entered_qty = $resultEnterdQty[0]->entered_qty + 1;

            $whereArray = array('sales_order_no' => $sales_order_no, 'category' => $category, 'make' => $make, 'model' => $model);  
            $dataArray = array('entered_qty' => $new_entered_qty);            
            $result = $this->db_model->updateData('supplier_purchase_m_tbl', $dataArray, $whereArray);


            //inner if 
            if($result){ // entered qty updated

                //insert serial no 
                $dataArraySerials = array(

                    'sales_order_no' => $sales_order_no,
                    'serial_no' => $serial_no,
                    'category' => $category,
                    'make' => $make,
                    'model' => $model,
                    'status' => "Verified"
                );

                $result = $this->db_model->insertData("supplier_product_sno_m_tbl", $dataArraySerials);

                //redirect to add serial no page with updated data
                $data['sales_order_no'] = $sales_order_no;
                $data['category'] = $category;
                $data['make'] = $make;
                $data['model'] = $model;
                $data['total_qty'] = $resultEnterdQty[0]->qty;
                $data['entered_qty'] = $new_entered_qty;

                $data['page_msg'] = "no";

                $data['nav'] = "serial nos";
                $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page',$data);

            //inner else    
            }else{

                echo "ERROR";
            }


        //outter else
        }else{

            // echo "Duplicate Entry!!"; 

            $fieldsetEnterdQty = array('*');
            $whereArrayEnterdQty = array('sales_order_no' => $sales_order_no, 'category' => $category, 'make' => $make, 'model' => $model);        
            $resultEnterdQty = $this->db_model->getData($fieldsetEnterdQty, 'supplier_purchase_m_tbl', $whereArrayEnterdQty);

            //redirect to add serial no page with updated data
                $data['sales_order_no'] = $sales_order_no;
                $data['category'] = $category;
                $data['make'] = $make;
                $data['model'] = $model;
                $data['total_qty'] = $resultEnterdQty[0]->qty;
                $data['entered_qty'] = $resultEnterdQty[0]->entered_qty;

                $data['page_msg'] = "yes";

                $data['nav'] = "serial nos";
                $this->load->view('psmsbackend/pages/serial_no/add_serial_nos_page',$data);


        }

        
        


       



    }



    
    public function remove_serial_nos(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "deactive"
        );        
        $whereArr = array(
            'supp_product_sno_id' => $this->input->post("supp_product_sno_id_remove_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('supplier_product_sno_m_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }
    
    public function restore_serial_nos(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "active"
        );        
        $whereArr = array(
            'supp_product_sno_id' => $this->input->post("supp_product_sno_id_restore_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('supplier_product_sno_m_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }

}

