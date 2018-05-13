<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    //
    protected $table = 'item_project';
    protected $fillable = ['NM_ITEM','ID_CAT_REQ','STATUS'];

    protected $primaryKey = 'ID' ;

    public $timestamps = false;
}
