<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class casefilesModel extends Model
{
    protected $table = 'tb_casefiles';
    public $incrementing = true;
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

    public function id_type()
    {
        return $this->hasOne('App\Models\casefilesTypeModel', 'id', 'id_type');
    }

    public function casefile_state()
    {
        return $this->hasOne('App\Models\casefilesStateModel','id','casefile_state');
    }

    public function start_user_id()
    {
        return $this->hasOne('App\Models\userModel', 'id', 'start_user_id');
    }

    public function finish_user_id()
    {
        return $this->hasOne('App\Models\userModel', 'id', 'finish_user_id');
    }
}
