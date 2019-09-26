@extends('master') @section('content')
<section class="content">
    <div class="alert alert-success alert-dismissible" id="alertUserUpdate" style="display: none">
        <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Sistema</h4>
        <span id="userMessageUpdate"></span>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editar Usuarios</h3>
            </div>
            <form class="form-horizontal" id="frmUpdateUser" method="post" enctype="multipart/form-data">
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
                                <a href="{{route('listUser')}}" id="back" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
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
<script src="js/user/updateUser.js"></script>
@endsection