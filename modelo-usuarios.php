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
    $id_registro = $_POST['id_registro'];
} else {
    $id_registro = null;
}
if (isset($_POST['registro'])) {
    $registro = $_POST['registro'];
} else {
    $registro = null;
}

// die(json_encode( $registro ));
if ($registro == "nuevo") {

    //Mientras mas grande sea el costo de un hash, mayor será la dificultar de descubrir la contraseña
    //Entre mayor sea el costo, mayor carga tendrá el servidor, es decir será más pesado.
    $opciones = array(
        'cost' => 10
    );
    //Convertira la contraseña en un string de 60 caracteres
    $passwordHasehd = password_hash($passwordUsuario, PASSWORD_BCRYPT, $opciones);
    //Insertar los datos a la BDD:
    try {
        $stmt = $conn->prepare("INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `nombre`, `apellido`) VALUES (NULL,  ?,  ?, ?, ?);");
        $stmt->bind_param("ssss",  $email, $passwordHasehd, $name, $lastname);
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
            $stmt->bind_param("sssi",  $email, $name, $lastname, $id_registro);
        } else {
            //Si el password tiene algo entonces actualizarla:
            $opciones = array(
                'cost' => 10
            );
            $hash_password = password_hash($passwordUsuario, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare("UPDATE `usuarios` SET `email` = ?, `nombre` = ?, `apellido` = ?, `password` = ? WHERE `idUsuario` = ? ");
            $stmt->bind_param("ssssi",  $email, $name, $lastname, $hash_password, $id_registro);
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
} else  if ($registro == "login"){
        //Insertar los datos a la BDD:
        try {
            $stmt = $conn->prepare(" SELECT * FROM usuarios WHERE email = ? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            //Bind Param nos regresa todos los datos devueltos por la BDD guardandolas segun el orden definido en la BDD:
            $stmt->bind_result($idUsuario, $email, $password, $nombre, $apellido);
            //Si hubo un cambio en las filas de la BD, quiere decir que se registro el Admin correctamente. 
            if ($stmt->affected_rows) {
                $existe = $stmt->fetch();
                if ($existe) {
                    //Convierte el password ingresado a hash y despues lo compara con el de la BDD.
                    //print(password_verify($passwordUsuario, $passwordUsuario));
                    if (password_verify($passwordUsuario, $password)) {
                        $respuesta = array(
                            'respuesta' => 'exitoso',
                            'adm' => $email,
                            'nombre'=> $nombre
                        );
                        //Se activa la sesion
                        session_start();
                        $_SESSION['usuario'] = $email;
                        $_SESSION['nombre'] = $nombre;
                        $_SESSION['id'] = $idUsuario;
                        //print($_SESSION['nombre']);
                        //Se le llevara a:
                        // header('Location:adm/escoger-libro-adm.php');
                    } else {
                        //Entonces el password no es correcto:
                        $respuesta = array(
                            'respuesta' => 'adm_si_existe_pero_password_incorrecto'
                        );
                    }
                } else {
                    $respuesta = array(
                        'respuesta' => 'adm_no_existe'
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'adm_no_existe'
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
}
