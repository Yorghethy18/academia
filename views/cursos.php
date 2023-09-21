<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>

  <!-- Bootstrap 5.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</head>
<body>

<div class="container mt-3">
  
  <!-- Alert superior -->
  <div class="alert alert-primary" role="alert">
    <strong>CURSOS:</strong> Inserción y lista de datos básicos | 
    <a href="index.php">Volver a la página principal</a>
  </div>

  <!-- Formulario -->
  <form id="formulario-cursos" autocomplete="off">
    <!-- NOTA -->
    <!-- Vamos a dividir la fila en 3 partes: nombrecurso + costo + nivel -->
    <!-- Para ello debemos crear una capa con la clase row (fila) -->
    <div class="row">
      <!-- Capa de 6 columnas de ancho para el nombrecurso -->
      <div class="col-md-5 mb-2">
        <label for="nombrecurso" class="form-label">Nombre de curso:</label>
        <input type="text" class="form-control" id="nombrecurso" autofocus>
      </div>
      <!-- Capa de 2 columnas de ancho para el costo -->
      <div class="col-md-2 mb-2">
        <label for="costo" class="form-label">Costo:</label>
        <input type="text" class="form-control text-end" id="costo" maxlength="6">
      </div>
      
      <div class="col-md-2 mb-2">
        <label for="nivel" class="form-label">Nivel</label>
        <select name="nivel" id="nivel" class="form-select">
          <option value="">Seleccione</option>
          <option value="B">Básico</option>
          <option value="I">Intermedio</option>
          <option value="A">Avanzado</option>
        </select>        
      </div>

      <div class="col-md-3 mb-2">
        <label for="" class="form-label">&nbsp;</label>
        <div class="input-group">
          <button class="btn btn-primary" type="button" id="guardar">Guardar</button>
          <button class="btn btn-secondary" type="button" id="cancelar">Cancelar</button>
        </div>
      </div>

    </div>  <!-- /.row -->
  </form>

  <!-- Espacio para creación de tabla -->
  <div class="row mt-2">
    <div class="col-md-12">
      <table class="table table-sm table-striped" id="tabla-cursos">
        <colgroup>
          <col width="5%">
          <col width="55%">
          <col width="10%">
          <col width="10%">
          <col width="20%">
        </colgroup>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre curso</th>
            <th>Costo</th>
            <th>Nivel</th>
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


