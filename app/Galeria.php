<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    public function multimedia(){
        return $this->hasMany('App\Multimedia','galeria_id','id');
    }
}
