<?php

namespace App\Http\Controllers;

use App\Models\clientModel;
use Illuminate\Http\Request;

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
        $client = clientModel::where('id', $id)->first();
        if ($client) {
            $client->delete();
            return response()->json('El cliente ha sido eliminado');
        } else {
            return response()->json('Ha ocurrido un error');
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

    public function listar()
    {
        $clients = clientModel::with(['type_client'])->get();
        return response()->json($clients);
    }
}