<?php

require_once '../models/Alumno.php';
require_once '../models/Funciones.php';

if(isset($_POST['operacion'])){
  $alumno = new Alumno();
  $operacion = $_POST['operacion'];

  switch ($operacion) {
    case 'registrar':
      $datosEnviar = [
        "apellidos"   => $_POST["apellidos"],
        "nombres"     => $_POST["nombres"],
        "fechanac"    => $_POST["fechanac"],
        "numerodoc"   => $_POST["numerodoc"],
        "telefono"    => $_POST["telefono"]
      ];
      $alumno->registrar($datosEnviar);
      break;
    case 'listar':
      enviarJSON($alumno->listar());
      break;

    case 'eliminar':
      $alumno->eliminar(["idalumno" => $_POST["idalumno"]]);
      break;
    case 'buscarDatos':
      $resultado = $alumno->buscarDatos(["numerodoc" => $_POST["numerodoc"]]);
      enviarJSON($resultado);
      break;
  }
}
?>