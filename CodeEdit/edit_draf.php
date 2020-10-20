/*
     * Common operations for technician view
     * navigation jobs count
     * navigation logged user data
     */

    public function technician_view_data() {

        if ($this->session->userdata('logged_in')) {

            $session_data = $this->session->userdata('logged_in');
            $user_role_id = $session_data['user_role_id'];
            $user_id = $session_data['user_id'];

            if ($user_role_id === "4") { //technician              
                //get the technician data
                $fieldTechInfo = "*";
                $whereArrTechInfo = array("emp_id" => $user_id);
                $resultTechInfo = $this->db_modal->getData($fieldTechInfo, "technician_m_tbl", $whereArrTechInfo);

                $tech_id = $resultTechInfo[0]->tech_id;

                //selecting all new jobs
                $fieldsetAllJobs = array('*');
                $whereArrayAllJobs = array('job_status' => 'New');
                $resultAllJobs = $this->db_modal->getData($fieldsetAllJobs, 'customer_job_tbl', $whereArrayAllJobs);

                //selecting all assigned to me jobs
                $fieldsetAssignedToMeJobs = array('*');
                $whereArrayAssignedToMeJobs = array('job_status' => 'In Progress', 'technician_id' => $tech_id);
                $result_assignedTomeJobs = $this->db_modal->getData($fieldsetAssignedToMeJobs, 'customer_job_tbl', $whereArrayAssignedToMeJobs);

                /*
                 * Assiciate array for sending data to view
                 */
                $data['assigned_to_me_job_count'] = count($result_assignedTomeJobs); // assigned to me job count
                $data['new_job_count'] = count($resultAllJobs); // all new job count
                $data['tech_id'] = $resultTechInfo[0]->tech_id; // technician id for operations
                
                return $data;
                
            } else {

                echo "no access";
            }
        } else {

            echo "No user session found or user logout!!!";
        }
    }