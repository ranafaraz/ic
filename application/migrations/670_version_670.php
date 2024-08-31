<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_670 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {

		$exist_qrcode = $this->db->select('id')->limit(1)->where('prefix', 'qrcode')->get('addon')->num_rows();
		if ($exist_privileges == 1) {
			
            $this->db->where_in('permission_id', ['501','502','503','504','505','518']);
            $this->db->delete('staff_privileges');

			$row = $this->db->where('prefix', 'qr_code_student_attendance')->get('permission')->row();
			if (!empty($row)) {
				$this->db->where('id', $row->id);
				$this->db->update('permission', ['id' => 501]);

				$this->db->where('permission_id', $row->id);
				$this->db->update('staff_privileges', ['permission_id' => 501]);
			}
			$row = $this->db->where('prefix', 'qr_code_employee_attendance')->get('permission')->row();
			if (!empty($row)) {
				$this->db->where('id', $row->id);
				$this->db->update('permission', ['id' => 502]);

				$this->db->where('permission_id', $row->id);
				$this->db->update('staff_privileges', ['permission_id' => 502]);
			}
			$row = $this->db->where('prefix', 'qr_code_student_attendance_report')->get('permission')->row();
			if (!empty($row)) {
				$this->db->where('id', $row->id);
				$this->db->update('permission', ['id' => 503]);

				$this->db->where('permission_id', $row->id);
				$this->db->update('staff_privileges', ['permission_id' => 503]);
			}
			$row = $this->db->where('prefix', 'qr_code_employee_attendance_report')->get('permission')->row();
			if (!empty($row)) {
				$this->db->where('id', $row->id);
				$this->db->update('permission', ['id' => 504]);

				$this->db->where('permission_id', $row->id);
				$this->db->update('staff_privileges', ['permission_id' => 504]);
			}
			$row = $this->db->where('prefix', 'qr_code_settings')->get('permission')->row();
			if (!empty($row)) {
				$this->db->where('id', $row->id);
				$this->db->update('permission', ['id' => 505]);

				$this->db->where('permission_id', $row->id);
				$this->db->update('staff_privileges', ['permission_id' => 505]);
			}
		}

    }
}
