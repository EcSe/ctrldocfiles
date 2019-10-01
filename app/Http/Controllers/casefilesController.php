<?php

namespace App\Http\Controllers;

use App\Models\casefilesDocumentModel;
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
        $casefileDocument = casefilesDocumentModel::where('id_casefile', $id)->first();
        if ($casefileDocument) {
            $casefile = casefilesModel::where('id', $casefileDocument->id_casefile)->first();
            return response()->json('Error: El expediente no se puede eliminar, contiene documentos', 400);
        } else {
            $casefile = casefilesModel::where('id', $id)->first();
            if ($casefile) {
                $casefile->delete();
                return response()->json('El expediente se ha eliminado con exito',200);
            } else {
                return response()->json('Ha ocurrido un error',500);
            }
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
        $userNow = session('user');
        $casefiles = casefilesModel::with(['id_client', 'id_type', 'casefile_state'])->orderBy('id','desc')->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'listCasefilePaginate' => $casefiles]);
    }

    public function listar()
    {
        $casefiles = casefilesModel::with(['id_client', 'id_type', 'casefile_state'])->orderBy('id','desc')->get();
        return response()->json($casefiles);
    }

    public function search(Request $request)
    {
        $userNow = session('user');
        $idClient = $request->input('srchClient');
        $description = $request->input('srchDescription');

        $casefiles = casefilesModel::with(['id_client', 'id_type', 'casefile_state', 'start_user_id', 'finish_user_id'])
            ->when($description, function ($query) use ($description) {
                return $query->orWhere('description', 'like', '%' . $description . '%');
            })
            ->when($idClient, function ($query) use ($idClient) {
                return $query->orWhere('id_client', 'like', '%' . $idClient . '%');
            })
            ->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'casefiles' => $casefiles]);

    }
}
