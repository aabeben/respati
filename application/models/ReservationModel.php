<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ReservationModel extends Eloquent {
    protected $table = 'rsvp';

    public function routeFrom() {
        return $this->hasOne('RouteModel', 'id', 'route_from');
    }

    public function routeTo() {
        return $this->hasOne('RouteModel', 'id', 'route_to');
    }

    public function flightDepart() {
        return $this->hasOne('FlightModel', 'id', 'maskapai');
    }

    public function flightReturn() {
        return $this->hasOne('FlightModel', 'id', 'maskapai_pulang');
    }
}