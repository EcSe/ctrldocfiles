@extends('master') @section('content')
<section class="content">
    <div class="alert alert-success alert-dismissible" id="alertCasefile" style="display: none">
        <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Sistema</h4>
        <span id="casefileMessage"></span>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Agregar Expediente</h3>
            </div>
            <form class="form-horizontal" id="frmAddCasefile" method="post">
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
                    <input type="submit" value="Agregar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection @section('scripts')
<script src="js/casefiles/addCasefiles.js"></script>
@endsection