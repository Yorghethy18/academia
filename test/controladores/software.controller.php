<?php

require_once '../modelos/Software.php';

//Comunicación cuando es por POST
if (isset($_POST['operacion'])){
  $software = new Software();

  switch($_POST['operacion']){
    case 'listar':
      echo json_encode($software->listar());
      break;
  }
}


//Comunicación cuando es por GET

if (isset($_GET['operacion'])){
  $software = new Software();

  switch($_GET['operacion']){
    case 'listar':
      echo json_encode($software->listar());
      break;
  }
}