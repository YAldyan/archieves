<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hisotem extends Model
{
    //
    protected $table = 'history_item';
    protected $fillable = ['FK_ID_ITEM','FK_ARSIP_REQ','UPLOAD_STAT','FILE_UPLOAD'];

    protected $primaryKey = 'ID';

    public $timestamps = false;
}
