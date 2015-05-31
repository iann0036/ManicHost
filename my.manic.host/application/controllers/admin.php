<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->helper('mail');
        $this->load->database();
        if ($this->session->userdata('userid')!=2)
            redirect('/error/e404/');
    }

    public function index() {
        $this->load->view('header',array(
            'title' => 'Admin',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('admin');
        $this->load->view('footer');
    }

    public function email() {
        sendCustomMail($this->input->post('from'), $this->input->post('to'), $this->input->post('subject'), $this->input->post('message'));

        redirect('/admin/');
    }
}