<?php

$nom=$_GET['nomEvent'];
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


?>
<script type="text/javascript">
	if (confirm("Etes vous sur de vouloir surpimer cette evenement ? ")) {
		<?php

			$req= $linkpdo -> prepare('select id from evenement where nom like 	:nom');
   			$req -> execute(array('nom'=> $nom ));

   			$id = $req-> fetch();
   			$id = $id[0];

			$req = $linkpdo -> prepare('delete from evenement where nom like :nom');
			$req-> execute(array('nom' => $nom));

			


   			$req = $linkpdo -> prepare('delete from participe where idEvent like :idEvent');
			$req-> execute(array('idEvent' => $id));


		?>

		 document.location.href="http://localhost/scan/compteAdmin.php";
    		
		} else {
   			 document.location.href="http://localhost/scan/compteAdmin.php";
		}
</script>


