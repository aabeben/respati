<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
    }

	public function index() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='flight/main'; 
			$data['series']  = FlightModel::all();
			
			$this->load->view('components/layout', $data);
		}
	}

	public function form($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='flight/form'; 
			$segment = $this->uri->segment_array()[3];

			if ($segment == 'create') {
				$data['flight']			 	 = new \stdClass();
				$data['flight']->kode_flight = '';
				$data['flight']->kodeklp	 = '';
				$data['flight']->flight		 = '';

				$data['entity'] = 'create'; 
			} else {
				$data['flight']  = FlightModel::find($id);
				$data['entity'] = 'update'; 
			}

			$this->load->view('components/layout', $data);
		}
	}

	public function store() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data           	= new FlightModel();
			$data->kode_flight  = $this->input->post('kode_flight');
			$data->kodeklp      = $this->input->post('kodeklp');
			$data->flight	    = $this->input->post('flight');
			$data->save();

			$this->session->set_flashdata('state', 'stored');
			redirect(site_url('flight'));
		}
	}

	public function update($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data           	= FlightModel::where('id', $id)->first();
			$data->kode_flight  = $this->input->post('kode_flight');
			$data->kodeklp      = $this->input->post('kodeklp');
			$data->flight	    = $this->input->post('flight');
			$data->save();
			
			$this->session->set_flashdata('state', 'updated');
			redirect(site_url('flight'));
		}
	}

	public function destroy($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			FlightModel::where('id', $id)->delete();

			$this->session->set_flashdata('state', 'destroyed');
			redirect(site_url('flight'));
		}
	}
}