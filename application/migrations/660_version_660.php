<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_660 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
		$this->db->query("TRUNCATE TABLE `email_templates`;");
		$this->db->query("INSERT INTO `email_templates` (`id`, `name`, `tags`) VALUES
						(1, 'account_registered', '{institute_name}, {name}, {login_username}, {password}, {user_role}, {login_url}'),
						(2, 'forgot_password', '{institute_name}, {username}, {email}, {reset_url}'),
						(3, 'change_password', '{institute_name}, {name}, {email}, {password}'),
						(4, 'new_message_received', '{institute_name}, {recipient}, {message}, {message_url}'),
						(5, 'payslip_generated', '{institute_name}, {username}, {month_year}, {payslip_url}'),
						(6, 'award', '{institute_name}, {winner_name}, {award_name}, {gift_item}, {award_reason}, {given_date}'),
						(7, 'leave_approve', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
						(8, 'leave_reject', '{institute_name}, {applicant_name}, {start_date}, {end_date}, {comments}'),
						(9, 'advance_salary_approve', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}'),
						(10, 'advance_salary_reject', '{institute_name}, {applicant_name}, {deduct_motnh}, {amount}, {comments}'),
						(11, 'apply_online_admission', '{institute_name}, {reference_no}, {applicant_name}, {applicant_mobile}, {class}, {section}, {apply_date}, {payment_url}, {admission_copy_url}, {paid_amount}'),
						(12, 'student_admission', '{institute_name}, {academic_year}, {admission_date}, {admission_no}, {roll}, {category}, {student_name}, {student_mobile}, {class}, {section}, {login_username}, {password}, {login_url}'),
						(13, 'email_pdf_exam_marksheet', '{institute_name}, {academic_year}, {admission_date}, {admission_no}, {roll}, {student_name}, {class}, {section}, {exam_name}'),
						(14, 'email_pdf_fee_invoice', '{institute_name}, {academic_year}, {today_date}, {admission_date}, {admission_no}, {roll}, {student_name}, {class}, {section}');");	
    }
}
