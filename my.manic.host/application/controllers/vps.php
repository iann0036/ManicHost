<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vps extends CI_Controller {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('url');
        if ($this->session->userdata('username')===false)
            redirect('/login/');

        $this->load->model('Vps_model');
    }

    public function remove($id) {
        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('userid'));
        $results = $this->db->get('vps');
        $row = $results->row();

        internalVpsRemove($row);

        $this->db->where('id',$id);
        $this->db->where('user_id',$this->session->userdata('userid'));
        $this->db->delete('vps');

        redirect('/vps/manage/');
    }

    public function stats($id) {
        $stats = $this->Vps_model->getStats($id);
        echo json_encode($stats);
    }

    public function reinstall() {
        $id = $this->input->post('id');
        $osid = $this->input->post('osid');

        $this->Vps_model->reinstallOS($id, $osid);
        redirect('/vps/manage/'.$id);
    }

    public function manage($id = null) {
        if ($id==null) {
            $vps_packages = $this->Vps_model->getPackages();

            $this->load->view('header', array(
                'title' => 'Manage VPS',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('vps_manage', array(
                'vps_packages' => $vps_packages
            ));
            $this->load->view('footer');
        } else {
            $stats = $this->Vps_model->getStats($id);

            $this->load->view('header', array(
                'title' => 'Manage VPS',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('vps_manage_plan', array(
                'stats' => $stats,
                'id' => $id
            ));
            $this->load->view('footer');
        }
    }

    public function action($action, $id = false) {
        if (!$id)
            $id = $this->input->get('id');
        if ($action=="resetnetwork") {
            $this->Vps_model->reconfigureNetwork($id);
        } else if ($action=="startserver") {
            $this->Vps_model->startServer($id);
        } else if ($action=="stopserver") {
            $this->Vps_model->stopServer($id);
        } else if ($action=="restartserver") {
            $this->Vps_model->restartServer($id);
        } else if ($action=="serialconsole") {
            echo json_encode($this->Vps_model->serialConsole($id));
        }
    }

	public function buy($attr = null) {
        if ($attr=="complete") {
            $plan = $this->input->post('plan');
            $months = $this->input->post('months');
            $hostname = $this->input->post('hostname');

            if ($plan==1) {
                $data = array(
                    'id' => 'vps_1',
                    'qty' => 1,
                    'price' => 16 * $months / 12,
                    'name' => 'VPS 1',
                    'options' => array('months' => $months, 'type' => 'vps_1', 'hostname' => $hostname)
                );
                $this->cart->insert($data);
            } else if ($plan==2) {
                $data = array(
                    'id' => 'vps_2',
                    'qty' => 1,
                    'price' => 5 * $months,
                    'name' => 'VPS 2',
                    'options' => array('months' => $months, 'type' => 'vps_2', 'hostname' => $hostname)
                );
                $this->cart->insert($data);
            } else if ($plan==3) {
                $data = array(
                    'id' => 'vps_3',
                    'qty' => 1,
                    'price' => 7 * $months,
                    'name' => 'VPS 3',
                    'options' => array('months' => $months, 'type' => 'vps_3', 'hostname' => $hostname)
                );
                $this->cart->insert($data);
            } else if ($plan==4) {
                $data = array(
                    'id' => 'vps_4',
                    'qty' => 1,
                    'price' => 10 * $months,
                    'name' => 'VPS 4',
                    'options' => array('months' => $months, 'type' => 'vps_4', 'hostname' => $hostname)
                );
                $this->cart->insert($data);
            }

            redirect('/checkout/');
        } else if ($attr!=null) {
            $this->load->view('header', array(
                'title' => 'Buy VPS',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('vps_buy_plan',array(
                'plan' => $attr,
                'months' => $this->input->get_post('months')
            ));
            $this->load->view('footer');
        } else {
            $this->load->view('header', array(
                'title' => 'Buy VPS',
                'uri' => uri_string(),
                'name' => $this->session->userdata('name'),
                'email' => $this->session->userdata('email'),
                'profileimage' => $this->session->userdata('profileimage')
            ));
            $this->load->view('vps_buy');
            $this->load->view('footer');
        }
	}
}
