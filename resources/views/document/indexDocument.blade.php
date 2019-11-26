@extends('master') @section('css')
<link rel="stylesheet" href="css/loader.css"> @endsection @section('content')
<section class="content">
    <div class="lds-hourglass" style="display: none" id="divLoader"></div>
    <div class="alert alert-success alert-dismissible" id="alertIndex" style="display: none">
        <button id="btnClose" class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i>Sistema</h4>
        <span id="indexMessage"></span>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Indexar Documentos</h3>
            </div>
            <div class="box-body">
                <button id="btnIndex" name="btnIndex" onclick="indexDocument()" class="btn btn-info">Indexar Documentos</button>
            </div>
        </div>
    </div>
</section>
@endsection @section('scripts')
<script src="js/document/indexDocument.js"></script>
@endsection