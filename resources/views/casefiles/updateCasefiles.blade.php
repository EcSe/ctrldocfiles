@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Expediente</h3>
            </div>
            <form class="form-horizontal" id="frmUpdateCasefile" method="post">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="code" class="control-label">Cliente</label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="id_client" name="id_client" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="name" class="control-label">Tipo</label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="id_type" name="id_type" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="login" class="control-label">Descripcion</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="description" name="description" class="form-control" placeholder="Descripcion" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="password" class="control-label">Estado</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="casefile_state" name="casefile_state" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center">
                <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <a href="{{route('listCasefiles')}}" id="back" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
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
<div class="modal modal-success fade" id="modal-success">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mensaje</h4>
            </div>
            <div class="modal-body">
                <p id="casefileMessage">One find body&hellip;</p>
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
<script src="js/casefiles/updateCasefiles.js"></script>
@endsection