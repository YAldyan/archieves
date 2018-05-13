<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $table = 'document';
    protected $fillable = ['FK_REQ','FK_USER_ID','NM_ARSIP','Mandatory'];

    protected $primaryKey = 'ID' ;

    public $timestamps = false;
}
