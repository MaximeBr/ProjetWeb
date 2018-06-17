<?php 
				session_start();
					try {
				//On se connecte a MySQL
				$bdd = new PDO('mysql:host=localhost;dbname=projetweb','root','');
				}
				catch (Exception $e) {
					//En cas d'erreur, on affiche un message et on arrete tout
					die('Erreur : '.$e->getMessage());
				}

				$req = $bdd -> prepare('select count(*) from medecin ');
	$req -> execute();
	$nbMedecin = $req -> fetch();
	$nbMedecin = $nbMedecin[0];
?>


<!-- <!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>
	<form action="../traitement/ajout_patient.php" method="post"> 

			<div class="form-group">
    			<label for="civilite" id="lab">civilite :   </label>
   				 <select class="form-control col-lg-2 " id="champCivilite" name="civilite" >
				      <option value="M" name="civilite" >M</option>
				      <option value="F" name="civilite">F</option>
   				 </select>
  			</div>

     		Votre nom : <input type="text" name="nom"><br /> 
     		Votre prenom : <input type="text" name="prenom"><br /> 
     		Votre adresse : <input type="text" name="adresse"><br /> 
     		Votre code postal : <input type="number" name="codePostal"><br /> 
     		Votre ville : <input type="text" name="ville"><br /> 
     		date N : <input type="date" name="dateN"><br />
     		ville N : <input type="text" name="villeN"><br />
     		num secu : <input type="number" name="numSecu"><br />
     		M : <input type="number" name="idMedecin"><br />

     		<div class="form-group">
				  <label for="sel1">Medecin :</label>
				  <select class="form-control" id="sel1" name="rien">
				    
				    <?php
				    $req = $bdd -> prepare('select nom from medecin');
					$req -> execute();

				   		$i = 0;
						while($i < $nbMedecin){
							$listeNom= $req -> fetch();
							$i = $i +1 ;
							?>
							<option><?php echo $listeNom[0] ?> </option>
							<?php
						}
				    ?>
				  </select>
			</div>
      		<input type="submit" value="OK"> 

    	</form> 

</body>
</html>
 -->


<!Doctype html>
<html>
	<html>
	<head>
	<title>Ajout Patient</title>




 
	<link rel="stylesheet" type="text/css" href="ihmSaisie.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	
	</head>
	<body>

	<div class="container-fluid">
		<div class="centre">
		<div id="registration">
		<h2> Ajouter un patient </h2>
		<form action="../traitement/ajout_patient.php" method="post">
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
				    $req = $bdd -> prepare('select nom  , idMedecin from medecin');
					$req -> execute();

				   		$i = 0;
						while($i < $nbMedecin){
							$listeNom= $req -> fetch();
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
</html>*/


<script type="text/javascript">
	function annuler(){
		 document.location.href="http://localhost/scan/index.php"
	}
</script>