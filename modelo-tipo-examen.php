<?php
include_once 'funciones/core.php';

if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = null;
}
if (isset($_POST['id_registro'])) {
    $idTipoExamen = $_POST['id_registro'];
} else {
    $idTipoExamen = null;
}
if (isset($_POST['registro'])) {
    $registro = $_POST['registro'];
} else {
    $registro = null;
}
if (isset($_POST['infoExamen'])) {
    $infoExamen = $_POST['infoExamen'];
} else {
    $infoExamen = null;
}

// die(json_encode( $_POST ));
if ($registro == "nuevo") {

    //Insertar los datos a la BDD:
    try {
        $stmt = $conn->prepare("INSERT INTO `tipoexamen` (`idTipoExamen`, `nombreTipoExamen`) VALUES (NULL, ?);");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $id_registro = $stmt->insert_id;
        //Si hubo un cambio en las filas de la BD, quiere decir que se registro el Admin correctamente.
        if ($stmt->affected_rows > 0) {
            //Creo un array llamado respuesta, la cual confirma que el registr fue todo un exito.
            $respuesta = array(
                'respuesta' => 'exito',
                'nombre' => $name,
                'id_admin' => $id_registro
            );
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
        $stmt = $conn->prepare("UPDATE `tipoexamen` SET `nombreTipoExamen` = ? WHERE `idTipoExamen` = ? ");
        $stmt->bind_param("si",  $infoExamen, $idTipoExamen );

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
        $stmt = $conn->prepare(" DELETE FROM `tipoexamen` WHERE `idTipoExamen` = ?");
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
