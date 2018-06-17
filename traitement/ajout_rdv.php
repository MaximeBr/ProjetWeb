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
        $linkpdo = new PDO("mysql:host=localhost;dbname=projetweb", "gael", ''); 
    } 
    catch (Exception $e) { 
		die
		('Erreur : '. $e->getMessage()); 
    }
//selectionne l'id en fnction du nom prenom
    //coupe le nom du patient
$val= explode(" ", $patient);
$reqPatient = $linkpdo -> prepare('select idUser from patient where ( nom like :nom and prenom like :prenom ) or  ( nom like :nomTest and prenom like :prenomTest)  ');

$reqPatient -> execute(array('nom' => $val[0] , 'prenom' => $val[1] , 'nomTest' => $val[1] , 'prenomTest' => $val[0]) );
$res = $reqPatient -> fetch();
if($res == null){
    ?>
    <script type="text/javascript">
        alert("Patient introuvable, veuillez saisir nom et prenom ou prenom et nom");
        document.location = 'http://81.64.97.173/git/projetweb/form/form_rdv.html';
    </script>
    <?php 
}
$idPatient= $res[0];



//recupere l'id du médecin en fonction de son nom et sn prenom
$val= explode(" ", $medecin);
$reqMedecin = $linkpdo -> prepare('select idMedecin from medecin where ( nom like :nom and prenom like :prenom ) or  ( nom like :nomTest and prenom like :prenomTest)  ');

$reqMedecin -> execute(array('nom' => $val[0] , 'prenom' => $val[1] , 'nomTest' => $val[1] , 'prenomTest' => $val[0]) );
$res = $reqMedecin -> fetch();
if($res == null){
    ?>
    <script type="text/javascript">
        alert("Medecin introuvable, veuillez saisir nom et prenom ou prenom et nom");
        document.location = 'http://81.64.97.173/git/projetweb/form/form_rdv.html';
    </script>
    <?php 
}
$idMedecin= $res[0];


///Préparation de la requête
    $req = $linkpdo->prepare('INSERT INTO rdv (duree, dateR, idMedecin, idUser) VALUES (:duree, :dateR, :idMedecin, :idUser)');
///Exécution de la requête
    $req->execute (array (	
    						'duree' =>$duree,
							'dateR' => $date,
							'idMedecin' => $idMedecin, 
							'idUser' => $idPatient)); 

    header('Location: http://81.64.97.173/git/projetweb/list/list_rdv.php');

?>

</body>
</html>