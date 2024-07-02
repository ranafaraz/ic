<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class TestFeeModel extends MY_Model{

    public function get_fee_groups() {
        $this->db->select('tfg.*, tft.title');
        $this->db->from('test_fee_groups as tfg');
        $this->db->join('test_fee_type as tft', 'tft.id = tfg.fee_type_id', 'inner');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_fee_group_details($fee_group_ids) {
        $this->db->select('tfgd.id, tfgd.fee_type_id, tfgd.amt, tfgd.due_date, tft.title as fee_type_title');
        $this->db->from('test_fee_groups_details tfgd');
        $this->db->join('test_fee_type tft', 'tft.id = tfgd.fee_type_id');
        $this->db->where_in('tfgd.fee_groups_id', $fee_group_ids);
//        $this->db->where_in('fee_groups_id', $fee_group_ids);
//        $query = $this->db->get('test_fee_groups_details');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_fee_group_detail($id) {
        $this->db->where('id', $id);
        return $this->db->delete('test_fee_groups_details');
    }

    public function insert_fee_allocation($data) {
        $this->db->insert_batch('test_fee_allocation', $data);
    }
}

