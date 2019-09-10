<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    protected $table = 'tb_users';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'code', 'name', 'email', 'description', 'login', 'password', 'keyaccess',
        'type_level', 'account_state',
    ];

    public function type_level()
    {
        return $this->hasOne('App\Models\userLevelModel','id','type_level');
    }

    public function account_state()
    {
        return $this->hasOne('App\Models\accountStateModel','id','account_state');
    }

}
