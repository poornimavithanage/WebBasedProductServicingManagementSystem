<?php

class Db_model extends CI_Model {

    public function insertData($table, $data) {
        $result = $this->db->insert($table, $data);


        return $result;
    }

    function insertExcel($table, $data) {
        $result = $this->db->insert_batch($table, $data);
        
        return $result;
    }

    public function updateData($tableName, $dataArra, $whereArr) {

        $this->db->where($whereArr);
        $this->db->update($tableName, $dataArra);
        $result = $this->db->affected_rows() > 0;
        return $result;
    }

    public function getData($fieldset, $tableName, $where = '') {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteData($table, $where) {

        $this->db->where($where);
        $this->db->delete($table);

        $result = $this->db->affected_rows() > 0;
        return $result;
    }

    public function getDataLike($fieldset, $tableName, $whereColumn = '', $whereValue) {

        $query = $this->db->select($fieldset)->from($tableName)->where("$whereColumn LIKE '%$whereValue%'")->get();
        // $query = $this->db->get();
        return $query->result();
    }

    public function getDataGroup($fieldset, $tableName, $where = '', $groupfield) {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
            $this->db->group_by($groupfield);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
            $this->db->group_by($groupfield);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataGroupDesc($fieldset, $tableName, $where = '', $groupfield, $orderfield) {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
            $this->db->group_by($groupfield);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
            $this->db->group_by($groupfield);
        }
        $this->db->order_by($orderfield, 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataGroupAsc($fieldset, $tableName, $where = '', $groupfield, $orderfield) {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
            $this->db->group_by($groupfield);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
            $this->db->group_by($groupfield);
        }
        $this->db->order_by($orderfield, 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataNew($fieldset, $tableName, $where = '') {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataRows($fieldset, $tableName, $where = '') {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getDataGroupBy($fieldset, $tableName, $where = '') {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $query = $this->db->get();
        $this->db->group_by($fieldset);
        return $query->result();
    }

    public function getDataSortAsc($fieldset, $tableName, $where, $asc_field) {
        if ($where == "") {
            $this->db->select($fieldset)->from($tableName);
        } else {
            $this->db->select($fieldset)->from($tableName)->where($where);
        }
        $this->db->order_by($asc_field, "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function sum($field, $wherefield, $table) {
        if ($wherefield == "") {

            $this->db->select_sum($field);
            $this->db->from($table);
        } else {
            $this->db->select_sum($field)->where($wherefield);
            $this->db->from($table);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function count($field, $wherefield, $table) {
        if ($wherefield == "") {

            $this->db->select($field);
            $this->db->from($table);
        } else {
            $this->db->select($field)->where($wherefield);
            $this->db->from($table);
        }
        return $query = $this->db->count_all_results();
    }

    public function avg($field, $wherefield, $table) {
        if ($wherefield == "") {

            $this->db->select_avg($field);
            $this->db->from($table);
        } else {
            $this->db->select_avg($field)->where($wherefield);
            $this->db->from($table);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function min($field, $wherefield, $table) {
        if ($wherefield == "") {

            $this->db->select_min($field);
            $this->db->from($table);
        } else {
            $this->db->select_min($field)->where($wherefield);
            $this->db->from($table);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function max($field, $wherefield, $table) {
        if ($wherefield == "") {

            $this->db->select_max($field);
            $this->db->from($table);
        } else {
            $this->db->select_max($field)->where($wherefield);
            $this->db->from($table);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function join($fields, $wherefieldtablefrom, $tablefrom, $tablejoin, $tablejoincondition) {

        if ($wherefieldtablefrom == "") {

            $this->db->select($fields); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'natural'); // $this->db->join('table2', 'table1.col1 = table2.col1');
            //$query = $this->db->get();
//            if ($query->num_rows() == 1) {
//                $data = $query->row();
//            } else if ($query->num_rows() > 1) {
//                $data = $query->result_array();
//            }
        } else {

            $this->db->select($fields); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'natural'); // $this->db->join('table2', 'table1.col1 = table2.col1');
            $this->db->where($wherefieldtablefrom); // $this->db->where('table1.col1', 2);
            //$query = $this->db->get();
//            if ($query->num_rows() == 1) {
//                $data = $query->row();
//            } else if ($query->num_rows() > 1) {
//                $data = $query->result_array();
//            }
        }


        $query = $this->db->get();
        return $query->result();
    }
    
     public function join_left($fields, $wherefieldtablefrom, $tablefrom, $tablejoin, $tablejoincondition) {

        if ($wherefieldtablefrom == "") {

            $this->db->select($fields); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'inner'); // $this->db->join('table2', 'table1.col1 = table2.col1');

        } else {

            $this->db->select($fields); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'inner'); // $this->db->join('table2', 'table1.col1 = table2.col1');
            $this->db->where('job_estimate_tbl','job_estimate_tbl.customer_id = CUS1001 AND job_estimate_tbl.est_status = Pending'); // $this->db->where('table1.col1', 2);

        }


        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    
    public function join_sum($sum_field, $wherefieldtablefrom, $tablefrom, $tablejoin, $tablejoincondition) {

        if ($wherefieldtablefrom == "") {

          $this->db->select_sum($sum_field); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'natural'); // $this->db->join('table2', 'table1.col1 = table2.col1');
            //$query = $this->db->get();
//            if ($query->num_rows() == 1) {
//                $data = $query->row();
//            } else if ($query->num_rows() > 1) {
//                $data = $query->result_array();
//            }
        } else {

            $this->db->select_sum('average_cost_price'); // $this->db->select('*');
            $this->db->from($tablefrom); // $this->db->from('table1');
            $this->db->join($tablejoin, $tablejoincondition, 'natural'); // $this->db->join('table2', 'table1.col1 = table2.col1');
            $this->db->where($wherefieldtablefrom); // $this->db->where('table1.col1', 2);
            //$query = $this->db->get();
//            if ($query->num_rows() == 1) {
//                $data = $query->row();
//            } else if ($query->num_rows() > 1) {
//                $data = $query->result_array();
//            }
        }


        $query = $this->db->get();
        return $query->result();
    }
    
    public function join_test($fieldArr, $from, $joinTable, $joinTableCondition, $join_type, $whereArr) {

        $this->db->select($fieldArr);
        $this->db->from($from);
        $this->db->join($joinTable, $joinTableCondition, $join_type);
        $this->db->where($whereArr);

        $query = $this->db->get();

        return $query->result();
    }

    public function upload_data($data) {


        $result = $this->db->insert($table, $data);
        return $result;

        // $this->load->database();
        // $this->db->insert('data',$data);     
        // return $this->db->insert_id();
    }

    /*
      $this->db->select('*');
      $this->db->from('blogs');
      $this->db->join('comments', 'comments.id = blogs.id');

      $query = $this->db->get();

      Produces:
      SELECT * FROM blogs
      JOIN comments ON comments.id = blogs.id

      $this->db->join('comments', 'comments.id = blogs.id', 'left');
      Produces: LEFT JOIN comments ON comments.id = blogs.id
     */
}
