<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value'
    ]; 
    
    /**
     * Get subject for a standard
     */
    public function subjects(){
        return $this->hasMany('App\Subject');
    }

    
}
