@extends('master') @section('content')
<section class="content">
    <div class="alert alert-success alert-dismissible" id="alertCasefile" style="display: none">
        <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Sistema</h4>
        <span id="casefileMessage"></span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Expedientes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('addCasefiles')}}" class="btn btn-primary">Agregar Expediente</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyCasefile">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form id="frmSearchCasefile">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="col-sm-6">
                                    <select class="form-control select2-container" id="srchClient" name="srchClient"></select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="search" class="form-control input-sm" id="srchDescription" name="srchDescription" placeholder="Descripcion">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="col-sm-6 text-center">
                                    <input type="submit" value="Buscar" class="btn btn-primary">
                                </div>
                                <div class="col-sm-6 text-center">
                                    <input type="button" value="Borrar Filtro" onclick="listCasefile()" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
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
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<div class="modal modal-danger fade" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensaje del Sistema</h4>
            </div>
            <div class="modal-body">
                <p>Esta seguro de borrar este expediente&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <button id="btnModalDelete" type="button" data-dismiss="modal" class="btn btn-outline">Borrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection @section('scripts')
<script src="js/casefiles/listCasefiles.js"></script>
@endsection