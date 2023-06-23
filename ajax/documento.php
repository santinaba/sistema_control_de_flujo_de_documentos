<?php
require_once "../modelos/Documento.php";
require_once "./utilities.php";
$correspondencia = new Correspondencia();
switch ($_GET["op"]) {
    case 'guardaryeditar':
        $idcorrespondencia = isset($_POST['idcorrespondencia']) ? limpiarcadena($_POST['idcorrespondencia']) : "";
        $emisor = isset($_POST['emisor']) ? limpiarcadena($_POST['emisor']) : "";
        $dirigido = isset($_POST['dirigido']) ? limpiarcadena($_POST['dirigido']) : "";
        $fecha_presentacion = isset($_POST['fecha_presentacion']) ? limpiarcadena($_POST['fecha_presentacion']) : "";
        $fecha_documento = isset($_POST['fecha_documento']) ? limpiarcadena($_POST['fecha_documento']) : "";
        $referente = isset($_POST['referente']) ? limpiarcadena($_POST['referente']) : "";
        date_default_timezone_set("America/La_Paz");
        $date = date("H:i:s");
        $fecha_presentacion .= ' ' . $date;
        if (empty($idcorrespondencia)) {
            $rspta = $correspondencia->insertar($emisor, $dirigido, $fecha_presentacion, $fecha_documento, $referente);
            echo $rspta ? "Documento registrado" : "No se pudo registrar documento";
        }
        break;
    case 'listar':
        $data = array();
        date_default_timezone_set("America/La_Paz");
        $date = date("Y-m-d");
        $rspta = $correspondencia->listado();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => '<button class="btn btn-warning" onclick="cambiarDirigido(' . $reg->id . ')"><i class="fa fa-pencil"></i> Transferir</button>',
                "1" => $reg->emisor,
                "2" => $reg->dirigido,
                "3" => convertir_fecha(substr($reg->fecha_recibido, 0, 10)),
                "4" => convertir_fecha(substr($reg->fecha_documento, 0, 10)),
                "5" => diferencia_fechas($reg->fecha_recibido, $date),
                "6" => $reg->referente,
                "7" => cambiar_estado($reg->estado, $reg->id),
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
    case 'guardar_estados':
        $id_estados = $_POST['id_estado'];
        $val_estados = $_POST['val_estado'];
        date_default_timezone_set("America/La_Paz");
        $date = date("Y-m-d H:i:s");
        $res = $correspondencia->guardar_estados($id_estados, $val_estados, $date);
        echo $res ? "Se actualizo correctamente" : "Ocurrio un error al acttualizar";
        break;
    case 'listado':
        $opcion = isset($_GET['opt']) ? limpiarCadena($_GET['opt']) : "";
        switch ($opcion) {
            case 1:
                $rspta = $correspondencia->listar_todo();
                break;
            case 2:
                $rspta = $correspondencia->listar_atendido();
                break;
            case 3:
                $rspta = $correspondencia->listar_rechazado();
                break;
            default:
                $rspta = 0;
                break;
        }
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->emisor,
                "1" => $reg->dirigido,
                "2" => convertir_fecha(substr($reg->fecha_recibido, 0, 10)),
                "3" => convertir_fecha(substr($reg->fecha_documento, 0, 10)),
                "4" => comparar($reg->estado, $reg->fecha_modificado),
                "5" => $reg->referente,
                "6" => estado($reg->estado)
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
    case 'cambiar_destino':
        $idcorrespondencia = isset($_POST['id_corr']) ? limpiarCadena($_POST['id_corr']) : "";
        $new_destino = isset($_POST['new_destino']) ? limpiarCadena($_POST['new_destino']) : "";
        $rspta = $correspondencia->actualizar_destino($idcorrespondencia, $new_destino);
        echo $rspta ? "Destino actualizado correctamente" : "Destino no se pudo actualizar";
        break;
    case 'atencion_dias':
        $fechas = $_POST['fechas'];
        $resp = $correspondencia->grafico_capacidad(limpiarCadena($fechas[0]), limpiarCadena($fechas[6]));
        $resp_data = array();
        while ($reg = $resp->fetch_object()) {
            $resp_data[] = array(
                "modificado" => $reg->fecha_modificado,
                "estado" => $reg->estado
            );
        }
        $con = 0;
        $conacep = 0;
        $conrecha = 0;
        $tot = 0;
        $data = array();
        for ($i = 0; $i < count($fechas); $i++) {
            for ($j = 0; $j < count($resp_data); $j++) {
                if (fecha_valida(substr($resp_data[$j]['modificado'], 0, 10), $fechas[$i])) {
                    if ($resp_data[$j]['estado'] == 2) {
                        $conacep++;
                    } else {
                        $conrecha++;
                    }
                }
            }
            $tot = $conacep + $conrecha;
            array_push($data, array(
                'y' => convertir_fecha($fechas[$i]),
                "tot" => "TOT : " . $tot,
                'a' => $conacep,
                'b' => $conrecha
            ));
            $conacep = 0;
            $conrecha = 0;
        }
        echo json_encode($data);
        break;
    case 'promedio_dias':
        $fechas = $_POST['fechas'];
        $resp = $correspondencia->grafico_promedio(limpiarCadena($fechas[0]), limpiarCadena($fechas[6]));
        $resp_data = array();
        while ($reg = $resp->fetch_object()) {
            $resp_data[] = array(
                "modificado" => $reg->fecha_modificado,
                "recibido" => $reg->fecha_recibido,
            );
        }
        $n = 0;
        $con = 0;
        $tot = 0;
        $data = array();
        for ($i = 0; $i < count($fechas); $i++) {
            for ($j = 0; $j < count($resp_data); $j++) {
                if (fecha_valida(substr($resp_data[$j]['modificado'], 0, 10), $fechas[$i])) {
                    $con = $con + diferencia_dias(substr($resp_data[$j]['modificado'], 0, 10), substr($resp_data[$j]['recibido'], 0, 10));
                    $n++;
                }
            }
            if ($n == 0) {
                $tot = $con / 1;
            } else {
                $tot = $con / $n;
            }
            array_push($data, array(
                'y' => convertir_fecha($fechas[$i]),
                "tot" => "TOT : " . $n,
                'a' => round($tot),
            ));
            $n = 0;
            $con = 0;
        }
        echo json_encode($data);
        break;
    case 'datos_dona':
        $f_inicio = isset($_POST['dinicio']) ? limpiarCadena($_POST['dinicio']) : "";
        $f_fin = isset($_POST['dfin']) ? limpiarCadena($_POST['dfin']) : "";
        $data = array();
        $cadena = generar_cadena($f_inicio, $f_fin);
        $rspta = $correspondencia->datos_dona($cadena);
        $data[] = array(
            "total" => $rspta['atendido'] + $rspta['espera'] + $rspta['rechazado'],
            "atendido" => $rspta['atendido'],
            "espera" => $rspta['espera'],
            "rechazado" => $rspta['rechazado']
        );
        echo json_encode($data);
        break;
    case 'listadoPDF':
        $f_inicio = isset($_GET['finicio']) ? limpiarCadena($_GET['finicio']) : "";
        $f_fin = isset($_GET['ffin']) ? limpiarCadena($_GET['ffin']) : "";
        $estado = isset($_GET['estado']) ? limpiarCadena($_GET['estado']) : "";
        $cadena = generar_cadena($f_inicio, $f_fin, $estado);
        $rspta = $correspondencia->generarPDF($cadena);
        $data = array();
        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->emisor,
                "1" => $reg->dirigido,
                "2" => convertir_fecha(substr($reg->fecha_recibido, 0, 10)),
                "3" => convertir_fecha(substr($reg->fecha_documento, 0, 10)),
                "4" => comparar($reg->estado, $reg->fecha_modificado),
                "5" => $reg->referente,
                "6" => estado($reg->estado)
            );
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
}
