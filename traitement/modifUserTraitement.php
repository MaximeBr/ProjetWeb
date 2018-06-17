<?php

session_start();
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


if(isset($_POST['nom']) && $_POST['nom']  != null ){
	$nom = $_POST['nom'];
 		echo $nom;
 		$req = $linkpdo-> prepare('UPDATE patient set nom = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $nom , 'idUser'=> $_SESSION['idUser']));
 		
 	}
if(isset($_POST['prenom']) && $_POST['prenom']  != null ){
	$prenom = $_POST['prenom'];
 		echo $prenom;
 		$req = $linkpdo-> prepare('UPDATE patient set prenom = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $prenom , 'idUser'=> $_SESSION['idUser']));
 		
 	}

  	
if(isset($_POST['adresse']) && $_POST['adresse']  != null ){
	$adresse = $_POST['adresse'];
 		echo $adresse;
 		$req = $linkpdo-> prepare('UPDATE patient set adresse = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $adresse , 'idUser'=> $_SESSION['idUser']));
 		
 	}
 	 	
if(isset($_POST['codePostal']) && $_POST['codePostal']  != null ){
	$codePostal = $_POST['codePostal'];
 		echo $codePostal;
 		$req = $linkpdo-> prepare('UPDATE patient set codePostal = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $codePostal , 'idUser'=> $_SESSION['idUser']));
 		
 	}
 	 	
if(isset($_POST['ville']) && $_POST['ville']  != null ){
	$ville = $_POST['ville'];
 		echo $prenom;
 		$req = $linkpdo-> prepare('UPDATE patient set ville = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $ville , 'idUser'=> $_SESSION['idUser']));
 		
 	}
 	if(isset($_POST['dateN']) && $_POST['dateN']  != null ){
	$dateN = $_POST['dateN'];
 		echo $prenom;
 		$req = $linkpdo-> prepare('UPDATE patient set dateN = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $dateN , 'idUser'=> $_SESSION['idUser']));
 		
 	}
 	if(isset($_POST['villeN']) && $_POST['villeN']  != null ){
	$villeN = $_POST['villeN'];
 		echo $prenom;
 		$req = $linkpdo-> prepare('UPDATE patient set villeN = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $villeN , 'idUser'=> $_SESSION['idUser']));
 		
 	}
 	if(isset($_POST['numSecu']) && $_POST['numSecu']  != null ){
	$numSecu = $_POST['numSecu'];
 		echo $prenom;
 		$req = $linkpdo-> prepare('UPDATE patient set numSecu = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $numSecu , 'idUser'=> $_SESSION['idUser']));
 		
 	}



 	if(isset($_POST['civilite']) && $_POST['civilite']  != null ){
	$civilite = $_POST['civilite'];
 		echo $civilite;
 		$req = $linkpdo-> prepare('UPDATE patient set civilite = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $civilite , 'idUser'=> $_SESSION['idUser']));
 		
 	}

 	if(isset($_POST['idMedecin']) && $_POST['idMedecin']  != null ){
	$idMedecin = $_POST['idMedecin'];
 		echo $idMedecin;
 		$req = $linkpdo-> prepare('UPDATE patient set idMedecin = :val where idUser like :idUser ');
 		$req -> execute( array('val' => $idMedecin , 'idUser'=> $_SESSION['idUser']));
 		
 	}


header ('Location:  http://localhost/git/projetweb/list/list_patient.php');

?>