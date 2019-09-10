@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Cliente</h3>
            </div>
            <form class="form-horizontal" id="frmUpdateClient" method="post">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="cif" class="control-label">Cif</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="cif" name="cif" maxlength="15" class="form-control" placeholder="Cif" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="code" class="control-label">Codigo</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="code" name="code" maxlength="15" class="form-control" placeholder="Codigo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="description" class="control-label">Descripcion</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="description" maxlength="15" name="description" class="form-control" placeholder="Descripcion" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="address" class="control-label">Direccion</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="address" name="address" maxlength="15" class="form-control" placeholder="Direccion">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="email" class="control-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" id="email" name="email" maxlength="50" class="form-control" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="phone" class="control-label">Telefono</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="phone" name="phone" maxlength="50" class="form-control" placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="notes" class="control-label">Notas</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="notes" name="notes" maxlength="50" class="form-control" placeholder="Notas">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="type_client" class="control-label">Tipo Cliente</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="type_client" name="type_client" class="form-control" required>
                                            <option value="1">Empresa Unipersonal</option>
                                            <option value="2">Empresa Individual de Responsabilidad Limitada (E.I.R.L.)</option>
                                            <option value="3">Sociedad Anónima (S.A.)</option>
                                            <option value="4">Sociedad Anónima Abierta (S.A.A.)</option>
                                            <option value="5">Sociedad Anónima Cerrada (S.A.C.)</option>
                                            <option value="6">Sociedad Comercial de Responsabilidad Limitada (S.R.L.)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-4">
                                <a href="{{route('listClient')}}" id="back" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
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
                <p id="clientMessage">One find body&hellip;</p>
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
<script src="js/client/updateClient.js"></script>
@endsection