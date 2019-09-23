@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Clientes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
                            </div>
                            <div class="col-sm-6">
                                <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cif</th>
                                            <th>Code</th>
                                            <th>Descripcion</th>
                                            <th>Email</th>
                                            <th>Tipo Cliente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyClient">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cif</th>
                                            <th>Code</th>
                                            <th>Descripcion</th>
                                            <th>Email</th>
                                            <th>Tipo Cliente</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form id="frmSearchClient">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="col-sm-4">
                                    <input type="search" class="form-control input-sm" id="srchCif" name="srchCif" placeholder="Cif">
                                </div>
                                <div class="col-sm-4">
                                    <input type="search" class="form-control input-sm" id="srchCode" name="srchCode" placeholder="Code">
                                </div>
                                <div class="col-sm-4">
                                    <input type="search" class="form-control input-sm" id="srchEmail" name="srchEmail" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div class="col-sm-6 text-center">
                                    <input type="submit" value="Buscar" class="btn btn-primary">
                                </div>
                                <div class="col-sm-6 text-center">
                                    <input type="button" value="Borrar Filtro" onclick="listClient()" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end form -->
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
                <p>Esta seguro de borrar este cliente&hellip;</p>
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
<script src="js/client/listClient.js"></script>
@endsection