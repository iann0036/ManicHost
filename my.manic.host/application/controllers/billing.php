<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require "/var/www/my.manic.host/application/third_party/stripe/vendor/autoload.php";

class Billing extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->model('Invoices_model');
    }

    public function index() {
        \Stripe\Stripe::setApiKey("SNIPPED");
        $customer = \Stripe\Customer::retrieve($this->session->userdata('stripe_id'));
        $default = $customer->default_source;
        $cards = $customer->sources->all(array(
            'limit' => 100,
            'object' => 'card'
        ));

        $this->load->view('header',array(
            'title' => 'Billing',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('billing',array(
            'invoices' => $this->Invoices_model->getInvoices(),
            'cards' => $cards->data,
            'default' => $default
        ));
        $this->load->view('footer');
    }

    public function view($id) {
        if ($this->Invoices_model->checkOwnership($id)) {
            $file = '/var/www/my.manic.host/invoices/Invoice_'.$id.'.pdf';
            $filename = 'Invoice_'.$id.'.pdf';

            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file));
            header('Accept-Ranges: bytes');

            @readfile($file);
        } else
            redirect('/error/');
    }

    public function cc($method, $id = null) {
        if ($method=="add") {
            if ($this->input->post('stripeToken')) {
                \Stripe\Stripe::setApiKey("SNIPPED");
                $customer = \Stripe\Customer::retrieve($this->session->userdata('stripe_id'));
                $customer->sources->create(array("source" => $this->input->post('stripeToken')));

                redirect('/billing/');
            } else
                redirect('/error/');
        } else
            redirect('/error/');
    }
}
