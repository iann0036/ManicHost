<?php

class Invoices_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('Logs');
        $this->load->database();
    }

    function addInvoice($total) {
        $user_id = $this->session->userdata('userid');

        $insert_data = array(
            'user_id' => $user_id,
            'duedate' => time(),
            'total' => $total,
            'status' => 'PAID'
        );
        $this->db->insert('invoice',$insert_data);

        $invoice_id = $this->db->insert_id();

        $this->Logs->log('An invoice was generated','file-text:info');

        return $invoice_id;
    }

    function getInvoices() {
        $invoices = array();

        $user_id = $this->session->userdata('userid');
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('invoice');
        foreach ($results->result() as $row) {
            $invoices[] = $row;
        }

        return array_reverse($invoices);
    }

    function checkOwnership($id) {
        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('userid'));
        $results = $this->db->get('invoice');
        if ($results->num_rows()>0)
            return true;
        return false;
    }
}