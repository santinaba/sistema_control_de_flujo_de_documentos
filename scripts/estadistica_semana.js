var mes = new Array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
var diaInicio,diaFin;
function init(){
 estadisticas();
 getTitulo(diaInicio,diaFin);
}
function estadisticas() {
  let nday = moment().isoWeekday()-1;
  let datec = moment().format("YYYY-MM-DD");
  let lunes;
  lunes = moment(datec).subtract(Math.abs(nday), "days");
  diaInicio = lunes.format("YYYY-MM-DD");
  diaFin = lunes.add(6, "days").format("YYYY-MM-DD");
  let vDias = vecDias(diaInicio);
  barChar1(vDias);
  barChar2(vDias);
  
}
function getTitulo(diaInicio, diaFin) {
    dInicio = diaInicio.split('-');
    dFin = diaFin.split('-');
    mesc = parseInt(dInicio[1]) - 1;
    anioc = dInicio[0];
    if (dInicio[1] == dFin[1] && dInicio[0] == dFin[0]) {
        tectoTitulo = dInicio[2] + ' al ' + dFin[2] + ' de ' + mes[dInicio[1] - 1] + ', ' + dFin[0];
    } else {
        if (dInicio[0] == dFin[0]) {
            tectoTitulo =
                dInicio[2] + ' de ' + mes[dInicio[1] - 1] + ' al ' + dFin[2] + ' de ' + mes[dFin[1] - 1] + ', ' + dFin[0];
        } else {
            tectoTitulo = mes[dInicio[1] - 1] + ' ' + dInicio[2] + ' ' + dInicio[0] + ' al ' + mes[dFin[1] - 1] + ' ' + dFin[2] + ', ' + dFin[0];
        }
    }

    $("#titulo_estadisticas").text("Estadísticas "+tectoTitulo);
}
function prevSemana() {
    diaFin = moment(diaInicio).subtract(1, "days").format("YYYY-MM-DD");
    diaInicio = moment(diaFin).subtract(6, "days").format("YYYY-MM-DD");
    getTitulo(diaInicio,diaFin);
    let vDias = vecDias(diaInicio);
    barChar1(vDias);
    barChar2(vDias);
  }
  function nextSemana() {
    diaInicio = moment(diaFin).add(1, "days").format("YYYY-MM-DD");
    diaFin = moment(diaInicio).add(6, "days").format("YYYY-MM-DD");
    getTitulo(diaInicio,diaFin);
    let vDias = vecDias(diaInicio);
    barChar1(vDias);
    barChar2(vDias);
  
  }
  function today() {
    let nday = moment().isoWeekday()-1;
    let datec = moment().format("YYYY-MM-DD");
    let lunes;
    lunes = moment(datec).subtract(Math.abs(nday), "days");
    diaInicio = lunes.format("YYYY-MM-DD");
    diaFin = lunes.add(6, "days").format("YYYY-MM-DD");
    getTitulo(diaInicio,diaFin);
    let vDias = vecDias(diaInicio);
    barChar1(vDias);
    barChar2(vDias);
  
  }
  function vecDias(dia){
      let vecDias = new Array();
      for (let i = 0; i < 7; i++) {
          let diasSemana= moment(dia).add(i, "days").format("YYYY-MM-DD");
          vecDias.push(diasSemana);  
      }
      return vecDias;
  } 
function barChar1(vDias){
    $.post("../ajax/documento.php?op=promedio_dias", {fechas:vDias},
    function (data) {
        data = JSON.parse(data);
        var bar = new Morris.Bar({
        element: 'bar-chart-1',
        resize: true,
        data: [
            {y: `${data[0].y}\n ${data[0].tot}`, a: data[0].a},
            {y: `${data[1].y}\n ${data[1].tot}`, a: data[1].a},
            {y: `${data[2].y}\n ${data[2].tot}`, a: data[2].a},
            {y: `${data[3].y}\n ${data[3].tot}`, a: data[3].a},
            {y: `${data[4].y}\n ${data[4].tot}`, a: data[4].a},
            {y: `${data[5].y}\n ${data[5].tot}`, a: data[5].a},
            {y: `${data[6].y}\n ${data[6].tot}`, a: data[6].a}
        ],
        barColors: ['#00a65a'],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Promedio'],
        hideHover: 'auto'
      });
    });
}

    


function barChar2(vDias){
$.post("../ajax/documento.php?op=atencion_dias", {fechas:vDias},
    function (data) {
        data = JSON.parse(data);
        var bar = new Morris.Bar({
            element: 'bar-chart-2',
            resize: true,
            data:[ {y: `${data[0].y}\n ${data[0].tot}`, a: data[0].a, b: data[0].b},
            {y: `${data[1].y}\n ${data[1].tot}`, a: data[1].a, b: data[1].b},
            {y: `${data[2].y}\n ${data[2].tot}`, a: data[2].a, b: data[2].b},
            {y: `${data[3].y}\n ${data[3].tot}`, a: data[3].a, b: data[3].b},
            {y: `${data[4].y}\n ${data[4].tot}`, a: data[4].a, b: data[4].b},
            {y: `${data[5].y}\n ${data[5].tot}`, a: data[5].a, b: data[5].b},
            {y: `${data[6].y}\n ${data[6].tot}`, a: data[6].a, b: data[6].b}],
            barColors: ['#00a65a', '#f56954'],
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Atendido', 'Rechazado'],
            hideHover: 'auto'
          });
    },
);
   
}



init();