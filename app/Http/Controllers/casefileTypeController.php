<?php

namespace App\Http\Controllers;

use App\Models\casefilesTypeModel;

class casefileTypeController extends Controller
{
    public function listar()
    {
        $casefileType = casefilesTypeModel::all();
        return response()->json($casefileType);
    }
}
