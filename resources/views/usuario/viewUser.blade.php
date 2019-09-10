@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ver Usuario</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID User:</th>
                            <td id="tid"></td>
                        </tr>
                        <tr>
                            <th>Codigo</th>
                            <td id="tcodigo"></td>
                        </tr>
                        <tr>
                            <th>Nombre:</th>
                            <td id="tnombre"></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td id="temail"></td>
                        </tr>
                        <tr>
                            <th>Descripcion:</th>
                            <td id="tdescripcion"></td>
                        </tr>
                        <tr>
                            <th>Login:</th>
                            <td id="tlogin"></td>
                        </tr>
                        <tr>
                            <th>Nivel:</th>
                            <td id="tnivel"></td>
                        </tr>
                        <tr>
                            <th>Estado de la cuenta:</th>
                            <td id="testado"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('listUser')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection @section('scripts') 
<script src="js/user/viewUser.js"></script>
@endsection