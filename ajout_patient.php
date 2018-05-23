<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>



<?php

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$codePostal = $_POST['codePostal'];
$ville =$_POST['ville'];
$dateN =$_POST['dateN'];
$villeN = $_POST['villeN'];
$numSecu = $_POST['numSecu'];
$civilite = $_POST['civilite'];
$idMedecin = $_POST['idMedecin'];


///Connexion au serveur MySQL 
    try { 
        $linkpdo = new PDO("mysql:host=localhost;dbname=projetweb", "root", ''); 
    } 
    catch (Exception $e) { 
		die
		('Erreur : '. $e->getMessage()); 
    } 
///Préparation de la requête
    $req = $linkpdo->prepare('INSERT INTO patient (civilite, nom, prenom, adresse, codePostal, ville, dateN, villeN, numSecu, idMedecin) VALUES (:civilite, :nom, :prenom, :adresse, :codePostal, :ville, :dateN, :villeN, :numSecu, :idMedecin)');
///Exécution de la requête
    $req->execute (array (	
    						'civilite' =>$civilite,
							'nom' => $nom, 
							'prenom' => $prenom, 
							'adresse' => $adresse, 
							'codePostal' => $codePostal, 
							'ville' => $ville, 
							'dateN'=> $dateN,
							'villeN' => $villeN,
							'numSecu' => $numSecu,
							'idMedecin' => $idMedecin)); 

    echo "merci vos données ont bien été enregistrées :)";

    header('Location: http://localhost/git/projetweb/list_patient.php ');

?>

</body>
</html>