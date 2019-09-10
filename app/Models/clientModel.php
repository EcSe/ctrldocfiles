<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class clientModel extends Model
{
    protected $table = 'tb_clients';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'cif', 'code', 'description', 'address', 'email', 'phone',
        'notes', 'type_client',
    ];

    public function type_client()
    {
        return $this->hasOne('App\Models\clientTypeModel','id','type_client');
    }
}
