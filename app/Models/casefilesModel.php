<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class casefilesModel extends Model
{
    protected $table = 'tb_casefiles';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_client', 'id_type', 'description', 'start_date', 'finish_date',
        'start_user_id', 'finish_user_id', 'casefile_state',
    ];

    public function id_client()
    {
        return $this->hasOne('App\Models\clientModel', 'id', 'id_client');
    }

    public function start_user_id()
    {
        return $this->hasOne('App\Models\userModel','id','start_user_id');
    }
}
