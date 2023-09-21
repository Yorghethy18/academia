<?php

class Cajero{

  private $codigoCajero = "11";
  private $estaActivo;
  private $dinero;

  //CONSTRUCTOR, es un método que se ejecuta al crear una instancia
  public function __CONSTRUCT($dinero){
    $this->dinero = $dinero;
  }

  //Ejemplo de cómo se accede a atributos de clase
  public function verCodigoCajero(){
    $codigoCajero = "22";
    return $this->codigoCajero;
  }

  public function activarCajero(){
    $this->estaActivo = true;
  }

  public function retirarDinero(){
    if ($this->estaActivo && $this->dinero > 0){
      return "Se procede al retiro";
    }
    else{
      return "No podemos atenderlo";
    }
  }

}

//Test, pruebas...
//Objeto = Constructor(Sobrecarga)
$cajero = new Cajero(0);

//echo $cajero->verCodigoCajero();
$cajero->activarCajero();       //true
echo $cajero->retirarDinero();