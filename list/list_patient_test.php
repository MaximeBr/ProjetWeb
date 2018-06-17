<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>
	<?php
				try {
				//On se connecte a MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb','gael','');
				}
				catch (Exception $e) {
					//En cas d'erreur, on affiche un message et on arrete tout
					die('Erreur : '.$e->getMessage());
				}

				$reponse = $bdd->prepare('SELECT * from patient');

				$reponse->execute();


				$result = $reponse->fetch();

				echo "$result[1]";
				echo "$result[2]";
				

	?>
</body>
</html>