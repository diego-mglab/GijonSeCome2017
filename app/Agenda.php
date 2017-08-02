<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    public function ponentesAgenda(){
        return $this->hasMany('App\PonentesAgenda','agenda_id','id');
    }
}
