<?php

class Logs extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
    }

    function log($message, $icon_type = null, $call_to_action = null, $override_user_id = null) {
        $user_id = $this->session->userdata('userid');
        if ($override_user_id!=null)
            $user_id = $override_user_id;

        $insert_data = array(
            'user_id' => $user_id,
            'message' => $message,
            'icon' => $icon_type,
            'cta' => $call_to_action,
            'ip_address' => $_SERVER['REMOTE_ADDR']
        );
        $this->db->insert('auditlogs',$insert_data);
    }

    function getLogs($fullset = false) {
        $LOGS_LIMIT = 30;
        if ($fullset)
            $LOGS_LIMIT = 9999999;

        $logs = array();

        $this->db->where('user_id', $this->session->userdata('userid'));
        $this->db->order_by("id", "desc");
        $this->db->limit($LOGS_LIMIT);

        $results = $this->db->get('auditlogs');
        foreach ($results->result() as $row) {
            $row->timestamp = strtotime($row->timestamp);
            $logs[] = $row;
        }

        $this->db->where('id', $this->session->userdata('userid'));
        $user_result = $this->db->get('user');
        $user = $user_result->row();
        $this->db->where('api_key',$user->apikey);
        $this->db->limit($LOGS_LIMIT);
        $results = $this->db->get('logs');
        foreach ($results->result() as $row) {
            $uri = substr($row->uri,4);
            $log = new stdClass();
            $log->message = 'A '.strtoupper($row->method)." API call was made to ".$uri;
            $log->icon = 'plug:primary';
            $log->cta = null;
            $log->timestamp = $row->time;
            $log->ip_address = $row->ip_address;
            $logs[] = $log;
        }

        if ($fullset)
            usort($logs, function($a, $b) {
                return ($a->timestamp > $b->timestamp);
            });
        else
            usort($logs, function($a, $b) {
                return ($a->timestamp < $b->timestamp);
            });

        return array_slice($logs, 0, $LOGS_LIMIT);
    }
}