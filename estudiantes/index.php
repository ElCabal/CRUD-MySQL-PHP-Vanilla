<?php

//Validación
//Creamos una variable y dentro un condicional ternario

//........Si    POST contiene [Dato] entonces Guardar Dato si no, retornar vacío

$txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : "";
$txtNombre = (isset($_POST["txtNombre"])) ? $_POST["txtNombre"] : "";
$txtApellidoP = (isset($_POST["txtApellidoP"])) ? $_POST["txtApellidoP"] : "";
$txtApellidoM = (isset($_POST["txtApellidoM"])) ? $_POST["txtApellidoM"] : "";
$txtTelefono = (isset($_POST["txtTelefono"])) ? $_POST["txtTelefono"] : "";
$txtCorreo = (isset($_POST["txtCorreo"])) ? $_POST["txtCorreo"] : "";
$txtFoto = (isset($_FILE["txtFoto"]["name"])) ? $_POST["txtFoto"]["name"] : "";

$action = (isset($_POST["action"])) ? $_POST["action"] : "";

//Incluimos archivo de conexión.
include("../conexion/conexion.php");

switch ($action) {
  case 'btnAgregar':
    //Esta línea me permite por medio del $conn(conexión) y la función prepare() crear una plantilla SQL para enviar a la base de datos.

    //documentación función prepare(): https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    $sentencia = $conn->prepare("INSERT INTO estudiantes(Nombre,ApellidoP,ApellidoM,Telefono,Correo,Foto) 
    VALUE (/* :ID, */:Nombre,:ApellidoP,:ApellidoM,:Telefono,:Correo,:Foto)");

    
    $sentencia->bindParam(":Nombre", $txtNombre);
    $sentencia->bindParam(":ApellidoP", $txtApellidoP);
    $sentencia->bindParam(":ApellidoM", $txtApellidoM);
    $sentencia->bindParam(":Telefono", $txtTelefono);
    $sentencia->bindParam(":Correo", $txtCorreo);
    $sentencia->bindParam(":Foto", $txtFoto);
    $sentencia->execute();

    echo "presionaste btnAgregar";
    break;
    
  case 'btnModificar':

    $sentencia = $conn->prepare("UPDATE estudiantes SET Nombre=:Nombre,
    ApellidoP=:ApellidoP,
    ApellidoM=:ApellidoM,
    Telefono=:Telefono,
    Correo=:Correo,
    Foto=:Foto WHERE 
    id=:id");
    

    
    $sentencia->bindParam(":Nombre", $txtNombre);
    $sentencia->bindParam(":ApellidoP", $txtApellidoP);
    $sentencia->bindParam(":ApellidoM", $txtApellidoM);
    $sentencia->bindParam(":Telefono", $txtTelefono);
    $sentencia->bindParam(":Correo", $txtCorreo);
    $sentencia->bindParam(":Foto", $txtFoto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

header("Location: index.php");


    echo "presionaste btnModificar";
    break;

  case 'btnEliminar':


    $sentencia = $conn->prepare("DELETE FROM  estudiantes 
    WHERE id=:id");
    
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    echo "presionaste btnEliminar";
    break;
  case 'btnCancelar':
    echo "presionaste btnCancelar";
    break;
}
//preparamos instrucción SQL para mostrar información 
$sentencia = $conn->prepare("SELECT * FROM `estudiantes` WHERE 1");
$sentencia->execute(); //ejecutamos
//Esta función nos permite asociar información de base de datos a un arreglo
$listaEstudiantes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD con MySQL y PHP vanilla </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div>
    <form class="form" action="" method="post" enctype="multipart/form-data">

      <label for="">ID:</label>
      <input type="text" name="txtID" value="<?php echo $txtID; ?>" placeholder="" id="txtID" require="">
      <br>
      <label for="">Nombre:</label>
      <input type="text" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="" id="txtNombre" require="">
      <br>
      <label for="">Apellido Paterno:</label>
      <input type="text" name="txtApellidoP" value="<?php echo $txtApellidoP; ?>" placeholder="" id="txtApellidoP"
        require="">
      <br>
      <label for="">Apellido Materno:</label>
      <input type="text" name="txtApellidoM" value="<?php echo $txtApellidoM; ?>" placeholder="" id="txtApellidoM"
        require="">
      <br>
      <label for="">Telefono:</label>
      <input type="text" name="txtTelefono" value="<?php echo $txtTelefono; ?>" placeholder="" id="txtTelefono"
        require="">
      <br>
      <label for="">Correo:</label>
      <input type="text" name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="" id="txtCorreo" require="">
      <br>
      <label for="">Foto:</label>
      <input type="file" accept="image/*" name="txtFoto" value="<?php echo $txtFoto; ?>" placeholder="" id="txtFoto"
        require="">
      <br>

      <button class="" value="btnAgregar" type="submit" name="action">Agregar</button>
      <button value="btnModificar" type="submit" name="action">Modificar</button>
      <button value="btnEliminar" type="submit" name="action">Eliminar</button>
      <button value="btnCancelar" type="submit" name="action">Cancelar</button>
    </form>

    <table class="table">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nombre Completo</th>
          <th>Telefono</th>
          <th>Correo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <?php 
foreach ($listaEstudiantes as $estudiantes) { 
?>
      <tr>
        <td><img class="img-thumbnail" width="100px" src="/assets/<?php echo $estudiantes["Foto"]; ?>"></td>
        <td><?php echo $estudiantes["Nombre"]; ?> <?php echo $estudiantes["ApellidoP"]; ?>
          <?php echo $estudiantes["ApellidoM"]; ?></td>
        <td><?php echo $estudiantes["Telefono"]; ?></td>
        <td><?php echo $estudiantes["Correo"]; ?></td>
        <td>
          <form action="" method=" post">

            <input type="hidden" name="txtID" value="<?php echo $estudiantes["ID"];?>">
            <input type="hidden" name="txtNombre" value="<?php echo $estudiantes["Nombre"];?>">
            <input type="hidden" name="txtApellidoP" value="<?php echo $estudiantes["ApellidoP"];?>">
            <input type="hidden" name="txtApellidoM" value="<?php echo $estudiantes["ApellidoM"];?>">
            <input type="hidden" name="txtTelefono" value="<?php echo $estudiantes["Telefono"];?>">
            <input type="hidden" name="txtCorreo" value="<?php echo $estudiantes["Correo"];?>">
            <input type="hidden" name="txtFoto" value="<?php echo $estudiantes["Foto"];?>">
            <input type="submit" value="Seleccionar">
            <button value="btnEliminar" type="submit" name="action">Eliminar</button>

          </form>
        </td>
      </tr>
      <?php
}
?>

    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>