<?php
session_start();
$server='localhost';
$db='trello';
$login='root';
$mdp='';
$mail = $_POST['mail'];
$pwd= $_POST['pwd'];
//connection a la bdd
try {
				$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

			}
catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());

}













// si modification de l'email
if(isset($_POST['mail']) && $_POST['mail'] != null){
	$mail = $_POST['mail'];
	// verifie si l'email n'y est pas deja
	$req = $linkpdo ->prepare('select * from user where mail like :mail');
			$req->execute(
				array('mail' => $mail));
			
			$res = $req -> fetch();
			if($res != null){
				?>
					<script type="text/javascript">

						if (confirm("L'email existe deja! voulez vous recommencer ? ")) {
				    		document.location.href="http://localhost/scan/compte.php"
						} else {
				   			 document.location.href="http://localhost/scan/compte.php";
						}	
					</script>
				<?php

			}else{
				$req = $linkpdo -> prepare('update user set mail = :mail where mail like :preMail');
				$req -> execute(array('mail' => $mail , 'preMail' => $_SESSION['mail']));
				$_SESSION['mail']=$mail;
				?>
				<script type="text/javascript">
					window.alert("modification effectuer");
					document.location.href("http://localhost/scan/compte.php");
				</script>

				<?php
				
			}
}

if(isset($_POST['societe']) && $_POST['societe']  != null ){
	$societe = $_POST['societe'];
 		
 		$req = $linkpdo-> prepare('UPDATE user set societe = :val where mail = :mail ');
 		$req -> execute( array('val' => $societe , 'mail'=> $_SESSION['mail']));
 	}

if(isset($_POST['nom'])  && $_POST['nom']  != null ){
 		$nom = $_POST['nom'];
 		$req = $linkpdo-> prepare('UPDATE user set nom = :val where mail = :mail ');
 		$req -> execute( array('val' => $nom , 'mail'=> $_SESSION['mail']));
 	}

if(isset($_POST['prenom']) && $_POST['prenom']  != null ){
 		$prenom = $_POST['prenom'];
 		
 		$req = $linkpdo-> prepare('UPDATE user set prenom = :val where mail = :mail ');
 		$req -> execute( array('val' => $prenom , 'mail'=> $_SESSION['mail']));
 	}

 	if(isset($_POST['codePostale']) && $_POST['codePostale']  != null ){
 		$cp = $_POST['codePostale'];
 		$req = $linkpdo-> prepare('UPDATE user set cp = :val where mail = :mail ');
 		$req -> execute( array('val' => $cp , 'mail'=> $_SESSION['mail']));
 	}

 	if(isset($_POST['ville']) && $_POST['ville' ] != null ){
 		$ville = $_POST['ville'];
 		$req = $linkpdo-> prepare('UPDATE user set ville = :val where mail = :mail ');
 		$req -> execute( array('val' => $ville , 'mail'=> $_SESSION['mail']));
 	}
 	
 	if(isset($_POST['pwd']) && $_POST['pwd']  != null ){
 		$pwd = $_POST['pwd'];
 		$req = $linkpdo-> prepare('UPDATE user set mdp = :val where mail = :mail ');
 		$req -> execute( array('val' => $pwd , 'mail'=> $_SESSION['mail']));
 	}
 	if(isset($_POST['adr']) && $_POST['adr'] != null ){
 		$adr = $_POST['adr'];

 		$req = $linkpdo-> prepare('UPDATE user set adresse = :val where mail = :mail ');
 		$req -> execute( array('val' => $adr , 'mail'=> $_SESSION['mail']));
 	}

if(isset($_POST['civilite']) && $_POST['civilite' ] != null ){
	 		switch ($_POST['civilite']){
			case 'M': $civilite=1; break;
			case 'F': $civilite=0; break;
			}

	 		$req = $linkpdo-> prepare('UPDATE user set civilite = :val where mail = :mail ');
	 		$req -> execute( array('val' => $civilite , 'mail'=> $_SESSION['mail']));
 	}
 
 header("Location: compte.php");	
 	
 ?>
