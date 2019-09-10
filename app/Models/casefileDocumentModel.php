<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class casefileDocumentModel extends Model
{
    protected $table = 'tb_casefiles_document';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_casefile', 'id_document', 'description',
    ];

    public function id_casefile()
    {
        return $this->hasOne('App\Models\casefilesModel', 'id', 'id_casefile');
    }

    public function id_document()
    {
        return $this->hasOne('App\Models\mainDocumentmodel','id','id_document');
    }
}
