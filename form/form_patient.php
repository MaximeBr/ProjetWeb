<?php 
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


<!DOCTYPE html>
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