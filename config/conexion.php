<?php
require_once "global.php";

$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

if(mysqli_connect_errno()){
    printf("Fallo en la conexion a base de datos: %s\n",mysqli_connect_error());
    exit();
}

if(!function_exists('ejecutarConsulta')){
    function ejecutarConsulta($sql){
        global $conexion;
        $query = $conexion->query($sql);
        if(!$query){
			printf("Errormessage: %s\n", $conexion->error ."\nLa consulta fue:\n ".$sql);
			exit;
		}
        return $query;
    }

    function ejecutarConsultaSimpleFila($sql){
        global $conexion;
        $query = $conexion->query($sql);
        if(!$query){
			printf("Errormessage: %s\n", $conexion->error ."\nLa consulta fue:\n ".$sql);
			exit;
		}
        $row = $query->fetch_assoc();
        return $row;
    }

    function ejecutarConsulta_retornarID($sql){
        global $conexion;
        $query = $conexion->query($sql);
        if(!$query){
			printf("Errormessage: %s\n", $conexion->error ."\nLa consulta fue:\n ".$sql);
			exit;
		}
        return $conexion->insert_id; 
    }

    function limpiarCadena($str){
        global $conexion;
        $str = mysqli_real_escape_string($conexion, trim($str));
        return htmlspecialchars($str);
    }
}

?>