<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise_call extends Frontend_Controller
{
//
    public function __construct()
    { //
        parent::__construct();
        $this->load->helpers('custom_fields');
        $this->load->model('fees_model');
        $this->load->model('email_model');
        $this->load->library('mailer');
        $this->load->library('home_model');
    }

//
    public function index()
    {

        if ($_POST) {
//            print_r($this->input->post('first_name'));
            $arrayData = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'cnic' => $this->input->post('cnic'),
                'gender' => $this->input->post('gender'),
                'cell_no' => $this->input->post('cell_no'),
                'email' => $this->input->post('email'),
                'mailing_address' => $this->input->post('mailing_address'),
                'created_at' => date("Y-m-d H:i:s")
            );
            $this->db->insert('f_expression_of_interest', $arrayData);

            $user_id = $this->db->insert_id();

            if ($user_id) {
                $arrAddress = array(
                    'country' => $this->input->post('country'),
                    'province' => $this->input->post('province'),
                    'district' => $this->input->post('district'),
                    'user_id' => $user_id
                );
                $this->db->insert('f_address', $arrAddress);
                $arrEducation = array(
                    'degree' => $this->input->post('degree_name'),
                    'institute' => $this->input->post('institute'),
                    'year' => $this->input->post('year'),
                    'user_id' => $user_id
                );
                $this->db->insert('f_education', $arrEducation);
                $arrEmployment = array(
                    'employerName' => $this->input->post('emp_name'),
                    'natureBusiness' => $this->input->post('business_nature'),
                    'dateEmp' => $this->input->post('date_employed'),
                    'positionHeld' => $this->input->post('position'),
                    'user_id' => $user_id
                );
                $this->db->insert('f_employment', $arrEmployment);
                $this->session->set_flashdata('message', "Your request submitted Successfully...");

                $url = base_url("/home/index");
//                $error = $this->form_validation->error_array();
                $array = array('status' => 'success', 'url' => $url);
            } else {

                $this->session->set_flashdata('error-message', "Please Try again with correct data...");
                $array = array('status' => 'fail', 'error' => '');
//                redirect(site_url('home'));
            }

            echo json_encode($array);
            exit();
//                redirect(site_url('home'));
        } else {


//            print_r($arrayData);
//            die();
//            $this->data['main_contents'] = $this->load->view('home/admission', $this->data, true);
//            $this->load->view('home/layout/index', $this->data);

//        $this->data['branchID'] = $branchID;
//        $this->data['page_data'] = $this->home_model->get('front_cms_admission', array('branch_id' => $branchID), true);
//        $this->data['main_contents'] = $this->load->view('home/expression_of_interest', $this->data, true);
            $this->data['main_contents'] = $this->load->view('home/franchise_call', $this->data, true);
            $this->load->view('home/layout/index', $this->data);
        }
    }

    public
    function franchise_call()
    {
//        print_r($this->input->post());
//        die();
        if (!$this->data['cms_setting']['online_admission']) {
            redirect(site_url('home'));
        }
        $branchID = $this->home_model->getDefaultBranch();
        $captcha = $this->data['cms_setting']['captcha_status'];
        if ($captcha == 'enable') {
            $this->load->library('recaptcha');
            $this->data['recaptcha'] = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
        }
        if ($_POST) {
            $this->form_validation->set_rules('class_id', translate('class'), 'trim|required');
            $this->form_validation->set_rules('first_name', translate('first_name'), 'trim|required');
            $this->form_validation->set_rules('last_name', translate('last_name'), 'trim|required');
            $this->form_validation->set_rules('email', translate('email'), 'trim|required|valid_email');
            $this->form_validation->set_rules('gender', translate('gender'), 'trim|required');
            $this->form_validation->set_rules('birthday', translate('birthday'), 'trim|required');
            $this->form_validation->set_rules('mobile_no', translate('mobile_no'), 'trim|required|numeric');
            $this->form_validation->set_rules('address', translate('address'), 'trim|required');
            $this->form_validation->set_rules('guardian_name', translate('guardian_name'), 'trim|required');
            $this->form_validation->set_rules('grd_occupation', translate('occupation'), 'trim|required');
            $this->form_validation->set_rules('guardian_relation', translate('guardian_relation'), 'trim|required');
            $this->form_validation->set_rules('grd_mobile_no', translate('guardian') . " " . translate('mobile_no'), 'trim|required|numeric');
            $this->form_validation->set_rules('grd_address', translate('guardian') . " " . translate('address'), 'trim|required');
            if ($captcha == 'enable') {
                $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|required');
            }
            // custom fields validation rules
            $customFields = getCustomFields('online_admission', $branchID);
            foreach ($customFields as $fields_key => $fields_value) {
                if ($fields_value['required']) {
                    $fieldsID = $fields_value['id'];
                    $fieldLabel = $fields_value['field_label'];
                    $this->form_validation->set_rules("custom_fields[online_admission][" . $fieldsID . "]", $fieldLabel, 'trim|required');
                }
            }

            if ($this->form_validation->run() == true) {
                $arrayData = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'gender' => $this->input->post('gender'),
                    'birthday' => date("Y-m-d", strtotime($this->input->post('birthday'))),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'guardian_name' => $this->input->post('guardian_name'),
                    'guardian_relation' => $this->input->post('guardian_relation'),
                    'father_name' => $this->input->post('father_name'),
                    'mother_name' => $this->input->post('mother_name'),
                    'grd_occupation' => $this->input->post('grd_occupation'),
                    'grd_income' => $this->input->post('grd_income'),
                    'grd_education' => $this->input->post('grd_education'),
                    'grd_email' => $this->input->post('grd_email'),
                    'grd_mobile_no' => $this->input->post('grd_mobile_no'),
                    'grd_address' => $this->input->post('grd_address'),
                    'status' => 1,
                    'branch_id' => $branchID,
                    'class_id' => $this->input->post('class_id'),
                    'section_id' => $this->input->post('section_id'),
                    'apply_date' => date("Y-m-d H:i:s"),
                );
                $this->db->insert('online_admission', $arrayData);
                $studentID = $this->db->insert_id();

                // handle custom fields data
                $class_slug = 'online_admission';
                $customField = $this->input->post("custom_fields[$class_slug]");
                if (!empty($customField)) {
                    saveCustomFields($customField, $studentID);
                }
                // check out admission payment status
                $this->load->model('admissionpayment_model');
                $getStudent = $this->admissionpayment_model->getStudentDetails($studentID);
                if ($getStudent['fee_elements']['status'] == 0) {
                    $url = base_url("home/admission_confirmation/" . $studentID);

                    // applicant email send
                    $arrayData['institute_name'] = get_type_name_by_id('branch', $arrayData['branch_id']);
                    $arrayData['admission_id'] = $studentID;
                    $arrayData['student_name'] = $arrayData['first_name'] . " " . $arrayData['last_name'];
                    $arrayData['class_name'] = get_type_name_by_id('class', $arrayData['class_id']);
                    $arrayData['section_name'] = get_type_name_by_id('section', $arrayData['section_id']);
                    $arrayData['payment_url'] = "";
                    $arrayData['admission_copy_url'] = $url;
                    $arrayData['paid_amount'] = 0;
                    $this->email_model->onlineAdmission($arrayData);

                    $success = "Thank you for submitting the online registration form. Please you can print this copy.";
                    $this->session->set_flashdata('success', $success);
                } else {
                    $url = base_url("admissionpayment/index/" . $studentID);
                }
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
        }

        $this->data['branchID'] = $branchID;
        $this->data['page_data'] = $this->home_model->get('front_cms_admission', array('branch_id' => $branchID), true);
        $this->data['main_contents'] = $this->load->view('home/admission', $this->data, true);
        $this->load->view('home/layout/index', $this->data);
    }

    public
    function franchise_call_request()
    {
        if ($_POST) {
            $this->form_validation->set_rules('cell_no', translate('Cell Number'), 'required|numeric');

            if ($this->form_validation->run() == true) {
//            print_r($this->input->post());
//            die();
//            $arrayData = [];
//            foreach ($this->input->post() as $post){
                $arrayq1 = array(
                    'question_id' => $this->input->post('q1'),
                    'option_id' => $this->input->post('new_conversion'),
                    'isactive' => "1"
                );
                $this->db->insert('f_question_answers', $arrayq1);
                $arrayq2 = array(
                    'question_id' => $this->input->post('q2'),
                    'option_id' => $this->input->post('students'),
                    'isactive' => "1"
                );
                $this->db->insert('f_question_answers', $arrayq2);
                $arrayq3 = array(
                    'question_id' => $this->input->post('q3'),
                    'option_id' => $this->input->post('fee'),
                    'isactive' => "1"
                );
                $this->db->insert('f_question_answers', $arrayq3);
                $arrayq4 = array(
                    'question_id' => $this->input->post('q4'),
                    'option_id' => $this->input->post('investment'),
                    'isactive' => "1"
                );
                $this->db->insert('f_question_answers', $arrayq4);
                $arrayq5 = array(
                    'question_id' => $this->input->post('q5'),
                    'input' => $this->input->post('cell_no'),
                    'isactive' => "1"
                );
                $this->db->insert('f_question_answers', $arrayq5);

                $this->session->set_flashdata('message', "Your request submitted Successfully...");
                $url = base_url("/home/index");
                $array = array('status' => 'success', 'url' => $url);
            } else {
                $error = $this->form_validation->error_array();
                $array = array('status' => 'fail', 'error' => $error);
            }
            echo json_encode($array);
            exit();
//            }

//            print_r($arrayq1);
//            die();
//            $this->db->insert('f_expression_of_interest', $arrayData);

//            $user_id = $this->db->insert_id();

//            if ($user_id) {
//                $this->db->insert('f_employment', $arrEmployment);

//                $error = $this->form_validation->error_array();

//            } else {

//                $this->session->set_flashdata('error-message', "Please Try again with correct data...");
//                $array = array('status' => 'fail', 'error' => '');
//                redirect(site_url('home'));
//            }

//                redirect(site_url('home'));
        } else {
            $this->data['main_contents'] = $this->load->view('home/franchise_call_request', $this->data, true);
            $this->load->view('home/layout/index', $this->data);
        }

    }

    public function view(){
        $question_answers = $this->home_model->question_answers();
        $this->data['answers'] = $question_answers;
        $this->data['main_contents'] = $this->load->view('home/answers_view', $this->data, true);
        $this->load->view('home/layout/index', $this->data);

    }
}