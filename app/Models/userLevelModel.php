<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userLevelModel extends Model
{
    protected $table = 'tb_user_level';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\userModel');
    }
}
