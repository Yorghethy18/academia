<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>
  
  <div class="container mt-5">
    <button class="btn btn-primary" type="button" id="mostrar1">Mostrar POST</button>
    <button class="btn btn-primary" type="button" id="mostrar2">Mostrar GET</button>
    <table class="table mt-3" id="tabla-software">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre Software</th>
          <th>Comandos</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const mostrar1 = document.querySelector("#mostrar1")
      const mostrar2 = document.querySelector("#mostrar2")
      const tabla = document.querySelector("#tabla-software tbody")

      function obtenerDatosPOST(){
        //() = URL
        //() = ¿Cómo recibo los datos? ... json(), text(), blob() < BINARIOS JPG
        //() = ¿Qué hago con los datos?
        //() = ¿Qué pasa si no llegan?

        //Cuando el controlador funciona utilizando $_POST, deberás crear un nuevo
        //objeto donde colocará todo lo que deseas enviar
        let parametros = new FormData();
        parametros.append("operacion", "listar");
        //parametros.append("", "");  //Repetir para cada valor

        fetch(`../controladores/software.controller.php`, {
          method: "POST",
          body: parametros
        })
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            datosRecibidos.forEach(element => {
              let nuevaFila = `
              <tr>
                  <td>${element.idsoftware}</td>
                  <td>${element.nombre}</td>
                  <td>
                    Editar | Eliminar
                  </td>
              </tr>
              `;
              tabla.innerHTML += nuevaFila;
            });
          })
          .catch(e => {
            console.error(e);
          });
      }


      //GET puede enviar información utilizando la URL
      //Registro(variabl1, variable2, variable3...)
      function obtenerDatosGET(){
        fetch(`../controladores/software.controller.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            console.log(datosRecibidos)
          })
          .catch(e => {
            console.error(e);
          });
      }

      //Esta nueva versión, utilizará un objeto que lleva todos los valores de la URL
      //Es recomendado, cuando existen muchos parámetros, ejemplo:
      //miurl.php?var1=valor1&var2=valor2&....

      function obtenerDatosGETMejorado(){

        //GET
        let parametros = new URLSearchParams();
        parametros.append("operacion", "listar");

        fetch(`../controladores/software.controller.php?${parametros}`)
          .then(respuesta => respuesta.json())
          .then(datosRecibidos => {
            console.log(datosRecibidos)
          })
          .catch(e => {
            console.error(e);
          });
      }

      //Evento
      mostrar1.addEventListener("click", obtenerDatosPOST);
      mostrar2.addEventListener("click", obtenerDatosGETMejorado);
    });
  </script>

</body>
</html>