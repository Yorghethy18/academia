<?php

require_once '../models/Curso.php';
require_once '../models/Funciones.php';

if (isset($_POST['operacion'])){

  $curso = new Curso();
  $operacion = $_POST['operacion'];

  switch($operacion){
    case 'registrar':
      //Necesitamos recibir los valores que se nos envía desde el front, estos
      //se almacenarán en un arreglo asociativo que luego enviaremos al método
      $datosEnviar = [
        "nombrecurso"   => $_POST["nombrecurso"],
        "costo"         => $_POST["costo"],
        "nivel"         => $_POST["nivel"]
      ];
      //Enviando datos al método
      $curso->registrar($datosEnviar);
      break;
    case 'listar':
      enviarJSON($curso->listar());
      break;
    case 'eliminar':
      //El método recibe el ID, en un arrreglo asociativo
      //No olvidar que $_POST[''] es todo lo que nos envía el front
      $curso->eliminar(["idcurso" => $_POST["idcurso"]]);
      break;
    case 'obtener':
      $datosEnviar = ["idcurso" => $_POST["idcurso"]];
      enviarJSON($curso->obtener($datosEnviar));
      break;
    case 'actualizar':
      $datosEnviar = [
        "idcurso"       => $_POST["idcurso"],
        "nombrecurso"   => $_POST["nombrecurso"],
        "costo"         => $_POST["costo"],
        "nivel"         => $_POST["nivel"]
      ];
      $curso->actualizar($datosEnviar);
      break;
  }

}