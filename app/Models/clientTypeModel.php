<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientTypeModel extends Model
{
    protected $table = 'tb_client_type';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description','notes'
    ];
}
