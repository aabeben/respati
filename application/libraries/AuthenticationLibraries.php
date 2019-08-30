<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

class AuthenticationLibraries {
    private $ci;
    private $msg;

    function __construct() {
        $this->ci = & get_instance();
		$this->ci->load->model('AuthenticationModel');
    }

    private function get_msg($msg) {
        $this->msg .= $msg . nl2br("\n");
    }


    function display_msg() {
        return $this->msg;
    }

    function login($username, $password) {
        if ((strlen($username) > 0) AND (strlen($password) > 0)) {
            $user = $this->ci->AuthenticationModel->get_user($username, $password);
            
            if ($user !== NULL) {
				$this->ci->session->set_userdata(array(
					'id'        => $user[0]->id_user,
                    'name'      => $user[0]->nama_lengkap,
                    'type'      => $user[0]->type,
					'identity'  => $user[0]->nik,
					'workplace' => $user[0]->lokasi_kerja,
					'homebase'  => $user[0]->homebase,
					'status'    => STATUS_ACTIVATED
                ));
                
                return TRUE;
            } else {
                $this->get_msg('incorrect credentials.');
            }
        }
        return FALSE;
    }

    function revoke() {
        $this->ci->session->set_userdata(
            array(
                'id'        => '', 
                'name'      => '', 
                'type'      => '', 
                'identity'  => '', 
                'workplace' => '', 
                'homebase'  => '', 
                'status'    => ''
            )
        );

        $this->ci->session->sess_destroy();
    }

    function active($activated = TRUE) {
        return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
    }

    function error() {
        return $this->msg;
    }
}