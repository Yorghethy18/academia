<?php
session_start();
require_once '../models/Usuario.php';

$_SESSION['acceso'] = [];

if (isset($_POST['operacion'])){

    //$_POST[] - $_GET[] representan datos que vienen desde la VISTA (FETCH)
    $usuario = new Usuario();

    //Array contiene la información sobre el estado del INICIO DE SESIÓN
    $status = [
        "login"     => false,
        "mensaje"   => ""
    ];

    switch($_POST['operacion']){
        case 'login':
            //NO olvidar que datos es un arreglo asociativo
            $datos = $usuario->login(['usuario' => $_POST['usuario']]);
            
            //Si no existe el usuario (SPU no retorna nada, vacío)
            if (!$datos){
                $status["login"] = false;
                $status["mensaje"] = "El usuario NO existe";
            }else{
                //No cantemos victoria, falta verificar la clave
                //$_POST['claveacceso'];    //El usuario escribió esta clave en FORM
                if (password_verify($_POST['claveacceso'], $datos["clave"])){
                    $status["login"] = true;
                    $status["mensaje"] = "Bienvenido al sistema";
                }else{
                    $status["login"] = false;
                    $status["mensaje"] = "Error en la contraseña";
                }
            }

            //Guardar el arreglo "STATUS" en la variable de sesión
            //¿Por qué?
            //Porque queremos que todas las páginas de nuestro sitio sepan/enteren si la sesión se dió correctamente
            $_SESSION['acceso'] = $status;

            //Enviando el resultado a la vista
            echo json_encode($status);
            break;
    }

}

if (isset($_GET['operacion'])){
    switch($_GET['operacion']){
        case 'destroy':
            session_destroy();
            session_unset();
            header("Location:../");
            break;
    }
}