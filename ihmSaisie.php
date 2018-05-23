<?php

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

$req = $linkpdo -> prepare('select count(*) from evenement ');
	$req -> execute();
	$nombreEvenement = $req -> fetch();
	$nombreEvenement = $nombreEvenement[0];






?>





<!Doctype html>
<html>
	<html>
	<head>
	<title>EventCreationCompte</title>




 
	<link rel="stylesheet" type="text/css" href="ihmSaisie.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	</head>
	<body>

	<div class="container">
		<div class="centre">
		<div id="registration">
		<h2> Creer un compte </h2>
		<form action="newCompte.php" method="post">
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
			<div class="form-group">
				  <label for="sel1">Evenement :</label>
				  <select class="form-control" id="sel1" name="nomEvenement">
				    
				    <?php
				    $req = $req = $linkpdo -> prepare('select nom from evenement');
					$req -> execute();
					


				   		$i = 0;
						while($i < $nombreEvenement){
							$listeNom= $req -> fetch();
							$i = $i +1 ;
							?>
							<option><?php echo $listeNom[0] ?> </option>
							<?php
						}
				    ?>
				  </select>
			</div>
			<button id="enregistrer" name="enregistrer" type="submit" ">Valider</button>
			<button id="enregistrer" name="cancel" type="button" onclick="annuler()">Annuler</button>

			</fieldset>
		</form>
		</div>
	</div>
	</div>
	
	</body>
</html>


<script type="text/javascript">
	function annuler(){
		 document.location.href="http://localhost/scan/index.php"
	}
</script>