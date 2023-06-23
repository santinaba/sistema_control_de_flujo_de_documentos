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
            <h1 class="box-title" id="titulo_estadisticas"></h1>
            <div class="box-tools pull-right">
                <button type="button" onclick="prevSemana()" class="btn btn-primary" >Anterior</button>
                <button type="button" onclick="today()" class="btn btn-primary" >Hoy</button>
                <button type="button" onclick="nextSemana()" class="btn btn-primary" >Siguiente</button>
            </div>
          </div>
          <div class="panel-body table-responsive" >
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Tiempo de atencion promedio (días)</h3>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart-1" style="height: 300px;"></div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Documentos atendidos por días</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart-2" style="height: 300px;"></div>
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
<script src="../public/plugins/chartjs/Chart.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/morris.js/morris.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../public/js/moment.min.js"></script>
<script src="../scripts/estadistica_semana.js"></script>