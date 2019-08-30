<?php 

use \Illuminate\Database\Eloquent\Model as Eloquent;

class FamilyModel extends Eloquent {
    protected $table = 'family';

    public function parties() {
        return $this->belongsTo('PartyModel');
    }
}
