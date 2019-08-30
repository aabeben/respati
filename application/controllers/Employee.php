<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');

		if (!$this->authenticationlibraries->active())
			redirect('authentication/signin');
    }

	public function index() {
		$data['content'] ='employee/main'; 
		$data['party'] 	 = PartyModel::with('family')->take(100)->get();
		
		$this->load->view('components/layout', $data);
	}

	public function form($id = null) {
		$data['content'] ='employee/form'; 
		$segment = $this->uri->segment_array()[3];

		if ($segment == 'create') {
			$data['party']			 = new \stdClass();
			$data['party']->id       = '';
			$data['party']->name     = '';
			$data['party']->email    = '';
			$data['party']->identity = '';
			$data['party']->phone_no = '';

			$data['entity'] = 'create'; 
		} else {
			$data['party']  = PartyModel::find($id);
			$data['entity'] = 'update'; 
		}

        $this->load->view('components/layout', $data);
	}

	public function store() {
		$data           = new PartyModel();
        $data->name     = $this->input->post('name');
        $data->email    = $this->input->post('email');
        $data->identity = $this->input->post('identity');
        $data->phone_no = $this->input->post('phone_no');
		$data->save();

		$this->session->set_flashdata('status', 'stored');
		redirect(site_url('employee'));
	}

	public function update($id = null) {
		$data           = PartyModel::where('id', $id)->first();
        $data->name     = $this->input->post('name');
        $data->email    = $this->input->post('email');
        $data->identity = $this->input->post('identity');
        $data->phone_no = $this->input->post('phone_no');
		$data->save();
		
		$this->session->set_flashdata('status', 'updated');
		redirect(site_url('employee'));
	}

	public function destroy($id = null) {
		PartyModel::where('id', $id)->delete();

		$this->session->set_flashdata('status', 'destroyed');
		redirect(site_url('employee'));
	}
}