@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agregar Documento</h3>
            </div>
            <form class="form-horizontal" id="frmAddDocument" method="post" enctype="multipart/form-data">
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
                                    <input type="text" id="document_code" name="document_code" maxlength="50" class="form-control" placeholder="Codigo Documento">
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
                                    <input type="file" id="filename" name="filename" class="form-control" required>
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
                    <input type="submit" data-toggle="modal" data-target="#modal-success" value="Agregar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</section>
<div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensaje</h4>
            </div>
            <div class="modal-body">
                <p id="userMessage">One find body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection @section('scripts')
<script src="js/document/addDocument.js"></script>
@endsection