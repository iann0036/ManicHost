<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require "/var/www/my.manic.host/application/third_party/stripe/vendor/autoload.php";
require "/var/www/my.manic.host/application/third_party/tcpdf/tcpdf.php";

class Checkout extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->helper('mail');
        $this->load->model('Invoices_model');
    }

    public function index() {
        $this->load->view('header',array(
            'title' => 'Checkout',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('checkout');
        $this->load->view('footer');
    }

    public function complete() {
        $admin_details = array(
            'email' => $this->input->post('admin_email'),
            'firstname' => $this->input->post('admin_firstname'),
            'lastname' => $this->input->post('admin_lastname'),
            'phone' => $this->input->post('admin_phone'),
            'country' => $this->input->post('admin_country'),
            'address1' => $this->input->post('admin_address1'),
            'address2' => $this->input->post('admin_address2'),
            'city' => $this->input->post('admin_city'),
            'state' => $this->input->post('admin_state'),
            'postcode' => $this->input->post('admin_postcode')
        );
        if ($this->input->post('billing_same')=="on")
            $billing_details = $admin_details;
        else
            $billing_details = array(
                'email' => $this->input->post('billing_email'),
                'firstname' => $this->input->post('billing_firstname'),
                'lastname' => $this->input->post('billing_lastname'),
                'phone' => $this->input->post('billing_phone'),
                'country' => $this->input->post('billing_country'),
                'address1' => $this->input->post('billing_address1'),
                'address2' => $this->input->post('billing_address2'),
                'city' => $this->input->post('billing_city'),
                'state' => $this->input->post('billing_state'),
                'postcode' => $this->input->post('billing_postcode')
            );
        if ($this->input->post('tech_same')=="on")
            $tech_details = $admin_details;
        else
            $tech_details = array(
                'email' => $this->input->post('tech_email'),
                'firstname' => $this->input->post('tech_firstname'),
                'lastname' => $this->input->post('tech_lastname'),
                'phone' => $this->input->post('tech_phone'),
                'country' => $this->input->post('tech_country'),
                'address1' => $this->input->post('tech_address1'),
                'address2' => $this->input->post('tech_address2'),
                'city' => $this->input->post('tech_city'),
                'state' => $this->input->post('tech_state'),
                'postcode' => $this->input->post('tech_postcode')
            );

        $this->cart->process($admin_details, $billing_details, $tech_details);

        $this->load->view('header',array(
            'title' => 'Checkout',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('checkout_complete');
        $this->load->view('footer');
    }

    public function creditcard() {
        if ($this->cart->total_items()<1)
            redirect('/checkout/');

        $this->load->view('header',array(
            'title' => 'Checkout',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('checkout_creditcard');
        $this->load->view('footer');
    }

    public function remove() {
        $item_id = $this->input->get_post('id');

        if ($item_id==false && substr($this->input->post('type'),0,19)=="domain_registration") {
            $item_id = $this->cart->getRowIDByDomain($this->input->post('domain'));
        }

        $data = array(
            'rowid' => $item_id,
            'qty'   => 0
        );

        $this->cart->update($data);
    }

    public function add() {
        $type = $this->input->post('type');
        $domain = $this->input->post('domain');
        $price = $this->input->post('price');

        if ($type=="domain_registration_1yr") {
            $data = array(
                'id' => $type,
                'qty' => 1,
                'price' => $price,
                'name' => 'Domain Registration',
                'options' => array('domain' => $domain, 'months' => 12, 'type' => 'domain_registration')
            );

            $this->cart->insert($data);
        }
    }
}
