
<?php

$idUser=$_GET['user'];
$server='81.64.97.173';
	$db='projetweb';
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
	if (confirm("Etes vous sur de vouloir surpimer ce medecin ? ")) {
		<?php


   			$req = $linkpdo -> prepare('delete from medecin where idMedecin like :idUser');
			$req-> execute(array('idUser' => $idUser));


		?>

		 document.location.href="http://81.64.97.173/git/projetweb/list/list_medecin.php";
    		
		} else {
   			 document.location.href="http://81.64.97.173/git/projetweb/list/list_medecin.php";
		}
</script>



?>