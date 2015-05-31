<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domains extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('CDAPI');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->model('Domains_model');
    }

    public function checktransfer() {
        $cdapi = new CDAPI();

        $domain = $this->input->post('domain');
        $epp = $this->input->post('epp');
        echo json_encode($cdapi->checkTransfer($domain, $epp));
    }

    private function _getTransferPrice($domain, $epp) {
        $cdapi = new CDAPI();

        $details = $cdapi->checkTransfer($domain, $epp);
        if (isset($details['price']))
            return $details['price'] * $details['min_years'];
        redirect('/error/');
    }

    public function transfer() {
        if ($this->input->post('domain')) {
            $domain = $this->input->post('domain');
            $epp = $this->input->post('epp');
            $years = $this->input->post('min_years');
            $data = array(
                'id' => 'domain_transfer',
                'qty' => 1,
                'price' => $this->_getTransferPrice($domain,$epp),
                'name' => 'Domain Transfer',
                'options' => array(
                    'type' => 'domain_transfer',
                    'months' => $years*12,
                    'domain' => $domain,
                    'epp' => $epp
                )
            );

            $this->cart->insert($data);

            redirect('/checkout/');
        } else {
            $this->load->view('header', array(
                'title' => 'Domain Transfer',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('domains_transfer');
            $this->load->view('footer');
        }
    }

    public function manage() {
        $domains = $this->Domains_model->getDomains();

        $this->load->view('header',array(
            'title' => 'Manage Domains',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('domains_manage',array(
            'domains' => $domains
        ));
        $this->load->view('footer');
    }

    public function cpanel($id) {
        $userid = $this->session->userdata('userid');

        $this->db->where('user_id',$userid); // precautionary
        $this->db->where('id',$id);
        $results = $this->db->get('domain');
        $row = $results->row();

        $user = 'dns'.$userid;
        $pass = $row->password;
        $hostname = $row->host;

        $service = 'cpanel';

        /////

        $goto = '/';

        $servicePorts = array('cpanel' => 2083, 'whm' => 2087, 'webmail' => 2096);

        // If no valid service has been given, default to cPanel
        $port = isset($servicePorts[$service]) ? $servicePorts[$service] : 2083;
        $ch = curl_init();
        $fields = array('user' => $user, 'pass' => $pass, 'goto_uri' => $goto);
        // Sets the POST URL to something like: https://example.com:2083/login/
        curl_setopt($ch, CURLOPT_URL, 'https://' . $hostname . ':' . $port . '/login/');
        curl_setopt($ch, CURLOPT_POST, true);
        // Turn our array of fields into a url encoded query string i.e.: ?user=foo&pass=bar
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        // RFC 2616 14.10 compliance
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection' => 'close'));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // Execute POST query returning both the response headers and content into $page
        $page = curl_exec($ch);
        curl_close($ch);
        $session = $token = array();
        // Find the session cookie in the page headers
        if(!preg_match('/session=([^\;]+)/', $page, $session)) {
            // This will also fail if the login authentication failed. No need to explicitly check for it.
            return 'No session';
        }
        // Find the cPanel session token in the page content
        if(!preg_match('|<META HTTP-EQUIV="refresh"[^>]+URL=/(cpsess\d+)/|i', $page, $token)) {
            return 'Cannot find session';
        }
        // Append the goto_uri to the query string if it's been manually set
        $extra = $goto == '/' ? '' : '&goto_uri=' . urlencode($goto);
        header('Location: https://' . $hostname . ':' . $port . '/' . $token[1] . '/login/?session=' . $session[1] . $extra);

        /////
    }

    public function debug() {
        $this->Domains_model->addDomain('test.com', 12);
    }

	public function search() {
        $domainResults = null;
        $q = $this->input->post('q');
        if ($q) {
            $domainResults = $this->_getDomainsByQuery($q);
        }

        $this->load->view('header',array(
            'title' => 'Domain Search',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
		$this->load->view('domains_search',array(
            'results' => $domainResults,
            'q' => $q
        ));
		$this->load->view('footer');
	}

    public function _getDomainsByQuery($query) {
        if (strlen($query)<2)
            return array();

        $parts = explode(".",$query);
        $tld = null;
        if (count($parts)>1) {
            $query = $parts[0];
            array_shift($parts);
            $tld = implode(".",$parts);
        }

        $result = array();

        $prices = $this->_getDomainPrices();
        if ($prices->success) {
            if ($tld!=null)
                $result[] = $this->_getDomainResult($query,$tld,$prices);
            if ($tld!="com")
                $result[] = $this->_getDomainResult($query,"com",$prices);
            if ($tld!="net")
                $result[] = $this->_getDomainResult($query,"net",$prices);
            if ($tld!="org")
                $result[] = $this->_getDomainResult($query,"org",$prices);
            if ($tld!="info")
                $result[] = $this->_getDomainResult($query,"info",$prices);
        }

        return $result;
    }

    public function _getDomainResult($domain,$tld,$prices) {
        if ($this->_checkDomainAvailable($domain . "." . $tld)) {
            return array(
                'domain' => $domain . "." . $tld,
                'available' => true,
                'price' => $this->_parseDollar($this->_getPriceByTld($tld, $prices)),
                'rawprice' => ($this->_getPriceByTld($tld, $prices) / 100),
                'in_cart' => $this->cart->isDomainInCart($domain . "." . $tld)
            );
        }

        return array(
            'domain' => $domain . "." . $tld,
            'available' => false
        );
    }

    public function _getPriceByTld($tld, $prices) {
        foreach ($prices->result as $item) {
            if ($item->tld==$tld)
                return $item->price_register;
        }

        return false;
    }

    public function _parseDollar($cents) {
        if ($cents==0)
            return "Free";
        return "$".number_format((float)$cents/100,2);
    }

    public function _checkDomainAvailable($domain) {
        $data = array(
            'domain' => $domain
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://backoffice.hostcontrol.com/api/v1/domain-is");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-APIKEY: SNIPPED'
        ));
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        if ($result->success) {
            if ($result->result=="free")
                return true;
        }

        return false;
    }

    public function _getDomainPrices() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://backoffice.hostcontrol.com/api/v1/domain-prices");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-APIKEY: SNIPPED'
        ));
        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        return $result;
    }
}
