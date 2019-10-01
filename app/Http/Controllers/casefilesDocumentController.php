<?php

namespace App\Http\Controllers;

use App\Models\casefilesDocumentModel;
use App\Models\mainDocumentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class casefilesDocumentController extends Controller
{
    public function agregar(Request $request)
    {
        $casefilesDocument = casefilesDocumentModel::where([
            ['id_casefile', $request->input('id_casefile')],
            ['id_document', $request->input('id_document')],
        ])->first();

        if ($casefilesDocument) {
            return response()->json('El documento ya existe en el expediente');
        } else {
            $casefilesDocument = new casefilesDocumentModel();
            $casefilesDocument->id_casefile = $request->input('id_casefile');
            $casefilesDocument->id_document = $request->input('id_document');
            $casefilesDocument->description = $request->input('description','');
            $casefilesDocument->save();
            return response()->json('El documento se ha agregado al expediente correctamente');
        }
    }

    public function agregarDocumentIntoCasefile(Request $request    )
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
        $document->place_details_id = $request->input('place_details_id',null);
        $document->place_details_obs = $request->input('place_details_obs',null);
        $user = session('user');
        $document->user_upload_id = $user->id;
        $document->document_state = $request->input('document_state');
        $document->save();

        //Add Documento into Casefile
        $casefilesDocument = new casefilesDocumentModel();
        $casefilesDocument->id_casefile = $request->input('idCasefile');
        $document = mainDocumentModel::where('filename',$filePath)->first();
        $casefilesDocument->id_document = $document->id;
        $casefilesDocument->description = '';
        $casefilesDocument->save();
        return response()->json('El documento ha sido agregado correctamente al expediente');
    }

    public function listPaginate() {
        $casefilesDocument = casefilesDocumentModel::with(['id_document'])->orderBy('id','desc')->paginate(10);
        return response()->json($casefilesDocument);
    }

    public function listar()
    {
        $casefilesDocument = casefilesDocumentModel::with(['id_document'])->orderBy('id','desc')->get();
        return response()->json($casefilesDocument);
    }

    public function show($id)
    {
        $casefilesDocument = casefilesDocumentModel::with(['id_document'])->where('id_casefile', $id)->paginate(10);
        return response()->json($casefilesDocument);
    }

    public function destroy($id)
    {
        $casefilesDocument = casefilesDocumentModel::where('id', $id)->first();
        if ($casefilesDocument) {
            $casefilesDocument->delete();
            return response()->json('El documento se ha eliminado del expediente con exito');
        } else {
            return response()->json('Ha ocurrido un error');
        }
    }
}
