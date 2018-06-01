<?php


try { 
	$linkpdo = new PDO("mysql:host=localhost;dbname=projetweb", 'root', ''); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 


// recupere le nombre de participant a cet evenement

$req = $linkpdo -> prepare('select count(*) from patient');
	$req -> execute();
	$nbPatient = $req -> fetch();
	$nbPatient = $nbPatient[0];

// recupere lid des user qui participe a cet event

$reqUser = $linkpdo -> prepare('select * from patient');
$reqUser -> execute();



$reqNomMed = $linkpdo -> prepare('select nom , prenom from medecin where idMedecin like :idMedecin');


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<?php include ("../static/navBar.php"); ?>
	<div class="container-fluid">
	<h2>Liste des patients inscrit</h2>


	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="thead-dark">
				<th>Civilité</th>
				<th>Nom</th>
		        <th>Prenom</th>
		        <th>Adresse</th>
		        <th>Code Postal</th>
		        <th>Ville</th>
		        <th>Date de naissance</th>
		        <th>Ville de naissance</th>
		        <th>Numero de sécurité</th>
		        <th>Medecin traitant</th>
			</thead>

			<?php
			
			$i = 0 ;
			while($i < $nbPatient) {
				// prochain utilisateur
				$user = $reqUser -> fetch();
				$i = $i +1 ;
				//recupere le nom du medecin traitant en fonction de son id
				$reqNomMed -> execute(array('idMedecin'=>$user[10]));
				$res = $reqNomMed -> fetch();
				$nomMed = $res[0];
				$prenomMed = $res[1];
			?>
			<tbody>
				<tr>
					<td> <?php echo $user[1] ?>  </td>
					<td> <?php echo $user[2] ?>  </td>
					<td> <?php echo $user[3] ?>  </td>
					<td> <?php echo $user[4] ?>  </td>
					<td> <?php echo $user[5] ?>  </td>
					<td> <?php echo $user[6] ?>  </td>
					<td> <?php echo $user[7] ?>  </td>
					<td> <?php echo $user[8] ?>  </td>
					<td> <?php echo $user[9] ?>  </td>
					<td> <?php echo $nomMed." ".$prenomMed ?>  </td>
					
				</tr>
			</tbody>

		<?php
		}
		?>
		<input type="button" name="ajouter" value="nouveau patient" class="btn btn-default" onclick="go()">

</body>
</html>



<script type="text/javascript">
	function go () {
		document.location.href="http://localhost/git/projetweb/form/form_patient.php";
	}
</script>