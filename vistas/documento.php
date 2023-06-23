<?php
require "header.php";
?>
<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Documentos <button class="btn btn-success" id="btnagregar"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
            <div class="box-tools pull-right" id="btnright">
              <button class="btn btn-primary" onclick="listar(1)"> Ver Todo</button>
              <button class="btn btn-warning" onclick="listado()"> Tranferir y Añadir</button>
              <button class="btn btn-success" onclick="listar(2)"> Atendido</button>
              <button class="btn btn-danger" onclick="listar(3)"> Rechazado</button>
            </div>
          </div>
          <div class="panel-body table-responsive" style="height: 520px;" id="listadoRegistros">
            <div class="panel-body table-responsive" id="listadoRegistros1" style="display: none;">
              <table id="tbllistadoeditar" width="100%" class="table  table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>Emisor</th>
                  <th>Dirigido</th>
                  <th>Fecha Entrega</th>
                  <th>Fecha Documento</th>
                  <th>Dias Espera</th>
                  <th>Referente</th>
                  <th>Cambiar estado</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                  <th>Opciones</th>
                  <th>Emisor</th>
                  <th>Dirigido</th>
                  <th>Fecha de Entrega</th>
                  <th>Fecha de Documento</th>
                  <th>Días Espera</th>
                  <th>Referente</th>
                  <th>Estado</th>
                </tfoot>
              </table>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button id="btnGuardarEstados" class="btn btn-primary" style="display: none;"><i class="fa fa-save"></i>Guardar Cambios</button>
              </div>
            </div>
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
          <div class="panel-body" style="height: 510px; display: none;" id="formularioRegistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                <label>Emisor:</label>
                <input type="text" class="form-control" name="emisor" id="emisor" maxlength="50" placeholder="Quien escribio la carta?" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                <label>Dirigido:</label>
                <input type="text" class="form-control" name="dirigido" id="dirigido" maxlength="50" placeholder="A quien esta dirigida la carta?" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                <label>Fecha de Presentación:</label>
                <input type="date" class="form-control" name="fecha_presentacion" id="fecha_presentacion" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                <label>Fecha de Documento:</label>
                <input type="date" class="form-control" name="fecha_documento" id="fecha_documento" required>
              </div>
              <div class="form-group col-lg-6 col-sm-6 col-xs-12">
                <label>Referente:</label>
                <input type="text" class="form-control" name="referente" id="referente" maxlength="100" required>
              </div>
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar">
                  <i class="fa fa-save"></i>Guardar</button>
                <button class="btn btn-danger" id="btnCancelar" type="button">
                  <i class="fa fa-arrow-circle-left"></i>Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </section>

</div>
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" onclick="myModal(false)" class="close" data-dismiss="modal" aria-hidden="true">&times; </button>
        <h4 class="modal-title">Transferir Documentos</h4>
      </div>
      <form name="formulario_destino" id="formulario_destino" method="POST">
        <div class="modal-body">
          <div class="form-group col-lg-12 col-sm-12 col-xs-12">
            <input type="hidden" name="id_corr" id="id_corr">
            <input type="text" name="new_destino" id="new_destino">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" onclick="myModal(false)" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guadar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require "footer.php";
?>
<script src="../public/js/moment.min.js"></script>
<script src="../scripts/correspondencia.js"></script>