<script>
  document.addEventListener("DOMContentLoaded", () => {

    let sonDatosNuevos = true;
    let idcurso = -1;

    const nombrecurso = document.querySelector("#nombrecurso");
    const costo = document.querySelector("#costo");
    const nivel = document.querySelector("#nivel");
    const tabla = document.querySelector("#tabla-cursos tbody");
    const guardar = document.querySelector("#guardar");
    const cancelar = document.querySelector("#cancelar");
    const formulario = document.querySelector("#formulario-cursos");

    function listarCursos(){
      let valoresEnviar = new FormData();
      valoresEnviar.append("operacion", "listar");

      fetch(`../controllers/curso.controller.php`, {
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
                  <td>${element.nombrecurso}</td>
                  <td>${element.costo}</td>
                  <td>${element.nivel}</td>
                  <td>
                    <a href='#' data-idcurso='${element.idcurso}' class='btn btn-sm btn-danger delete'>Eliminar</a>
                    <a href='#' data-idcurso='${element.idcurso}' class='btn btn-sm btn-info update'>Editar</a>
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

    //Dependiendo de la variable "sonDatosNuevos" será capaz
    //de registrar nuevos datos, o actualizar los ya existentes. 
    function registrarCurso(){
      if (nombrecurso.value == "" || costo.value == "" || nivel.value == ""){
        alert("Debe completar la información solicitada");
        nombrecurso.focus();
      }else{

        let nombreProceso = sonDatosNuevos ? "registrar un nuevo curso": "actualizar el registro actual";

        if (confirm(`¿Está seguro de ${nombreProceso}?`)){
          //Preparamos un paquete de datos que recibirá el controlador
          let valoresEnviar = new FormData();

          //Definiendo operación en el controlador
          if (sonDatosNuevos){
            valoresEnviar.append("operacion", "registrar");
          }else{
            valoresEnviar.append("operacion", "actualizar");
            valoresEnviar.append("idcurso", idcurso);
          }

          //Valores que se envían siempre no importa si registras o actualizas
          valoresEnviar.append("nombrecurso", nombrecurso.value);
          valoresEnviar.append("costo", costo.value);
          valoresEnviar.append("nivel", nivel.value);
          
          fetch(`../controllers/curso.controller.php`, {
            method: "POST",
            body: valoresEnviar
          })
            .then(respuesta => respuesta.text())
            .then(datosRecibidos => {
              if (datosRecibidos.trim() == ""){
                listarCursos();
                reiniciarInterfaz();
              }
            })
            .catch(e => {
              console.error(e);
            });
        }
      }
    }

    //Se utiliza cuando cancelas o bien cuando finalizas el registro/actualización de datos
    function reiniciarInterfaz(){
      idcurso = -1;
      formulario.reset();
      guardar.innerHTML = "Guardar";
      sonDatosNuevos = true;
      nombrecurso.focus();
    }

    //Eventos
    guardar.addEventListener("click", registrarCurso);
    
    cancelar.addEventListener("click", reiniciarInterfaz);

    //Necesitamos "detectar" de algún modo el click en cada botón ELIMINAR y EDITAR, para ello, añadiremos
    //en cada uno de los botones una clase CSS para poder identificarlos, para el primero será "delete" y el
    //segundo "update"; estas clases se agregan solo con propósito de identificación, no contendrán estilos.

    //¿Dónde se agregarán estas clases?
    //Visualiza el método listarCursos() dentro de la generación de cada nuevaFila que recibirá la tabla, ahí está;
    //además, tendremos que pasar el "idcurso" para que los procesos eliminar y editar puedan hacer sus operaciones.

    //Como los botones ELIMINAR y EDITAR se crean dentro del cuerpo de la tabla, entonces partiremos de esta referencia
    //"event" es un objeto que contiene información sobre el evento click, se pudo llamar de cualquier otra manera.
    tabla.addEventListener("click", function (event){
      //Realmente NO queremos detectar el clic en la tabla, sino en los elementos que están dentro de ella
      //entonces, primero detectaremos el idcurso que se envió.
      idcurso = parseInt(event.target.dataset.idcurso);
      
      //Ahora hace falta saber el origen del click (pueden haber muchos botones dentro de la tabla)
      //y para saber esto, es que utilizamos las clasess CSS
      
      //Eliminar
      if (event.target.classList.contains('delete')){
        if (confirm("¿Está seguro de eliminar el registro?")){
          
          let parametros = new FormData();
          parametros.append("operacion", "eliminar");
          parametros.append("idcurso", idcurso);

          fetch(`../controllers/curso.controller.php`, {
            method: "POST",
            body: parametros
          })
            .then(respuesta => respuesta.text())
            .then(datosRecibidos => {
              console.log(datosRecibidos)
              if (datosRecibidos.trim() == ""){
                listarCursos();
              }
            })
            .catch(e => {
              console.error(e);
            });
        }
      }

      //Editar
      if (event.target.classList.contains('update')){
        //Proceso para editar...
        //Buscamos el registro a partir del IDCURSO
        let parametros = new FormData();
        parametros.append("operacion", "obtener");
        parametros.append("idcurso", idcurso);

        fetch(`../controllers/curso.controller.php`, {
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            nombrecurso.value = datosRecibidos.nombrecurso;
            costo.value = datosRecibidos.costo;
            nivel.value = datosRecibidos.nivel;
            guardar.innerHTML = "Actualizar";
            sonDatosNuevos = false;
            nombrecurso.focus();
          })
          .catch(e => {
            console.error(e);
          });
      }

    });

    listarCursos();

  });
</script>

</body>
</html>