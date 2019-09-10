@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Usuarios</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Code</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
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
                <p>Esta seguro de borrar este usuario&hellip;</p>
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
<script src="js/user/listUser.js"></script>
@endsection