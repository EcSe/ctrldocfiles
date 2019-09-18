<?php

namespace App\Http\Controllers;

use App\Models\casefilesModel;
use Illuminate\Http\Request;

class casefilesController extends Controller
{
    public function agregar(Request $request)
    {
        $casefile = new casefilesModel();
        $casefile->id_client = $request->input('id_client');
        $casefile->id_type = $request->input('id_type');
        $casefile->description = $request->input('description');
        $casefile->start_date = now();
        $user = session('user');
        $casefile->start_user_id = $user->id;
        $casefile->casefile_state = $request->input('casefile_state');
        $casefile->save();
        return response()->json('El expediente ' . $casefile->description . ' ha sido agregado correctamente');
    }

    public function destroy($id)
    {
        $casefile = casefilesModel::where('id', $id)->first();
        if ($casefile) {
            $casefile->delete();
            return response()->json('El expediente se ha eliminado con exito');
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }

    public function update(Request $request, $id)
    {
        $casefileUpdate = casefilesModel::where('id', $id)->first();
        $casefileUpdate->id_client = $request->input('id_client');
        $casefileUpdate->id_type = $request->input('id_type');
        $casefileUpdate->description = $request->input('description');
        $casefileUpdate->casefile_state = $request->input('casefile_state');
        if ($request->input('casefile_state') == 2) {
            $user = session('user');
            $casefileUpdate->finish_user_id = $user->id;
            $casefileUpdate->finish_date = now();
        }
        $casefileUpdate->save();

        return response()->json('El expediente ' . $casefileUpdate->description . ' ha sido actualizado');
    }

    public function show($id)
    {
        $casefile = casefilesModel::with(['id_client', 'id_type', 'casefile_state', 'start_user_id', 'finish_user_id'])
            ->where('id', $id)->first();
        if ($casefile) {
            return response()->json($casefile);
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }

    public function listPaginate()
    {
        $casefiles = casefilesModel::with(['id_client', 'id_type', 'casefile_state'])->paginate(10);
        return response()->json($casefiles);
    }

    public function listar()
    {
        $casefiles = casefilesModel::with(['id_client', 'id_type', 'casefile_state'])->get();
        return response()->json($casefiles);
    }
}
