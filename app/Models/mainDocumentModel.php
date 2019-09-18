<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class mainDocumentModel extends Model
{
    protected $table = 'tb_main_document';
    public $incrementing = true;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_type', 'id_client', 'document_code', 'description', 'filename',
        'document_date', 'period_start_date', 'period_finish_date', 'value',
        'main_doc_id', 'place_details_id', 'place_details_obs', 'user_upload_id',
        'document_state',
    ];

    public function document_state()
    {
        return $this->hasOne('App\Models\documentStateModel', 'id', 'document_state');
    }

    public function id_type()
    {
        return $this->hasOne('App\Models\documentTypeModel', 'id', 'id_type');
    }

    public function id_client()
    {
        return $this->hasOne('App\Models\clientModel','id','id_client');
    }
}
