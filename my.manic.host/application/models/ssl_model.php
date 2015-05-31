<?php

require '/var/www/my.manic.host/application/third_party/ssl/GoGetSSLApi.php';

class Ssl_model extends CI_Model {
    private $api;

    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
    }

    function getCert($id) {
        $this->db->where('user_id',$this->session->userdata('userid'));
        $this->db->where('id',$id);
        $results = $this->db->get('ssl');
        if ($results->num_rows()<1)
            return false;
        $row = $results->row();

        return array(
            'domain' => $row->domain,
            'type' => $this->_getLongTypeById($row->typeid),
            'expiry' => $row->expiry,
            'status' => "active"
        );
    }

    function _getLongTypeById($id) {
        if ($id==0) {
            return "Unknown";
        }
        if ($id==45) {
            return "PositiveSSL";
        }
    }

    function addSSL($product_id, $csr, $months, $webserver, $approver_email, $admin_details, $tech_details, $item) {
        $this->_initApi();

        $data = array(
            'product_id' => $product_id,
            'csr' => $csr,
            'server_count' => "-1",
            'period' => $months,
            'approver_email' => $approver_email,
            'webserver_type' => $webserver,
            'admin_firstname' => $admin_details['firstname'],
            'admin_lastname' => $admin_details['lastname'],
            'admin_city' => $admin_details['city'],
            'admin_country' => $admin_details['country'],
            'admin_phone' => $admin_details['phone'],
            'admin_title' => "Mx",
            'admin_email' => $admin_details['email'],
            'tech_firstname' => $tech_details['firstname'],
            'tech_lastname' => $tech_details['lastname'],
            'tech_city' => $tech_details['city'],
            'tech_country' => $tech_details['country'],
            'tech_phone' => $tech_details['phone'],
            'tech_title' => "Mx",
            'tech_email' => $tech_details['email']
        );

        $response = $this->api->addSSLOrder($data);

        error_log(var_export($response,true));

        if (isset($response['error']))
            return false;

        if (isset($response['order_id'])) {
            $insert_data = array(
                'user_id' => $this->session->userdata('userid'),
                'orderid' => $response['order_id'],
                'domain' => $item['options']['domain'],
                'typeid' => $product_id
            );
            $this->db->insert('ssl', $insert_data);

            return true;
        }

        return false;
    }

    function _initApi() {
        if (isset($this->api))
            return;

        $this->api = new GoGetSSLApi(null, 'https://sandbox.gogetssl.com/api');
        $authKey = $this->api->auth('admin@manic.host', 'SNIPPED');
        $key = $authKey['key'];
        $this->api->setKey($key);
    }

    function getList() {
        $ssls = array();

        $this->db->where('user_id',$this->session->userdata('userid'));
        $results = $this->db->get('ssl');
        foreach ($results->result() as $row) {
            $ssls[] = array(
                'id' => $row->id,
                'domain' => $row->domain,
                'type' => $this->_getLongTypeById($row->typeid),
                'expiry' => $row->expiry,
                'status' => "active"
            );
        }

        return $ssls;
    }

    function getEmails($domain) {
        $this->_initApi();

        return $this->api->getDomainEmails($domain);
    }

    function getWebservers($ca = '') {
        $this->_initApi();

        if ($ca=='comodo')
            $return = $this->api->getWebServers(1);
        else if ($ca=='geotrust' || $ca=='symantec' || $ca=='thawte')
            $return = $this->api->getWebServers(2);
        else
            $return = array('success' => false);

        if ($return['success'])
            return $return['webservers'];
        else
            return array(array('id' => 18, 'software' => 'OTHER'));
    }

    function _oldgetList() {
        $api_host = 'https://api.namecheap.com/xml.response';
        $api_key = 'SNIPPED';
        $command = 'namecheap.ssl.getList';
        $clientip = $_SERVER['REMOTE_ADDR'];

        $url = $api_host."?ApiUser=iann0036&ApiKey=".$api_key."&UserName=iann0036&ClientIp=".$clientip."&Command=".$command;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($result) or redirect('/error/');
        $certs = array();
        foreach ($xml->CommandResponse->SSLListResult->SSL as $result) {
            $attr = $result->attributes();
            $certs[] = array(
                'id' => (int)$attr['CertificateID'],
                'hostname' => (string)$attr['HostName'],
                'type' => (string)$attr['SSLType'],
                'purchase_date' => (string)$attr['PurchaseDate'],
                'expiry_date' => (string)$attr['ExpireDate'],
                'activation_expiry_date' => (string)$attr['ActivationExpireDate'],
                'expired' => (bool)$attr['IsExpiredYN'],
                'status' => (string)$attr['Status'],
                'order_id' => (int)$attr['ProviderOrderID'],
                'years' => (int)$attr['Years']
            );
        }

        return $certs;
    }

    function generateCsr($domain, $org, $dept, $city, $state, $country, $email) {
        $this->_initApi();

        $data = array(
            'csr_commonname' => $domain,
            'csr_organization' => $org,
            'csr_department' => $dept,
            'csr_city' => $city,
            'csr_state' => $state,
            'csr_country' => $country,
            'csr_email' => $email,
            'signature_hash' => 'SHA1'
        );
        $csrReturn = $this->api->generateCsr($data);

        return $csrReturn;
    }

    function _oldgetInfo($id) {
        $api_host = 'https://api.namecheap.com/xml.response';
        $api_key = 'SNIPPED';
        $command = 'namecheap.ssl.getinfo';
        $clientip = $_SERVER['REMOTE_ADDR'];

        $url = $api_host."?ApiUser=iann0036&ApiKey=".$api_key."&UserName=iann0036&ClientIp=".$clientip."&Command=".$command."&certificateID=".$id."&returncertificate=true&returntype=PKCS7";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $xml = simplexml_load_string($result) or redirect('/error/');
        $ssldetails = array(
            'commonname' => (string)$xml->CommandResponse->SSLGetInfoResult->CertificateDetails->CommonName,
            'approver_email' => (string)$xml->CommandResponse->SSLGetInfoResult->CertificateDetails->ApproverEmail,
            'admin_name' => (string)$xml->CommandResponse->SSLGetInfoResult->CertificateDetails->AdministratorName,
            'admin_email' => (string)$xml->CommandResponse->SSLGetInfoResult->CertificateDetails->AdministratorEmail,
            'provider' => (string)$xml->CommandResponse->SSLGetInfoResult->Provider->Name,
            'certificate' => $xml->CommandResponse->SSLGetInfoResult->Certificates->Certificate,
            'root' => $xml->CommandResponse->SSLGetInfoResult
        );

        return $ssldetails;
    }
}