<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class PartyModel extends Eloquent {
    protected $table = 'party';

    public function family() {
        return $this->belongsTo('FamilyModel', 'nik', 'nik');
    }
}