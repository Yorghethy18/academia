<?php

//Clase = Plantilla, nos permitirá construir/crear nuevos objetos
class Perro{

  //Atributos de clase (solo existen dentro de la clase)
  private $raza = "";
  private $nombre = "";
  private $peso = 0.0;
  private $estaDespierto = true;

  public function ladrar(){
    return "guau guau grrr";
  }

  public function dormir(){
    $this->estaDespierto = false;
  }

  public function comprobar(){
    if ($this->estaDespierto){
      return "El perro está despierto y jugando";
    }else{
      return "El perro duerme, guardar silencio";
    }
  }


}

//Estoy fuera de la clase..
//Aquí haremos las pruebas
//Las clases deben tener primera letra mayúscula, SINGULAR
$perro = new Perro();

//Verificando el primer método
echo $perro->ladrar();

//dormiremos al perro
//$perro->dormir();

//comprobar si está despierto o dormido
echo $perro->comprobar();