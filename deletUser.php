
<?php

$idUser=$_GET['user'];
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
	if (confirm("Etes vous sur de vouloir surpimer la participation de l'utilisateur à ce concour ? ")) {
		<?php

			$req= $linkpdo -> prepare('select id from user where  id like	:idUser');
   			$req -> execute(array('idUser'=> $idUser ));

   			$id = $req-> fetch();
   			$id = $id[0];

			$req = $linkpdo -> prepare('delete from participe where idUser like :idUser');
			$req-> execute(array('idUser' => $idUser));

			


   			$req = $linkpdo -> prepare('delete from participe where idUser like :idUser');
			$req-> execute(array('idUser' => $idUser));


		?>

		 document.location.href="http://localhost/scan/compteAdmin.php";
    		
		} else {
   			 document.location.href="http://localhost/scan/compteAdmin.php";
		}
</script>



?>