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
                            <th style="width:50%">ID Client:</th>
                            <td id="tid"></td>
                        </tr>
                        <tr>
                            <th>Cif</th>
                            <td id="tcif"></td>
                        </tr>
                        <tr>
                            <th>Codigo:</th>
                            <td id="tcodigo"></td>
                        </tr>
                        <tr>
                            <th>Descripcion:</th>
                            <td id="tdescripcion"></td>
                        </tr>
                        <tr>
                            <th>Direccion:</th>
                            <td id="tdireccion"></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td id="temail"></td>
                        </tr>
                        <tr>
                            <th>Telefono:</th>
                            <td id="ttelefono"></td>
                        </tr>
                        <tr>
                            <th>Notas:</th>
                            <td id="tnotas"></td>
                        </tr>
                        <tr>
                            <th>Tipo Cliente:</th>
                            <td id="ttipocliente"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('listClient')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection @section('scripts')
<script src="js/client/viewClient.js"></script>
@endsection