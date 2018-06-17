<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>



<?php

$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];

///Connexion au serveur MySQL 
    try { 
        $linkpdo = new PDO("mysql:host=81.64.97.173;dbname=projetweb", "root", ''); 
    } 
    catch (Exception $e) { 
		die
		('Erreur : '. $e->getMessage()); 
    } 
///Préparation de la requête
    $req = $linkpdo->prepare('INSERT INTO medecin (civilite, nom, prenom) VALUES (:civilite, :nom, :prenom)');
///Exécution de la requête
    $req->execute (array (	
    						'civilite' =>$civilite,
							'nom' => $nom, 
							'prenom' => $prenom)); 

    echo "merci vos données ont bien été enregistrées :)";

    header('Location: http://81.64.97.173/git/projetweb/list/list_medecin.php ');

?>

</body>
</html>