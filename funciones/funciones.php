<?php
/*
============================ USUARIOS ============================
*/
/* 
============================
    obtenerUsuarios() 
Regresa un paciente de la BD segun el idPaciente
Params: idPaciente
============================
*/ 
function obtenerUsuario($id){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `usuarios` WHERE idUsuario = $id ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}

/*
============================ PACIENTES ============================
*/
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
/* 
============================
    obtenerPaciente() 
Regresa un paciente de la BD segun el idPaciente
Params: idPaciente
============================
*/ 
function obtenerPaciente($id){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `pacientes` WHERE idPaciente = $id ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/*
============================ TIPO DE EXAMEN ============================
*/
/*============================
    obtenerTipoDeExamenes() 
Regresar un array con todos los tipos de examenes de la BD
Params: Ninguno.
============================
*/ 
function obtenerTipoDeExamenes(){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `tipoexamen` ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/* 
============================
    obtenerTipoDeExamen() 
Regresa un tipo de examen de la BD segun el idTipoExamen
Params: idTipoExamen
============================
*/ 
function obtenerTipoDeExamen($idTipoExamen){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT * FROM `tipoexamen` WHERE idTipoExamen = $idTipoExamen ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/*
============================ EXAMENES ============================
*/
/* 
============================
    obtenerExamenes() 
Regresar un array con todos los examenes de la BD segun el idUsuario
Params: idUsuario - Usuario del Registro en create-account.php
============================
*/ 
function obtenerExamenes($idUsuario){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT
        examenes.idExamen,
        examenes.idPacienteF,
        examenes.idTipoExamenF,
        examenes.informacionExamen,
        pacientes.nombrePaciente,
        pacientes.apellidoPaciente,
        pacientes.identificacion,
        usuarios.nombre,
        usuarios.apellido,
        tipoexamen.nombreTipoExamen 
    FROM
        examenes
        INNER JOIN pacientes ON examenes.idPacienteF = pacientes.idPaciente
        INNER JOIN usuarios ON pacientes.idUsuarioF = usuarios.idUsuario
        INNER JOIN tipoexamen ON examenes.idTipoExamenF = tipoexamen.idTipoExamen 
    WHERE
        usuarios.idUsuario = $idUsuario ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/* 
============================
    obtenerExamen() 
Regresa un examen especifico segun el idExamen
Params: idExamen - Usuario del Registro en create-account.php
============================
*/ 
function obtenerExamen($idExamen){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT
        examenes.idExamen,
        examenes.idPacienteF,
        examenes.idTipoExamenF,
        examenes.informacionExamen,
        pacientes.nombrePaciente,
        pacientes.apellidoPaciente,
        usuarios.nombre,
        usuarios.apellido,
        pacientes.edad,
        pacientes.sexo,
        pacientes.identificacion,
        tipoexamen.nombreTipoExamen,
        pacientes.email 
    FROM
        examenes
        INNER JOIN pacientes ON examenes.idPacienteF = pacientes.idPaciente
        INNER JOIN usuarios ON pacientes.idUsuarioF = usuarios.idUsuario
        INNER JOIN tipoexamen ON examenes.idTipoExamenF = tipoexamen.idTipoExamen 
    WHERE
        examenes.idExamen =  $idExamen");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/* 
============================
    obtenerCantidadDeExamenes() 
Regresar un array con la cantidad de los examenes de la BD segun el idUsuario
Params: idUsuario - Usuario del Registro en create-account.php
============================
*/ 
function obtenerCantidadDeExamenes($idUsuario){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT
        COUNT(*) AS registros
    FROM
        examenes
        INNER JOIN pacientes ON examenes.idPacienteF = pacientes.idPaciente
        INNER JOIN usuarios ON pacientes.idUsuarioF = usuarios.idUsuario 
    WHERE
        usuarios.idUsuario = $idUsuario ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/* 
============================
    obtenerCantidadDePacientes() 
Regresar un onjeto que debe ser pasado por un fetch_assoc() para usarse
Params: idUsuario - Usuario del Registro en create-account.php
============================
*/ 
function obtenerCantidadDePacientes($idUsuario){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT
        Count(*) AS registros
    FROM
        pacientes
        INNER JOIN usuarios ON pacientes.idUsuarioF = usuarios.idUsuario 
    WHERE
        usuarios.idUsuario = $idUsuario ");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}
/* 
============================
    obtenerCantidadDeTiposDeExamenes() 
Regresar un onjeto que debe ser pasado por un fetch_assoc() para usarse
============================
*/ 
function obtenerCantidadDeTiposDeExamenes(){
    include 'bd_conexion.php';
    try{
        return $conn->query("SELECT
        Count(*) AS registros
    FROM
        tipoexamen");
    }catch(Exception $e){
        echo 'Error!! '. $e->getMessage() . '<br>';
        return false;
    }
}

