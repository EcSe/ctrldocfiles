@extends('master') @section('content')
<section class="content">
    <div class="alert alert-success alert-dismissible" id="alertDocumentUpdate" style="display: none">
        <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Sistema</h4>
        <span id="documentMessageUpdate"></span>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Documento</h3>
            </div>
            <form class="form-horizontal" id="frmUpdateDocument" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="id_type" class="control-label">Tipo Documento</label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="id_type" name="id_type" class="form-control" required>
                                           
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="id_client" class="control-label">Cliente</label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="id_client" name="id_client" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="document_code" class="control-label">Codigo Documento</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="document_code" name="document_code" class="form-control" placeholder="Codigo Documento">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="description" class="control-label">Descripcion</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="description" name="description" class="form-control" placeholder="descripcion" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="filename" class="control-label">Archivo</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" id="filename" name="filename" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="document_date" class="control-label">Fecha Documento</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" id="document_date" name="document_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="period_start_date" class="control-label">Periodo Inicio</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" id="period_start_date" name="period_start_date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="period_finish_date" class="control-label">Periodo Fin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" id="period_finish_date" name="period_finish_date" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="value" class="control-label">Valor</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="value" name="value" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="main_doc_id" class="control-label">ID Main Doc</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="main_doc_id" name="main_doc_id" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="place_details_id" class="control-label">Detalle Lugar</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="place_details_id" name="place_details_id" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="main_doc_id" class="control-label">Obs. Lugar</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="place_details_obs" name="place_details_obs" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="document_state" class="control-label">Estado Documento</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="document_state" name="document_state" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <a href="{{route('listDocument')}}" id="back" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" id="update" data-toggle="modal" data-target="#modal-success" value="Actualizar" class="btn btn-primary">
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" id="updateBack" onclick="return back();" value="Actualizar y Volver" class="btn btn-default">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection @section('scripts')
<script src="js/document/updateDocument.js"></script>
@endsection