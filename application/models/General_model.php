<?php

class General_model extends CI_Model
{

    // SELECT -----------------------------------------------------------------------------------------

    public function fetch_specific_val($fields, $where, $tables, $order = null)
    { //get 1  record
        $this->db->trans_start();
        $this->db->select($fields);
        $this->db->where($where);
        if ($order !== null) {
            $this->db->order_by($order);
        }
        $query = $this->db->get($tables);
        $this->db->trans_complete();
        return $query->row();
    }

    public function fetch_specific_vals($fields, $where, $tables, $order = null)
    { //get more than 1 records
        $this->db->trans_start();
        $this->db->select($fields);
        $this->db->where($where);
        if ($order !== null) {
            $this->db->order_by($order);
        }
        $query = $this->db->get($tables);
        $this->db->trans_complete();
        return $query->result();
    }

    public function fetch_all($fields, $tables, $order = null)
    { //get all records
        $this->db->trans_start();
        $this->db->select($fields);
        if ($order !== null) {
            $this->db->order_by($order);
        }
        $query = $this->db->get($tables);
        $this->db->trans_complete();
        return $query->result();
    }

    // INSERT -----------------------------------------------------------------------------------------

    public function insert_vals($data, $table) // simple insert

    {
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function batch_insert($data, $table)
    {
        $this->db->trans_start();
        $this->db->insert_batch($table, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insert_array_vals($data, $table) // Optional

    {
        $this->db->trans_start();
        for ($loop = 0; $loop < count($data); $loop++) {
            $this->db->insert($table, $data[$loop]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insert_vals_last_inserted_id($data, $table) //Simple Insert and return last inserted ID

    {
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $lastInsertId = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return $lastInsertId;
        }
    }

    public function batch_insert_first_inserted_id($data, $table)
    { // Batch Insert and return first inserted ID
        $this->db->trans_start();
        $this->db->insert_batch($table, $data);
        $firstInsertedId = $this->db->insert_id();
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return $firstInsertedId;
        }
    }

    // UPDATE -----------------------------------------------------------------------------------------

    public function update_vals($data, $where, $table)
    {
        $this->db->trans_start();
        $this->db->where($where);
        $this->db->update($table, $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function custom_update_vals($data, $where, $table)
    { //custom update
        $this->db->where($where);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update_array_vals($array, $table)
    { // Optional
        $this->db->trans_start();
        for ($loop = 0; $loop < count($array); $loop++) {
            $this->db->set($array[$loop]['data']);
            $this->db->where($array[$loop]['where']);
            $this->db->update($table);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function batch_update($data, $field, $table)
    {
        $this->db->trans_start();
        $this->db->update_batch($table, $data, $field);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    // DELETE -----------------------------------------------------------------------------------------

    public function delete_vals($where, $table)
    {
        $this->db->trans_start();
        $this->db->where($where);
        $this->db->delete($table);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    // CUSTOM QUERY -----------------------------------------------------------------------------------------

    public function custom_query($qry)
    { //custom query
        $this->db->trans_start();
        $query = $this->db->query($qry);
        $this->db->trans_complete();
        return $query->result();
    }

    public function custom_query_yield($qry)
    { //custom query
        $this->db->trans_start();
        $query = $this->db->query($qry);
        $this->db->trans_complete();
        foreach($query->result() as $row) {
            yield $row;
        }
    }
    public function custom_query_row($qry)
    { //custom query
        $this->db->trans_start();
        $query = $this->db->query($qry);
        $this->db->trans_complete();
        return $query->row();
    }

    public function custom_query_no_return($qry)
    { //custom query
        $this->db->trans_start();
        $this->db->query($qry);
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function custom_query_no_return_array($array)
    { //arrays of queries
        $this->db->trans_start();
        for ($loop = 0; $loop < count($array); $loop++) {
            $this->db->query($array[$loop]);
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === false) {
            return 0;
        } else {
            return 1;
        }
    }

    public function join_select($query)
    {
        $this->db->trans_start();
        $this->db->select($query['fields']);
        $this->db->from($query['table']);
        foreach ($query['join'] as $key => $val) {
            $this->db->join($key, $val);
        }
        if (isset($query['where'])) {
            $this->db->where($query['where']);
        }
        $data = $this->db->get();
        $this->db->trans_complete();
        return $data->result();
    }

}