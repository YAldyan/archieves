<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    //
    protected $table = 'user_item';
    protected $fillable = ['FK_ID_ITEM','FK_ID_USER','FK_USERS_ID','STATUS','PESAN'];

    protected $primaryKey = 'ID';

    public $timestamps = false;
}
