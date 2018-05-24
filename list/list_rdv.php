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

$reqUser = $linkpdo -> prepare('select * from rdv');
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
	<h2>Liste des RDV</h2>


</body>
</html>



<script type="text/javascript">
	function go () {
		document.location.href="http://localhost/git/projetweb/form_patient.php";
	}
</script>