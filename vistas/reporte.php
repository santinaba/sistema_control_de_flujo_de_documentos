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
            <h1 class="box-title" id="texto_titulo">Generar PDF's</h1>
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
                <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                  <label>Estado:</label><br>
                  <select name="estado" id="estado">
                    <option value="" selected>Todo</option>
                    <option value="1">Espera</option>
                    <option value="2">Atendido</option>
                    <option value="3">Rechazado</option>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <button class="btn btn-primary" type="submit" id="btnGuardar">
                     Generar PDF</button>
                </div>
              </form>
              <div class="col-lg-12 col-sm-12 col-xs-12" id="generarPDF" style="display: none;">
              <div class="panel-body table-responsive" id="listadoRegistros2">
              <table id="tbllistado" width="100%" class="table  table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Emisor</th>
                  <th>Dirigido</th>
                  <th>Fecha Entrega</th>
                  <th>Fecha Documento</th>
                  <th>Fecha modificado</th>
                  <th>Referente</th>
                  <th>Estado</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Emisor</th>
                  <th>Dirigido</th>
                  <th>Fecha de Entrega</th>
                  <th>Fecha de Documento</th>
                  <th>Fecha modificado</th>
                  <th>Referente</th>
                  <th>Estado</th>
                </tfoot>
              </table>
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
<script src="../public/js/moment.min.js"></script>
<script src="../scripts/reportes.js"></script>