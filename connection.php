<?php
$server='localhost';
$db='trello';
$login='root';
$mdp='';
session_start();
// connection alabdd
try { 
	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp); //chemin de la base de données a ajouter avec login et mdp 
		
	}catch (Exception $e) { 
	die('Erreur : '.$e->getMessage());
	} 

//traitement de la connection
	$mail = $_POST['mail'];
	$pwd= $_POST['pwd'];
	$req = $linkpdo->prepare('select mail , mdp from user where mail like :mail and mdp like :pwd');
	$req->execute(array('mail' => $mail,
						'pwd' => $pwd)); 

	$data= $req -> fetch();
	// si pas trouvé dansla bdd
	if($data == null){
		?>
		<script type="text/javascript">
			window.alert("vos information n'on pas permis de vous identifier");
			 document.location.href="http://localhost/scan/index.php";
		</script>
		<?php
	}
	else{
		$_SESSION['mail']=$mail;
		$_SESSION['pwd']=$pwd;
		// recupere si le compte est admin ou pas
		$req = $linkpdo -> prepare('select admin from user where mail like :mail and mdp like :pwd');
		$req->execute(array('mail' => $mail , 'pwd' => $pwd));
		$data = $req -> fetch();
		$data = $data[0];
		
		
		if($data == 0 ){
			 header("Location: compte.php");
	}else{
		 header("Location: compteAdmin.php");
	}




		
	}
?>