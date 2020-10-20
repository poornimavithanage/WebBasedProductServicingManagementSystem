<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard', $data);
    }

    public function job_report_view() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];

            if ($user_role_id === "1") { //admin
                $data['nav'] = "Job Report";
                $this->load->view('psmsbackend/reports/job_reports', $data);
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

            if ($user_role_id === "1") { //admin
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



        $htmldata = $this->load->view('psmsbackend/reports/pdf/Job_status_date_range_report_pdf', $data, TRUE);

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

            if ($user_role_id === "1") { //admin
                $data['nav'] = "Stock Inventory";
                $this->load->view('psmsbackend/reports/stock_inventory_reports', $data);
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

            if ($user_role_id === "1") { //admin
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



        $htmldata = $this->load->view('psmsbackend/reports/pdf/stock_category_wise_pdf', $data, TRUE);

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

            if ($user_role_id === "1") { //admin
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
            $htmldata = $this->load->view('psmsbackend/reports/pdf/zero_parts_inventory_pdf', $data, TRUE);



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
            $htmldata = $this->load->view('psmsbackend/reports/pdf/min_level_parts_inventory_pdf', $data, TRUE);



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
