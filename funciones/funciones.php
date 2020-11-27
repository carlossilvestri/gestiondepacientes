<?php

/* 
============================
    obtenerPacientes() 
Regresar un array con todos los pacientes de la BD de los pacientes segun el idUsuarioF
Params: idUsuarioF - Usuario del Registro en create-account.php
============================
*/ 
function obtenerPacientes($idUsuarioF){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `pacientes` WHERE `idUsuarioF` = $idUsuarioF ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
//Obtiene un Paciente  toma un id
function obtenerPaciente($id){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `pacientes` WHERE idPaciente = $id ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
