<?php

require '/var/www/my.manic.host/application/third_party/opensrs/openSRS_loader.php';

class Email_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
    }

    function getEmail($user_id = null) {
        $email_packages = array();

        if ($user_id==null)
            $user_id = $this->session->userdata('userid');
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('email_domain');
        foreach ($results->result() as $row) {
            $this->db->where('domain_id', $row->id);
            $email_results = $this->db->get('email_address');
            foreach ($email_results->result() as $email_row) {
                $email_packages[] = array(
                    'id' => $email_row->id,
                    'email' => $email_row->prefix."@".$row->domain,
                    'type' => $email_row->type,
                    'expiry' => $email_row->expiry
                );
            }
        }

        return $email_packages;
    }

    function addMailbox($email,$password) {
        $user_id = $this->session->userdata('userid');

        $email = explode("@",$email);
        $prefix = $email[0];
        $domain = $email[1];

        $callArray = array (
            "func" => "mailGetDomain",
            "data" => array (
                "domain" => $domain,
            )
        );

        $osrsHandler = processOpenSRS("array", $callArray);
        $domain_details = $osrsHandler->resultRaw;

        $domain_exists = true;
        if ($domain_details==null)
            $domain_exists = false;
        else if (!$domain_details['is_success'])
            $domain_exists = false;

        if (!$domain_exists) {
            $callArray = array (
                "func" => "mailCreateDomain",
                "data" => array (
                    "domain" => $domain,
                    "spam_level" => 'NORMAL'
                )
            );

            $osrsHandler = processOpenSRS("array", $callArray);
            $callArray = array (
                "func" => "mailGetDomain",
                "data" => array (
                    "domain" => $domain,
                )
            );

            $osrsHandler = processOpenSRS("array", $callArray);
            $domain_details = $osrsHandler->resultRaw;

            $domain_exists = true;
            if ($domain_details==null)
                return false;
            else if (!$domain_details['is_success'])
                return false;

            $insert_data = array(
                'user_id' => $user_id,
                'domain' => $domain
            );
            $this->db->insert('email_domain',$insert_data);
            $domain_id = $this->db->insert_id();
        } else {
            $this->db->where('domain',$domain);
            $results = $this->db->get('email_domain');
            $row = $results->row();
            if ($row->user_id != $user_id)
                return false;
            $domain_id = $row->id;
        }

        $callArray = array (
            "func" => "mailGetDomainMailboxes",
            "data" => array (
                "domain" => $domain,
            )
        );
        $osrsHandler = processOpenSRS("array", $callArray);
        $details = $osrsHandler->resultRaw;
        if (isset($details['attributes']['list'])) {
            foreach ($details['attributes']['list'] as $domain_email) {
                if ($domain_email['mailbox'] == $prefix)
                    return false;
            }
        }

        $callArray = array (
            "func" => "mailCreateMailbox",
            "data" => array (
                "domain" => $domain,
                "mailbox" => $prefix,
                "password" => $password,
                "workgroup" => "staff"
            )
        );
        $osrsHandler = processOpenSRS("array", $callArray);
        $details = $osrsHandler->resultRaw;

        if (!isset($details['is_success']))
            return false;
        if ($details['is_success']) {
            $insert_data = array(
                'domain_id' => $domain_id,
                'prefix' => $prefix,
                'type' => 'Mailbox',
                'expiry' => time("+1 month")
            );
            $this->db->insert('email_address',$insert_data);

            return true;
        }
        return false;
    }

    function addForwarder($email, $forward_email) {

    }

    function remove($id) {
        $this->db->where('id',$id);
        $results = $this->db->get('email_address');
        $row = $results->row();
    }
}