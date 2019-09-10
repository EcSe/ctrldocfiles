<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\documentStateModel;

class documentStateController extends Controller
{
    public function listar ()
    {
        $states = documentStateModel::all();
        return response()->json($states);
    }
}
