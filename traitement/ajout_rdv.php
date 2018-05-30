<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>



<?php

$date = $_POST['date'];
$duree = $_POST['duree'];
$medecin = $_POST['medecin'];
$patient = $_POST['patient'];


///Connexion au serveur MySQL 
    try { 
        $linkpdo = new PDO("mysql:host=localhost;dbname=projetweb", "root", ''); 
    } 
    catch (Exception $e) { 
		die
		('Erreur : '. $e->getMessage()); 
    } 
///Préparation de la requête
    $req = $linkpdo->prepare('INSERT INTO rdv (duree, dateR, idMedecin, idPatient) VALUES (:duree, :dateR, :idMedecin, :idPatient)');
///Exécution de la requête
    $req->execute (array (	
    						'duree' =>$duree,
							'dateR' => $date,
							'idMedecin' => $idMedecin, 
							'idPatient' => $idPatient)); 

    echo "merci vos données ont bien été enregistrées :)";

    header('Location: http://localhost/git/projetweb/list/list_rdv.php');

?>

</body>
</html>