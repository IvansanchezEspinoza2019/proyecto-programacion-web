<?php
// valores que nos envían del formulario de la página principal
$value = $_POST['value'];
$unit = $_POST['unit'];
$column = $_POST['column'];
$value2 = $_POST['value2'];
$column2 = $_POST['column2'];


// host, usuario, contrseña, db
$con=mysqli_connect("localhost","id17924027_edgar","yD\$YcwjU*X1Bvz7]","id17924027_iotdb");
////////////////////////////////////////////////////////////////////////////////////////////////////// 

// verifica conneccion
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error(); 	//If no connection, give an error
}

// actualiza el status de la alarma del usuario
mysqli_query($con,"UPDATE Alarm_Status SET $column = '{$value}', $column2 = '{$value2}' WHERE id=$unit");

// regresa a la página principal
header("location: index.php");


?>