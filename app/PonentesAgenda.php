<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PonentesAgenda extends Model
{
    protected $table='ponentes_agenda';

    public function agenda() {
        return $this->belongsTo('App\Agenda','id','agenda_id');
    }

    public function ponentes() {
        return $this->belongsTo('App\Ponente','id','ponente_id');
    }

}
