<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->model('Logs');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->database();
    }

    public function apikey() {
        $this->db->where('id',$this->session->userdata('userid'));
        $result = $this->db->get('user');
        $user = $result->row();
        $this->Logs->log('Retrieved API key','key:warning');
        echo $user->apikey;
    }

    public function index() {
        $accountUpdate = false;

        if ($this->input->post('account')) {
            if ($this->input->post('loginnotify')) {
                $update_data = array(
                    'option_loginnotify' => true
                );
                $this->session->set_userdata(array(
                    'loginnotify' => true
                ));
            } else {
                $update_data = array(
                    'option_loginnotify' => false
                );
                $this->session->set_userdata(array(
                    'loginnotify' => false
                ));
            }
            $this->db->where('id',$this->session->userdata('userid'));
            $this->db->update('user',$update_data);

            $accountUpdate = true;
        }

        $this->load->view('header',array(
            'title' => 'Settings',
            'uri' => uri_string(),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'profileimage' => $this->session->userdata('profileimage')
        ));
        $this->load->view('settings',array(
            'username' => $this->session->userdata('username'),
            'name' => $this->session->userdata('name'),
            'email' => $this->session->userdata('email'),
            'loginnotify' => $this->session->userdata('loginnotify'),
            'type' => $this->session->userdata('type'),
            'accountUpdate' => $accountUpdate
        ));
        $this->load->view('footer');
    }

    public function exportlogs() {
        $logs = $this->Logs->getLogs(true);
        header("Content-Disposition: attachment; filename=\"ManicHost_Logs.csv\"");
        header('Content-type: text/plain');
        echo "message,datetime,ip_address\n";
        foreach ($logs as $log) {
            echo $log->message.",".str_replace(",","",date(DATE_RFC2822,$log->timestamp)).",".$log->ip_address."\n";
        }
    }
}
