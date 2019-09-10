@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agregar Usuarios</h3>
            </div>
            <form class="form-horizontal" id="frmAddUser" method="post">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="code" class="control-label">Code</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="code" name="code" maxlength="10" class="form-control" placeholder="code">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="name" class="control-label">Nombre</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="nombre" required>
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
                                    <input type="email" id="email" name="email" class="form-control" placeholder="email" required>
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
                                    <label for="login" class="control-label">UserID</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="login" name="login" class="form-control" placeholder="login" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="keyaccess" class="control-label">Key</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="keyaccess" name="keyaccess" class="form-control" placeholder="keyaccess">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="type_level" class="control-label">Nivel</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="typeLevel" name="typeLevel" class="form-control">
                                            <option value="1">Administrador</option>
                                            <option value="2">Usuario</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="account_state" class="control-label">Estado</label>
                                </div>
                                <div class="col-md-8">
                                    <select id="accountState" name="accountState" class="form-control">
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                            <option value="3">Suspendida</option>
                                    </select>
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
<script src="js/user.js"></script>
@endsection