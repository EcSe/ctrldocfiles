<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accountStateModel extends Model
{
    protected $table = 'tb_account_state';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description', 'value',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\userModel');
    }
}
