<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
    }

	public function index() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='employee/main'; 
			$data['party'] 	 = PartyModel::with('family')->take(100)->get();
			
			$this->load->view('components/layout', $data);
		}
	}

	public function form($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='employee/form'; 
			$segment = $this->uri->segment_array()[3];

			if ($segment == 'create') {
				$data['party']			 	 = new \stdClass();
				$data['party']->nama_lengkap = '';
				$data['party']->id_user      = '';
				$data['party']->email    	 = '';
				$data['party']->no_hp 	     = '';
				$data['party']->nohp_atasan  = '';

				$data['entity'] = 'create'; 
			} else {
				$data['party']  = PartyModel::find($id);
				$data['entity'] = 'update'; 
			}

			$this->load->view('components/layout', $data);
		}
	}

	public function store() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data           = new PartyModel();
			$data->nama_lengkap = $this->input->post('nama_lengkap');
			$data->id_user      = $this->input->post('id_user');
			$data->email 		= $this->input->post('email');
			$data->no_hp 	    = $this->input->post('no_hp');
			$data->nohp_atasan 	= $this->input->post('no_hp');
			$data->save();

			$this->session->set_flashdata('state', 'stored');
			redirect(site_url('employee'));
		}
	}

	public function update($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data           	= PartyModel::where('id', $id)->first();
			$data->nama_lengkap = $this->input->post('nama_lengkap');
			$data->id_user      = $this->input->post('id_user');
			$data->email 		= $this->input->post('email');
			$data->no_hp 	    = $this->input->post('no_hp');
			$data->save();
			
			$this->session->set_flashdata('state', 'updated');
			redirect(site_url('employee'));
		}
	}

	public function destroy($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			PartyModel::where('id', $id)->delete();

			$this->session->set_flashdata('state', 'destroyed');
			redirect(site_url('employee'));
		}
	}
}