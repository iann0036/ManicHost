<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hosting extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->model('Hosting_model');
    }

    public function manage() {
        $hosting_packages = $this->Hosting_model->getHosting();

        $this->load->view('header',array(
            'title' => 'Manage Hosting',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('hosting_manage',array(
            'hosting_packages' => $hosting_packages
        ));
        $this->load->view('footer');
    }

    public function cpanel($id) {
        $userid = $this->session->userdata('userid');

        $this->db->where('user_id',$userid); // precautionary
        $this->db->where('id',$id);
        $results = $this->db->get('hosting');
        $row = $results->row();

        $user = 'h'.$id;
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

	public function buy($action = null) {
        $this->load->view('header',array(
            'title' => 'Buy Hosting',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));

        if ($action=="complete") {
            $months = $this->input->post('months');
            $plan = $this->input->post('plan');
            $domainname = $this->input->post('domainname');
            $domainsetting = $this->input->post('domainsetting');

            if ($plan=="basic") {
                $data = array(
                    'id' => 'hosting_basic',
                    'qty' => 1,
                    'price' => $months,
                    'name' => 'Basic Hosting',
                    'options' => array(
                        'type' => 'hosting',
                        'months' => $months,
                        'domain' => $domainname,
                        'domainsetting' => $domainsetting
                    )
                );
            } else if ($plan=="standard") {
                $data = array(
                    'id' => 'hosting_standard',
                    'qty' => 1,
                    'price' => $months*3,
                    'name' => 'Standard Hosting',
                    'options' => array(
                        'type' => 'hosting',
                        'months' => $months,
                        'domain' => $domainname,
                        'domainsetting' => $domainsetting
                    )
                );
            } else if ($plan=="deluxe") {
                $data = array(
                    'id' => 'hosting_deluxe',
                    'qty' => 1,
                    'price' => $months*6,
                    'name' => 'Deluxe Hosting',
                    'options' => array(
                        'type' => 'hosting',
                        'months' => $months,
                        'domain' => $domainname,
                        'domainsetting' => $domainsetting
                    )
                );
            } else
                redirect('/error/');

            $this->cart->insert($data);

            redirect('/checkout/');
        } else if ($action!=null) {
            $months = $this->input->post('months');
            $this->load->view('hosting_buy_plan',array(
                'months' => $months,
                'plan' => $action
            ));
        } else {
            $this->load->view('hosting_buy');
        }
		$this->load->view('footer');
	}
}
