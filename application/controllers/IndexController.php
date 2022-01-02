<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('IndexModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $data['items'] = $this->IndexModel->getAllItemModel();
        $this->load->view('Index.php', $data);
    }

    public function addItem()
    {
        $itemName = $this->input->post('itemName');
        $itemPrice = $this->input->post('itemPrice');
        $itemStatus = $this->input->post('itemStatus');
        $itemDesc = $this->input->post('itemDesc');

        $config['upload_path'] = './assets/items';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']     = '0';

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('itemImg')) {

            if (!empty($_FILES['itemImg']['name'])) {

                $this->session->set_tempdata('error', $this->upload->display_errors('', ''), 1);
                redirect(base_url());
            } else {
                if ($this->IndexModel->addItemModel($itemName, $itemPrice, NULL, $itemStatus, $itemDesc) !== false) {
                    $this->session->set_tempdata('notice', 'Item has been added succesfully.', 1);
                } else {
                    $this->session->set_tempdata('error', 'Failed to add the new item.', 1);
                }
                redirect(base_url());
            }
        } else {

            $itemImg = $this->upload->data('file_name');

            if ($this->IndexModel->addItemModel($itemName, $itemPrice, $itemImg, $itemStatus, $itemDesc) !== false) {
                $this->session->set_tempdata('notice', 'Item has been added succesfully.', 1);
            } else {
                $this->session->set_tempdata('error', 'Failed to add the new item.', 1);
            }
            redirect(base_url());
        }
    }

    public function deleteItem($itemID)
    {
        if ($this->IndexModel->deleteItemModel($itemID) !== false) {
            $this->session->set_tempdata('notice', 'The item has been delete succesfully.', 1);
        } else {
            $this->session->set_tempdata('error', 'Failed to delete the item.', 1);
        }
        redirect(base_url());
    }
}
