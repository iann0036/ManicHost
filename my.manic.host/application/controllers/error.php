<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('error');
    }

    public function e404() {
        $this->load->view('error_e404');
    }
}
