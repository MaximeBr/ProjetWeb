<?php
include ("../static/navBar.php");

$server='localhost';
$db='projetweb';
$login='root';
$mdp='';
//connection a la bdd
try {
				$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
			}
catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());

}
//recupere le nombre de patent enregister
$reqNombre = $linkpdo -> prepare('select count(*) from patient');
$reqNombre -> execute();
$nombrePatient = $reqNombre -> fetch();
$nombrePatient = $nombrePatient[0];

$req = $linkpdo -> prepare('select count(*) from medecin');
	$req -> execute();
	$nbMedecin = $req -> fetch();
	$nbMedecin = $nbMedecin[0];

// recupere lid des user qui participe a cet event

$reqUser = $linkpdo -> prepare('select * from medecin');
$reqUser -> execute();


//recupere les données pour les moins de 25 ans 
$reqJeune = $linkpdo -> prepare('select dateN , civilite from patient  ');
$reqJeune -> execute();
$i = 0 ;
$jeuneF =0  ;
$interF =0;
$vieuxF =0;
$jeuneM =0  ;
$interM =0;
$vieuxM =0;
while ( $i < $nombrePatient) {
	$i = $i +1 ;
	$res =  $reqJeune -> fetch();
	$civilite = $res[1];
	$res = $res[0];
	$timestamp = strtotime($res);
	$age = time() - $timestamp;
	$age = $age / 31536000 ;
	if($age < 25 && $civilite == "M" ){
		$jeuneM++;
	}
	if($age >=  25 && $age <= 50 && $civilite == "M" ){
		$interM ++;
	}
	if($age > 50 && $civilite == "M"){
		$vieuxM++;
	}


	//pour les femmes
	if($age < 25 && $civilite == "F" ){
		$jeuneF++;
	}
	if($age >=  25 && $age <= 50 && $civilite == "F" ){
		$interF ++;
	}
	if($age> 50 && $civilite == "F"){
		$vieuxF++;
	}


}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container-fluid">
		<h2>Les valeurs utiles : </h2>
		<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Tranche d'age</th>
      <th scope="col">Nombre d'hommes</th>
      <th scope="col">Nombre de femme</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Moins de 25 ans</th>
      <td><?php echo $jeuneM ; ?> </td>
      <td><?php echo $jeuneF ; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Entre 25 et 50 ans</th>
      <td><?php echo $interM ; ?></td>
      <td><?php echo $interF ; ?></td>
      
    </tr>
    <tr>
      <th scope="row">Plus	de 50 ans</th>
      <td><?php echo $vieuxM ; ?></td>
      <td><?php echo $vieuxF ; ?></td>
    </tr>
  </tbody>
</table>


	<div class="table-responsive">
		<table class="table table-bordered">
			<h2>Liste des médecin et leur durée cummulé de rendrez-vous</h2>
			<thead class="thead-dark">
				
				<th>Nom</th>
		        <th>Prenom</th>
		        <th>Minutes de consultations en heures</th>
			</thead>

			<?php
			
			$i = 0 ;
			while($i < $nbMedecin) {
				$user = $reqUser -> fetch();
				//recupere le temps pour chaque medecin
				$reqMinutes = $linkpdo -> prepare('select sum(duree) from rdv where idMedecin like :idMedecin');
				$reqMinutes -> execute(array('idMedecin' => $user[0]));
				$resMinutes = $reqMinutes -> fetch();
				$resMinutes = $resMinutes[0];
				$resMinutes /= 60 ;
				$i = $i +1 ;
			?>
			<tbody>
				<tr>
					
					<td><?php echo $user[2] ?></td>
					<td> <?php echo $user[1] ?>  </td>
					<td><?php echo round($resMinutes,3) ?></td>
				</tr>
			</tbody>

		<?php
		}
		?>
	
	</div>
		
	</div>

</body>
</html>