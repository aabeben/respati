<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class FamilyModel extends Eloquent {
    protected $table = 'family';

    public function employee() {
        return $this->hasOne('PartyModel', 'nik', 'nik');
    }
}