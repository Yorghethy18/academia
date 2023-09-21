<?php

class Alumno{

  //1. Asignación directa
  private $apellidos = "Torres";
  private $nombres = "Mónica";
  private $carrera = "Diseño";

  //2. Constructor
  public function __CONSTRUCT($apellidos, $nombres, $carrera){
    $this->apellidos = $apellidos;
    $this->nombres = $nombres;
    $this->carrera = $carrera;
  }

  //Métodos que asignan valores (SET)
  public function setApellidos($valor){
    $this->apellidos = $valor;
  }

  public function setNombres($valor){
    $this->nombres = $valor;
  }

  public function setCarrera($valor){
    $this->carrera = $valor;
  }

  //Métodos que devuelven valores (GET)
  public function presentarse(){
    return "Soy {$this->apellidos} {$this->nombres} de la carrera de {$this->carrera}";
  }

}

$alumno = new Alumno("Matías", "Hugo", "Soldadura");

//3. Asignaciones manuales
/*
$alumno->setApellidos("Gonzales");
$alumno->setNombres("Katherin");
$alumno->setCarrera("Administración");
*/
echo $alumno->presentarse();