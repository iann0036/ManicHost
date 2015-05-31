<?php

class Hosting_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
    }

    function addHosting($domain, $plan, $months) {
        $user_id = $this->session->userdata('userid');
        $password = uniqid();
        $host = 'lv-shared02.cpanelplatform.com';

        $this->_createWHM($user_id,$password,$domain,$host);

        $expiry_date = strtotime("+".$months." months", time());

        $insert_data = array(
            'domain' => $domain,
            'plan' => $plan,
            'user_id' => $user_id,
            'host' => $host,
            'password' => $password,
            'expiry' => $expiry_date
        );
        $this->db->insert('hosting',$insert_data);
    }

    function getHosting($user_id = null) {
        $hosting_packages = array();

        if ($user_id==null)
            $user_id = $this->session->userdata('userid');
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('hosting');
        foreach ($results->result() as $row) {
            $datediff = strtotime($row->expiry) - time();
            $daydiff = floor($datediff/(60*60*24));
            $row->daydiff = $daydiff;

            $hosting_packages[] = $row;
        }

        return $hosting_packages;
    }

    public function delete($id, $scheduled = false, $user_id = null) {
        if ($user_id==null)
            $user_id = $this->session->userdata('userid');

        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('hosting');
        if ($results->num_rows()!=1)
            return false;

        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);

        if ($scheduled) {
            $data = array(
                'deletion_scheduled' => 1
            );
            $this->db->update('hosting',$data);

            return true;
        }

        $this->db->delete('hosting');

        return true;
    }

    function _createWHM($user_id,$password,$domain,$host) {
        $whmusername = "SNIPPED";
        $whmpassword = "SNIPPED";

        $username = 'usr' . $user_id;

        $query = "https://".$host.":2087/cpsess2353581798/json-api/createacct?api.version=1&username=" .
            $username . "&password=" . $password . "&domain=" . $domain . "&plan=manichos_basic";

        $curl = curl_init();                                // Create Curl Object
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);       // Allow self-signed certs
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);       // Allow certs that do not match the hostname
        curl_setopt($curl, CURLOPT_HEADER, 0);               // Do not include header in output
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);       // Return contents of transfer on curl_exec
        $header[0] = "Authorization: Basic " . base64_encode($whmusername . ":" . $whmpassword) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password
        curl_setopt($curl, CURLOPT_URL, $query);            // execute the query
        $result = curl_exec($curl);
        if ($result == false) {
            error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");
            // log error if curl exec fails
        }
        curl_close($curl);

        error_log(var_export($result,true));
    }
}