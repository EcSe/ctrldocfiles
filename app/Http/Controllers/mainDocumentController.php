<?php

namespace App\Http\Controllers;

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
        $document->period_start_date = $request->input('period_star_date');
        $document->period_finish_date = $request->input('period_finish_date');
        $document->value = $request->input('value');
        $document->main_doc_id = $request->input('main_doc_id');
        $document->place_details_id = $request->input('place_details_id');
        $document->place_details_obs = $request->input('place_details_obs');
        $user = session('user');
        $document->user_upload_id = $user->id;
        $document->document_state = $request->input('document_state');
        $document->save();

        return response()->json('El documento ha sido correctamente agregado');
    }

    public function destroy($id)
    {
        $document = mainDocumentModel::where('id', $id)->first();
        if ($document) {
            $fileold = $document->filename;
            Storage::disk('doc')->delete($fileold);
            $document->delete();
            return response()->json('El documento se ha eliminado correctamente');
        } else {
            return response()->json('Ha ocurrido un error');
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
        if($file){
            $fileold =$documentUpdate->filename;
            Storage::disk('doc')->delete($fileold);
            $filePath = time().$file->getClientOriginalName(); 
            Storage::disk('doc')->put($filePath,\File::get($file));
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
        $document = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->where('id', $id)->first();
        if ($document) {
            return response()->json($document);
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }

    public function listar()
    {
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->get();
        return response()->json($documents);
    }
}