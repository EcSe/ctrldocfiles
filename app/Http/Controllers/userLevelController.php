<?php

namespace App\Http\Controllers;

use App\Models\userLevelModel;

class userLevelController extends Controller
{
    public function listar()
    {
        $userLevel = userLevelModel::all();
        return response()->json($userLevel);
    }
}
