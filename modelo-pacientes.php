<?php
include_once 'funciones/core.php';

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
} else {
    $usuario = null;
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = null;
}
if (isset($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
} else {
    $lastname = null;
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = null;
}
if (isset($_POST['direccion'])) {
    $direccion = $_POST['direccion'];
} else {
    $direccion = null;
}
if (isset($_POST['identificacion'])) {
    $identificacion = $_POST['identificacion'];
} else {
    $identificacion = null;
}
if (isset($_POST['edad'])) {
    $edad = $_POST['edad'];
} else {
    $edad = null;
}
if (isset($_POST['exampleRadios'])) {
    $sexo = $_POST['exampleRadios'];
} else {
    $sexo = null;
}
if (isset($_POST['password'])) {
    $passwordUsuario = $_POST['password'];
} else {
    $passwordUsuario = null;
}
if (isset($_POST['repeatpassword'])) {
    $repeatpassword = $_POST['repeatpassword'];
} else {
    $repeatpassword = null;
}
if (isset($_POST['registrarusuario'])) {
    $registrarusuario = $_POST['registrarusuario'];
} else {
    $registrarusuario = null;
}

if (isset($_POST['agregar-admin'])) {
    $agregarAdmin = $_POST['agregar-admin'];
} else {
    $agregarAdmin = null;
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

// die(json_encode( $_POST ));
if ($registro == "nuevo") {

    //Insertar los datos a la BDD:
    try {
        $stmt = $conn->prepare("INSERT INTO `pacientes` (`idPaciente`, `idUsuarioF`, `email`, `nombre`, `apellido`, `identificacion`, `direccion`, `edad`, `sexo` ) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("isssssis", $idUsuario, $email, $name, $lastname, $identificacion, $direccion, $edad, $sexo );
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
            //Se activa la sesion
            // session_start();
            // $_SESSION['usuario'] = $email;
            // $_SESSION['nombre'] = $nombreAdmin;
            // $_SESSION['id'] = $id_registro;
            // header('Location:index.php');
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
        //Si el password esta vacio:
        if (empty($_POST['password'])) {
            //Entonces que no actualice el password
            $stmt = $conn->prepare("UPDATE `usuarios` SET `email` = ?, `nombre` = ?, `apellido` = ? WHERE `idUsuario` = ? ");
            $stmt->bind_param("ssi",  $email, $name, $lastname, $id_registro);
        } else {
            //Si el password tiene algo entonces actualizarla:
            $opciones = array(
                'cost' => 10
            );
            $hash_password = password_hash($passwordUsuario, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare("UPDATE `usuarios` SET `email` = ?, `nombre` = ?, `apellido` = ?, `password` = ? WHERE `idUsuario` = ? ");
            $stmt->bind_param("sssi",  $email, $name, $lastname, $hash_password, $id_registro);
        }

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
        $stmt = $conn->prepare(" DELETE FROM `usuarios` WHERE `idUsuario` = ?");
        $stmt->bind_param("i", $idBorrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'eliminado',
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
