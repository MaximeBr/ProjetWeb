
<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
  <link rel="stylesheet" type="text/css" href="ihmSaisie.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<!-- <form action="../traitement/ajout_medecin.php" method="post"> 

			<div class="form-group">
    			<label for="civilite" id="lab">civilite :   </label>
   				 <select class="form-control col-lg-2 " id="champCivilite" name="civilite" >
				      <option value="M" name="civilite" >M</option>
				      <option value="F" name="civilite">F</option>
   				 </select>
  			</div>

     		Votre nom : <input type="text" name="nom"><br /> 
     		Votre prenom : <input type="text" name="prenom"><br /> 
      		<input type="submit" value="OK"> 

    	</form>  -->

      <div class="container-fluid">
    <div class="centre">
    <div id="registration">
    <h2> Ajouter un Medcin </h2>
    <form action="../traitement/ajout_medecin.php" method="post">
      <fieldset>
    
      <label for="nom">Nom :   </label> <input type="text" name="nom" value=""><br />
      <label for="prenom">Prenom :           </label>  <input type="text" name="prenom" value=""><br />
     

      <div class="form-group">
          <label for="civilite" id="lab">Civilite :   </label>
           <select class="form-control col-lg-2 " id="champCivilite" name="civilite" >
              <option value="M" name="civilite" >M</option>
              <option value="F" name="civilite">F</option>
      
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