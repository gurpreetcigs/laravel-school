<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    public function videos(){
        return $this->hasMany('App\Video')->get();
    }
}
