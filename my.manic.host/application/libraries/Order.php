<?php
/**
 * Created by PhpStorm.
 * User: iann0036
 * Date: 23/3/2015
 * Time: 11:59 PM
 */

class Order {
    public $CI;

    function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->helper('mail');
        $this->CI->load->model('Ssl_model');
        $this->CI->load->model('Email_model');
    }

    private function _generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }

    public function run($user_id, $admin_details, $billing_details, $tech_details, $payment_details, $items) {
        $manual_provision_items = array();
        foreach ($items as $item) {
            if ($item['id']=="hosting_basic") {
                if ($this->_provisionHosting('basic',$user_id,$item,$admin_details))
                    continue;
            } else if ($item['id']=="hosting_standard") {
                if ($this->_provisionHosting('standard',$user_id,$item,$admin_details))
                    continue;
            } else if ($item['id']=="hosting_deluxe") {
                if ($this->_provisionHosting('deluxe',$user_id,$item,$admin_details))
                    continue;
            } else if ($item['id']=="ssl_positivessl") {
                if ($this->_provisionSSL('positivessl',$item, $admin_details, $tech_details))
                    continue;
            } else if ($item['id']=="email_forwarder") {
                if ($this->_createForwarder($item['options']['email_address'],$admin_details,$item))
                    continue;
            } else if ($item['id']=="email_mailbox") {
                if ($this->_createMailbox($item['options']['email_address'],$admin_details,$item))
                    continue;
            }
            $manual_provision_items[] = $item;
        }

        if (!empty($manual_provision_items))
            sendManualProvisionMail($admin_details['email'], $admin_details['firstname'], $manual_provision_items);
    }

    private function _provisionSSL($shortname, $item, $admin_details, $tech_details) {
        if ($shortname=="positivessl")
            $product_id = 45;
        else
            return false;

        $months = $item['options']['months'];
        $csr = $item['options']['csr'];
        $webserver = $item['options']['webserver'];
        $validation_email = $item['options']['validation_email'];
        $success = $this->CI->Ssl_model->addSSL($product_id, $csr, $months, $webserver, $validation_email, $admin_details, $tech_details, $item);
        if ($success) {
            sendProvisionedSSLMail($admin_details['email'], $admin_details['firstname'], $item['options']['domain']);

            return true;
        }

        return false;
    }

    private function _provisionHosting($plan, $user_id, $item, $admin_details) {
        $password = $this->_generatePassword();
        $insert_data = array(
            'user_id' => $user_id,
            'plan' => $plan,
            'domain' => $item['options']['domain'],
            'password' => $password,
            'expiry' => strtotime("+".$item['options']['months']." months")
        );
        $this->CI->db->insert('hosting',$insert_data);
        $hosting_id = $this->CI->db->insert_id();

        $host = $this->_createWHM($plan,$hosting_id,$password,$item['options']['domain']);

        if (!$host) {
            $this->CI->db->where('id',$hosting_id);
            $this->CI->db->delete('hosting');
        } else {
            $update_data = array(
                'host' => $host
            );
            $this->CI->db->where('id', $hosting_id);
            $this->CI->db->update('hosting', $update_data);

            sendProvisionedHostingMail($admin_details['email'], $admin_details['firstname'], $plan, $item['options']['domain']);

            return true;
        }

        return false;
    }

    private function _createForwarder($email,$admin_details,$item) {
        $forward_email = "test@manic.host";
        if ($this->CI->Email_model->addForwarder($email,$forward_email))
            sendProvisionedForwarderMail($admin_details['email'], $admin_details['firstname'], $item['options']['email_address']);
        return false;
    }

    private function _createMailbox($email,$admin_details,$item) {
        $password = "SNIPPED";
        if ($this->CI->Email_model->addMailbox($email,$password))
            sendProvisionedMailboxMail($admin_details['email'], $admin_details['firstname'], $item['options']['email_address'], $password);
        return false;
    }

    private function _createWHM($plan,$hosting_id,$password,$domain) {
        $whmusername = "SNIPPED";
        $whmpassword = "SNIPPED";
        $host = "lv-shared02.cpanelplatform.com";

        $username = "h" . $hosting_id;

        $query = "https://".$host.":2087/cpsess2353581798/json-api/createacct?api.version=1&username=" .
            $username . "&password=" . $password . "&domain=" . $domain . "&plan=manichos_" . $plan;

        $curl = curl_init();                                // Create Curl Object
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);       // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);       // Allow certs that do not match the hostname
        curl_setopt($curl, CURLOPT_HEADER, 0);               // Do not include header in output
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);       // Return contents of transfer on curl_exec
        $header[0] = "Authorization: Basic " . base64_encode($whmusername . ":" . $whmpassword) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
        curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
        $result = curl_exec($curl);

        error_log(var_export($result,true));

        if ($result == false) {
            error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
            return false;
        }
        $output = json_decode($result);
        if ($output->metadata->reason!="Account Creation Ok")
            return false;
        curl_close($curl);

        return $host;
    }
}