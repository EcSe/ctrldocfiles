@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ver Expediente</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID Expediente:</th>
                            <td id="tid"></td>
                        </tr>
                        <tr>
                            <th>Cliente</th>
                            <td id="tclient"></td>
                        </tr>
                        <tr>
                            <th>Tipo Expediente:</th>
                            <td id="tcasetype"></td>
                        </tr>
                        <tr>
                            <th>Descripcion:</th>
                            <td id="tdescription"></td>
                        </tr>
                        <tr>
                            <th>Fecha Inicio:</th>
                            <td id="tstartdate"></td>
                        </tr>
                        <tr>
                            <th>Fecha Fin:</th>
                            <td id="tfinishdate"></td>
                        </tr>
                        <tr>
                            <th>Usuario Apertura:</th>
                            <td id="tstartuser"></td>
                        </tr>
                        <tr>
                            <th>Usuario Cierre:</th>
                            <td id="tfinishuser"></td>
                        </tr>
                        <tr>
                            <th>Estado:</th>
                            <td id="tstate"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box-footer text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-4">
                            <a href="{{route('listCasefiles')}}" id="back" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-4">
                            <a class="btn btn-default" id="hrefAddDocument">Agregar Documento Nuevo</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-info collapsed-box" id="divDocuCase">
                <div class="box-header with-border">
                    <h3 class="box-title">Agregar Documento Existente</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" type="button" onclick="listDocument()" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Tipo Documento</th>
                                            <th>Cliente</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentCasefile">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tipo Documento</th>
                                            <th>Cliente</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-5">
                            <div id="example1_info" class="dataTables_info" role="status" aria-live="polite">
                                Mostrando <span id="from"></span> a <span id="to"></span> de <span id="total"></span> entradas
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-md-4 ">
                                <a href="#" id="hPrev" class="">Anterior</a>
                            </div>
                            <div class="col-md-4 ">
                                Pagina: <span id="currentPage"></span>
                            </div>
                            <div class="col-md-4 ">
                                <a href="#" id="hNext" class="">Siguiente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Documentos agregados en este Expediente</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table no-margin">
                                <thead>
                                    <tr>
                                        <th>Tipo Documento</th>
                                        <th>Cliente</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDocumentIntoCasefile">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tipo Documento</th>
                                        <th>Cliente</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-5">
                        <div id="example1_info" class="dataTables_info" role="status" aria-live="polite">
                            Mostrando <span id="sfrom"></span> a <span id="sto"></span> de <span id="stotal"></span> entradas
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-md-4 ">
                            <a href="#" id="shPrev" class="">Anterior</a>
                        </div>
                        <div class="col-md-4 ">
                            Pagina: <span id="scurrentPage"></span>
                        </div>
                        <div class="col-md-4 ">
                            <a href="#" id="shNext" class="">Siguiente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<div class="modal fade in" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Vista Previa</h4>
            </div>
            <div class="modal-body">
                <object id="objectdocument" width="100%" height="600">
                    <embed id="idocument"/>
                </object>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection @section('scripts')
<script src="js/casefiles/viewCasefiles.js"></script>
@endsection