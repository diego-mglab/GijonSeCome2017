<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Zona extends Model
{
    public function agenda(){
        return $this->hasMany('App\Agenda','zona_id','id');
    }
}
