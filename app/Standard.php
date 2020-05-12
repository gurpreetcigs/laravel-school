<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    /**
     * Get subject for a standard
     */
    public function subjects(){
        return $this->hasMany('App\Subject');
    }

    
}
