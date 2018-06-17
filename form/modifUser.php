<?php
session_start();
$server='81.64.97.173';
$db='projetweb';
$login='root';
$mdp='';
$idUser = $_GET['user'];
$_SESSION['idUser']=$idUser;
//connection a la bdd
try {
				$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

			}
catch (Exception $e) {
				die('Erreur : ' . $e->getMessage());

}

$req = $linkpdo -> prepare('select count(*) from medecin ');
	$req -> execute();
	$nbMedecin = $req -> fetch();
	$nbMedecin = $nbMedecin[0];


//requete pour recuperer le nom du mec
$req = $linkpdo -> prepare('select nom,prenom from patient where idUser like :idUser');
$req -> execute(array('idUser'=> $idUser 
		));

$nom = $req -> fetch();
$prenom = $nom[1];
$nom = $nom[0];


// requete pour savoir le genre
$req = $linkpdo -> prepare('select civilite from user where idUser like :idUser');
$req -> execute(array('idUser'=> $idUser
		));

$civilite = $req -> fetch();
$civilite = $civilite[0];






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
		<h2> Modification de : <?php echo $nom." ".$prenom ?>  </h2> 
		<p>Souhaitez-vous modifier des infos </p>

		<form action="../traitement/modifUserTraitement.php" method="post">
			<fieldset>
		
			<label for="nom">Nom :   </label> <input type="text" name="nom" value=""><br />
			<label for="prenom">Prenom :           </label>  <input type="text" name="prenom" value=""><br />
			<label for="adresse">Adresse :     </label>  <input type="text" name="adresse" value=""><br />
			<label for="codePostal">Code postale :       </label>  <input type="number" name="codePostal" value=""><br />
			<label for="ville" >Ville :    </label>  <input type="text" name="ville" value=""><br />
			<label for="dateN">Date de naissance : </label>  <input type="date" name="dateN" value=""><br />
			<label for="villeN">Ville de naissance :        </label>  <input type="text" name="villeN" value=""><br />
			<label for="numSecu">n° Sécurité sociale :        </label>  <input type="number" name="numSecu" value=""><br />

			<div class="form-group">
    			<label for="civilite" id="lab">Civilite :   </label>
   				 <select class="form-control col-lg-2 " id="champCivilite" name="civilite" >
				      <option value="M" name="civilite" >M</option>
				      <option value="F" name="civilite">F</option>
      
   				 </select>
  			</div>

  			
  			
     		<div class="form-group">
				  <label for="idMedecin">Medecin :</label>
				  <select class="form-control"  name="idMedecin">
				    
				    <?php
				    $req = $linkpdo -> prepare('select nom  , idMedecin from medecin');
					$req -> execute();

				   		$i = 0;
						while($i < $nbMedecin){
							$listeNom= $req -> fetch();
							echo $listeNom;
							$i = $i +1 ;
							?>
							<option name="idMedecin" value="<?php echo $listeNom[1] ?>" ><?php echo $listeNom[0] ?> </option>
							<?php
						}

					// selectionne le medecin

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
	function deconec(){
		document.location.href="http://81.64.97.173/scan/index.php";
		
	}
</script>