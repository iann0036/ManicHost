<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('database');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->helper('mail');
    }

    public function index() {
        $REMINDER_PERIOD = 7 * 24 * 60 * 60;
        $ROTATION_LENGTH = 24 * 60 * 60;

        /* Domains */
        $results = $this->db->get('domain');
        foreach ($results->result() as $row) {
            if ($row->expiry > (time() + $REMINDER_PERIOD) && $row->expiry < (time() + $REMINDER_PERIOD + $ROTATION_LENGTH) && !$row->deletion_scheduled) {
                $this->db->where('id',$row->user_id);
                $user_results = $this->db->get('user');
                $user = $user_results->row();
                sendDomainReminderMail($user->email,$user->name,$row->domain);
            } else if ($row->expiry < time()) {
                // REMOVE DOMAINS
            }
        }
    }
}
