<?php
session_start();
?>



<!DOCTYPE html>
<html>
<head>
	<title>Compte admin</title>
	<link rel="stylesheet" type="text/css" href="compteAdmin.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

</head>
<body>
	<header>
		<h1>Bienvenue Admin</h1>
	</header>

	<div class="container-fluid">
		<?php afficherEvenement() ;?>
	</div>

	
</body>
</html>


<?php






function afficherEvenement( ){
	$server='localhost';
	$db='trello';
	$login='root';
	$mdp='';

// connection alabdd
try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 





//recupere le nombre devenement
	$req = $linkpdo -> prepare('select count(*) from evenement ');
	$req -> execute();
	$nombreEvenement = $req -> fetch();
	$nombreEvenement = $nombreEvenement[0];

	?>
<!-- remplie les titre des colonnes -->
	<table class="table table-bordered ">
			  <thead class="thead-dark">
			    <tr>
			      
			      <th scope="col">Date</th>
			      <th scope="col">Adresse</th>
			      <th scope="col">Heure</th>
			      <th scope="col">Description</th>
			      <th scope="col">Nom</th>
			      <th scope="col">Code Postale</th>
			       <th scope="col">Ville</th>
			       <th scope="col">Surpimmer !</th>
			    </tr>
			  </thead>
	<?php


//recupere toute la liste des evenements 
	$req = $linkpdo -> prepare('select * from evenement ');
	$req -> execute();

	// affiches les informations
	$i = 0;
	while($i < $nombreEvenement) {
		$data= $req-> fetch();
		$i = $i +1 ;
		?>
		
			  <tbody>
			    <tr>
			      <!-- <td><button type="button" class="btn btn-secondary" onclick="voirInfo(<?php echo $i ?> )"> <?php echo $i ?> </button></td> -->
			      <td><?php echo $data[0] ?>   </td>
			      <td><?php echo $data[1] ?></td>
			      <td><?php echo $data[2] ?></td>
			      <td><?php echo $data[3] ?></td>
			      <td>
			      	<form method="post" action="infoParticipant">
			      		<input type="submit" name="nomEvent" value="<?php echo $data[4] ?>"> 
			      	</form>
			      </td>
			      <td><?php echo $data[5] ?></td>
			      <td><?php echo $data[6] ?></td>
			      <!-- <td><button type="button" class="btn btn-primary" onclick="Surpimmer()">Surpimmer</button></td> -->
			      <td>
			      	<a href="deletEvent.php?nomEvent=<?php  echo $data[4]?>" class="btn btn-primary"> delete</a>
			    </tr>
			    
			  


		<?php
		
	}
	?>

	</tbody>
	</table>


	<button type="button" class="btn btn-success" onclick="newEvent()">Ajouter un nouvel event</button>
	<button type="button" onclick="deco()" class="btn btn-default"> Deconnection</button>
	<?php

}


?>


<script type="text/javascript">
	function voirInfo(nombre){
		
		// recupere le nom de levenement
		var evenement = document.getElementsByTagName('table')[0].getElementsByTagName('tr')[nombre].cells[5].innerHTML;
		


	}


	function newEvent(){
		 document.location.href="http://localhost/scan/newEvent.php"
	}


	function deco(){
		document.location.href="http://localhost/scan/index.php"
	}
	
</script>


