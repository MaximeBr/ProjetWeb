<?php


try { 
	$linkpdo = new PDO("mysql:host=81.64.97.173;dbname=projetweb", 'root', ''); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 


// recupere le nombre de participant a cet evenement

$req = $linkpdo -> prepare('select count(*) from rdv');
	$req -> execute();
	$nbPatient = $req -> fetch();
	$nbPatient = $nbPatient[0];

// recupere lid des user qui participe a cet event

$reqRdv = $linkpdo -> prepare('select * from rdv order by dateR desc ');
$reqRdv -> execute();


$reqPatient = $linkpdo -> prepare('select nom , prenom from patient where idUser like :idUser');
$reqMedecin = $linkpdo -> prepare('select nom , prenom from medecin where idMedecin like :idMedecin');




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
	<meta charset="utf-8">
</head>
<body>

	<?php include ("../static/navBar.php"); ?>
	<div class="container-fluid">
	<h2>Liste des RDV</h2>

	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="thead-dark">
				<th>Date</th>
				<th>Durée</th>
		        <th>Patient</th>
		        <th>Docteur</th>
		        <th>Surpimmer</th>
			</thead>

			<?php
			
			$i = 0 ;
			while($i < $nbPatient) {
				$user = $reqRdv -> fetch();
				$idUser = $user[4];
				$idMedecin = $user[3];
				$reqPatient -> execute(array( 'idUser' => $idUser));
				$reqMedecin -> execute(array( 'idMedecin' => $idMedecin));
				$nomPrenomP = $reqPatient -> fetch();
				$nomP = $nomPrenomP[0];
				$prenomP = $nomPrenomP[1];

				//info du medecin
				$nomPrenomM = $reqMedecin -> fetch();
				$nomM = $nomPrenomM[0];
				$prenomM = $nomPrenomM[1];
				
				$i = $i +1 ;
			?>
			<tbody>
				<tr>
					<td> <?php echo $user[2] ?>  </td>
					<td> <?php echo $user[1]." minutes" ?>  </td>
					<td> <?php echo $nomP." ".$prenomP ?>  </td>
					<td> <?php echo $nomM." ".$prenomM ?>  </td>
					<td> ><a href="http://81.64.97.173/git/projetweb/traitement/supprimerRdv.php?user=<?php  echo $user[0]?>" class="btn btn-primary">Suprimmer </td>
				</tr>
			</tbody>

		<?php
		}
		?>
		<input type="button" name="ajouter" value="nouveau rdv" class="btn btn-default" onclick="go()">

</body>
</html>



<script type="text/javascript">
	function go () {
		document.location.href="http://81.64.97.173/git/projetweb/form/form_rdv.html";
	}
</script>