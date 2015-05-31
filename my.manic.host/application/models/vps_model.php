<?php

class Vps_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->database();
    }

    function getPackages($user_id = null) {
        $vps_packages = array();

        if ($user_id==null)
            $user_id = $this->session->userdata('userid');
        $this->db->where('user_id', $user_id);
        $results = $this->db->get('vps');
        foreach ($results->result() as $row) {
            $datediff = strtotime($row->expiry) - time();
            $daydiff = floor($datediff/(60*60*24));
            $row->daydiff = $daydiff;
            $vps_packages[] = $row;
        }

        return $vps_packages;
    }

    function reinstallOS($id, $osid) {
        $vmid = $this->_getVMID($id);
        if (!$vmid)
            return false;
        $cookie = $this->_getCookie();
        return $this->_serialConsole($vmid, $cookie, $osid);
    }

    function serialConsole($id) {
        $vmid = $this->_getVMID($id);
        if (!$vmid)
            return false;
        $cookie = $this->_getCookie();
        return $this->_serialConsole($vmid, $cookie);
    }

    function reconfigureNetwork($id) {
        $vmid = $this->_getVMID($id);
        if (!$vmid)
            return false;
        $cookie = $this->_getCookie();
        $this->_reconfigureNetwork($vmid, $cookie);
        return true;
    }

    function _getVMID($id) {
        $user_id = $this->session->userdata('userid');
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);
        $results = $this->db->get('vps');
        if ($results->num_rows()>0) {
            $vps = $results->row();
            return $vps->vmid;
        } else
            return false;
    }

    function getStats($id) {
        $this->db->where('id',$id);
        $results = $this->db->get('vps');
        $vps = $results->row();
        $stats = $this->_retrieveStats($vps->api_key,$vps->api_hash);

        return $stats;
    }

    function startServer($id) {
        $this->db->where('id',$id);
        $results = $this->db->get('vps');
        $vps = $results->row();
        $this->_startServer($vps->api_key,$vps->api_hash);
    }

    function _startServer($key,$hash) {
        $url = "https://manage.crissic.net:5656/api/client";

        $postfields = array();
        $postfields["key"] = $key;
        $postfields["hash"] = $hash;
        $postfields["action"] = "boot";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "/command.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $data = curl_exec($ch);
        curl_close($ch);
    }

    function restartServer($id) {
        $this->db->where('id',$id);
        $results = $this->db->get('vps');
        $vps = $results->row();
        $this->_restartServer($vps->api_key,$vps->api_hash);
    }

    function _restartServer($key,$hash) {
        $url = "https://manage.crissic.net:5656/api/client";

        $postfields = array();
        $postfields["key"] = $key;
        $postfields["hash"] = $hash;
        $postfields["action"] = "reboot";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "/command.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $data = curl_exec($ch);
        curl_close($ch);
    }

    function stopServer($id) {
        $this->db->where('id',$id);
        $results = $this->db->get('vps');
        $vps = $results->row();
        $this->_stopServer($vps->api_key,$vps->api_hash);
    }

    function _stopServer($key,$hash) {
        $url = "https://manage.crissic.net:5656/api/client";

        $postfields = array();
        $postfields["key"] = $key;
        $postfields["hash"] = $hash;
        $postfields["action"] = "shutdown";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "/command.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $data = curl_exec($ch);
        curl_close($ch);
    }

    function _retrieveStats($key,$hash) {
        $url = "https://manage.crissic.net:5656/api/client";

        $postfields = array();
        $postfields["key"] = $key;
        $postfields["hash"] = $hash;
        $postfields["action"] = "info";
        $postfields["ipaddr"] = "true";
        $postfields["hdd"] = "true";
        $postfields["mem"] = "true";
        $postfields["bw"] = "true";
        $postfields["status"] = "true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "/command.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        $data = curl_exec($ch);
        curl_close($ch);

        preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $match);
        $result = array();
        foreach ($match[1] as $x => $y) {
            $result[$y] = $match[2][$x];
        }

        $hdd_parts = explode(",",$result['hdd']);
        $bw_parts = explode(",",$result['bw']);
        $mem_parts = explode(",",$result['mem']);

        if ($result['status']=="success") {
            $return = array(
                'error' => false,
                'status' => ucfirst($result['vmstat']),
                'hostname' => $result['hostname'],
                'primary_ip' => $result['ipaddress'],
                'ip_addresses' => explode(",", $result['ipaddr']),
                'disk' => array(
                    'total' => $this->_convertUsage($hdd_parts[0]),
                    'used' => $this->_convertUsage($hdd_parts[1]),
                    'free' => $this->_convertUsage($hdd_parts[2]),
                    'percent' => $hdd_parts[3]
                ),
                'bandwidth' => array(
                    'total' => $this->_convertUsage($bw_parts[0]),
                    'used' => $this->_convertUsage($bw_parts[1]),
                    'free' => $this->_convertUsage($bw_parts[2]),
                    'percent' => $bw_parts[3]
                ),
                'memory' => array(
                    'total' => $this->_convertUsage($mem_parts[0]),
                    'used' => $this->_convertUsage($mem_parts[1]),
                    'free' => $this->_convertUsage($mem_parts[2]),
                    'percent' => $mem_parts[3]
                ),
            );
            if ($return['status']=="Online")
                $return['status'] = '<span class="label label-success">Online</span>';
            else if ($return['status']=="Offline")
                $return['status'] = '<span class="label label-danger">Offline</span>';
            else
                $return['status'] = '<span class="label label-default">'.$return['status'].'</span>';
        } else {
            $return = array(
                'error' => true
            );
        }

        return $return;
    }

    function _convertUsage($bytes) {
        if ($bytes<0)
            $bytes = 0;
        $bytes*=1.966796875;
        if ($bytes/1024/1024<1) {
            return number_format($bytes/1024,2)." KB";
        } elseif ($bytes/1024/1024/2014<1) {
            return number_format($bytes/1024/2014,2)." MB";
        } elseif ($bytes/1024/1024/2014/2014<1) {
            return number_format($bytes/1024/2014/1024,2)." GB";
        } else
            return number_format($bytes/1024/2014/1024/1024,2)." TB";
    }

    function _getCookie() {
        $cookieFile = "/tmp/mh_cookie_".uniqid().".txt";
        if(!file_exists($cookieFile)) {
            $fh = fopen($cookieFile, "w");
            fwrite($fh, "");
            fclose($fh);
        } else
            die();

        $postfields = array(
            'username' => 'SNIPPED',
            'password' => 'SNIPPED',
            'act' => 'login',
            'Submit' => 1
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://manage.crissic.net/login.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
        $data = curl_exec($ch);
        curl_close($ch);

        return $cookieFile;
    }

    function _reconfigureNetwork($vmid, $cookieFile) {
        $postfields = array(
            'act' => 'kvmreconfigure',
            'vi' => $vmid
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://manage.crissic.net/_vm_remote.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
        $data = curl_exec($ch);
        curl_close($ch);
        error_log(var_export($data,true));
    }

    function _reinstallOS($vmid, $cookieFile, $osid) {
        $postfields = array(
            'initiatereinstall' => 1,
            'rins' => $osid
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://manage.crissic.net/reinstall.php?_v=".$vmid);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
        $data = curl_exec($ch);
        curl_close($ch);
    }

    function _serialConsole($vmid, $cookieFile) {
        $return = array();

        $postfields = array(
            'sessiontime' => 1,
            'sessioncreate' => "Create+Session"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://manage.crissic.net/remote.php?_v=".$vmid);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Expect:' ) );
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
        $data = curl_exec($ch);
        curl_close($ch);
        $return['debug'] = $data;
        $return['debug2'] = $vmid;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://manage.crissic.net/remote.php?_v=".$vmid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
        $data = curl_exec($ch);
        curl_close($ch);
        /*
        $doc = new DOMDocument();
        $doc->loadHTML($data);
        $property_list = $doc->getElementsByTagName('tr');
        for ($i=1; $i<$property_list->length; $i++) {
            $tds = $property_list->item($i)->childNodes;
            if ($i==1)
                $return['ip'] = trim($tds->item(2)->textContent);
            else if ($i==2)
                $return['port'] = trim($tds->item(2)->textContent);
            else if ($i==3)
                $return['username'] = trim($tds->item(2)->textContent);
            else if ($i==4)
                $return['password'] = trim($tds->item(2)->textContent);
        }
        $return['seconds'] = substr($data,strpos($data,'javascript_countdown.init(')+26,strpos($data,",",strpos($data,'javascript_countdown.init('))-strpos($data,'javascript_countdown.init(')-26);
        */
        return $return;
    }
}