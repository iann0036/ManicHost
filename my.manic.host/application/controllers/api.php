<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Api extends REST_Controller {
    private $api_version = "1.0";

	function __construct() {
        // Construct our parent class
        parent::__construct();

        $this->load->helper('url');
        $this->load->database();
        $this->load->model('Domains_model');
        $this->load->model('Hosting_model');

        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        //$this->methods['debug_get']['limit'] = 20; //500 requests per hour per user/key

        if (!isset($_SERVER['HTTP_X_FORWARDED_HOST']))
            redirect('/error/');
        if ($_SERVER['HTTP_X_FORWARDED_HOST']!="api.manic.host")
            redirect('/error/');
    }

    function index_get() {
        $this->response(array(
            'api_version' => $this->api_version,
            'documentation' => 'https://github.com/iann0036/ManicHostREST',
            'status' => true
        ), 200);
    }

    function domains_get($id = null) {
        $return = array();

        $domains = $this->Domains_model->getDomains($this->_getUserID());
        if (!is_array($domains))
            $this->_error();

        foreach ($domains as $domain) {
            if ($id==null) {
                $return[] = array(
                    'id' => $domain->id,
                    'domain' => $domain->domain,
                    'expiry' => strtotime($domain->expiry)
                );
            } else if ($id==$domain->id) {
                $return = array(
                    'id' => $domain->id,
                    'domain' => $domain->domain,
                    'expiry' => strtotime($domain->expiry)
                );
            }
        }

        $this->response(array(
            'domains' => $return,
            'status' => true
        ), 200);
    }

    function domains_delete($id = null, $scheduled = false) {
        if ($id==null)
            $this->_error();

        if ($scheduled!=false) {
            if ($scheduled=="scheduled")
                $scheduled = true;
            else
                $this->_error();
        }

        $return = $this->Domains_model->delete($id, $scheduled, $this->_getUserID());

        if ($return) {
            $this->response(array(
                'deletion' => true,
                'status' => true
            ), 200);
        }
        $this->_error();
    }

    function hosting_get($id = null) {
        $return = array();

        $hosting_packages = $this->Hosting_model->getHosting($this->_getUserID());
        if (!is_array($hosting_packages))
            $this->_error();

        foreach ($hosting_packages as $package) {
            if ($id==null) {
                $return[] = array(
                    'id' => $package->id,
                    'plan' => $package->plan,
                    'domain' => $package->domain,
                    'expiry' => strtotime($package->expiry)
                );
            } else if ($id==$package->id) {
                $return = array(
                    'id' => $package->id,
                    'plan' => $package->plan,
                    'domain' => $package->domain,
                    'expiry' => strtotime($package->expiry)
                );
            }
        }

        $this->response(array(
            'hosting' => $return,
            'status' => true
        ), 200);
    }

    function hosting_delete($id = null, $scheduled = false) {
        if ($id==null)
            $this->_error();

        if ($scheduled!=false) {
            if ($scheduled=="scheduled")
                $scheduled = true;
            else
                $this->_error();
        }

        $return = $this->Hosting_model->delete($id, $scheduled, $this->_getUserID());

        if ($return) {
            $this->response(array(
                'deletion' => true,
                'scheduled' => $scheduled,
                'status' => true
            ), 200);
        }
        $this->_error();
    }

    function _error() {
        $this->response(array(
            'status' => false,
            'error' => 'An unexpected error has occured.'
        ), 404);
    }

    function _getUserID() {
        $this->db->where('apikey',$this->rest->key);
        $results = $this->db->get('user');
        if ($results->num_rows!=1)
            $this->_error();
        $user = $results->row();
        return $user->id;
    }

    /*
    function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
		);
		
    	$user = @$users[$this->get('id')];
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function user_delete()
    {
    	//$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
			array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
			array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);
        
        if($users)
        {
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


	public function send_post()
	{
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
    */
}