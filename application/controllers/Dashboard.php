<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Capsule\Manager as DB;

class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('AuthenticationLibraries');
    }

	public function index() { 
		if (!$this->authenticationlibraries->active()) {
			redirect('authentication/signin');
		} else {
			$data['content']  ='dashboard/main'; 
			$data['employee'] = PartyModel::where('type', 'employee')->count();
			$data['family']   = FamilyModel::count();
			$data['flight']   = FlightModel::count();
			$data['route']   = RouteModel::count();

			// child
			$data['child_nh'] = count(
				DB::select(
					DB::raw("
						SELECT family.nik FROM party, family
						WHERE party.nik = family.nik
						AND   family.relationship = 'CHILD'
						GROUP BY family.nik
						HAVING count(*) = 0
					")
				)
			);
			$data['child_1'] = count(
				DB::select(
					DB::raw("
						SELECT family.nik FROM party, family
						WHERE party.nik = family.nik
						AND   family.relationship = 'CHILD'
						GROUP BY family.nik
						HAVING count(*) = 1
					")
				)
			);
			$data['child_2'] = count(
				DB::select(
					DB::raw("
						SELECT family.nik FROM party, family
						WHERE party.nik = family.nik
						AND   family.relationship = 'CHILD'
						GROUP BY family.nik
						HAVING count(*) = 2
					")
				)
			);
			$data['child_3'] = count(
				DB::select(
					DB::raw("
						SELECT family.nik FROM party, family
						WHERE party.nik = family.nik
						AND   family.relationship = 'CHILD'
						GROUP BY family.nik
						HAVING count(*) = 3
					")
				)
			);
			$data['child_m3'] = count(
				DB::select(
					DB::raw("
						SELECT family.nik FROM party, family
						WHERE party.nik = family.nik
						AND   family.relationship = 'CHILD'
						GROUP BY family.nik
						HAVING count(*) > 3
					")
				)
			);

			// marriage
			$data['marriage_true'] = count(
				DB::select(
					DB::raw("
						select family.nik from party, family
						where party.nik = family.nik
						and   family.relationship = 'SPOUSE'
						group by family.nik
					")
				)
			);
			$data['marriage_false'] = count(
				DB::select(
					DB::raw("
						select party.nik from party, family
						where party.nik = family.nik
						and   family.relationship IS NULL;
					")
				)
			);

			// rsvp
			$data['rsvp_reimbursement_this_month'] = 
				DB::select(
					DB::raw('
						select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
						where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now())
						and   rsvp.metode_pemesanan = "R"
						group by month
					')
				);
			$data['rsvp_reimbursement_min1_month'] = 
				DB::select(
					DB::raw('
						select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
						where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 1
						and   rsvp.metode_pemesanan = "R"
						group by month
					')
				);
			$data['rsvp_reimbursement_min2_month'] = 
				DB::select(
					DB::raw('
						select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
						where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 2
						and   rsvp.metode_pemesanan = "R"
						group by month
					')
				);
			$data['rsvp_reimbursement_min3_month'] = 
				DB::select(
					DB::raw('
						select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
						where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 3
						and   rsvp.metode_pemesanan = "R"
						group by month
					')
				);

				// rsvp homebase
		$data['rsvp_homebase_this_month'] = 
			DB::select(
				DB::raw('
					select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
					where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now())
					and   rsvp.metode_pemesanan = "H"
					group by month
				')
			);
		$data['rsvp_homebase_min1_month'] = 
			DB::select(
				DB::raw('
					select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
					where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 1
					and   rsvp.metode_pemesanan = "H"
					group by month
				')
			);
		$data['rsvp_homebase_min2_month'] = 
			DB::select(
				DB::raw('
					select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
					where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 2
					and   rsvp.metode_pemesanan = "H"
					group by month
				')
			);
		$data['rsvp_homebase_min3_month'] = 
			DB::select(
				DB::raw('
					select DATE_FORMAT(created_at, "%M") as month, count(*) as total from rsvp
					where EXTRACT(MONTH FROM created_at) = EXTRACT(MONTH FROM now()) - 3
					and   rsvp.metode_pemesanan = "H"
					group by month
				')
			);

			$data['rsvp_homebase_last']      = ReservationModel::where('metode_pemesanan', 'H')->take(5)->orderBy('id', 'desc')->get();
			$data['rsvp_reimbursement_last'] = ReservationModel::where('metode_pemesanan', 'R')->take(5)->orderBy('id', 'desc')->get();

			$this->load->view('components/layout', $data);
		}
	}
}