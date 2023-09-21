<!doctype html>
<html lang="es">

<head>
  <title>Matrículas</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <div class="container mt-3">
    <div class="alert alert-secondary" role="alert">
      <strong>MATRÍCULAS:</strong> Inserción y listado de matrículas |
      <a href="index.php">Volver a la página principal</a>
    </div>
    
    <form id="formulario-matriculas" autocomplete="off">
      <div class="row">
        <!-- CURSO A ELEGIR -->
        <div class="col-md-12 mb-2">
          <label for="nombrecurso" class="form-label">Curso a elegir</label>
          <div class="input-group">
            <select name="nombrecurso" id="nombrecurso" class="form-select form-select-md">
              <option value="">Seleccione</option>
            </select>
          </div>
        </div>
        <!-- DNI Y DATOS DEL ALUMNOS -->
        <div class="col-md-6 mb-2">
          <label for="numerodoc" class="form-label">DNI:</label>
          <input type="tel" class="form-control form-control-md text-end" id="numerodoc" maxlength="8">
        </div>
        <div class="col-md-6 mb-2">
          <label for="datos_alumno" class="form-label">Datos de alumno:</label>
          <input type="text" class="form-control form-control-md" id="datos_alumno">
        </div>
        <!-- CAMPO TURNO Y OBSERVACIONES -->
        <div class="col-md-6 mb-2">
          <label for="turno" class="form-label">Turno:</label>
            <div class="input-group">
              <select name="turno" id="turno" class="form-select form-select-md">
                <option value="">Seleccione</option>
                <option value="M">Mañana</option>
                <option value="T">Tarde</option>
                <option value="N">Noche</option>
              </select>
            </div>
        </div>
        <div class="col-md-6 mb-2">
          <label for="observaciones" class="form-label">Observaciones:</label>
          <div class="input-group">
            <input type="text" class="form-control form-control-md" id="observaciones">
            <button class="btn btn-secondary" type="button" id="registrar">Registrar matrícula</button>
          </div>
        </div>
      </div>
    </form> 

    <!-- CrEACION DE LA TABLA -->
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-sm table-striped" id="tabla-matriculas">
            <colgroup>
              <col width="5%">
              <col width="15%">
              <col width="15%">
              <col width="15%">
              <col width="15%">
              <col width="15%">
              <col width="15%">
            </colgroup>
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre Curso</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Turno</th>
                <th>Costo Curso</th>
                <th>Comandos</th>
              </tr>
            </thead>
            <tbody>  
            </tbody>
          </table>
        </div>
      </div>
    </div> <!-- Fin de la tabla -->
    
    
  </div>





  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () =>{

      //El idalumno no será const, ya que es un valor que puede cambiar (con cada búsqueda)
      let idalumno = 0; //le asignamos un valor neutral

      const nombrecurso = document.querySelector("#nombrecurso");
      const numerodoc = document.querySelector("#numerodoc");
      const datos_alumno = document.querySelector("#datos_alumno");
      const turno = document.querySelector("#turno");
      const observaciones = document.querySelector("#observaciones");
      const tabla = document.querySelector("#tabla-matriculas tbody");
      const registrar = document.querySelector("#registrar");
      const formulario = document.querySelector("#formulario-matriculas");

      function listarMatriculas(){
        let valorEnviado = new FormData();
        valorEnviado.append("operacion","listar");
        fetch(`../controllers/matricula.controller.php`,{
          method:"POST",
          body: valorEnviado
        })
        .then(respuesta => respuesta.json())
        .then(datoRecibidos =>{
          //Renderizando
          let numeroFila = 1;
          let nuevaFila = ``;
          tabla.innerHTML = ``;

          datoRecibidos.forEach(element =>{
            nuevaFila = `
              <tr>
                <td>${numeroFila}</td>
                <td>${element.nombrecurso}</td>
                <td>${element.apellidos}</td>
                <td>${element.nombres}</td>
                <td>${element.turno}</td>
                <td>${element.costo}</td>
                <td>
                  <a href='#' data-idmatricula='${element.idmatricula}' class='btn btn-sm btn-danger delete'>Eliminar</a>
                  <a href='#' data-idmatricula='${element.idmatricula}' class='btn btn-sm btn-info update'>Editar</a>
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

      

      function obtenerCurso(){
        let datosEnviar = new FormData()
        datosEnviar.append("operacion","curso");
        fetch(`../controllers/matricula.controller.php`, {
          method: "POST",
          body: datosEnviar
        })
        .then(respuesta => respuesta.json())
        .then(datos => {
          datos.forEach(element => {
            let optionTag = document.createElement("option");
            optionTag.value = element.idcurso;
            optionTag.innerText = element.nombrecurso;

            nombrecurso.appendChild(optionTag);
          });
        })
        .catch(e =>{
          console.error(e);
        });
      }

      


      //¡CUIDADO!
      //Si buscas un alumno, la funcionalidad debe estar en el MODELO ALUMNO, CONTROLADOR ALUMNO
      //no en matrícula, ya que el sstema podría tener un módulo matrículas, asistencia, notas, etc
      //y todos ellos van a requerir BUSCAR al alumno
      function buscarAlumno() {
        const dni = numerodoc.value; //valor buscado

        // trim => elimina espacion en blanco
        if (dni.length == 8) {
          // Realizar una solicitud AJAX para buscar el alumno por DNI
          let datosEnviar = new FormData();
          datosEnviar.append("operacion", "buscarDatos");
          datosEnviar.append("numerodoc", dni);

          fetch(`../controllers/alumno.controller.php`, {
            method: "POST",
            body: datosEnviar,
          })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            if (datosRecibidos.length > 0) {
              //Como ya encontramos al alumno, debemos RESERVAR su ID para el proceso de matrícula
              idalumno = datosRecibidos[0].idalumno;

              // Actualizar el campo "datos_alumno" con los datos del alumno encontrado
              datos_alumno.value = datosRecibidos[0].datos_alumno;
           }
          })
          .catch((e) => {
            datos_alumno.value = "Alumno no encontrado";
          });
        }
      }

      // EVENTOS
      numerodoc.addEventListener("keypress", function (e){
        if (e.charCode == 13){
          buscarAlumno();
        }
      });

      function registrarMatricula(){
        if(nombrecurso.value == "" || numerodoc.value == "" || turno.value == ""){
          alert("Por favor, completar los datos solicitados");
          nombrecurso.focus();
        }else{
          if(confirm("¿Está seguro de registrar matrícula?")){
            let valorEnviado = new FormData();

            valorEnviado.append("operacion","registrar");
            valorEnviado.append("idcurso", nombrecurso.value); //Se obtiene desde el <select>
            valorEnviado.append("idalumno", idalumno); //Se debió obtener después de haber encontrado al alumno con la función de BUSCAR
            valorEnviado.append("turno",turno.value); //Se obtiene desde el <select>
            valorEnviado.append("observaciones",observaciones.value); //Se obtiene desde el <input>

            fetch(`../controllers/matricula.controller.php`, {
              method: "POST",
              body: valorEnviado
            })
            .then(respuesta => respuesta.text())
            .then(datoRecibidos => {
              if(datoRecibidos.trim() == ""){
                listarMatriculas();
                formulario.reset();
                nombrecurso.focus();
              }
            })
            .catch(e => {
              console.error(e);
            });
          }
        }
      }

      // EVENTO REGISTRAR
      registrar.addEventListener("click", registrarMatricula);

      tabla.addEventListener("click", function(event){
        let idmatricula = parseInt(event.target.dataset.idmatricula);

        // PROCESO PARA ELIMINAR
        if (event.target.classList.contains('delete')){
          if (confirm("¿Está seguro de eliminar el registro?")){
          
            let parametros = new FormData();
            parametros.append("operacion", "eliminar");
            parametros.append("idmatricula", idmatricula);

            fetch(`../controllers/matricula.controller.php`, {
              method: "POST",
              body: parametros
            })
            .then(respuesta => respuesta.text())
            .then(datosRecibidos => {
              console.log(datosRecibidos)
              if (datosRecibidos.trim() == ""){
                listarMatriculas();
              }
            })
            .catch(e => {
              console.error(e);
            });
          }
        }
      });

      obtenerCurso();
      listarMatriculas();
    });
  </script>



</body>

</html>