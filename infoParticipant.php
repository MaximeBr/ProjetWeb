<?php

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 


$nomEvent = $_POST['nomEvent'];


//recupere lid de levenement
$req= $linkpdo -> prepare('select id from evenement where nom like 	:nomEvent');
$req -> execute(array('nomEvent'=> $nomEvent ));

$idEvent = $req -> fetch();
$idEvent = $idEvent[0];

// recupere le nombre de participant a cet evenement

$req = $linkpdo -> prepare('select count(*) from participe where idEvent like :idEvent ');
	$req -> execute(array('idEvent'=> $idEvent ));
	$nombreParticipant = $req -> fetch();
	$nombreParticipant = $nombreParticipant[0];

// recupere lid des user qui participe a cet event

$reqUser = $linkpdo -> prepare('select idUser from participe where idEvent like :idEvent');
$reqUser -> execute(array('idEvent'=> $idEvent ));






?>



<!DOCTYPE html>
<html>
<head>
	<title>Infoparticipants</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>


<div class="container-fluid">
	<h2>Liste des utilisateurs participants à : <?php echo $nomEvent ?></h2>


	<div class="table-responsive">
		<table class="table table-bordered">
			<thead class="thead-dark">
				<th>Nom</th>
		        <th>Prenom</th>
		        <th>Societe</th>
		        <th>Civilite</th>
		        <th>Adresse</th>
		        <th>Ville</th>
		        <th>Code postale</th>
		        <th>Suprimer</th>
			</thead>

			<?php
			
			$i = 0 ;
			while($i < $nombreParticipant) {
				$user = $reqUser -> fetch();
				$user = $user[0];
				$i = $i +1 ;
			?>
			<tbody>
				<tr>
					<td> <?php echo(getNom($user)) ?>  </td>
					<td> <?php echo(getPrenom($user)) ?>  </td>
					<td> <?php echo(getSociete($user)) ?> </td>
					<td> <?php echo(getCivilite($user)) ?></td>
					<td> <?php echo(getAdresse($user)) ?></td>
					<td>  <?php echo(getVille($user)) ?></td>
					<td> <?php echo(getCodeP($user)) ?></td>
					<td><a href="deletUser.php?user=<?php  echo $user?>" class="btn btn-primary"> delete</a></td> 
					
				</tr>
			</tbody>

		<?php
		}
		?>


		</table>
		<button type="button" onclick="annuler()" class="btn btn-default"> Annuler</button>
	</div>
</div>




</body>
</html>


<script type="text/javascript">
	function annuler(){
		 document.location.href="http://localhost/scan/compteAdmin.php";
	}
</script>


<?php

// toute les fonctions sont les meme ya que la requete qui change

function getNom($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select nom from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;


}




function getPrenom($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select prenom from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;

}


function getSociete($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select societe from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;

}


function getCivilite($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select civilite from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

if($res == 0){
	$res = "F";
}
else{
	$res = "M";
}

return $res ;

}





function getAdresse($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select adresse from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;

}

function getVille($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select ville from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;

}


function getCodeP($idUser){

$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';

try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

$req = $linkpdo -> prepare('select codePostale from user where id like :idUser');
$req -> execute(array('idUser'=> $idUser));
$res = $req -> fetch();
$res = $res[0];

return $res ;

}



?>