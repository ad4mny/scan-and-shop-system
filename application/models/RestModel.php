<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RestModel extends CI_Model
{
    public function setPaymentModel($customerID = NULL, $itemArray = [], $paymentTotal = NULL)
    {
        $cartID = uniqid();
        $data = [];

        foreach ($itemArray as $key => $value) {
            array_push(
                $data,
                array(
                    'cartID' => $cartID,
                    'itemID' => $key,
                    'cartQuantity' => $value
                )
            );
        }

        $this->db->insert_batch('cartData', $data);

        $data = array(
            'cartID' => $cartID,
            'customerID' => $customerID,
            'paymentTotal' => $paymentTotal,
            'paymentStatus' => 'Success',
        );

        return $this->db->insert('paymentData', $data);
    }

    public function getCartInfoModel($itemArray = [])
    {
        $data = [];

        foreach ($itemArray as $key => $value) {
            array_push($data, $key);
        }

        $this->db->select('*');
        $this->db->from('itemData');
        $this->db->where_in('itemID', $data);
        return $this->db->get()->result_array();
    }

    public function getItemDetailModel($itemID = NULL)
    {
        $this->db->select('*');
        $this->db->from('itemData');
        $this->db->where('itemID', $itemID);
        return $this->db->get()->row_array();
    }

    public function getHistoryModel($customerID = NULL)
    {
        $this->db->select('*');
        $this->db->from('paymentData');
        $this->db->where('customerID', $customerID);
        return $this->db->get()->result_array();
    }
}
