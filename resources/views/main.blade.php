@extends('master') @section('content')
<section class="content">
    <div class="row">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Expedientes por Cliente</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="casefile-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="row">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Documentos por Cliente</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="document-chart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3 id="hcasefileOpen"></h3>

                    <p>Expedientes Abiertos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="{{route('listCasefiles')}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3 id="hcasefileClose"></h3>

                    <p>Expedientes Cerrados</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <a href="{{route('listCasefiles')}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3 id="nroUsers"></h3>

                    <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('listUser')}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3 id="hEspacioDisco">></h3>

                    <p>Espacio Consulta</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="{{route('listCasefiles')}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <h3 id="hEspacioOcupado"></h3>

                    <p>Expedientes</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
                <a href="{{route('listCasefiles')}}" class="small-box-footer">Info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

</section>
@endsection @section('scripts')
<script type="text/javascript" src="js/main/main.js"></script>
@endsection