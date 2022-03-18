<?php
//Conexión con mi base de datos con el método PDO


//En variables guardamos el nombre de nuestra base y el host, que en este caso es localhost que tiene asignada la dirección IP 217.0.0.1, usuario y contraseña.
$servername = "mysql:dbname=bootcamp;host=127.0.0.1";
$username = "root";
$password = "";


// Este uso del try nos va a permitir que si no hay ningún error nos conecte directamente a la base de datos
try {
  $conn = new PDO($servername, $username, $password);
  echo "Conexión exitosa :D";
  
} catch(PDOException $e) { //Y el catch no nos va a permitir entrar si hay un error.
  echo "Conexión fallida :( ".$e->getMessage();
}
?>