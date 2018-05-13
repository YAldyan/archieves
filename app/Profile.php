<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = 'profile';
    protected $fillable = ['NM_PROFILE','FLOW'];

    protected $primaryKey = 'ID' ;

    public $timestamps = false;
}
