<?php
function diferencia_fechas($fecha, $date)
{
    $date1 = new DateTime($date);
    $date2 = new DateTime($fecha);
    $diff = $date1->diff($date2);
    if ($diff->days < 3) {
        $result = '<span class="label bg-green">' . $diff->days . ' Días</span>';
    }
    if ($diff->days >= 3) {
        $result = '<span class="label bg-yellow">' . $diff->days . ' Días</span>';
    }
    if ($diff->days >= 7) {
        $result = '<span class="label bg-red">' . $diff->days . ' Días</span>';
    }
    return $result;
}
function cambiar_estado($estado, $id)
{
    $cadena = '<select name="cambio_estado" >';
    $estados = array('Espera', 'Atendido', 'Rechazado');
    for ($i = 1; $i <= 3; $i++) {
        if ($i == $estado) {
            $cadena .= '<option value="' . $i . '-' . $id . '" checked >' . $estados[$i - 1] . '</option>';
        } else {
            $cadena .= '<option value="' . $i . '-' . $id . '">' . $estados[$i - 1] . '</option>';
        }
    }
    $cadena .= '</option>';
    return $cadena;
}

function comparar($estados, $fecha_modificado)
{
    if ($estados == 1) {
        $cadena =  'No revisado aún';
    } else {
        $cadena =  substr($fecha_modificado, 0, 10);
    }
    return $cadena;
}
function estado($indice)
{
    $result = "";
    $estado = array('Espera', 'Atendido', 'Rechazado');
    if ($indice == 1) {
        $result = '<span class="label bg-yellow">' . $estado[$indice - 1] . '</span>';
    }
    if ($indice == 2) {
        $result = '<span class="label bg-green">' . $estado[$indice - 1] . '</span>';
    }
    if ($indice == 3) {
        $result = '<span class="label bg-red">' . $estado[$indice - 1] . '</span>';
    }
    return $result;
}
function convertir_fecha($fecha)
{
    $fechas = explode("-", $fecha);
    return $fechas[2] . '/' . $fechas[1] . '/' . $fechas[0];
}
function fecha_valida($fecha, $date)
{
    $date1 = new DateTime($date);
    $date2 = new DateTime($fecha);
    $diff = $date1->diff($date2);
    if ($diff->days == 0) {
        return true;
    } else {
        return false;
    }
}
function diferencia_dias($fecha, $date)
{
    $date1 = new DateTime($date);
    $date2 = new DateTime($fecha);
    $diff = $date1->diff($date2);
    return $diff->days;
}
function generar_cadena($f_inicio, $f_fin, $estado = "")
{

    $cadena = "WHERE";
    if (!($f_inicio == $f_fin)) {// Verifica que las fechas no sean iguales
        if (!empty($f_inicio) && !empty($f_fin)) { // Verifica que las fechas no son nulas
            $cadena .= " DATE(fecha_recibido) >=  '$f_inicio'  AND  DATE(fecha_recibido) <='$f_fin'";
            if ($estado != "") {
                $cadena .= "AND estado = $estado";
            }
        } else {
            if ($f_inicio == "") {// Verifica cual fecha esta vacia
                $cadena .= " DATE(fecha_recibido) <= '$f_fin'";
            }
            if ($f_fin == "") {
                $cadena .= " DATE(fecha_recibido) >= '$f_inicio'";
            }
            if (!empty($estado)) {
                $cadena .= "AND estado =$estado";
            }
        }
    } else {
        if ($f_inicio == $f_fin) {//verifica que las fechas sean iguales
            $cadena .= " DATE(fecha_recibido) =  '$f_inicio'";
            if ($estado != "") {
                $cadena .= "AND estado = $estado";
            }
        } else {
            $cadena = "";
        }
    }
    return $cadena;
}
