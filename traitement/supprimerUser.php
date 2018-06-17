
<?php

$idUser=$_GET['user'];
$server='localhost';
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
	if (confirm("Etes vous sur de vouloir surpimer ce patient ? ")) {
		<?php


   			$req = $linkpdo -> prepare('delete from patient where idUser like :idUser');
			$req-> execute(array('idUser' => $idUser));


		?>

		 document.location.href="http://localhost/git/projetweb/list/list_patient.php";
    		
		} else {
   			 document.location.href="http://localhost/git/projetweb/list/list_patient.php";
		}
</script>



?>