<?php

namespace App\Http\Controllers;

use App\Models\casefilesModel;
use App\Models\clientModel;
use App\Models\mainDocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    public function agregar(Request $request)
    {
        $client = new clientModel();
        $client->cif = $request->input('cif');
        $client->code = $request->input('code');
        $client->description = $request->input('description');
        $client->address = $request->input('address');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->notes = $request->input('notes');
        $client->type_client = $request->input('type_client');
        $client->save();
        return response()->json('El cliente ' . $client->cif . ' ha sido agregado correctamente');
    }

    public function destroy($id)
    {
        $casefile = casefilesModel::where('id_client', $id)->first();
        $mainDocument = mainDocumentModel::where('id_client', $id)->first();
        if ($casefile) {
            return response()->json('Error: El cliente no se puede eliminar,
                                    tiene expedientes creados', 400);
        } else if ($mainDocument) {
            return response()->json('Error: El cliente no se puede eliminar,
                                     tiene documentos creados', 400);
        } else {
            $client = clientModel::where('id', $id)->first();
            if ($client) {
                $client->delete();
                return response()->json('El cliente ha sido eliminado',200);
            } else {
                return response()->json('Ha ocurrido un error',500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $clientUpdate = clientModel::where('id', $id)->first();
        $clientUpdate->cif = $request->input('cif');
        $clientUpdate->code = $request->input('code');
        $clientUpdate->description = $request->input('description');
        $clientUpdate->address = $request->input('address');
        $clientUpdate->email = $request->input('email');
        $clientUpdate->phone = $request->input('phone');
        $clientUpdate->notes = $request->input('notes');
        $clientUpdate->type_client = $request->input('type_client');
        $clientUpdate->save();

        return response()->json('El cliente ' . $clientUpdate->cif . ' ha sido actualizado');
    }

    public function show($id)
    {
        $client = clientModel::with(['type_client'])->where('id', $id)->first();
        if ($client) {
            return response()->json($client);
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }

    public function listPaginate()
    {
        $userNow = session('user');
        $clients = clientModel::with(['type_client'])->orderBy('id','desc')->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'listClientPaginate' => $clients]);
    }

    public function listar()
    {
        $clients = clientModel::with(['type_client'])->orderBy('id','desc')->get();
        return response()->json($clients);
    }

    public function search(Request $request)
    {
        $userNow = session('user');
        $cif = $request->input('srchCif');
        $description = $request->input('srchDescription');
        $email = $request->input('srchEmail');

        $clients = clientModel::with('type_client')
            ->when($cif, function ($query) use ($cif) {
                return $query->orWhere('cif', 'like', '%' . $cif . '%');
            })
            ->when($description, function ($query) use ($description) {
                return $query->orWhere('description', 'like', '%' . $description . '%');
            })
            ->when($email, function ($query) use ($email) {
                return $query->orWhere('email', 'like', '%' . $email . '%');
            })
            ->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'clients' => $clients]);
    }
}
