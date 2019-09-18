<?php

namespace App\Http\Controllers;

use App\Models\casefilesStateModel;

class casefileStateController extends Controller
{
    public function listar()
    {
        $casefileState = casefilesStateModel::all();
        return response()->json($casefileState);
    }
}
