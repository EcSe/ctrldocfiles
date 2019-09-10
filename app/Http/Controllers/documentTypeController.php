<?php

namespace App\Http\Controllers;

use App\Models\documentTypeModel;

class documentTypeController extends Controller
{
    public function listar()
    {
        $documentType = documentTypeModel::all();
        return response()->json($documentType);
    }
}
