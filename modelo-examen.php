<?php
include_once 'funciones/core.php';

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
} else {
    $usuario = null;
}
if (isset($_POST['idPaciente'])) {
    $idPaciente = $_POST['idPaciente'];
} else {
    $idPaciente = null;
}
if (isset($_POST['idTipoDeExamen'])) {
    $idTipoDeExamen = $_POST['idTipoDeExamen'];
} else {
    $idTipoDeExamen = null;
}
if (isset($_POST['infoExamen'])) {
    $infoExamen = $_POST['infoExamen'];
} else {
    $infoExamen = null;
}
if (isset($_POST['id_registro'])) {
    $idUsuario = $_POST['id_registro'];
} else {
    $idUsuario = null;
}
if (isset($_POST['registro'])) {
    $registro = $_POST['registro'];
} else {
    $registro = null;
}
if (isset($_POST['idExamen'])) {
    $idExamen = $_POST['idExamen'];
} else {
    $idExamen = null;
}

// die(json_encode( $_POST ));
if ($registro == "nuevo") {

    //Insertar los datos a la BDD:
    try {
        $stmt = $conn->prepare("INSERT INTO `examenes` (`idExamen`, `idPacienteF`, `idTipoExamenF`, `informacionExamen`) VALUES (NULL, ?, ?, ?);");
        $stmt->bind_param("iis", $idPaciente, $idTipoDeExamen, $infoExamen);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        //Si hubo un cambio en las filas de la BD, quiere decir que se registro el Admin correctamente.
        if ($stmt->affected_rows > 0) {
            //Creo un array llamado respuesta, la cual confirma que el registr fue todo un exito.
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            );
            // Crear el PDF
            
            // Enviar el email
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
            // header('Location:create-account.php');
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
} else  if ($registro == "actualizar") {

    try {
        $stmt = $conn->prepare("UPDATE `examenes` SET `idPacienteF` = ?, `idTipoExamenF` = ?, `informacionExamen` = ? WHERE `idExamen` = ? ");
        $stmt->bind_param("iisi",  $idPaciente, $idTipoDeExamen, $infoExamen, $idExamen);

        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'editado',
                'id_actualizado' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
} else  if ($registro == "eliminar") {

    $idBorrar = $_POST['id'];
    try{
        $stmt = $conn->prepare(" DELETE FROM `examenes` WHERE `idExamen` = ?");
        $stmt->bind_param("i", $idBorrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'eliminado-tipo-examen',
                'id_eliminado' => $idBorrar
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }

    }catch(Exception $e){
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
} 
