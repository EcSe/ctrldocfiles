<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\accountStateModel;

class accountStateController extends Controller
{
    public function listar() {
        $accountState = accountStateModel::all();
        return response()->json($accountState);
    }
}
