<?php

require "/var/www/my.manic.host/application/third_party/stripe/vendor/autoload.php";

class User_model extends CI_Model {
    function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('mail');
        $this->load->model('Logs');
        $this->load->database();
    }

    function isUsernameAvailable($username) {
        $users = $this->db->get('user');

        foreach ($users->result() as $row) {
            if ($row->username == $username)
                return false;
        }

        return true;
    }

    function login($username, $password) {
        $this->db->where('username',$username);
        $this->db->where('type','internal');
        $this->db->where('password',$this->_passHash($password));
        $result = $this->db->get('user');

        if ($result->num_rows()>0) {
            $user = $result->row();
            $this->session->set_userdata(array(
                'userid' => $user->id,
                'type' => $user->type,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'loginnotify' => $user->option_loginnotify,
                'profileimage' => 'https://secure.gravatar.com/avatar/'.@md5(strtolower(trim($user->email))),
                'stripe_id' => $user->stripe_id
            ));

            if ($user->option_loginnotify)
                sendLoginMail($username,$user->email,$user->name);

            $this->Logs->log('User logged in','user:success');

            return true;
        }

        return false;
    }

    function twitterLogin($username, $name, $pic) {
        $this->db->where('username',$username);
        $this->db->where('type','twitter');
        $result = $this->db->get('user');
        if ($result->num_rows()>0) {
            $user = $result->row();
            $this->session->set_userdata(array(
                'userid' => $user->id,
                'type' => $user->type,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'loginnotify' => $user->option_loginnotify,
                'profileimage' => $user->pic,
                'stripe_id' => $user->stripe_id
            ));

            if ($user->option_loginnotify)
                sendLoginMail($user->name." (Twitter)",$user->email,$user->name);

            $this->Logs->log('User logged in via Twitter','twitter:success');

            return true;
        } else {
            \Stripe\Stripe::setApiKey("SNIPPED");
            $customer = \Stripe\Customer::create(array(
                'description' => $name
            ));

            $insert_data = array(
                'username' => $username,
                'name' => $name,
                'pic' => $pic,
                'type' => 'twitter',
                'email' => null,
                'password' => null,
                'option_loginnotify' => 0,
                'apikey' => $this->_randomToken(),
                'stripe_id' => $customer->id
            );
            $this->db->insert('user',$insert_data);
            $userid = $this->db->insert_id();

            $this->session->set_userdata(array(
                'userid' => $userid,
                'type' => 'twitter',
                'username' => $username,
                'name' => $name,
                'email' => null,
                'loginnotify' => 1,
                'profileimage' => $pic,
                'stripe_id' => $customer->id
            ));

            $this->Logs->log('User signed up with Twitter','user-plus:info');
            $this->Logs->log('User logged in via Twitter','twitter:success');

            return false;
        }
    }

    function facebookLogin($code) {
        $access_token_raw = file_get_contents('https://graph.facebook.com/oauth/access_token?'.
            'client_id=818854014829609'.
            '&redirect_uri=http://my.manic.host/login/facebook/'.
            '&client_secret=SNIPPED'.
            '&code='.$code);

        $access_token = substr($access_token_raw,13,strpos($access_token_raw,'&')-13);

        $session_info = json_decode(file_get_contents('https://graph.facebook.com/debug_token?'.
            'input_token='.$access_token.
            '&access_token=SNIPPED'));

        $user_id = $session_info->data->user_id;

        $this->db->where('username',$user_id);
        $this->db->where('type','facebook');
        $result = $this->db->get('user');

        if ($result->num_rows()>0) {
            $user = $result->row();
            $this->session->set_userdata(array(
                'userid' => $user->id,
                'type' => $user->type,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'loginnotify' => $user->option_loginnotify,
                'profileimage' => 'https://graph.facebook.com/v2.2/'.$user->username.'/picture?type=small',
                'stripe_id' => $user->stripe_id
            ));

            if ($user->option_loginnotify && strlen($user->email)>1)
                sendLoginMail($user->name.' (Facebook)',$user->email,$user->name);

            $this->Logs->log('User logged in via Facebook','facebook:success');

            return true;
        } else {
            $user_data = json_decode(file_get_contents('https://graph.facebook.com/v2.2/'.$user_id.'?access_token='.$access_token));

            $email = null;
            if (isset($user_data->email))
                $email = $user_data->email;

            \Stripe\Stripe::setApiKey("SNIPPED");
            $customer = \Stripe\Customer::create(array(
                'description' => $user_data->name,
                'email' => $email
            ));

            $insert_data = array(
                'username' => $user_id,
                'name' => $user_data->name,
                'type' => 'facebook',
                'email' => $email,
                'password' => null,
                'option_loginnotify' => 1,
                'apikey' => $this->_randomToken(),
                'stripe_id' => $customer->id
            );
            $this->db->insert('user',$insert_data);
            $userid = $this->db->insert_id();

            $this->session->set_userdata(array(
                'userid' => $userid,
                'type' => 'facebook',
                'username' => $user_id,
                'name' => $user_data->name,
                'email' => $email,
                'loginnotify' => 1,
                'profileimage' => 'https://graph.facebook.com/v2.2/'.$user_id.'/picture?type=small',
                'stripe_id' => $customer->id
            ));

            $this->Logs->log('User signed up with Facebook','user-plus:info');
            $this->Logs->log('User logged in via Facebook','facebook:success');

            return true;
        }

        return false;
    }

    function register($name,$email,$address,$city,$country,$username,$password) {
        if (!$this->isUsernameAvailable($username))
            return false;

        \Stripe\Stripe::setApiKey("SNIPPED");
        $customer = \Stripe\Customer::create(array(
            'description' => $name,
            'email' => $email
        ));

        $insert_data = array(
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'username' => $username,
            'password' => $this->_passHash($password),
            'apikey' => $this->_randomToken(),
            'stripe_id' => $customer->id
        );
        $this->db->insert('user',$insert_data);

        sendWelcomeMail($username,$email,$name);

        $this->Logs->log('User signed up','user-plus:info');

        return true;
    }

    function resetPasswordByToken($token, $password) {
        $this->db->where('reset_token', $token);
        $result = $this->db->get('user');
        if ($result->num_rows()<1)
            return false;
        $user = $result->row();

        $update_data = array(
            'reset_token' => null,
            'password' => $this->_passHash($password)
        );
        $this->db->where('id',$user->id);
        $this->db->update('user',$update_data);

        $this->Logs->log('User reset password','refresh:info', null, $user->id);
    }

    function forgot($username) {
        $this->db->where('username',$username);
        $this->db->where('type','internal');
        $result = $this->db->get('user');
        if ($result->num_rows()<1)
            return false;
        $user = $result->row();

        $token = $this->_randomToken();
        $update_data = array(
            'reset_token' => $token
        );
        $this->db->where('username',$username);
        $this->db->update('user',$update_data);

        sendResetMail($username,$user->email,$user->name,$token);

        $this->Logs->log('User requested password reset','refresh:warning', null, $user->id);

        return true;
    }

    function _passHash($password) {
        $salt = "SNIPPED"; // if you see this, i'm fucked

        return crypt($password,$salt);
    }

    function _randomToken() {
        return md5(rand());
    }
}