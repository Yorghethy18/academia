<?php

require_once 'Conexion.php';

class Alumno extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function listar(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_alumnos_listar()");
      $consulta->execute();
      return $consulta->fetchALL(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function registrar($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_alumnos_registrar(?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['apellidos'],
          $datos['nombres'],
          $datos['fechanac'],
          $datos['numerodoc'],
          $datos['telefono']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function eliminar($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_alumnos_eliminar(?)");
      $consulta->execute(
        array(
          $datos['idalumno']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  //¡Cuidado!
  //En un sistema, siempre hay N formas de hacer una búsqueda, ser más explícito
  public function buscarDatos($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_alumnos_buscar_dni(?)");
      $consulta->execute(
        array(
          $datos['numerodoc']
        )
      );
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch(Exception $e){
      die($e->getMessage);
    }
  }

}