<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Route extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
    }

	public function index() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='route/main'; 
			$data['series']  = RouteModel::all();
			
			$this->load->view('components/layout', $data);
		}
	}

	public function service() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='flight/main'; 
			$data['series']  = RouteModel::all();

			print $data['series'];
		}
	}

	public function form($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='route/form'; 
			$segment = $this->uri->segment_array()[3];

			if ($segment == 'create') {
				$data['route']	     = new \stdClass();
				$data['route']->id 	 = '';
				$data['route']->city = '';

				$data['entity'] = 'create'; 
			} else {
				$data['route']  = RouteModel::find($id);
				$data['entity'] = 'update'; 
			}

			$this->load->view('components/layout', $data);
		}
	}

	public function store() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data       = new RouteModel();
			$data->id   = $this->input->post('id');
			$data->city = $this->input->post('city');
			$data->save();

			$this->session->set_flashdata('state', 'stored');
			redirect(site_url('route'));
		}
	}

	public function update($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data       = RouteModel::where('id', $id)->first();
			$data->id   = $this->input->post('id');
			$data->city = $this->input->post('city');
			$data->save();
			
			$this->session->set_flashdata('state', 'updated');
			redirect(site_url('route'));
		}
	}

	public function destroy($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			RouteModel::where('id', $id)->delete();

			$this->session->set_flashdata('state', 'destroyed');
			redirect(site_url('route'));
		}
	}
}