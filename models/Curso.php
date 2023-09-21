<?php

require_once 'Conexion.php';

class Curso extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  //$datos = [] ARRAY !!!
  public function registrar($datos = []){
    try{
      $consulta = $this->pdo->prepare("call spu_cursos_registrar(?,?,?)");
      $consulta->execute(
        array(
          $datos['nombrecurso'],
          $datos['costo'],
          $datos['nivel']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function listar(){
    try{
      $consulta = $this->pdo->prepare("call spu_cursos_listar()");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  //Para eliminar solo requerimos el ID, igual lo pasamos por array asociativo
  public function eliminar($datos = []){
    try{
      $consulta = $this->pdo->prepare("call spu_cursos_eliminar(?)");
      $consulta->execute(
        array(
          $datos['idcurso']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function obtener($datos = []){
    try{
      $consulta = $this->pdo->prepare("call spu_cursos_obtener(?)");
      $consulta->execute(
        array(
          $datos['idcurso']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function actualizar($datos = []){
    try{
      $consulta = $this->pdo->prepare("call spu_cursos_actualizar(?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idcurso'],
          $datos['nombrecurso'],
          $datos['costo'],
          $datos['nivel']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

}