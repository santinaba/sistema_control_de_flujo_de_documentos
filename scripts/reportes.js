var mes = new Array(
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre"
);
function init() {
  $("#formulario").on("submit", (e) => {
    listar(e);
  });
  $("#fecha_fin").val(fechaActual);
}
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
function listar(e) {
  e.preventDefault();
  let diaInicio = $("#fecha_inicio").val();
  let diaFin = $("#fecha_fin").val();
  let estado = $("#estado").val();
  if (diaFin >= diaInicio || diaFin == "") {
    let tabla = $("#tbllistado")
      .dataTable({
        aProcessing: true, //Activamos el procesamiento de dataTables
        aServerSide: true, //Paginacion y filtrado realizados por el servidor
        dom: "Bfrtip", //Definimos los elementos de control de la tabla
        buttons: ["pdf"],
        ajax: {
          url:
            "../ajax/documento.php?op=listadoPDF&finicio=" +
            diaInicio +
            "&ffin=" +
            diaFin +
            "&estado=" +
            estado,
          type: "get",
          dataType: "json",
          error: function (e) {
            console.log(e.responseText);
          },
        },
        bDestroy: true,
        iDisplayLength: 8, 
        order: [[4, "des"]],
      })
      .DataTable();
    $("#tbllistado").hide();
    $("#tbllistado_paginate").hide();
    $("#tbllistado_filter").hide();
    $("#generarPDF").show();

    titulos(diaInicio, diaFin);
  } else {
    bootbox.alert("La fecha es incorrecta");
    $("#generarPDF").hide();
  }
}

function titulos(diaInicio, diaFin) {
  if (diaInicio == "" && diaFin == "") {
    $("#texto_titulo").text("Estadísticas Globales");
  } else {
    if (diaInicio != "" && diaFin != "") {
      if (diaInicio != "" && diaFin != "") {
        if (diaFin == diaInicio) {
          dInicio = diaInicio.split("-");
          $("#texto_titulo").text(
            `Estadísticas del ${dInicio[2]} de ${mes[dInicio[1] - 1]}, ${
              dInicio[0]
            } `
          );
        } else {
      getTitulo(diaInicio, diaFin);
        }
    } else {
      if (diaInicio == "") {
        dIaFin = diaFin.split("-");
        $("#texto_titulo").text(
          `Estadísticas Hasta el ${dIaFin[2]} de ${mes[dIaFin[1] - 1]}, ${dIaFin[0]} `
        );
      }
      if (diaFin == "") {
        dInicio = diaInicio.split("-");
        $("#texto_titulo").text(
          `Estadísticas Desde el ${dInicio[2]} de ${mes[dInicio[1] - 1]}, ${
            dInicio[0]
          } `
        );
      }
    }
  }
}
}

function getTitulo(diaInicio, diaFin) {
  dInicio = diaInicio.split("-");
  dIaFin = diaFin.split("-");
  mesC = parseInt(dInicio[1]) - 1;
  anioC = dInicio[0];
  if (dInicio[1] == dIaFin[1] && dInicio[0] == dIaFin[0]) {
    textoTitulo = `${dInicio[2]} al ${dIaFin[2]} de ${mes[dInicio[1] - 1]},${
      dIaFin[0]
    }`;
  } else {
    if (dInicio[0] == dIaFin[0]) {
      textoTitulo = `${dInicio[2]} de ${mes[dInicio[1] - 1]} al ${dIaFin[2]} de ${
        mes[dIaFin[1] - 1]
      } , ${dIaFin[0]}`;
    } else {
      textoTitulo = `${mes[dInicio[1] - 1]} ${dInicio[2]} ${dInicio[0]} al ${
        mes[dIaFin[1] - 1]
      } ${dIaFin[2]}, ${dIaFin[0]}`;
    }
  }

  $("#texto_titulo").text("Estadísticas " + textoTitulo);
}
init()
