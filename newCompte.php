<?php

session_start();

$societe=null;
$civilite=null;
$nom=null;
$prenom=null;
$adr=null;
$cp=null;
$ville=null;
$mail=null;


// si tous champs on été remplies
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['societe']) && isset($_POST['mail']) && isset($_POST['civilite']) && isset($_POST['adr']) && isset($_POST['pwd'])  && isset($_POST['codePostale']) && isset($_POST['ville'])){
	
	$societe=$_POST['societe'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$adr=$_POST['adr'];
	$codePostale=$_POST['codePostale'];
	$ville=$_POST['ville'];
	$mail=$_POST['mail'];
	$pwd=$_POST['pwd'];
	$nomEvenement = $_POST['nomEvenement'];

	switch ($_POST['civilite']){
		case 'M': $civilite=1; break;
		case 'F': $civilite=0; break;
	}

	if(isset($_POST['enregistrer'])) {
			$server='localhost';
			$db='trello';
			$login='root';
			$mdp='';
			///Connexion au serveur MySQL
			try {
				$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

			}
			catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());

			}

			//verifie si lemail eiste deja dans la bdd
			$req = $linkpdo ->prepare('select * from user where mail like :mail');
			$req->execute(
				array('mail' => $mail));
			
			$res = $req -> fetch();
			if($res != null){
				?>
					<script type="text/javascript">

						if (confirm("L'email existe deja! voulez vous recommencer ? ")) {
				    		document.location.href="http://localhost/scan/ihmSaisie.php"
						} else {
				   			 document.location.href="http://localhost/scan/index.php";
						}	
					</script>
				<?php

			}

			// lemail nexiste pas deja donc on peut sauvegarder
			else{
				///Préparation de la requête
				$req = $linkpdo->prepare('INSERT INTO user(societe, civilite, nom, prenom, adresse, codePostale, ville, mail , mdp) VALUES(:societe, :civilite, :nom, :prenom, :adr, :codePostale, :ville, :mail , :pwd)');

				///Exécution de la requête
				$req->execute(
					array('societe' =>$societe ,
				'civilite' => $civilite ,
				'nom' => $nom ,
				'prenom' => $prenom,
				'adr' => $adr,
				'codePostale' => $codePostale, 
				'ville' => $ville,
				'pwd' => $pwd,
				'mail' => $mail));

				$_SESSION['pwd']=$pwd;
				$_SESSION['mail']=$mail;


				//sauvegarde dans la table participe
				//recupere d'abord les id de lutilisateur et de levenement

				$req = $linkpdo -> prepare('select id from user where mail like :mail and mdp like :pwd');
				$req -> execute(array('mail'=> $mail , 'pwd' =>  $pwd 

				));

				$idUser = $req -> fetch();
				$idUser = $idUser[0];


				// recupere id event

				$req = $linkpdo -> prepare('select id from evenement where nom like :nomEvenement');
				$req -> execute(array('nomEvenement'=> $nomEvenement));
				$idEvent = $req -> fetch();
				$idEvent = $idEvent[0];

				

				// sauvegarde sa participation au concour


				$req = $linkpdo -> prepare('INSERT into participe(idUser , idEvent) values(:idUser , :idEvent)');

				$req->execute(array('idEvent' => $idEvent , 'idUser'=> $idUser

					 ));


				envoyerMail($idUser,$idEvent,$mail,$pwd);
				

				header("Location: compte.php");

			}


			
			
			
	}

// si tous les champs n'ont pas été remplis ont demande si il veut recommencer si oui il recommence si non il va page d'acceuil
}else{
	?>
	<script type="text/javascript">

		if (confirm("Les information n'ont pas été saisies correctement! voulez vous recommencer ? ")) {
    		document.location.href="http://localhost/scan/ihmSaisie.php"
		} else {
   			 document.location.href="http://localhost/scan/index.php";
		}	
	</script>
	<?php

	
}



function envoyerMail($idUser,$idEvent,$mailUser,$pwd){
$mail = $mailUser; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Salut à tous, voici un e-mail envoyé par un script PHP.";
$message_html = genererMessage();
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Inscription au concour !";
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Gael B\"<gael.benaissa1@gmail.fr>".$passage_ligne;
$header.= "Reply-to: \"Gael B\" <gael.benaissa1@gmail.com>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========





$mail = $mailUser; 
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========

echo "mail enovyer";





}



function genererMessage(){

$server='localhost';
$db='trello';
$login='root';
$mdp='';
//connection a la bdd
try {
				$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

			}
catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());

}


//recupération des inforamtion de l'utilisateur
$req = $linkpdo-> prepare('select prenom, nom , societe , adresse , ville , codePostale , mail  from user where mail like :mail and mdp like :pwd');

$req->execute(array('mail' => $mailUser, 'pwd' => $pwd ));

$res = $req -> fetch();

$prenom = $res[0];
$nom = $res[1];
$societe = $res[2];
$adresse = $res[3];
$ville = $res[4];
$codePostale = $res[5];
$mail = $res[6];


//recuperation des info de l'evenement
$req = $linkpdo-> prepare(' select date , adresse , heure , description , nom , cp , ville   from evenement where id = 1');

$req -> execute();
$response= $req -> fetch();

$date = $response[0];

$adresseEvent = $response[1];

$heure = $response[2];

$description = $response[3];

$nomEvent = $response[4];

$cpEvent = $response[5];
$villeEvent = $response[6];




$message = "<h2>Merci d'imprimer cette invitation </h2>";

//les information de la personne
$message.="<p>Vos inforamtion: </p><br>";
$message.=$nom." ".$prenom."<br>";
$message.=$adresse." ".$ville." ".$codePostale."<br> ".$mail."<br> <br>";


//les information du concour
$message.="L'evenement se deroulera le : ".$date."<br>";
$message.="Heure prevu de debut : ".$heure."<br>";
$message.="Lieu : ".$adresseEvent." ".$cpEvent." ".$villeEvent."<br><br>";

$message.="Recapitulatif : <br>".$description."<br>";
$message.="<img src="."\""."http://api.qrserver.com/v1/create-qr-code/?data=HelloWorld!&size=400x400\"";



return $message;
	
}




?>