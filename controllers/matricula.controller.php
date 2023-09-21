<?php

require_once '../models/Matricula.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $matricula = new Matricula();
  $operacion = $_POST['operacion'];

  switch($operacion){
    case 'registrar':
      $datosEnviados = [
        "idcurso"       => $_POST['idcurso'],
        "idalumno"      => $_POST['idalumno'],
        "turno"         => $_POST['turno'],
        "observaciones" => $_POST['observaciones']
      ];
      $matricula->registrar($datosEnviados);
      break;
    case 'listar':
      enviarJSON($matricula->listar());
      break;
    case 'curso':
      enviarJSON($matricula->curso());
      break;
    case 'eliminar':
      $matricula->eliminar(["idmatricula" => $_POST["idmatricula"]]);
      break;
  }

}