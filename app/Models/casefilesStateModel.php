<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class casefilesStateModel extends Model
{
    protected $table = 'tb_casefiles_state';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description','value'
    ];
}
