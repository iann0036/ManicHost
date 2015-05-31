<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dns extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');
    }

    public function index() {
        $this->load->view('header',array(
            'title' => 'DNS',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        //$this->load->view('support');
        $this->load->view('footer');
    }

    public function manage($domain) {
        $this->load->view('header',array(
            'title' => 'Manage DNS',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        //$this->load->view('support');
        $this->load->view('footer');
    }
}
