<?php
require "header.php";
?>
<link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.css">
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title" id="titulo_estadisticas">Estadísticas por fechas</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="panel-body table-responsive">
                        <div class="panel-body" style="height: 510px;" id="formularioRegistros">
                            <form name="formulario" id="formulario" method="POST">
                                <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                                    <label>Fecha Inicio:</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                                </div>
                                <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                                    <label>Fecha Fin:</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" type="submit" id="btnGuardar">
                                        <i class="fa fa-pie-chart"></i> Generar Estadísticas</button>
                                    <span class="pull-right">Si no selecciona una fecha se generará estadisticas globales</span>
                                </div>
                            </form>
                            <div class="col-lg-12 col-sm-12 col-xs-12" id="estadisticas_totales" style="display: none;">
                                <h2 id="texto_titulo" style="text-align: center;"></h2>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group bg-blue col-lg-12 col-sm-12 col-xs-12">
                                        <h3 class="" id=num_total>Número Total: 18</h3>
                                    </div>
                                    <div class="form-group bg-green col-lg-12 col-sm-12 col-xs-12">
                                        <h3 id="num_atendido">Documentos atendidos:</h3>
                                    </div>
                                    <div class="form-group bg-red col-lg-12 col-sm-12 col-xs-12">
                                        <h3 id="num_rechazado">Documentos rechazados:</h3>
                                    </div>
                                    <div class="form-group bg-yellow col-lg-12 col-sm-12 col-xs-12">
                                        <h3 id="num_espera">Documentos en espera:</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <i class="fa fa-bar-chart-o"></i>

                                            <h3 class="box-title">Gráfico Estadístico</h3>
                                        </div>
                                        <div class="box-body">
                                            <div id="donut-chart" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php
require "footer.php";
?>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/Flot/jquery.flot.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/Flot/jquery.flot.resize.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/Flot/jquery.flot.pie.js"></script>
<script src="../public/js/moment.min.js"></script>
<script src="../scripts/estadistica_fechas.js"></script>

