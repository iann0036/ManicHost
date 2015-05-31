<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require "/var/www/my.manic.host/application/third_party/twitter/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

class Login extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
    }

	public function index()	{
        $message = null;

        if ($this->input->post()!==false) {
            if ($this->input->post('action')=='login') {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->User_model->login($username,$password))
                    redirect('/');
                else
                    $message = array(
                        'type' => 'error',
                        'message' => 'The login failed. Check your username and password and try again.'
                    );
            } else if ($this->input->post('action')=='register') {
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $city = $this->input->post('city');
                $country = $this->input->post('country');
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if ($this->User_model->register($name,$email,$address,$city,$country,$username,$password))
                    $message = array(
                        'type' => 'success',
                        'message' => 'Registration Successful. You may now log in.'
                    );
                else
                    $message = array(
                        'type' => 'error',
                        'message' => 'Registration Failed. The username is already taken.'
                    );
            } else if ($this->input->post('action')=='forgot') {
                $username = $this->input->post('username');

                if ($this->User_model->forgot($username))
                    $message = array(
                        'type' => 'info',
                        'message' => 'Check your e-mail for password reset instructions.'
                    );
                else
                    $message = array(
                        'type' => 'error',
                        'message' => 'The user does not exist.'
                    );
            }
        }

		$this->load->view('login',array(
            'message' => $message
        ));
	}

    public function facebook() {
        if ($this->input->get('code'))
            $login_success = $this->User_model->facebookLogin($this->input->get('code'));
        redirect('/');
    }

    public function twitterstart() {
        $twitteroauth = new TwitterOAuth('SNIPPED', 'SNIPPED');
        $request_token = $twitteroauth->oauth("oauth/request_token", array("oauth_callback" => 'http://my.manic.host/login/twitter/'));

        if ($twitteroauth->getLastHttpCode() == 200) {
            $this->session->set_flashdata('oauth_token', $request_token['oauth_token']);
            $this->session->set_flashdata('oauth_token_secret', $request_token['oauth_token_secret']);
            $url = $twitteroauth->url("oauth/authenticate", array("oauth_token" => $request_token['oauth_token']));
            //$url = $twitteroauth->url("oauth/authorize", array("oauth_token" => $request_token['oauth_token']));
            header('Location: '. $url);
        } else {
            redirect('/login/');
        }
    }

    public function twitter() {
        if ($this->input->get('oauth_verifier') && $this->session->flashdata('oauth_token') && $this->session->flashdata('oauth_token_secret')) {
            $twitteroauth = new TwitterOAuth('SNIPPED', 'SNIPPED', $this->session->flashdata('oauth_token'), $this->session->flashdata('oauth_token_secret'));

            $access_token = $twitteroauth->oauth("oauth/access_token", array("oauth_verifier" => $this->input->get('oauth_verifier')));
            $user_twitteroauth = new TwitterOAuth('SNIPPED', 'SNIPPED', $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $user_info = $user_twitteroauth->get('account/verify_credentials');

            $username = $user_info->id;
            $name = $user_info->name;
            $pic = $user_info->profile_image_url_https;
            if ($this->User_model->twitterLogin($username,$name,$pic)) {
                redirect('/');
            } else {
                $this->load->view('login_terms');
            }
        } else {
            redirect('/login/');
        }
    }

    public function recover($username = null, $token = null) {
        if ($username==null) {
            $token = $this->input->post('token');
            $password = $this->input->post('password');

            $this->User_model->resetPasswordByToken($token, $password);
            redirect('/');
        } else {
            $this->load->view('login_recover', array(
                'username' => $username,
                'token' => $token
            ));
        }
    }
}
