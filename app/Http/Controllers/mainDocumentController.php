<?php

namespace App\Http\Controllers;

use App\Models\casefilesDocumentModel;
use App\Models\casefilesModel;
use App\Models\clientModel;
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
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->orderBy('id', 'desc')->paginate(10);
        return response()->json(['userLevel' => $userNow->type_level, 'listDocumentPaginate' => $documents]);
    }

    public function listar()
    {
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])->orderBy('id', 'desc')
            ->get();
        return response()->json($documents);
    }

    public function listDocumentClient($id)
    {
        $casefile = casefilesModel::where('id', $id)->first();
        $documents = mainDocumentModel::with(['document_state', 'id_type', 'id_client'])
            ->where('id_client', $casefile->id_client)->orderBy('id', 'desc')
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

    public function indexarDocument($fileRoute)
    {
        $user = session('user');
        $filename = pathinfo($fileRoute)['basename'];
        $filenameBase = pathinfo($filename)['filename'];
        $extension = pathinfo($filename)['extension'];
        if ($extension !== 'pdf') {
            $resp = [
                'code' => 400,
                'msg' => 'El archivo tiene que ser PDF. Archivo: '.$filenameBase
            ];
            return $resp;
        }
        $data = explode('_', $filenameBase);
        if (count($data) !== 5) {
            $resp = [
                'code' => 400,
                'msg' => 'El nombre del documento no tiene el formato adecuado. Archivo: '.$filenameBase
            ];
            return $resp;
        }
        $codeClient = $data[0];
        $serial = $data[1];
        $dateCount = $data[2];
        $copyBlack = $data[3];
        $copyColor = $data[4];

        //Validamos si el formato de la fecha es correcta
        if (strlen($dateCount) !== 8) {
            $resp = [
                'code' => 400,
                'msg' => 'El formato de la fecha no es correcta. Archivo: '.$filenameBase
            ];
            return $resp;
        }
        $arrayDate = str_split($dateCount, 2);
        $day = $arrayDate[0];
        $month = $arrayDate[1];
        $year = $arrayDate[2] . $arrayDate[3];
        $stringToDate = strtotime($year . $month . $day);
        $dateFormat = date('Y-m-d', $stringToDate);

        //Validamos los datos del nombre del documento
        $client = clientModel::where('code', $codeClient)->first();
        if (!$client) {
            $resp = [
                'code' => 400,
                'msg' => 'El codigo del cliente no existe. Archivo: '.$filenameBase
            ];
            return $resp;
        }

        $isDocumentExist = mainDocumentModel::where('filename', $filename)->first();
        if ($isDocumentExist) {
            $resp = [
                'code' => 400,
                'msg' => 'Ya existe un documento creado con ese nombre. Archivo: '.$filenameBase
            ];
            return $resp;
        }

        //Creamos el documento
        $document = new mainDocumentModel();
        $document->id_type = 9;
        $document->id_client = $client->id;
        $document->description = 'Documento de contador para ' . $client->description;
        rename($fileRoute, '/Users/elvinsalinasespinoza/ArchivosPrueba/' . $filename);
        $document->filename = $filename;
        $document->document_date = $dateFormat;
        $document->value = $copyBlack;
        $document->value1 = $copyColor;
        $document->user_upload_id = $user->id;
        $document->document_state = 1;
        $document->save();

        //Creamos el expediente
        $isCasefileExist = casefilesModel::where([
            ['description', '=', 'CONTADORES'],
            ['id_client', $client->id],
        ])->first();
        $documentCreated = mainDocumentModel::where('filename', $filename)->first();
        if ($isCasefileExist) {
            $casefileDocument = new casefilesDocumentModel();
            $casefileDocument->id_casefile = $isCasefileExist->id;
            $casefileDocument->id_document = $documentCreated->id;
            $casefileDocument->description = '';
            $casefileDocument->save();
        } else {
            //Creamos un nuevo expediente
            $casefile = new casefilesModel();
            $casefile->id_client = $client->id;
            $casefile->id_type = 9;
            $casefile->description = 'CONTADORES';
            $casefile->start_date = now();
            $casefile->start_user_id = $user->id;
            $casefile->casefile_state = 1;
            $casefile->save();

            //Creamos un nuevo expediente-documento
            $casefileCreated = casefilesModel::where([
                ['description', '=', 'CONTADORES'],
                ['id_client', $client->id],
            ])->first();
            $casefileDocument = new casefilesDocumentModel();
            $casefileDocument->id_casefile = $casefileCreated->id;
            $casefileDocument->id_document = $documentCreated->id;
            $casefileDocument->description = '';
            $casefileDocument->save();
        }    
        $resp = [
            'code' => 200,
            'msg' => 'El documento ha sido subido satisfactoriamente. Archivo: '.$filenameBase
        ];
        return $resp;    
    }

    public function pruebaScanDir()
    {
        $path = '/Users/elvinsalinasespinoza/PruebaIndex';
        if (is_dir($path)) {
            if ($dh = opendir($path)) {
                while (false !== ($file = readdir($dh))) {
                    if (substr($file, 0, 2) !== '00') {
                        continue;
                    }
                    $filepath = $path . '/' . $file;
                    $anexando = $this->indexarDocument($filepath);
                    if($anexando['code'] !== 200){
                        return response()->json($anexando['msg'],$anexando['code']);
                    }
                    continue;
                }
                closedir($dh);
                clearstatcache();
            }
            return response()->json('Los archivos han sido procesados adecuadamente', 200);
        } else {
            return response()->json('Error con la ruta especificada', 400);
        }
    }
}
