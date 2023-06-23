<?php
require "../config/conexion.php";
class Correspondencia
{
    public function __construct(){}
    public function insertar($emisor, $dirigido, $fecha_presentacion, $fecha_documento, $referente)
    {
        $sql = "INSERT INTO correspondencia (emisor,dirigido,fecha_recibido,fecha_modificado,estado,fecha_documento,referente)
        VALUES ('$emisor', '$dirigido', '$fecha_presentacion','$fecha_presentacion',1,'$fecha_documento','$referente')";
        return ejecutarConsulta($sql);
    }
    public function guardar_estados($id_estados, $val_estados, $date)
    {
        $sw = true;
        for ($i = 0; $i < count($id_estados); $i++) {
            $id = isset($id_estados[$i]) ? limpiarCadena($id_estados[$i]) : "";
            $val = isset($val_estados[$i]) ? limpiarCadena($val_estados[$i]) : "";
            $sql = "UPDATE correspondencia SET estado=$val, fecha_modificado= '$date'
           WHERE id=$id";
            ejecutarConsulta($sql) or $sw = false;
        }
        return $sw;
    }
    public function listar_todo()
    {
        $sql = "SELECT * FROM correspondencia ORDER BY fecha_recibido DESC";
        return ejecutarConsulta($sql);
    }
    public function listar_atendido()
    {
        $sql = "SELECT * FROM correspondencia WHERE estado=2 ORDER BY fecha_modificado DESC";
        return ejecutarConsulta($sql);
    }
    public function listar_rechazado()
    {
        $sql = "SELECT * FROM correspondencia WHERE estado=3 ORDER BY fecha_modificado DESC";
        return ejecutarConsulta($sql);
    }
    public function listado()
    {
        $sql = "SELECT * FROM correspondencia WHERE estado=1 ORDER BY fecha_recibido DESC";
        return ejecutarConsulta($sql);
    }
    public function actualizar_destino($id, $new_dest)
    {
        $sql = "UPDATE correspondencia SET dirigido='$new_dest' WHERE id=$id";
        return ejecutarConsulta($sql);
    }   
    public function grafico_capacidad($diainicio, $diafin)
    {
        $sql = "SELECT fecha_modificado,estado FROM correspondencia WHERE (estado BETWEEN 2 AND 3) AND (fecha_modificado BETWEEN '$diainicio' AND '$diafin')";
        return ejecutarConsulta($sql);
    }
    public function grafico_promedio($diainicio, $diafin)
    {
        $sql = "SELECT fecha_recibido,fecha_modificado FROM correspondencia WHERE (estado BETWEEN 2 AND 3) AND (fecha_recibido BETWEEN '$diainicio' AND '$diafin')";
        return ejecutarConsulta($sql);
    }
    public function datos_dona($cadena)
    {
        $sql = "SELECT SUM(case when estado = 1 then 1 else 0 end) as espera, SUM(case when estado = 2 then 1 else 0 end) as atendido, SUM(case when estado = 3 then 1 else 0 end) as rechazado FROM correspondencia ".$cadena;
        return ejecutarConsultaSimpleFila($sql);
    }
    public function generarPDF($cadena)
    {
        $sql = "SELECT * FROM correspondencia ".$cadena;
        return ejecutarConsulta($sql);
    }
}