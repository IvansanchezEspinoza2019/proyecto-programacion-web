<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="border: 0px">
<div class="row content">	
   <header>
        HISTORIAL
   </header>
</div>
   <main>
<div style='color: #000; font-size: 20px; padding: 10px; border-radius: 10px; background:#1DE513; margin: 20px; '>
    HISTORIAL DE ACTIVACIONES A LO LARGO DEL TIEMPO
 </div>
<?php
    // servidor, usuario, contraseña, db
			$con=mysqli_connect("localhost","id17924027_edgar","yD\$YcwjU*X1Bvz7]","id17924027_iotdb");
	  
			// Verifica conneccion
			if (mysqli_connect_errno()) {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}  	  
	  
	  		// obtiene el estatus actual de la alarma y el usuario
			$result = mysqli_query($con,"SELECT * FROM Alarm_History WHERE alarm_id=1;");
            echo "<table>";
            echo " <tr>
                      <th>Accion</th>
                      <th>Fecha activación</th>
                      <th>Umbral de activación</th>
                      <th>Valor medido del sensor</th>
          </tr>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr><td>ACTIVADA</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['threshold']."</td>";
                echo "<td>".$row['sensor_value']."</td></tr>";
            }

            echo "</table>";
            echo "<div class='adust'><a class='historial' href='./index.php'>Regresar</a></div>";
?>

    
   </main>
</body>
</html>