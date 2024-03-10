<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Version_620 extends CI_Migration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up()
    {
		$this->db->query("ALTER TABLE `addon` ADD `items_code` varchar(255) DEFAULT NULL AFTER `purchase_code`;");
		$this->db->query("ALTER TABLE `addon` ADD `last_update` datetime DEFAULT NULL AFTER `created_at`;");
		$this->db->query("ALTER TABLE `language_list` ADD `rtl` tinyint(1) NOT NULL DEFAULT '0' AFTER `status`;");
		
		$this->db->query("ALTER TABLE `branch` ADD `currency_formats` tinyint NOT NULL DEFAULT '1' AFTER `symbol`;");
		$this->db->query("ALTER TABLE `branch` ADD `symbol_position` tinyint NOT NULL DEFAULT '1' AFTER `currency_formats`;");
		
		$this->db->query("ALTER TABLE `global_settings` ADD `currency_formats` tinyint NOT NULL DEFAULT '1' AFTER `currency_symbol`;");
		$this->db->query("ALTER TABLE `global_settings` ADD `symbol_position` tinyint NOT NULL DEFAULT '1' AFTER `currency_formats`;");
		
		$this->db->query("ALTER TABLE `offline_fees_payments` ADD `fine` float(10,2) NOT NULL AFTER `amount`;");
		
		$this->db->query("CREATE TABLE IF NOT EXISTS `exam_rank` (
						  `id` int NOT NULL AUTO_INCREMENT,
						  `exam_id` int NOT NULL,
						  `enroll_id` int NOT NULL,
						  `principal_comments` text CHARACTER SET utf8 COLLATE utf8_general_ci,
						  `teacher_comments` text CHARACTER SET utf8 COLLATE utf8_general_ci,
						  `rank` int NOT NULL DEFAULT '0',
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  `updated_at` date DEFAULT NULL,
						  PRIMARY KEY (`id`),
						  KEY `exam_group_class_batch_exam_id` (`exam_id`),
						  KEY `student_id` (`enroll_id`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
		
		
		$this->db->query("ALTER TABLE `exam` ADD `status` tinyint(1) NOT NULL DEFAULT '1' AFTER `mark_distribution`;");
		$this->db->query("ALTER TABLE `exam` ADD `publish_result` tinyint(1) NOT NULL DEFAULT '1' AFTER `status`;");
		$this->db->query("ALTER TABLE `exam` ADD `rank_generated` tinyint(1) NOT NULL DEFAULT '0' AFTER `publish_result`;");

		$this->db->query("INSERT INTO `permission` (`module_id`, `name`, `prefix`, `show_view`, `show_add`, `show_edit`, `show_delete`, `created_at`) VALUES
						(9, 'Generate Position', 'generate_position', 1, 0, 0, 0, '2023-08-10 15:08:29');");
		
		$purchase_paymentID = $this->db->select('id')->where('prefix', 'purchase_payment')->get('permission')->row()->id;
		$this->db->where('id', $purchase_paymentID)->update('permission', ['show_add' => 1]);

		$generate_positionID = $this->db->select('id')->where('prefix', 'generate_position')->get('permission')->row()->id;
		$this->db->query("INSERT INTO `staff_privileges` (`role_id`, `permission_id`, `is_add`, `is_edit`, `is_view`, `is_delete`) VALUES
						(2, " . $generate_positionID . ", 0, 0, 1, 0);");
    }
}
