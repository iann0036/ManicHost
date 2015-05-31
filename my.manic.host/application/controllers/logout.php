<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
    }

	public function index()	{
        $this->session->sess_destroy();

        redirect('/login/');
	}
}
