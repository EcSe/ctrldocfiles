<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentTypeModel extends Model
{
    protected $table = 'tb_document_type';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'description'
    ];
}
