<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class parts_inventory_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function parts_inventory_list() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin     
                $fieldset = "*";
                $whereArray = "";
                $parts_all_list = $this->db_model->getData($fieldset, 'parts_inventory_m_tbl', $whereArray);

                $data['all_parts_list'] = $parts_all_list;

                $data['nav'] = "parts_inventory";
                $this->load->view('psmsbackend/pages/parts_inventory/parts_inventory_list_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

//function end

    public function parts_inventory_add_page() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin   
                $updated_id = $this->get_reg_id("Part_", "Part Ref Code");

                $data['nav'] = "parts_inventory";
                $this->load->view('psmsbackend/pages/parts_inventory/parts_inventory_add_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

//function end

    public function parts_inventory_add() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin   
                $updated_id = $this->get_reg_id("P_", "Part Ref Code");

                $dataArray = array(
                    //database field name => form field name
                    'part_ref_code' => $updated_id,
                    'part_no' => $this->input->post("part_no", TRUE),
                    'description' => $this->input->post("description", TRUE),
                    'min_qty' => $this->input->post("min_qty", TRUE),
                    'store_qty' => $this->input->post("store_qty", TRUE),
                    'store_status' => 'Available',
                );

                $result = $this->db_model->insertData("parts_inventory_m_tbl", $dataArray);


                if ($result) {

                    $dataArraId = array('id_number' => $updated_id);
                    $whereArrId = array('id_type' => "Part Ref Code");

                    $result = $this->db_model->updateData('id_numbers_m_tbl', $dataArraId, $whereArrId);


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

    public function parts_inventory_update_page() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin        
                $data['nav'] = "parts_inventory";
                $this->load->view('psmsbackend/pages/parts_inventory/parts_inventory_update_page', $data);
            } else {

                $this->load->view('psmsbackend/403_error_page');
            }
        } else {

            $this->load->view('psmsbackend/401_error_page');
        }
    }

//function end

    public function import_stock_inventory_data_page() {


        $data['page_msg'] = "Import Stock Inventory Data From CSV";

        $data['nav'] = "parts_inventory"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/parts_inventory/import_stock_inventory_page', $data);
    }

    public function import_stock_inventory() {

        $this->load->library('csvimport');
        $file_data = $this->csvimport->get_array($_FILES["stock_inventory"]["tmp_name"]);
        foreach ($file_data as $row) {
            $data[] = array(
                'part_ref_code' => $row["part_ref_code"],
                'part_no' => $row["part_no"],
                'description' => $row["description"],
                'min_qty' => $row["min_qty"],
                'store_qty' => $row["store_qty"],
                'category' => $row["category"],
                'average_cost_price' => $row["average_cost_price"],
                'closing_stock_value' => $row["closing_stock_value"],
                'bin_no' => $row["bin_no"],
                'dm' => $row["dm"],
                'gp' => $row["gp"],
                'ro' => $row["ro"],
                'rma_applicability' => $row["rma_applicability"],
                'store_status' => $row["store_status"]
                
                    
            );
        }

        $result = $this->db_model->insertExcel('parts_inventory_m_tbl', $data);

        if ($result) {
            $var = array("final_result" => "success");
            echo json_encode($var);
        } else {
            $var = array("final_result" => "unsuccess");
            echo json_encode($var);
        }
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

//class end