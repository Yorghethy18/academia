<?php
//MODELO
class Software{

  public function listar(){
    $listaSoftware = [
      ["idsoftware" => 1, "nombre" => "Nod Antivirus"],
      ["idsoftware" => 2, "nombre" => "Windows 11"],
      ["idsoftware" => 3, "nombre" => "MS Office"],
      ["idsoftware" => 4, "nombre" => "Android Studio"],
      ["idsoftware" => 5, "nombre" => "VSCode"]
    ];
    return $listaSoftware;
  }

}