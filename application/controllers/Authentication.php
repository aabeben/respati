<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
		$this->load->model('PartyModel');
    }
	
	public function index() {
		if ($this->authenticationlibraries->active())
			redirect('employee');
		else
			$this->load->view('authentication/signin');
	}

	public function signin() {
		if ($this->authenticationlibraries->active())
			redirect('employee');
		else
			$this->load->view('authentication/signin');
	}

	public function session() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->authenticationlibraries->login($username, $password)) {
			redirect(site_url('employee'));
		} else {
			$errors = $this->authenticationlibraries->error();
			$this->session->set_flashdata('status', $errors);
			redirect(site_url('authentication/signin'));
		}
	}

	function revoke() {
        if ($this->authenticationlibraries->active()) {
			$this->authenticationlibraries->revoke();
		}
		
        redirect('authentication/signin');
    }
}