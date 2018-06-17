

<?php



	//Récupération des paramètres du formulaire 
	$identifiant = $_POST['identifiant']; 
	$mdp = $_POST['mdp'];

	//Affichage des paramètres 
	echo "identifiant : $identifiant ";
	echo "mdp : $mdp <br/>";

	try {
			//On se connecte a MySQL
			$bdd = new PDO('mysql:host=localhost;dbname=projetweb','root','maxime');
		}
		catch (Exception $e) {
			//En cas d'erreur, on affiche un message et on arrete tout
			die('Erreur : '.$e->getMessage());
		}

		$requete = $bdd->prepare('SELECT * from utilisateur where identifiant like :identifiant');

		$requete->execute(array('identifiant' => $identifiant));

		$reponse = $requete->fetch();
		$mdp_b = $reponse[1];


		if($mdp == $mdp_b) {
			header('Location: http://localhost/git/ProjetWeb/list/list_rdv.php');
		}

		else {
			echo "mdp faux";
		}


 ?>