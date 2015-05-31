<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->model('Email_model');
    }

    public function manage() {
        $email_packages = $this->Email_model->getEmail();

        $this->load->view('header',array(
            'title' => 'Manage Email',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('email_manage',array(
            'email_packages' => $email_packages
        ));
        $this->load->view('footer');
    }

	public function buy() {
        $this->load->view('header',array(
            'title' => 'Buy Email',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('email_buy',array(
            'emails' => array()
        ));
		$this->load->view('footer');
	}

    public function add() {
        $email_address = $this->input->post('email_address');
        $type = $this->input->post('type');

        if ($type=="mailbox") {
            $data = array(
                'id' => 'email_mailbox',
                'qty' => 1,
                'price' => 10,
                'name' => 'Email Mailbox',
                'options' => array('email_address' => $email_address, 'months' => 12, 'type' => 'email_mailbox')
            );
        } else if ($type=="forwarder") {
            $data = array(
                'id' => 'email_forwarder',
                'qty' => 1,
                'price' => 1,
                'name' => 'Email Forwarder',
                'options' => array('email_address' => $email_address, 'months' => 12, 'type' => 'email_forwarder')
            );
        }

        $this->cart->insert($data);

        redirect('/checkout/');
    }

    public function remove($id) {
        $this->Email_model->remove($id);

        redirect('/email/manage/');
    }
}
