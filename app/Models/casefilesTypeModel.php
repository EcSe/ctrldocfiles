<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class casefilesTypeModel extends Model
{
    protected $table = 'tb_casefiles_type';
    public $incrementing = true;
    public $timestamps = false;
    protected $primarykey = 'id';
    protected $fillable = [
        'description'
    ];
}
