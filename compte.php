<?php
session_start();
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


//requete pour recuperer le nom du mec
$req = $linkpdo -> prepare('select nom from user where mail like :mail and mdp like :pwd');
$req -> execute(array('mail'=> $_SESSION['mail'], 'pwd' => $_SESSION['pwd']
		));

$nom = $req -> fetch();
$nom = $nom[0];

// requete pour savoir le genre
$req = $linkpdo -> prepare('select civilite from user where mail like :mail and mdp like :pwd');
$req -> execute(array('mail'=> $_SESSION['mail'], 'pwd' => $_SESSION['pwd']
		));

$civilite = $req -> fetch();
$civilite = $civilite[0];
if($civilite == 0 ){
	$civilite = "Mme.";
}
else{
	$civilite = "M.";
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Compte</title>
	
	<link rel="stylesheet" type="text/css" href="ihmSaisie.css" />
	<link rel="stylesheet" type="text/css" href="compteAdmin.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	</head>
	<body>


	<div class="container">
		<div class="centre">
		<div id="registration">
		<h2> Bienvenue <?php echo $civilite.$nom ?>  </h2> 
		<p>Souhaitez-vous modifier des infos </p>

		<form action="modif.php" method="post">
			<fieldset>
		
			<label for="societe">Societe :   </label> <input type="text" name="societe" value=""><br />
			<label for="nom">Nom :           </label>  <input type="text" name="nom" value=""><br />
			<label for="prenom">Prenom :     </label>  <input type="text" name="prenom" value=""><br />
			<label for="adr">Adresse :       </label>  <input type="text" name="adr" value=""><br />
			<label for="codePostale">Code Postal :    </label>  <input type="text" name="codePostale" value=""><br />
			<label for="ville">Ville :       </label>  <input type="text" name="ville" value=""><br />
			<label for="mail">Email :        </label>  <input type="email" name="mail" value=""><br />
			<label for="pwd">Mot de passe :        </label>  <input type="password" name="pwd" value=""><br />

			<div class="form-group">
    			<label for="civilite" id="lab">Civilite :   </label>
   				 <select class="form-control col-lg-2 " id="champCivilite" name="civilite" >
				      <option value="M" name="civilite" >M</option>
				      <option value="F" name="civilite">F</option>
      
   				 </select>
  			</div>
			
			<button id="enregistrer" name="enregistrer" type="submit" ">Modifier</button>
			<button id="enregistrer" name="cancel" type="reset" >Annuler</button>
			<button id="enregistrer" name="deco" type="button" onclick="deconec()">Deconection</button>

			</fieldset>
		</form>
		</div>
	</div>
	</div>
	
	</body>
</html>



<script type="text/javascript">
	function deconec(){
		document.location.href="http://localhost/scan/index.php";
		
	}
</script>