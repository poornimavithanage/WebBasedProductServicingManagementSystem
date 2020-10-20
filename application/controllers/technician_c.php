<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class technician_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('db_model');
    }

    public function index() {

        $data['nav'] = "dashboard";
        $this->load->view('psmsbackend/pages/dashboard', $data);
    }

    public function technician_view() {

        //selecting all the active technicians
        $fieldset = array('*');
        $whereArray = array('status' => 'active');
        $result = $this->db_model->getData($fieldset, 'technician_m_new_tbl', $whereArray);

        //selecting all the deactivated technicians
        $fieldsetDeactive = array('*');
        $whereArrayDeactive = array('status' => 'deactive');
        $resultDeactive = $this->db_model->getData($fieldsetDeactive, 'technician_m_new_tbl', $whereArrayDeactive);

        $data['active_technicians'] = $result; //contains active technicians (associative array)
        $data['deactive_technicians'] = $resultDeactive; //contains deactive technicians (associative array)

        $data['nav'] = "Technicians"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/technician/technician_list', $data);
    }

    public function add_technician_page() {

        $updated_id = $this->get_reg_id("TEC", "Technician");

        $data['tech_id'] = $updated_id;
        $data['nav'] = "Technicians"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/technician/add_technicians', $data);
    }

    public function add_technicians() {

        $updated_id = $this->get_reg_id("TEC", "Technician"); //technician id 
        $updated_emp_id = $this->get_reg_id("EMP", "Employee");  //employee id

        $email = $this->input->post("tech_email", TRUE);

        $password_employe = "test password";


        $dataArray = array(
            //database field name => form field name
            'emp_id' => $updated_emp_id,
            'tech_id' => $updated_id,
            'tech_first_name' => $this->input->post("tech_first_name", TRUE),
            'tech_last_name' => $this->input->post("tech_last_name", TRUE),
            'tech_gender' => $this->input->post("tech_gender", TRUE),
            'tech_email' => $this->input->post("tech_email", TRUE),
            'tech_contact' => $this->input->post("tech_contact", TRUE),
            'tech_nic' => $this->input->post("tech_nic", TRUE),
            'status' => "active"
        );

        $result = $this->db_model->insertData("technician_m_new_tbl", $dataArray);

        $dataArrayID = array('id_number' => $updated_id);
        $whereArrID = array('id_type' => 'Technician');

        $this->db_model->updateData('id_numbers_m_tbl', $dataArrayID, $whereArrID);

        if ($result) {


            // load the My_PHPMailer library : Student Email
            $this->load->library('My_PHPMailer');

            $date = date("Y/m/d");
            $body_message = " - Welcome to the PSMS -  <br/><br/> Please use below login creadentials to login to the system <br/><br/> Username :" . $email . " <br/> Password :" . $password_employe . "";

            $maildata["subject"] = "Username and Password";
            $maildata["recepients"] = array(array('email' => $email));

            $maildata["mailbody"] = $body_message;
            $maildata["date"] = $date;
            $maildata["altmailbody"] = "Swedish Trading Audio Visual (Pvt) Ltd. - Administration<br/><br/>";

            $mail = new My_PHPMailer();
            $abc = $mail->sendcustomemail($maildata);
            
            $record = array('final_result' => 'success', 'email_status' => $abc);
            echo json_encode($record);
            
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function edit_technician_page($tech_id) {

        //get the all fields details related to the selected fdo id
        $fieldset = array('*');
        $whereArray = array('tech_id' => $tech_id);
        $result = $this->db_model->getData($fieldset, 'technician_m_new_tbl', $whereArray); // details of the selected fdo

        $data['tech_details'] = $result;

        $data['nav'] = "Technicians"; // this is for highligting left navigation tab (associative array) 
        $this->load->view('psmsbackend/pages/user_mgt/technician/edit_technicians', $data);
    }

    public function edit_technicians() {

        $whereArray = array('tech_id' => $this->input->post("tech_id", TRUE));


        $dataArray = array(
            //database field name => form field name
            'tech_first_name' => $this->input->post("tech_first_name", TRUE),
            'tech_last_name' => $this->input->post("tech_last_name", TRUE),
            'tech_gender' => $this->input->post("tech_gender", TRUE),
            'tech_email' => $this->input->post("tech_email", TRUE),
            'tech_contact' => $this->input->post("tech_contact", TRUE),
            'tech_nic' => $this->input->post("tech_nic", TRUE),
        );


        $result = $this->db_model->updateData('technician_m_new_tbl', $dataArray, $whereArray);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function remove_technicians() {

        $dataArray = array(
            //database field name => form field name
            'status' => "deactive"
        );
        $whereArr = array(
            'tech_id' => $this->input->post("tech_id_remove_form", TRUE)
        );

        $result = $this->db_model->updateData('technician_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
        }
    }

    public function restore_technicians() {

        $dataArray = array(
            //database field name => form field name
            'status' => "active"
        );
        $whereArr = array(
            'tech_id' => $this->input->post("tech_id_restore_form", TRUE)
        );

        $result = $this->db_model->updateData('technician_m_new_tbl', $dataArray, $whereArr);

        if ($result) {
            $record = array('final_result' => 'success');
            echo json_encode($record);
        } else {
            $record = array('final_result' => 'unsuccess');
            echo json_encode($record);
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
