<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ssl extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->helper('mail');
        $this->load->model('Ssl_model');
    }

    public function remove($id) {
        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('userid'));
        $results = $this->db->get('ssl');
        $row = $results->row();

        internalSslRemove($row);

        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('userid'));
        $this->db->delete('ssl');

        redirect('/ssl/manage/');
    }

    public function test($timeline,$domain) {
        if ($timeline=="start")
            echo file_get_contents('https://api.ssllabs.com/api/v2/analyze?all=on&startNew=off&host='.$domain);
        else
            echo file_get_contents('https://api.ssllabs.com/api/v2/analyze?all=on&host='.$domain);
    }

    public function manage($id = null) {
        if ($id!=null) {
            $cert = $this->Ssl_model->getCert($id);
            if ($cert==false)
                redirect('/error/');

            $this->load->view('header', array(
                'title' => 'Manage SSL',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('ssl_manage_plan', array(
                'id' => $id,
                'cert' => $cert
            ));
            $this->load->view('footer');
        } else {
            $certs = $this->Ssl_model->getList();

            $this->load->view('header', array(
                'title' => 'Manage SSL',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('ssl_manage', array(
                'certs' => $certs
            ));
            $this->load->view('footer');
        }
    }

    public function emails($domain) {
        $emails = $this->Ssl_model->getEmails($domain);
        echo json_encode($emails);
    }

	public function buy($product = null, $complete = null) {
        if ($product!=null) {
            if ($product=="positivessl") {
                $long_product = "PositiveSSL";
                $provider = "comodo";
                $year_price = 10;
            } else {
                $product = "unknown";
                $long_product = "Unknown SSL Certificate";
                $provider = "";
                $year_price = 9999;
            }

            if ($complete==null) {
                $this->load->view('header', array(
                    'title' => 'Buy SSL',
                    'uri' => uri_string(),
                    'name' => $this->session->userdata('name'),
                    'email' => $this->session->userdata('email'),
                    'profileimage' => $this->session->userdata('profileimage')
                ));
                $this->load->view('ssl_buy_plan',array(
                    'years' => $this->input->post('years'),
                    'product' => $product,
                    'long_product' => $long_product,
                    'provider' => $provider,
                    'year_price' => $year_price,
                    'webservers' => $this->Ssl_model->getWebservers($provider)
                ));
                $this->load->view('footer');
            } else {
                $years = $this->input->post('years');
                $webserver = $this->input->post('webserver');
                $csr = $this->input->post('csr');
                $validation_email = $this->input->post('validation_email');
                $domain = $this->input->post('domain');
                $data = array(
                    'id' => 'ssl_'.$product,
                    'qty' => 1,
                    'price' => $year_price * $years,
                    'name' => 'SSL Certificate - '.$long_product,
                    'options' => array(
                        'months' => 12 * $years,
                        'type' => 'ssl_certificate',
                        'cert_type' => $long_product,
                        'webserver' => $webserver,
                        'csr' => $csr,
                        'validation_email' => $validation_email,
                        'domain' => $domain
                ));

                $this->cart->insert($data);

                redirect('/checkout/');
            }
        } else {
            $this->load->view('header', array(
                'title' => 'Buy SSL',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('ssl_buy');
            $this->load->view('footer');
        }
	}

    public function view($id) {
        $sslinfo = $this->Ssl_model->getInfo($id);
        echo '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h4 class="modal-title">View Certificate</h4></div><div class="modal-body">';
        echo '<div class="row"><pre>';
        print_r($sslinfo);
        echo '</pre></div>';
        echo '</div><div class="modal-footer"></div>';
    }

    public function csr($domain) {
        echo json_encode($this->Ssl_model->generateCsr($domain, $this->input->post('org'), $this->input->post('dept'), $this->input->post('city'), $this->input->post('state'), $this->input->post('country'), $this->input->post('email')));
    }
}
