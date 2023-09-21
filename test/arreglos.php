<?php

//Variable
$sueldo = 1500;

//Arreglo - F1
$colores = ["verde", "rojo", "amarillo"];

//Arreglo F2
$amigos = array("Juan", "Pedro", "José");

/*
echo "<pre>";
var_dump($colores);
var_dump($amigos);
echo "</pre>";
*/

//Arreglos que se componen de otros arreglos
//MATRIZ = ARREGLO compuesto ARREGLOS
$aplicaciones = [
  ["Nod Antivirus", "Panda", "Avira", "AVG"],
  ["Word", "Excel", "PowerPoint"],
  ["VSCode", "NetBeans", "AndroidStudio", "Eclipse"],
  ["Windows 11"]
];

/*
echo "<pre>";
var_dump($aplicaciones);
*/

//Hasta aquí todos los arreglos utilizan índice (0...n)
//Claves y valores
//ARREGLOS ASOCIATIVOS (claves -> valores) ... JSON
$institucion = [
  "zonal"   => "Ica Ayacucho",
  "cfp"     => "Chincha",
  "carreras"=> ["Mecánico", "Soldador", "Ing. Software IA", "Diseño"]
];

echo "<pre>";
var_dump($institucion);
echo "</pre>";

echo "<hr>";

//json_encode() => Convierte un objeto PHP a JSON
//json_decode() => Convierte un JSON a objeto PHP
echo json_encode($institucion);