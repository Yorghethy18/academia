<?php

require_once 'Conexion.php';

class MiClase extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function nombreMetodo($datos = []){
    try{
      $consulta = $this->pdo->prepare("");
      $consulta->execute();
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

  public function listar(){
    try{
      $consulta = $this->pdo->prepare("");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

}