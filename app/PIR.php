<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PIR extends Model
{
    //
    protected $table = 'pir';
    protected $fillable = ['ID','FK_ID_PROJECT','FK_ID_DOCUMENT','SUBMIT_DATE','PIR_DATE'];

    protected $primaryKey = 'ID' ;

    public $timestamps = false;
}
