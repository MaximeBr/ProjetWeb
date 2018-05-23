<?php

//conectionbdd
$server='localhost';
	$db='trello';
	$login='root';
	$mdp='';

// connection alabdd
try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 



$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$ville =$_POST['ville'];
$codeP = $_POST['codeP'];
$date= $_POST['date'];
$heure =$_POST['heure'];
$description =$_POST['description'];




if($_POST['nom'] != null && $_POST['ville']!= null && $_POST['adresse'] != null && $_POST['codeP']!= null && $_POST['date'] != null && $_POST['heure'] && $_POST['description'] =! null ){
	
	$req = $linkpdo -> prepare('insert into evenement (nom , ville , adresse , cp , date , heure , description) values (:nom , :ville , :adresse , :cp , :date , :heure , :description)');

	$req -> execute(array('nom' => $nom , 'ville' => $ville , 'adresse' => $adresse , 'cp' => $codeP , 'date' => $date  , 'heure' => $heure  , 'description' => $description  ));


	$req = $linkpdo -> prepare('select nom from evenement where nom like :nom');
	$req-> execute(array('nom' => $nom));

	$res = $req -> fetch();
	$res = $res[0];
	if($res == null){
		?>

		<script type="text/javascript">
			if (confirm("Les information n'ont pas été saisies correctement! voulez vous recommencer ? ")) {
    		document.location.href="http://localhost/scan/newEvent.php"
		} else {
   			 document.location.href="http://localhost/scan/compteAdmin.php";
		}
		</script>

		<?php
	}else{
		?>
		<script type="text/javascript">
			alert("levenement à bien été ajouté");
			document.location.href="http://localhost/scan/compteAdmin.php"
		</script>

		<?php
	}

	

}else{
	?>
	<script type="text/javascript">
		if (confirm("Les information n'ont pas été saisies correctement! voulez vous recommencer ? ")) {
    		document.location.href="http://localhost/scan/newEvent.php"
		} else {
   			 document.location.href="http://localhost/scan/compteAdmin.php";
		}	
	</script>

	<?php
}


?>