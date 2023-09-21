<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alumnos</title>
  <!-- Bootstrap 5.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</head>
<body>
  <div class="container mt-3">
    <!-- ALERTA -->
    <div class="alert alert-success" role="alert">
      <strong>ALUMNOS :</strong> Registro y listado de alumnos |
      <a href="index.php">Volver a la página principal</a>
    </div>
    <!-- FORMULARIO PARA ALUMNOS -->
    <form id="formulario-alumnos" autocomplete="off">
      <div class="row">
        <!-- Columna para apellidos -->
        <div class="col md-2 mb-2">
          <label for="apellidos" class="form-label">Apellidos:</label>
          <input type="text" class="form-control" id="apellidos" autofocus>
        </div>
        <!-- Columna para nombres -->
        <div class="col md-2 mb-2">
          <label for="nombres" class="form-label">Nombres:</label>
          <input type="text" class="form-control" id="nombres">
        </div>
        <!-- Columna para fecha de nacimiento -->
        <div class="col md-2 mb-2">
          <label for="fechanac" class="form-label">Fecha de nacimiento:</label>
          <input type="date" class="form-control" id="fechanac">
        </div>
        <!-- Columna para el número de documento -->
        <div class="col md-2 mb-2">
          <label for="numerodoc" class="form-label">Número de documento:</label>
          <input type="tel" class="form-control text-end" id="numerodoc" maxlength="8">
        </div>
        <!-- Columna para el telefono -->
        <div class="col md-4 mb-2">
          <label for="telefono" class="form-label">Télefono</label>
          <div class="input-group">
            <input type="tel" class="form-control text-end" id="telefono" maxlength="9">
            <button class="btn btn-success" type="button" id="registrar">Registrar</button>
          </div>
        </div>
      </div>
    </form>

    <!-- Creando la tabla visualizadora -->
    <div class="row mt-2">
      <div class="col-md-12">
        <table class="table table-sm table-striped" id="tabla-alumnos">
          <colgroup>
            <col width="5%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="10%">
            <col width="20%">
          </colgroup>
          <thead>
            <tr>
              <th>#</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Fecha de nacimiento</th>
              <th>Número de documento</th>
              <th>Télefono</th>
              <th>Comandos</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>  
    </div>

  </div>

  <!-- Bootstrap 5.2 -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  <!-- LLAMADO EN EL FRONT -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const apellidos = document.querySelector("#apellidos");
      const nombres = document.querySelector("#nombres");
      const fechanac = document.querySelector("#fechanac");
      const numerodoc = document.querySelector("#numerodoc");
      const telefono = document.querySelector("#telefono");
      const tabla = document.querySelector("#tabla-alumnos tbody");
      const registrar = document.querySelector("#registrar");
      const formulario = document.querySelector("#formulario-alumnos");

      function listarAlumnos(){
        let valoresEnviar = new FormData();
        valoresEnviar.append("operacion", "listar");

        fetch(`../controllers/alumno.controller.php`, {
          method: "POST",
          body: valoresEnviar
        })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            //Renderizamos el resultado en el cuerpo de la tabla <tbody>
              let numeroFila = 1;
              let nuevaFila = ``;
              tabla.innerHTML = ``;

              datosRecibidos.forEach(element => {
                nuevaFila = `
                  <tr>
                    <td>${numeroFila}</td>
                    <td>${element.apellidos}</td>
                    <td>${element.nombres}</td>
                    <td>${element.fechanac}</td>
                    <td>${element.numerodoc}</td>
                    <td>${element.telefono}</td>
                    <td>
                      <a href='#' data-idalumno='${element.idalumno}' class='btn btn-sm btn-danger delete'>Eliminar</a>
                      <a href='#' data-idalumno='${element.idalumno}' class='btn btn-sm btn-info update'>Editar</a>
                    </td>
                  </tr>
                `;
                numeroFila++;
                tabla.innerHTML += nuevaFila;
              });
          })
          .catch(e => {
            console.error(e);
          });
      }
      listarAlumnos();

      function registrarAlumno(){
        if(apellidos.value == "" || nombres.value == "" || fechanac.value == "" || numerodoc.value == "" || telefono.value == ""){
          alert("Debe completar la información solicitada");
          apellidos.focus();
        }else{
          if(confirm("¿Está seguro de registrar a un nuevo alumno?")){
            let valorEnviar = new FormData();
            valorEnviar.append("operacion","registrar");
            valorEnviar.append("apellidos",apellidos.value);
            valorEnviar.append("nombres",nombres.value);
            valorEnviar.append("fechanac",fechanac.value);
            valorEnviar.append("numerodoc",numerodoc.value);
            valorEnviar.append("telefono",telefono.value);

            fetch(`../controllers/alumno.controller.php`, {
              method: "POST",
              body: valorEnviar
            })
            .then(respuesta => respuesta.text())
            .then(datosRecibidos => {
              if(datosRecibidos.trim() == ""){
                listarAlumnos();
                formulario.reset();
                apellidos.focus();
              }
            })
            .catch(e => {
              console.error(e);
            })
          }
        }
      }

      // EVENTOS
      registrar.addEventListener("click", registrarAlumno);

      tabla.addEventListener("click", function(event){
        let idalumno = parseInt(event.target.dataset.idalumno);
        
        
        // PROCESO PARA ELIMINAR
        if(event.target.classList.contains('delete')){
          if(confirm("¿Está seguro(a) de eliminar el registro?")){
            let parametros = new FormData();
            parametros.append("operacion","eliminar");
            parametros.append("idalumno",idalumno);

            fetch(`../controllers/alumno.controller.php`,{
              method: "POST",
              body: parametros
            })
            .then(respuesta => respuesta.text())
            .then(datosRecibidos =>{
              console.log(datosRecibidos)
              if(datosRecibidos.trim() == ""){
                listarAlumnos();
              }
            })
            .catch(e =>{
              console.error(e);
            });
          }
        }
      });
      
    });
  </script>
</body>
</html>