<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
    }

	public function index() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content'] ='family/main'; 
			$data['family']  = FamilyModel::with('employee')->orderBy('id', 'desc')->take(100)->get();

			$this->load->view('components/layout', $data);
		}
	}

	public function form($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content']   ='family/form'; 
			$data['employee']  = PartyModel::where('type', 'employee')->get();

			$segment = $this->uri->segment_array()[3];

			if ($segment == 'create') {
				$data['family']		  	   	  = new \stdClass();
				$data['family']->nama 	   	  = '';
				$data['family']->nik 	   	  = '';
				$data['family']->relationship = '';
				$data['family']->tgl_lahir 	  = '';
				$data['family']->gender    	  = '';

				$data['entity'] = 'create'; 
			} else {
				$data['family'] = FamilyModel::find($id);
				$data['entity'] = 'update'; 
			}

			$this->load->view('components/layout', $data);
		}
	}

	public function store() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data            	= new FamilyModel();
			$data->nama      	= $this->input->post('nama');
			$data->nik		 	= $this->input->post('nik');
			$data->relationship = $this->input->post('relationship');
			$data->tgl_lahir 	= $this->input->post('tgl_lahir');
			$data->gender    	= $this->input->post('gender');
			$data->save();

			$this->session->set_flashdata('state', 'stored');
			redirect(site_url('family'));
		}
	}

	public function update($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data               = FamilyModel::where('id', $id)->first();
			$data->nama      	= $this->input->post('nama');
			$data->nik		 	= $this->input->post('nik');
			$data->relationship = $this->input->post('relationship');
			$data->tgl_lahir 	= $this->input->post('tgl_lahir');
			$data->gender    	= $this->input->post('gender');
			$data->save();
			
			$this->session->set_flashdata('state', 'updated');
			redirect(site_url('family'));
		}
	}

	public function destroy($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			FamilyModel::where('id', $id)->delete();

			$this->session->set_flashdata('state', 'destroyed');
			redirect(site_url('family'));
		}
	}
}