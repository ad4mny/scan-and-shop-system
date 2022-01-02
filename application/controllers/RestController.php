<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') or exit('No direct script access allowed');

class RestController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RestModel');
    }

    public function setPayment()
    {
        $customerID = $this->input->post('customerID');
        $itemArray = $this->input->post('itemArray');
        $paymentTotal = $this->input->post('paymentTotal');

        if ($customerID == null) {
            $customerID = date('ymdHis') . mt_rand(1000, 9999);
        }
        
        if ($this->RestModel->setPaymentModel($customerID, $itemArray, $paymentTotal) !== false) {
            echo json_encode($customerID);
            exit;
        } else {
            echo json_encode(false);
            exit;
        }
    }

    public function getCartInfo()
    {
        $itemArray = $this->input->post('itemArray');
        echo json_encode($this->RestModel->getCartInfoModel($itemArray));
        exit;
    }

    public function getItemDetail()
    {
        $itemID = $this->input->post('itemID');
        echo json_encode($this->RestModel->getItemDetailModel($itemID));
        exit;
    }

    public function getHistory()
    {
        $customerID = $this->input->post('customerID');
        echo json_encode($this->RestModel->getHistoryModel($customerID));
        exit;
    }
}
