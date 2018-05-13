<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    //
    //
    protected $table = 'request';
    protected $fillable = ['NM_REQ'];

    protected $primaryKey = 'ID' ;

    public $timestamps = false;
}
