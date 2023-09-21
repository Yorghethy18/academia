<?php

// Llamado al modelo usado
// require_once '../models/Curso.php';
// require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $curso = new Curso();
  $operacion = $_POST['operacion'];

  switch($operacion){
    case 'registrar':
      break;
    case 'listar':
      enviarJSON($curso->listar());
      break;
    case 'eliminar':
      break;
  }

}