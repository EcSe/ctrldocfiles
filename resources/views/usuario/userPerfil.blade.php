@extends('master') @section('content')
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img id="imgProfile" class="profile-user-img img-responsive img-circle" src="" alt="User profile picture">

                    <h3 id="hName" class="profile-username text-center"></h3>

                    <p id="pDescription" class="text-muted text-center"></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Documentos Subidos</b> <a class="pull-right"><span id="spDocumentsUpload"></span></a>
                        </li>
                        <li class="list-group-item">
                            <b>Expedientes Abiertos</b> <a class="pull-right"><span id="spCasefilesOpen"></span></a>
                        </li>
                        <li class="list-group-item">
                            <b>Expedientes Cerrados</b> <a class="pull-right"><span id="spCasefilesClosed"></span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="alert alert-success alert-dismissible" id="alertUserProfile" style="display: none">
                <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i>Sistema</h4>
                <span id="userProfileMessage"></span>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Informacion</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                        <form id="frmUserProfile" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Descripcion</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" placeholder="Descripcion"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="idUser" class="col-sm-2 control-label">Id Usuario</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="idUser" placeholder="idUser" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
@endsection @section('scripts')
<script>
    let user = @json($user);
</script>
<script src="js/user/perfilUser.js"></script>
@endsection