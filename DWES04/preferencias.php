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
<?php
session_start();
if(isset($_POST['establecer'])){
  $_SESSION['idioma']=$_POST['idioma'];
  $_SESSION['perfil']=$_POST['perfil'];
  $_SESSION['zona']=$_POST['zona_horaria'];
}


?>

<body class="bg-secondary" style="--bs-bg-opacity: .5;">
  <header>
    <!-- place navbar here -->
  </header>
  <main class="my-4">
  <!--No utilicé el Font Awesome porque había que registrarse -->  
<div class="container bg-white border border-2 rounded col-4">

  <div class="bg-light py-3 border-bottom"><h3>Preferencias Usuario</h3></div>
  
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> <!-- formulario que envía los datos a sí misma por POST-->
    <div class="mb-3">
      <?php
      if(!empty($_POST)){
        echo "<h5 class='text-primary my-3'>Preferencias de usuario guardadas</h5>";
      }
      ?>
      <label for="idioma" class="form-label my-2">Idioma</label>
      <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
    <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z"/>
    <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z"/>
    </svg></span>
        <select class="form-select form-select-lg" name="idioma" id="idioma">
          <?php 
          if ($_SESSION['idioma']=="esp") {
            echo "<option selected value='esp'>Español</option>";
            echo "<option value='ing'>Inglés</option>";  
          }else if ($_SESSION['idioma']=="ing") {
            echo "<option selected value='ing'>Inglés</option>";
            echo "<option value='esp'>Español</option>";  
          }else{
            echo "<option value='ing'>Inglés</option>";
            echo "<option value='esp'>Español</option>";  
          }

          ?>
        </select>
      </div>
    </div>
    
    <div class="mb-3">
      <label for="perfil" class="form-label">Perfil público</label>
      <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
    </svg></span>
        <select class="form-select form-select-lg" name="perfil" id="perfil">
        <?php 
          if ($_SESSION['perfil']=="si") {
            echo "<option selected value='si'>Sí</option>";
            echo "<option value='no'>No</option>";  
          }else if ($_SESSION['perfil']=="no") {
            echo "<option selected value='no'>No</option>";
            echo "<option value='si'>Sí</option>";  
          }else{
            echo "<option value='si'>Sí</option>";
            echo "<option value='no'>No</option>";   
          }

          ?>



         
        </select>
      </div>
    </div>
    
    <div class="mb-3">
      <label for="zona_horaria" class="form-label">Zona horaria</label>
      <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
    </svg></span>
        <select class="form-select form-select-lg" name="zona_horaria" id="zona_horaria">
        <?php 
          if ($_SESSION['zona']=="GMT-2") {
            echo "<option selected value='GMT-2'>GMT-2</option>";
            echo "<option value='GMT-1'>GMT-1</option>";  
            echo "<option value='GMT'>GMT</option>";  
            echo "<option value='GMT+1'>GMT+1</option>";  
            echo "<option value='GMT+2'>GMT+2</option>";  
          }else if ($_SESSION['zona']=="GMT-1") {
            echo "<option value='GMT-2'>GMT-2</option>";
            echo "<option selected value='GMT-1'>GMT-1</option>";  
            echo "<option value='GMT'>GMT</option>";  
            echo "<option value='GMT+1'>GMT+1</option>";  
            echo "<option value='GMT+2'>GMT+2</option>";             
          }else if ($_SESSION['zona']=="GMT") {
            echo "<option value='GMT-2'>GMT-2</option>";
            echo "<option value='GMT-1'>GMT-1</option>";  
            echo "<option selected value='GMT'>GMT</option>";  
            echo "<option value='GMT+1'>GMT+1</option>";  
            echo "<option value='GMT+2'>GMT+2</option>";           
          }else if ($_SESSION['zona']=="GMT+1") {
            echo "<option value='GMT-2'>GMT-2</option>";
            echo "<option value='GMT-1'>GMT-1</option>";  
            echo "<option value='GMT'>GMT</option>";  
            echo "<option selected value='GMT+1'>GMT+1</option>";  
            echo "<option value='GMT+2'>GMT+2</option>";        
          }else if ($_SESSION['zona']=="GMT+2") {
            echo "<option value='GMT-2'>GMT-2</option>";
            echo "<option value='GMT-1'>GMT-1</option>";  
            echo "<option value='GMT'>GMT</option>";  
            echo "<option value='GMT+1'>GMT+1</option>";  
            echo "<option selected value='GMT+2'>GMT+2</option>";         
          }else{
            echo "<option value='GMT-2'>GMT-2</option>";
            echo "<option value='GMT-1'>GMT-1</option>";  
            echo "<option value='GMT'>GMT</option>";  
            echo "<option value='GMT+1'>GMT+1</option>";  
            echo "<option value='GMT+2'>GMT+2</option>";  
          }

          ?>

        </select>
      </div>
      <div class="my-3 mb-4 d-flex justify-content-between">
      <a href="mostrar.php"><button type="button" class="btn btn-primary" name="mostrar" id="mostrar">Mostrar preferencias</button></a>
      <button type="submit" class="btn btn-success" name="establecer" id="establecer">Establecer preferencias</button>
    </div>
    
  </form>
  </div>
  
</div>
  
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>