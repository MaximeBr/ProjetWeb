<?php


try { 
	$linkpdo = new PDO("mysql:host=localhost;dbname=projetweb", 'gael', ''); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 


// recupere le nombre de participant a cet evenement

$req = $linkpdo -> prepare('select count(*) from medecin');
	$req -> execute();
	$nbMedecin = $req -> fetch();
	$nbMedecin = $nbMedecin[0];

// recupere lid des user qui participe a cet event

$reqUser = $linkpdo -> prepare('select * from medecin');
$reqUser -> execute();


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
	<h2>Liste des medecins inscrit</h2>


	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="thead-dark">
				<th>Civilité</th>
				<th>Nom</th>
		        <th>Prenom</th>
		        <th>Suprimmer</th>
			</thead>

			<?php
			
			$i = 0 ;
			while($i < $nbMedecin) {
				$user = $reqUser -> fetch();
				//print_r($user);
				//$user = $user[0];
				$i = $i +1 ;
			?>
			<tbody>
				<tr>
					<td> <?php echo $user[3] ?>  </td>
					<td><a href="http://81.64.97.173/git/projetweb/form/modifierMedecin.php?user=<?php  echo $user[0]?>" class="btn btn-secondary"><?php echo $user[2] ?></td>
					<td> <?php echo $user[1] ?>  </td>
					<td><a href="http://81.64.97.173/git/projetweb/traitement/supprimerMerdin.php?user=<?php  echo $user[0]?>" class="btn btn-primary">Surprimer</td>
				</tr>
			</tbody>

		<?php
		}
		?>
		<input type="button" name="ajouter" value="nouveau medecin" class="btn btn-default" onclick="go()">
	</div>
</body>
</html>



<script type="text/javascript">
	function go () {
		document.location.href="http://81.64.97.173/git/projetweb/form/form_medecin.php";
	}
</script>