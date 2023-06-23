"use strict";
var idEstado = Array();
var valEstado = Array();
var num = 1;

function init() {
  listar(num);
  $("#formulario").on("submit", (e) => {
    guardarForm(e);
  });
  $("#formulario_destino").on("submit", (e) => {
    guardarDestino(e);
  });
}

$("#btnagregar").click(mostrarForm);
$("#btnCancelar").click(cancelarForm);
$("#btnGuardar").click(guardarForm);
$("#tbllistadoeditar").change(agregarEstado);
$("#btnGuardarEstados").click(guardarEstado);

function fechaActual() {
  let date = new Date();
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let year = date.getFullYear();

  if (month < 10) {
    month = `0${month}`;
  }
  if (day < 10) {
    day = `0${day}`;
  }
  return `${year}-${month}-${day}`;
}

function cancelarForm() {
  $("#formulario")[0].reset();
  $("#formularioRegistros").hide();
  $("#listadoRegistros").show();
  $("#btnagregar").show();
  $("#btnright").show();
}
function mostrarForm() {
  $("#listadoRegistros").hide();
  $("#btnagregar").hide();
  $("#btnright").hide();
  $("#fecha_presentacion").attr("value", fechaActual());
  $("#fecha_documento").attr("value", fechaActual());
  $("#formularioRegistros").show();
}
function myModal(flag) {
  if (flag) {
    $("#myModal").modal("show");
  } else {
    $("#myModal").modal("hide");
    $("#formulario_destino")[0].reset();
  }
}

function guardarForm(e) {
  e.preventDefault();
  let fecha1 = $("#fecha_presentacion").val();
  let fecha2 = $("#fecha_documento").val();

  if (validarFechas(fecha1, fecha2)) {
    if (camposVacios()) {
      let data = $("#formulario").serialize();
      $.post("../ajax/documento.php?op=guardaryeditar", data, function (
        data
      ) {
        bootbox.alert(data);
        cancelarForm();
        listar(num);
      });
    } else {
      bootbox.alert("Campos incompletos");
    }
  } else {
    bootbox.alert("Fecha de documento no valida");
  }
}

function guardarDestino(e) {
  e.preventDefault();
  let valor = $("#new_destino").val();
  if (valor != "") {
    let data = $("#formulario_destino").serialize();
    $.post("../ajax/documento.php?op=cambiar_destino", data, function (
      data
    ) {
      myModal(false);
      bootbox.alert(data);
      listar(num);
    });
  }
}
function listar(opt) {
  if (opt < 1 || opt > 3) {
    num = 1;
  } else {
    num = opt;
  }
  $("#listadoRegistros1").hide();
  $("#listadoRegistros2").show();
  let tabla = $("#tbllistado")
    .dataTable({
      aProcessing: true, //Activamos el procesamiento de dataTables
      aServerSide: true, //Paginacion y filtrado realizados por el servidor
      dom: "Bfrtip", //Definimos los elementos de control de la tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "../ajax/documento.php?op=listado&opt=" + num,
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      iDisplayLength: 8, //Paginacion
      order: [[4, "des"]],
    })
    .DataTable();
}

function agregarEstado(e) {
  e.preventDefault();
  let estados = e.target.value.split("-");
  let indice = idEstado.indexOf(estados[1]);
  if (indice == -1) {
    idEstado.push(estados[1]);
    valEstado.push(estados[0]);
  } else {
    if (estados[0] == 1) {
      idEstado.splice(indice, 1);
      valEstado.splice(indice, 1);
    } else {
      val_estado[indice] = estados[0];
    }
  }
  if (idEstado.length > 0) {
    $("#btnGuardarEstados").show();
  } else {
    $("#btnGuardarEstados").hide();
  }

}
function guardarEstado() {
  $.post(
    "../ajax/documento.php?op=guardar_estados",
    { id_estado: idEstado, val_estado: valEstado },
    function (data) {
      bootbox.alert(data);
      idEstado = [];
      valEstado = [];
      $("#btnGuardarEstados").hide();
      listar(num);
    }
  );
}
function cambiarDirigido(id) {
  $("#id_corr").attr("value", id);
  myModal(true);
}

function validarFechas(fecha1, fecha2) {
  fecha1 = moment23541 (fecha1);
  fecha2 = moment(fecha2);
  if (fecha1 >= fecha2) {
    return true;
  } else {
    return false;
  }
}
function camposVacios() {
  let flag = true;
  if ($("#emisor").val() == "") flag = false;
  if ($("#dirigido").val() == "") flag = false;
  if ($("#referente").val() == "") flag = false;

  return flag;
}

function listado() {
  $("#listadoRegistros2").hide()
  $("#listadoRegistros1").show()
  let tabla = $("#tbllistadoeditar")
    .dataTable({
      aProcessing: true, //Activamos el procesamiento de dataTables
      aServerSide: true, //Paginacion y filtrado realizados por el servidor
      dom: "Bfrtip", //Definimos los elementos de control de la tabla
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdf"],
      ajax: {
        url: "../ajax/documento.php?op=listar",
        type: "get",
        dataType: "json",
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      iDisplayLength: 8, //Paginacion
      order: [[2, "asc"]],
    })
    .DataTable();
}

init();
