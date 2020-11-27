<?php
    @session_start();
    error_reporting(0);
	define( 'CHARSET','UTF-8' );
	header( 'Content-type: text/html; charset='.CHARSET );
    require_once 'bd_conexion.php';
    require_once 'funciones.php';
    define("PATH", "http://localhost//ProgWebUni/pacientes"); // Url de la página
?>