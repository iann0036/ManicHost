<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require "/var/www/my.manic.host/application/third_party/twitter/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class Dashboard extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->model('Logs');
        if ($this->session->userdata('username')===false)
            redirect('/login/');
    }

	public function index() {
        $twitteroauth = new TwitterOAuth('SNIPPED', 'SNIPPED');
        $announcements = $twitteroauth->get("statuses/user_timeline", array("screen_name" => "ManicDotHost", "count" => 3));

        $this->load->view('header',array(
            'title' => 'Dashboard',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
		$this->load->view('dashboard',array(
            'announcements' => $announcements,
            'logs' => $this->Logs->getLogs()
        ));
		$this->load->view('footer');
	}
}
