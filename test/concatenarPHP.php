<?php

$apellidos = "Francia Minaya";
$nombres = "Jhon Edward";

//En PHP si se puede asignar multilinea con ""
$saludo = "
  Esta es una
  cadena escrita
  en varias líneas
  solo funciona en PHP
";

//$datosCompletos = "Hola " . $apellidos . " " . $nombres . " un gusto saludarte";

//Es necesario comillas dobles
$datosCompletos = "Hola {$apellidos} {$nombres} un gusto saludarte";

echo $datosCompletos;