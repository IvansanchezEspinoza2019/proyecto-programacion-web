<?php

/*
    Recibimos los valores del sensor mediante parámetros en el query string de la url
    EJemplo: https://alarm-iot.000webhostapp.com/RX.php?id=1&pw=123&s1=123
*/
foreach($_REQUEST as $key => $value)
{
	if($key =="id"){    // id de la alarma
	$unit = $value;
	}

	if($key =="pw"){    // contraseña 
	$pass = $value;
	}

	if($key =="s1"){   // el valor del sensor
	$sensor = $value;
	}	
}


// server, user, pass, database
$con=mysqli_connect("localhost","id17924027_edgar","yD\$YcwjU*X1Bvz7]","id17924027_iotdb");
 

// verifica la conneccion
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// ctuializa el vlor leído del sensor en la tabla de mysql
mysqli_query($con,"UPDATE Alarm_Status SET SENSOR_VALUE = $sensor WHERE id=$unit AND PASSWORD=$pass"); 


//tiempo
date_default_timezone_set('UTC');
$t1 = date('l jS \of F Y h:i:s A');

//Pull out the table
$result = mysqli_query($con,"SELECT * FROM Alarm_Status");//table select

//loop through the table and filter out data for this unit id
while($row = mysqli_fetch_array($result))
{
	if($row['id'] == $unit)
	{
		$d1 = $row['THRESHOLD'];
		$d2 = $row['SENSOR_VALUE'];
		$d3 = $row['ALARM_STATUS'];

		echo "_t1$t1##_d1$d1##_d2$d2##_d3$d3##";

		if($sensor > $d1)   // si el valor del sensor superó el umbral permitido para la activacion de la alarma
		{	
			if($d3 == 1) // si la alarm está activa y lista para dispararse
			{	
				// envía un email para notificar al usuario que la alarma ha sido activada
				mail("edgarse1945@gmail.com", "ALARMA", "EN $t1\nSENSOR: '$unit' superó el umbral '$d1' y el valor en tiempo real del sensor es de: '$sensor'\n\nLa puerta fue abierta!", "De: admin@gmail.com");
                // cambia el estado de la alarma
				mysqli_query($con,"UPDATE Alarm_Status SET ALARM_STATUS = '0' WHERE id=$unit AND PASSWORD=$pass");
			}
		}
	}
}
?>







