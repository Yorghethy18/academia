<!doctype html>
<html lang="es">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
<div class="container">
    <div class="row mt-3">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <!-- INICIO DE CARD -->
        <div class="card">
          <div class="card-header bg-info text-light">
           <strong>Inicio de sesión</strong>
          </div>
          <div class="card-body">
            <!--<img src="views/img/fotografias/programador.png">-->
            <form action="" autocomplete="off" id="formulario-login">
              <div class="mb-3">
                <label for="nombreusuario" class="form-label">
                  <i class="fa-solid fa-user"></i>
                  Nombre usuario:
                </label>
                <input type="text" id="nombreusuario" class="form-control form-control-sm"  placeholder="Ingrese su usuario">
              </div>
              <div class="mb-3">
                <label for="claveacceso" class="form-label">
                  <i class="fa-solid fa-lock"></i>
                  Contraseña:
                </label>
                <input type="password" id="claveacceso" class="form-control form-control-sm" placeholder="******">
              </div>
            </form>
          </div>
          <div class="card-footer text-center">
            <button type="button" id="iniciarsesion" class="btn btn-sm btn-success" >Iniciar Sesión <i class="fa-solid fa-right-to-bracket"></i></button>
          </div>
        </div>
        <!-- FIN DE CARD-->
      </div>
      <div class="col-md-3"></div>
    </div>
  </div> 


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", () =>{
      const nombreusuario   = document.querySelector("#nombreusuario");
      const claveacceso     = document.querySelector("#claveacceso");
      const formulario      = document.querySelector("#formulario-login");
      const iniciarsesion   = document.querySelector("#iniciarsesion");

      
    });
  </script>
</body>

</html>