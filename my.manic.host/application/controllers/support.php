<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->helper('mail');
        if ($this->session->userdata('username')===false)
            redirect('/login/');
    }

    public function index() {
        $this->load->view('header',array(
            'title' => 'Support',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('support');
        $this->load->view('footer');
    }

    public function contact() {
        $subject = htmlentities($this->input->post('subject'));
        $message = str_replace("\r","",str_replace("\n","<br />",htmlentities($this->input->post('message'))));
        sendContactMail($this->session->userdata('name'),$this->session->userdata('email'),$this->session->userdata('username'),$subject,$message);

        redirect('/');
    }
}
