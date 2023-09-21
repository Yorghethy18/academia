<?php

require_once 'Conexion.php';

class Usuario extends Conexion{

  private $pdo;

  public function __CONSTRUCT(){
    $this->pdo = parent::getConexion();
  }

  public function iniciarSesion($datos = []){
    try{
      $consulta = $this->pdo->prepare("CALL spu_usuario_login(?)");
      $consulta->execute(
        array(
          $datos['nombreusuario']
        )
      );
      return $consulta->fetch(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage);
    }
  }

}