<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "robot_mapping";



$conn = mysqli_connect($servername, $username, $password,$db);


	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}

if (isset($_POST['save'])) {
						$forwards = mysqli_real_escape_string($conn, $_POST['Forwards']);
						$right = mysqli_real_escape_string($conn, $_POST['Right']);
						$left = mysqli_real_escape_string($conn, $_POST['Left']);
						$Transition_process = mysqli_real_escape_string($conn, $_POST['Transition_process']);

				$sql = "INSERT INTO `directions` ( `Forwards`, `Right`, `Left`, `Transition_process`) 
				VALUES ( '$forwards','$right', '$left' , '$Transition_process')";
				
				if(mysqli_query($conn, $sql)){
							
						} else {
							echo 'query error: '. mysqli_error($conn);
						}
						mysqli_close($conn);
	}
 ?>


<!DOCTYPE html>
<meta charset="UTF-8">
<html>

<head>
    <title>robot mapping</title>
    <main>Robots control panel </main>

<link rel="stylesheet" href="style.css"> 
</head>

<body>
    <div class="container">
	<form  action="index.php" method="POST">
							<label>Transition process: </label>
							<input type="text" name="Transition process" class="Transition_process" placeholder="first letter, such as R: right" ><br>
							<label>Forwards steps:</label>
							<input type="text" name="Forwards" class = "Forwards inputF"><br>
							<label>Right steps:</label>
							<input type="text" name="Right" class = "Right inputR"><br>
							<label>Left steps:</label>
							<input type="text" name="Left" class = "Left inputL"><br>
							<input type="submit" name="save" value="save in database" id="save">
							<input type="submit" name="start" value="start" id="start" >
					</form>

					</div>
		<div class="Draw">		
				<button class="buttonD">Draw the direction</button>
		</div>
		

			  <?php  	
			  if(isset($_POST['start'])){
							$sql = 'SELECT * FROM `directions`';

							
							$result = mysqli_query($conn, $sql);

							
							$directions = mysqli_fetch_all($result, MYSQLI_ASSOC);				
			  ?>

				
			  <table style="width:100%" >
		  <tr>
		    
		    <th>Forwards</th>
		    <th>Right</th>
		    <th>Left</th>
		    <th>Transition Process</th>
		  </tr>
		  <tr>
		    
		    <td><?php echo  $directions[count($directions)-1]['forwards']; ?></td>
		    <td><?php echo  $directions[count($directions)-1]['right']; ?></td>
		    <td><?php echo  $directions[count($directions)-1]['left']; ?></td>
		    <td><?php echo  $directions[count($directions)-1]['Transition_process']; ?></td>
		  </tr>
		  <?php mysqli_free_result($result);
			mysqli_close($conn); }
			?>
			  </table>
			  

		 <canvas id="c" width="500" height="500"></canvas>

		<script type="text/javascript" src="map.js"></script>
</body>
</html>