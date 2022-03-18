<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD con MySQL y PHP vanilla </title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <div class=" text-5xl">
    <form action="" method="post" enctype="multipart/form-data">
      <label for="ID">ID:</label><input type="text" name="ID" placeholder="" id="ID" require=""><br>
      <label for="">Nombre:</label><input type="text" name="Nombre" placeholder="" id="Nombre" require=""><br>
      <label for="">Apellido Paterno:</label><input type="text" name="ApellidoP" placeholder="" id="ApellidoP" require=""><br>
      <label for="">Apellido Materno:</label><input type="text" name="ApellidoM" placeholder="" id="ApellidoM" require=""><br>
      <label for="">Numero:</label><input type="text" name="Numero" placeholder="" id="Numero" require=""><br>
      <label for="">Correo:</label><input type="text" name="Correo" placeholder="" id="Correo" require=""><br>
      <label for="">Foto:</label><input type="text" name="Foto" placeholder="" id="Foto" require=""><br>

      <button class="" value="btnAgregar" type="submit" name="action">Agregar</button>
      <button value="btnModificar" type="submit" name="action">Modificar</button>
      <button value="btnEliminar" type="submit" name="action">Eliminar</button>
      <button value="btnCancelar" type="submit" name="action">Cancelar</button>
    </form>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>