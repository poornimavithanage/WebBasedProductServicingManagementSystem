<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class products_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

      
    public function products_view() {
    
        //selecting all the active products
        $fieldset = array('*');
        $whereArray = array('status' => 'active');        
        $result = $this->db_model->getData($fieldset, 'item_product_m_tbl', $whereArray);
        
        //selecting all the deactivated products
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');        
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'item_product_m_tbl', $whereArrayDeactive);
        
        $data['active_products'] = $result; //contains active products (associative array)
        $data['deactive_products'] = $resultDeactive; //contains deactive products (associative array)
        
        $data['nav'] = "products"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/products/products_list',$data);
        
    }


    public function add_products_page(){

        $data['nav'] = "products"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/products/add_products',$data);
        
    }

    
    public function add_products() {
        
        $dataArray = array(            
            //database field name => form field name
            'category' => $this->input->post("category", TRUE),
            'brand' => $this->input->post("brand", TRUE),
            'model' => $this->input->post("model", TRUE),
            'status' => "active"
        );
        
        $result = $this->db_model->insertData("item_product_m_tbl", $dataArray);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }


    public function edit_products_page($product_id) {
        
        //get the all fields details related to the selected product id
        $fieldset = array('*');
        $whereArray = array('item_product_m_id' => $product_id);        
        $result = $this->db_model->getData($fieldset, 'item_product_m_tbl', $whereArray); // details of the selected product

        $data['product_details'] = $result;

        $data['nav'] = "products"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/products/edit_products',$data);

        
    }



    public function edit_products() {
        
        $whereArray = array('item_product_m_id' => $this->input->post("product_id", TRUE));  


        $dataArray = array(            
            //database field name => form field name
            'category' => $this->input->post("category", TRUE),
            'brand' => $this->input->post("brand", TRUE),
            'model' => $this->input->post("model", TRUE)
        );
        
        $result = $this->db_model->updateData('item_product_m_tbl', $dataArray, $whereArray);;
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
        
    }

    
    public function remove_products(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "deactive"
        );        
        $whereArr = array(
            'item_product_m_id' => $this->input->post("product_id_remove_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('item_product_m_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
        }
    }
    
    public function restore_products(){      
                
        $dataArray = array(            
            //database field name => form field name
            'status' => "active"
        );        
        $whereArr = array(
            'item_product_m_id' => $this->input->post("product_id_restore_form", TRUE)            
            );
        
        $result = $this->db_model->updateData('item_product_m_tbl', $dataArray, $whereArr);
        
        if($result){            
            $record = array('final_result' => 'success');            
            echo json_encode($record);
        }else{
            $record = array('final_result' => 'unsuccess');            
            echo json_encode($record);
            
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
