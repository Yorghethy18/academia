<?php

require_once 'Conexion.php';

class Matricula extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function registrar($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_matriculas_registrar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idcurso'],
          $datos['idalumno'],
          $datos['turno'],
          $datos['observaciones']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function listar(){
    try{
      $consulta = $this->pdo->prepare("CALL spu_matriculas_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function curso(){
    try {
      $consulta = $this->pdo->prepare("CALL spu_cursos_nombres()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
  }

  public function eliminar($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_matriculas_eliminar(?)");
      $consulta->execute(
        array(
          $datos['idmatricula']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }
  

}