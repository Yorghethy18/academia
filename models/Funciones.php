<?php

function enviarJSON($datos){
  if ($datos){
    echo json_encode($datos);
  }
}

?>