<?php
//para refrescar el sitio we cada cierto tiempo
$page = $_SERVER['PHP_SELF'];
$sec = "15";
?>


<html><head>
<meta charset="utf-8">
<title>IoT Alarm</title>	
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">		
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> <!-- Bootstrap-->
    <link rel="stylesheet" href="styles.css">
</head>

	
<body>	
<div class="row content">	
    <header>HOME</header>

	<div style="padding: 40px;"> 	
		<div class="row content" style="margin-bottom: 300px;">
			<?php
		
			// Credenciales de la base de datos del sitio
            // servidor, usuario, contraseña, db
			$con=mysqli_connect("localhost","id17924027_edgar","yD\$YcwjU*X1Bvz7]","id17924027_iotdb");
	  
			// Verifica conneccion
			if (mysqli_connect_errno()) {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}  	  
	  
	  		// obtiene el estatus actual de la alarma y el usuario
			$result = mysqli_query($con,"SELECT * FROM Alarm_Status INNER JOIN Users ON Users.user_id=Alarm_Status.User_ID INNER JOIN User_Info ON User_Info.user_id=Users.user_id WHERE Alarm_Status.id=1 LIMIT 1;");//table select
 
            
			while($row = mysqli_fetch_array($result)) {
                // columnas de la base de datos
				$column = "THRESHOLD";
				$column2 = "ALARM_STATUS";
				$column3 = "SENSOR_VALUE";

                // umbral de activicion de la alarma
				$current_THRESHOLD = $row['THRESHOLD'];	
				$current_SENSOR = $row['SENSOR_VALUE'];	
				$current_ALARM_STATUS = $row['ALARM_STATUS'];

                // si la alarma esta activa pero sin disprrse
				if($current_ALARM_STATUS == 1){
					$label_sent_bool_1 = "label-success";
					$text_sent_bool_1 = "NO ALARM";
				}  // si la alarma se disparó
				else{
					$label_sent_bool_1 = "label-danger";
					$text_sent_bool_1 = "MAIL SENT";
				}

                echo "<div><h2 class='user-name'>Bienvenido ";
                    echo $row["first_name"];
                echo "</h2></div>";
				echo "<div style='color: #000; font-size: 40px; padding: 10px; border-radius: 10px; background:#e6e6e6; '>";
					$unit_id = $row['id'];
					echo "Alarm ID: '" .$row['id']."'"; 		
				echo "</div>";

                echo "<br><div style='color: #000; font-size: 20px; padding: 10px; border-radius: 10px; background:#1DE513; '>";
                echo "Estado de la alarma"; 		
                echo "</div>";

                echo "<br><section>";
				echo "<div  class='sensor-value'>";
                echo "<p claas='sensorTitle'>VALOR DEL SENSOR</p><br>";
					$unit_id = $row['id'];
					echo "Valor tiempo real: "  .$row['SENSOR_VALUE']; 		
				echo "</div>";

				echo "<div  class='treshold'";
                echo "<p claas='sensorTitle'>UMBRAL ACTUAL</p><br>";
					$unit_id = $row['id'];
					echo "Umbral: " .$row['THRESHOLD'];; 
                    /* Cambiar los valores del umbral de activacion de la alarma*/
					echo "<td><form style='float: left; margin: 0px; padding: 0px; font-size:20px;' action=backend_user_alarm.php method= 'post'>
					<input type='text' name='value' value=$current_THRESHOLD  size='15' >
					<input type='hidden' name='unit' value=$unit_id >
					<input type='hidden' name='column' value=$column >

					<input type='hidden' name='value2' value=$current_SENSOR  size='15' >
					<input type='hidden' name='unit' value=$unit_id >
					<input type='hidden' name='column2' value=$column3 >

					<input type= 'submit' name= 'change_but' style='text-align:center' value='change'></form></td>";
				echo "</div>";

                 /* estado de la alrma, (resetearla)*/
				echo "<div  class='alarm-status'>";
					$unit_id = $row['id'];
					echo "Alarm status: <br>"; 
					echo "<span style='font-size: 18px;' class='label $label_sent_bool_1'>" . $text_sent_bool_1 . "</span> <br>";
					echo "<form style='float: left; margin: 0px; padding: 0px; font-size:20px;' action=backend_user_alarm.php method= 'post'>
					<input type='hidden' name='value' value='1'  size='15' >
					<input type='hidden' name='unit' value=$unit_id >
					<input type='hidden' name='column' value=$column2 >	

					<input type='hidden' name='value2' value='0'  size='15' >
					<input type='hidden' name='unit' value=$unit_id >
					<input type='hidden' name='column2' value=$column3 >	

					<input type= 'submit' name= 'change_but' id='change_but' style='text-align:center' value='Reset'></form>";
				echo "</div>";
                echo "</section>";

                echo "<div class='adust'><a class='historial' href='./history.php'>Ver Historial</a></div>";

			}
			?>
			<div class="clearfix"></div>				
		</div>
	</div>
	
	<div class="col-sm-2"></div>  <?php /*?>Just an empty div<?php */?>																					
</div>	
</body>	
</html>