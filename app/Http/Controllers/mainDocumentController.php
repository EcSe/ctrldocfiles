<?php

namespace App\Http\Controllers;

use App\Models\casefilesDocumentModel;
use App\Models\casefilesModel;
use App\Models\mainDocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class mainDocumentController extends Controller
{
    public function agregar(Request $request)
    {
        $document = new mainDocumentModel();
        $document->id_type = $request->input('id_type');
        $document->id_client = $request->input('id_client');
        $document->document_code = $request->input('document_code');
        $document->description = $request->input('description');
        $file = $request->file('filename');
        if ($file) {
            $filePath = time() . $file->getClientOriginalName();
            Storage::disk('doc')->put($filePath, \File::get($file));
        }
        $document->filename = $filePath;
        $document->document_date = $request->input('document_date');
        $document->period_start_date = $request->input('period_start_date');
        $document->period_finish_date = $request->input('period_finish_date');
        $document->value = $request->input('value');
        $document->main_doc_id = $request->input('main_doc_id');
        $document->place_details_id = $request->input('place_details_id', null);
        $document->place_details_obs = $request->input('place_details_obs', null);
        $user = session('user');
        $document->user_upload_id = $user->id;
        $document->document_state = $request->input('document_state');
        $document->save();

        return response()->json('El documento ha sido correctamente agregado');
    }

    public function destroy($id)
    {
        $casefileDocument = casefilesDocumentModel::where('id_document', $id)->first();
        if ($casefileDocument) {
            $casefile = casefilesModel::where('id', $casefileDocument->id_casefile)->first();
            return response()->json('Error: El documento no se puede eliminar, pertenece al
                                    expediente con descripcion: ' . $casefile->description, 400);
        } else {
            $document = mainDocumentModel::where('id', $id)->first();
            if ($document) {
                $fileold = $document->filename;
                Storage::disk('doc')->delete($fileold);
                $document->delete();
                return response()->json('El documento se ha eliminado correctamente', 200);
            } else {
                return response()->json('Ha ocurrido un error', 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $documentUpdate = mainDocumentModel::where('id', $id)->first();
        $documentUpdate->id_type = $request->input('id_type');
        $documentUpdate->id_client = $request->input('id_client');
        $documentUpdate->document_code = $request->input('document_code');
        $documentUpdate->description = $request->input('description');

        $file = $request->file('filename');
        if ($file) {
            $fileold = $documentUpdate->filename;
            Storage::disk('doc')->delete($fileold);
            $filePath = time() . $file->getClientOriginalName();
            Storage::disk('doc')->put($filePath, \File::get($file));
            $documentUpdate->filename = $filePath;
        }
        $documentUpdate->document_date = $request->input('document_date');
        $documentUpdate->period_start_date = $request->input('period_star_date');
        $documentUpdate->period_finish_date = $request->input('period_finish_date');
        $documentUpdate->value = $request->input('value');
        $documentUpdate->main_doc_id = $request->input('main_doc_id');
        $documentUpdate->place_details_id = $request->input('place_details_id');
        $documentUpdate->place_details_obs = $request->input('place_details_obs');
        $user = session('user');
        $documentUpdate->user_upload_id = $user->id;
        $documentUpdate->document_state = $request->input('document_state');
        $documentUpdate->save();

        return response()->json('El documento ha sido actualizado');
    }

    public function show($id)
    {
        $document = mainDocumentModel::with(['document_state', 'id_type', 'id_client', 'user_upload_id'])->where('id', $id)->first();
        if ($document) {
            return response()->json($document);
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }

    public function listPaginate()
    {
        $userNow = session('user');
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->orderBy('id','desc')->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'listDocumentPaginate' => $documents]);
    }

    public function listar()
    {
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->orderBy('id','desc')
            ->get();
        return response()->json($documents);
    }

    public function listDocumentClient($id)
    {
        $casefile = casefilesModel::where('id', $id)->first();
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])
            ->where('id_client', $casefile->id_client)->orderBy('id','desc')
            ->paginate(10);
        return response()->json($documents);
    }

    public function search(Request $request)
    {
        $userNow = session('user');
        $client = $request->input('srchClient');
        $descripcion = $request->input('srchDescription');
        $date = $request->input('srchDate');

        $documents = mainDocumentModel::with('document_state', 'id_type', 'id_client')
            ->when($client, function ($query) use ($client) {
                //return $query->orWhere('id_client', 'like', '%' . $client . '%');
                return $query->orWhere('id_client', '=', $client);
            })
            ->when($descripcion, function ($query) use ($descripcion) {
                return $query->orWhere('description', 'like', '%' . $descripcion . '%');
            })
            ->when($date, function ($query) use ($date) {
                return $query->orWhere('document_date', 'like', '%' . $date . '%');
            })
            ->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'documents' => $documents]);
    }
}
