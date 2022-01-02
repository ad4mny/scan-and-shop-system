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

    public function deleteItemModel($itemID)
    {
        $this->db->select('*');
        $this->db->from('itemData');
        $this->db->where('itemID', $itemID);

        $data = $this->db->get()->row_array();

        if ($data['itemImg'] !== NULL) {
            unlink(base_url() . 'assets/items/' . $data['itemImg']);
        }

        $this->db->where('itemID', $itemID);
        return $this->db->delete('itemData');
    }
}
