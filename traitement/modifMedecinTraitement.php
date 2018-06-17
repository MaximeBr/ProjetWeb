<?php
session_start();
$server='81.64.97.173';
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
 		$req = $linkpdo-> prepare('UPDATE medecin set nom = :val where idMedecin like :idUser ');
 		$req -> execute( array('val' => $nom , 'idUser'=> $_SESSION['idUser']));
 		
 	}

if(isset($_POST['prenom']) && $_POST['prenom']  != null ){
	
 		$prenom = $_POST['prenom'];
 		$req = $linkpdo-> prepare('UPDATE medecin set prenom = :val where idMedecin like :idUser ');
 		$req -> execute( array('val' => $prenom , 'idUser'=> $_SESSION['idUser']));
 		
 	}

 if(isset($_POST['civilite']) && $_POST['civilite']  != null ){
	
 		$civilite = $_POST['civilite'];
 		$req = $linkpdo-> prepare('UPDATE medecin set civilite = :val where idMedecin like :idUser ');
 		$req -> execute( array('val' => $civilite , 'idUser'=> $_SESSION['idUser']));
 		
 	}
header ('Location:  http://81.64.97.173/git/projetweb/list/list_medecin.php');

?>