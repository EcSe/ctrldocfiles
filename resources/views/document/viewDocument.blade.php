@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ver Documento</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">ID Documento:</th>
                            <td id="tid"></td>
                        </tr>
                        <tr>
                            <th>Tipo Documento</th>
                            <td id="ttipodoc"></td>
                        </tr>
                        <tr>
                            <th>Cliente:</th>
                            <td id="tcliente"></td>
                        </tr>
                        <tr>
                            <th>Codigo Documento:</th>
                            <td id="tcodigo"></td>
                        </tr>
                        <tr>
                            <th>Descripcion:</th>
                            <td id="tdescripcion"></td>
                        </tr>
                        <tr>
                            <th>Filename:</th>
                            <td id="tfilename"></td>
                        </tr>
                        <tr>
                            <th>Fecha Documento:</th>
                            <td id="tfecha"></td>
                        </tr>
                        <tr>
                            <th>Periodo Inicio:</th>
                            <td id="tperiodin"></td>
                        </tr>
                        <tr>
                            <th>Periodo Fin:</th>
                            <td id="tperiodfin"></td>
                        </tr>
                        <tr>
                            <th>Valor:</th>
                            <td id="tvalue"></td>
                        </tr>
                        <tr>
                            <th>Valor 1:</th>
                            <td id="tvalue1"></td>
                        </tr>
                        <tr>
                            <th>Documento Relacionado:</th>
                            <td id="tdocrel"></td>
                        </tr>
                        <tr>
                            <th>Lugar:</th>
                            <td id="tlugar"></td>
                        </tr>
                        <tr>
                            <th>Detalle Lugar:</th>
                            <td id="tdetallelugar"></td>
                        </tr>
                        <tr>
                            <th>Subido por:</th>
                            <td id="tuserupload"></td>
                        </tr>
                        <tr>
                            <th>Estado Documento:</th>
                            <td id="testado"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{route('listDocument')}}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Volver</a>
            </div>
            <div class="box-body">
                <object id="objectdocument" width="100%" height="600" type="application/pdf">
                    <embed id="idocument"  type="application/pdf" >
                </object>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection @section('scripts')
<script src="js/document/viewDocument.js"></script>
@endsection