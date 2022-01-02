<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexModel extends CI_Model
{
    public function getAllItemModel()
    {
        $this->db->select('*');
        $this->db->from('itemData');
        return $this->db->get()->result_array();
    }

    public function addItemModel($itemName, $itemPrice, $itemImg, $itemStatus, $itemDesc)
    {
        $data = array(
            'itemName' => $itemName,
            'itemPrice' => $itemPrice,
            'itemImg' => $itemImg,
            'itemStatus' => $itemStatus,
            'itemDesc' => $itemDesc,
        );

        return $this->db->insert('itemData', $data);
    }
}
