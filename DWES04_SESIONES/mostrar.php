<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<?php
session_start(); //iniciamos sesión



?>

<body class="bg-secondary" style="--bs-bg-opacity: .5;">

  <main class="my-4">
  <!--No utilicé el Font Awesome porque había que registrarse -->  
<div class="container bg-success bg-gradient  border border-2 rounded border-success col-4 text-white">
   <h2 class="my-3"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="white" class="bi bi-person-fill-gear me-2" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
</svg>Preferencias</h2>
   <div class="fs-5">
  <?php
      if(!empty($_POST)){
        if(empty($_SESSION['idioma'])){
            echo "<h4 class='text-danger my-3'><b>Debes fijar primero las preferencias</b></h4>";
        }else{
            echo "<h4 class='text-danger my-3'><b>Preferencias borradas</b></h4>";
        }
        
      }

      if(isset($_POST['borrar'])){
        session_unset();
        }
      ?>
  <?php
  if(!isset($_SESSION['idioma'])){
        $nodef='No establecido';
        echo "<p><b>Idioma: </b>".$nodef."</p>";
        echo "<p><b>Perfil Público: </b>".$nodef."</p>";
        echo "<p><b>Zona horaria: </b>".$nodef."</p>";
    }else{
        echo "<p><b>Idioma: </b>".$_SESSION['idioma']."</p>";
        echo "<p><b>Perfil Público: </b>".$_SESSION['perfil']."</p>";
        echo "<p><b>Zona horaria: </b>" .$_SESSION['zona']."</p>";
}

  ?>
  </div>
  <div class="my-3">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <a href="preferencias.php"><button type="button" class="btn btn-primary" name="establecer" id="establecer">Establecer</button></a>
    <button type="submit" class="btn btn-danger ms-3" name="borrar" id="borrar">Borrar</button>
    </form>
  </div>
</div>
</main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>