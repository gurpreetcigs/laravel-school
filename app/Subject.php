<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function videos(){
        if(auth('web')->check())
            return $this->hasMany('App\Video')->where(['status' => '1'])->get();
        else
            return $this->hasMany('App\Video')->get();
    }
}
