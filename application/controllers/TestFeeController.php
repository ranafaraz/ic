<?php
defined('BASEPATH') or exit('No direct script access allowed');


class TestFeeController extends Admin_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('TestFeeModel');
    }

    public function fetch_fee_groups() {

//        if (!get_permission('fees_reports', 'is_view')) {
//            access_denied();
//        }
//        $branchID = $this->application_model->get_branch_id();
        $this->data['fee_groups'] = $this->TestFeeModel->get_fee_groups();
//        $this->load->view('test_fee_view', $data);
        $this->data['title'] = translate('test_fee_view');
        $this->data['sub_page'] = 'fees/test_fee_view';
        $this->data['main_menu'] = 'fees';
        $this->load->view('layout/index', $this->data);
    }

    public function fetch_fee_group_details() {
        $fee_group_ids = $this->input->post('fee_group_ids');
        $fee_group_details = $this->TestFeeModel->get_fee_group_details($fee_group_ids);
        echo json_encode($fee_group_details);
    }

    public function delete_fee_group_detail() {
        $id = $this->input->post('id');
        $this->load->model('TestFeeModel');
        $result = $this->TestFeeModel->delete_fee_group_detail($id);

        if ($result) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the record.']);
        }
    }

    public function save_fee_allocation() {
        $fee_allocations = $this->input->post('fee_allocation');
        $branch_id = $this->input->post('branch_id');

        $data = [];
        foreach ($fee_allocations as $id => $allocation) {
            $data[] = [
                'branch_id' => $branch_id,
                'class_id' => 1,
                'section_id' => 1,
                'session_id' => 1,
                'fee_type_id' => $allocation['fee_type_id'],
                'original_amt' => $allocation['amt'],
                'discount' => $allocation['discount'],
                'net_receivable' => $allocation['net_receivable'],
                'due_date' => $allocation['due_date'],
                'status' => 1,
                'student_id' => 1
            ];
        }

        $this->TestFeeModel->insert_fee_allocation($data);
        redirect('TestFeeController/success');
    }
    public function success() {
        // Success message or redirection after saving data
        $this->session->set_flashdata('msg_success', translate('Fee allocation saved successfully.'));
        redirect('TestFeeController/fetch_fee_groups');
    }
}
