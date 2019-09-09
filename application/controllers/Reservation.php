<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Reservation extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('ReservationModel');
		$this->load->library('AuthenticationLibraries');
	}
	
	public function homebase() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['family']  		= FamilyModel::with('rsvp')
											->where('nik', $this->session->identity)
											->get();
				$data['flagged_family'] = ReservationModel::where('nik', $this->session->identity)
				->where('st_approv', 'false')->where('metode_pemesanan', 'H')->get();

				$data['route']   		= RouteModel::all();
				$data['flight']  		= FlightModel::all();
				$data['content'] 		='reservation/homebase/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('metode_pemesanan', 'H')
														->where('nik', $this->session->identity)
														->where('st_approv', 'false')
														->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('metode_pemesanan', 'H')
														->where('nik', $this->session->identity)
														->where('trip', 'double')
														->where('st_approv', 'false')
														->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] 		='reservation/homebase/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('trip', '!=', 'null')
											->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('trip', 'double')
											->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function homebase_history() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['family']  		= FamilyModel::with('rsvp')
											->where('nik', $this->session->identity)
											->get();
				$data['flagged_family'] = ReservationModel::where('nik', $this->session->identity)
				->where('st_approv', 'false')->where('metode_pemesanan', 'H')->get();

				$data['route']   		= RouteModel::all();
				$data['flight']  		= FlightModel::all();
				$data['content'] 		='reservation/homebase/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('metode_pemesanan', 'H')
														->where('nik', $this->session->identity)
														->where('st_approv', '!=', 'false')
														->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('metode_pemesanan', 'H')
														->where('nik', $this->session->identity)
														->where('trip', 'double')
														->where('st_approv', '!=', 'false')
														->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] 		='reservation/homebase/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('trip', '!=', 'null')
											->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('trip', 'double')
											->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function homebase_reporting() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['content'] ='reservation/homebase/reporting';


				$data['employee'] = PartyModel::where('type', 'employee')->get();
				$depart  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('nik', $this->session->identity)
											->where('trip', '!=', 'null');

				
				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$depart->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$depart->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$depart->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['depart'] = $depart->get();




				$return  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
								->where('metode_pemesanan', 'H')
								->where('trip', 'double');


				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$return->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$return->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$return->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['return'] = $return->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] ='reservation/homebase/reporting';


				$data['employee'] = PartyModel::where('type', 'employee')->get();
				$depart  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'H')
											->where('trip', '!=', 'null');

				
				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$depart->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$depart->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$depart->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['depart'] = $depart->get();




				$return  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
								->where('metode_pemesanan', 'H')
								->where('trip', 'double');


				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$return->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$return->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$return->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['return'] = $return->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function reimbursement_reporting() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['content'] ='reservation/reimbursement/reporting';


				$data['employee'] = PartyModel::where('type', 'employee')->get();
				$depart  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('nik', $this->session->identity)
											->where('trip', '!=', 'null');

				
				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$depart->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$depart->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$depart->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['depart'] = $depart->get();




				$return  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
								->where('metode_pemesanan', 'R')
								->where('trip', 'double');


				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$return->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$return->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$return->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['return'] = $return->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] ='reservation/reimbursement/reporting';

				$data['employee'] = PartyModel::where('type', 'employee')->get();
				$depart  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('trip', '!=', 'null');

				
				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$depart->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$depart->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$depart->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['depart'] = $depart->get();




				$return  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
								->where('metode_pemesanan', 'R')
								->where('trip', 'double');


				if ($this->input->get('status')) {
					if ($this->input->get('status') != 'all') {
						$return->where('st_approv', $this->input->get('status'));
					}
				}

				if ($this->input->get('employee')) {
					if ($this->input->get('employee') != 'all') {
						$return->where('nik', $this->input->get('employee'));
					}
				}

				if ($this->input->get('from_date') || $this->input->get('to_date')) {
					$from_date = $this->input->get('from_date') . ' 00:00:00';
					$to_date   = $this->input->get('to_date') . ' 23:59:59';

					$return->whereBetween('created_at', [$from_date, $to_date]);
				}

				$data['return'] = $return->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function reimbursement() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['family']  		= FamilyModel::with('rsvp')
											->where('nik', $this->session->identity)
											->get();
				$data['flagged_family'] = ReservationModel::where('nik', $this->session->identity)
											->where('metode_pemesanan', 'R')
											->where('st_approv', 'false')
											->get();

				$data['route']   		= RouteModel::all();
				$data['flight']  		= FlightModel::all();
				$data['content'] 		='reservation/reimbursement/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('nik', $this->session->identity)
														->where('metode_pemesanan', 'R')
														->where('st_approv', 'false')
														->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('nik', $this->session->identity)
														->where('metode_pemesanan', 'R')
														->where('trip', 'double')
														->where('st_approv', 'false')
														->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] 		='reservation/reimbursement/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('trip', '!=', 'null')
											->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('trip', 'double')
											->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function reimbursement_history() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->session->type === 'employee') {
				$data['family']  		= FamilyModel::with('rsvp')
											->where('nik', $this->session->identity)
											->get();
				$data['flagged_family'] = ReservationModel::where('nik', $this->session->identity)
											->where('metode_pemesanan', 'R')
											->where('st_approv', '!=', 'false')
											->get();

				$data['route']   		= RouteModel::all();
				$data['flight']  		= FlightModel::all();
				$data['content'] 		='reservation/reimbursement/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('nik', $this->session->identity)
														->where('metode_pemesanan', 'R')
														->where('st_approv', '!=', 'false')
														->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
														->where('nik', $this->session->identity)
														->where('metode_pemesanan', 'R')
														->where('trip', 'double')
														->where('st_approv', '!=', 'false')
														->get();

				$this->load->view('components/layout', $data);
			} else {
				$data['content'] 		='reservation/reimbursement/main'; 
				$data['depart']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('trip', '!=', 'null')
											->get();

				$data['return']  = ReservationModel::with('flightDepart', 'flightReturn', 'routeFrom', 'routeTo')
											->where('metode_pemesanan', 'R')
											->where('trip', 'double')
											->get();

				$this->load->view('components/layout', $data);
			}
		}
	}

	public function attachmentChange() {
		$target_dir  = "./assets/storage/image/boarding/";
		$file_name = 'BOARDING-PASS-' . date('YmdHis') . '.' . pathinfo($_FILES['boarding']['name'], PATHINFO_EXTENSION);
		$target_file = $target_dir . $file_name;

		if (move_uploaded_file($_FILES["boarding"]["tmp_name"], $target_file)) {
			$data          	= ReservationModel::where('id', $this->input->post('rsvp_id'))->first();
			$data->document = $file_name;
			$data->save();

			$this->session->set_flashdata('state', 'stored');
			redirect(site_url('reservation/reimbursement'));
		}
	}

	public function store() {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			if ($this->input->post('entity') == 'REIMBURSEMENT') {
				$target_dir  = "./assets/storage/image/boarding/";
				$file_name = 'BOARDING-PASS-' . date('YmdHis') . '.' . pathinfo($_FILES['boarding']['name'], PATHINFO_EXTENSION);
				$target_file = $target_dir . $file_name;

				if (move_uploaded_file($_FILES["boarding"]["tmp_name"], $target_file)) {
					$data           	= new ReservationModel();
					$data->trip = $this->input->post('typetrip');
					$data->nama = $this->input->post('nama');
					$data->nik  = $this->input->post('party');
					$data->statusku = $this->input->post('statusku');
					$data->route_from = $this->input->post('route_from');
					$data->route_to = $this->input->post('route_to');
					$data->maskapai = $this->input->post('maskapai_berangkat');
					$data->maskapai_pulang = $this->input->post('maskapai_pulang');
					$data->tgl_berangkat = $this->input->post('tgl_berangkat');
					$data->waktu_berangkat = $this->input->post('waktu_berangkat');
					$data->tgl_pulang = $this->input->post('tgl_pulang');
					$data->waktu_pulang = $this->input->post('waktu_pulang');
					$data->kode_flight = $this->input->post('kode_flight');
					$data->harga = $this->input->post('harga');
					$data->metode_pemesanan = 'R';
					$data->kode_flight_pulang = $this->input->post('kode_flight_pulang');
					$data->harga_pulang = $this->input->post('harga_pulang');
					$data->document = $file_name;
					$data->save();

					$this->session->set_flashdata('state', 'stored');
					redirect(site_url('reservation/reimbursement'));
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			} else {
				$data           	= new ReservationModel();
				$data->trip = $this->input->post('typetrip');
				$data->nama = $this->input->post('nama');
				$data->nik  = $this->input->post('party');
				$data->statusku = $this->input->post('statusku');
				$data->route_from = $this->input->post('route_from');
				$data->route_to = $this->input->post('route_to');
				$data->maskapai = $this->input->post('maskapai_berangkat');
				$data->maskapai_pulang = $this->input->post('maskapai_pulang');
				$data->tgl_berangkat = $this->input->post('tgl_berangkat');
				$data->waktu_berangkat = $this->input->post('waktu_berangkat');
				$data->tgl_pulang = $this->input->post('tgl_pulang');
				$data->waktu_pulang = $this->input->post('waktu_pulang');
				$data->kode_flight = $this->input->post('kode_flight');
				$data->harga = $this->input->post('harga');
				$data->metode_pemesanan = 'H';
				$data->kode_flight_pulang = $this->input->post('kode_flight_pulang');
				$data->harga_pulang = $this->input->post('harga_pulang');
				$data->save();

				$this->session->set_flashdata('state', 'stored');
				redirect(site_url('reservation/homebase'));
			}
		}
	}

	public function destroy($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			ReservationModel::where('id', $id)->delete();

			$this->session->set_flashdata('state', 'destroyed');
			redirect(site_url('reservation/reimbursement'));
		}
	}


	public function approval($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data       	 = ReservationModel::where('id', $id)->first();
			$data->st_approv = $this->input->get('action');
			$data->save();
			
			$this->session->set_flashdata('state', 'updated');
			redirect(site_url('reservation/' . $this->input->get('back')));
		}
	}

	public function serviceRsvpNotification() {
		$data = json_encode(
			DB::select(
				DB::raw('
					select 
					(select count(*) as noti_approve from rsvp
					where nik = "'.$this->session->identity.'"
					and   notif_user = "A"
					and   metode_pemesanan = "R"
					and   st_approv = "true") as noti_reimbursement_approve,
					(select count(*) as noti_approve from rsvp
					where nik = "'.$this->session->identity.'"
					and   notif_user = "A"
					and   metode_pemesanan = "R"
					and   st_approv = "reject") as noti_reimbursement_reject,
					(select count(*) as noti_approve from rsvp
					where nik = "'.$this->session->identity.'"
					and   notif_user = "A"
					and   metode_pemesanan = "H"
					and   st_approv = "true") as noti_homebase_approve,
					(select count(*) as noti_approve from rsvp
					where nik = "'.$this->session->identity.'"
					and   notif_user = "A"
					and   metode_pemesanan = "H"
					and   st_approv = "reject") as noti_homebase_reject,
					(select count(*) as noti_approve from rsvp
					where nik = "'.$this->session->identity.'"
					and   notif_user = "A"
					and   st_approv in ("true", "reject")) as total
				')
			)
		);

		print $data;
	}

	public function updateNoti($id = null) {
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data       	  = ReservationModel::where('notif_user', 'A')->where('nik', $this->session->identity)->update([
				'notif_user' => 'Y'
			]);
			
		}
	}
}