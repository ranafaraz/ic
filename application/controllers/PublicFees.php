<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package : Ramom school management system
 * @version : 4.0
 * @developed by : RamomCoder
 * @support : ramomcoder@yahoo.com
 * @author url : http://codecanyon.net/user/RamomCoder
 * @filename : Fees.php
 * @copyright : Reserved RamomCoder Team
 */
class Fees extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('fees_model');
    }

    // Insert Fee in Fee_Payment_History
    public function adjust_paid_vouchers() {
        $data = $this->fees_model->get_unprocessed_vouchers();
        $this->fees_model->create_payment_history($data);
        print_r($data);
    }

}
