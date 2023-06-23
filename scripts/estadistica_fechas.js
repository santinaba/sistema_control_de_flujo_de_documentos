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
    donaDatos(e);
  });
  $("#fecha_fin").val(fechaActual());
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
function donaDatos(e) {
  e.preventDefault();
  let diaInicio = $("#fecha_inicio").val();
  let diaFin = $("#fecha_fin").val();
  if (diaFin >= diaInicio || diaFin == "") {
    $.post(
      "../ajax/documento.php?op=datos_dona",
      { dinicio: diaInicio, dfin: diaFin },
      function (data) {
        data = JSON.parse(data);
        if (data[0].total != 0) {
          $("#estadisticas_totales").show();
          $("#num_total").text(`Número Total: ${data[0].total}`);
          $("#num_atendido").text(`Documentos atendidos: ${data[0].atendido}`
          );
          $("#num_rechazado").text(`Documentos rechazados: ${data[0].rechazado}`
          );
          $("#num_espera").text(`Documentos en espera: ${data[0].espera}`);
          var donutData = [
            { label: "Atendido", data: data[0].atendido, color: "#5cb85c" },
            { label: "Espera", data: data[0].espera, color: "#f0ad4e" },
            { label: "Rechazado", data: data[0].rechazado, color: "#d9534f" },
          ];
          $.plot("#donut-chart", donutData, {
            series: {
              pie: {
                show: true,
                radius: 1,
                innerRadius: 0.5,
                label: {
                  show: true,
                  radius: 2 / 3,
                  formatter: labelFormatter,
                  threshold: 0.1,
                },
              },
            },
            legend: {
              show: false,
            },
          });
          titulos(diaInicio, diaFin);
        } else {
          bootbox.alert("No se encontro Docuemento");
          $("#estadisticas_totales").hide();
        }
      }
    );
  } else {
    bootbox.alert("La fecha es incorrecta");
    $("#estadisticas_totales").hide();
  }
}

function titulos(diaInicio, diaFin) {
  if (diaInicio == "" && diaFin == "") {
    $("#texto_titulo").text("Estadísticas Globales");
  } else {
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
        dFin = diaFin.split("-");
        $("#texto_titulo").text(
          `Estadísticas Hasta el ${dFin[2]} de ${mes[dFin[1] - 1]}, ${dFin[0]} `
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

function getTitulo(diaInicio, diaFin) {
  dInicio = diaInicio.split("-");
  dFin = diaFin.split("-");
  mesc = parseInt(dInicio[1]) - 1;
  anioc = dInicio[0];
  if (dInicio[1] == dFin[1] && dInicio[0] == dFin[0]) {
    textoTitulo = `${dInicio[2]} al ${dFin[2]} de ${mes[dInicio[1] - 1]},${
      dFin[0]
    }`;
  } else {
    if (dInicio[0] == dFin[0]) {
      textoTitulo = `${dInicio[2]} de ${mes[dInicio[1] - 1]} al ${dFin[2]} de ${
        mes[dFin[1] - 1]
      } , ${dFin[0]}`;
    } else {
      textoTitulo = `${mes[dInicio[1] - 1]} ${dInicio[2]} ${dInicio[0]} al ${
        mes[dFin[1] - 1]
      } ${dFin[2]}, ${dFin[0]}`;
    }
  }

  $("#texto_titulo").text("Estadísticas " + textoTitulo);
}

function labelFormatter(label, series) {
  return (
    '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
    label +
    "<br>" +
    Math.round(series.percent) +
    "%</div>"
  );
}

init();
