<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentStateModel extends Model
{
    protected $table = 'tb_document_state';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description','value'
    ];
}
