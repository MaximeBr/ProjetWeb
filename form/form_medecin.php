
<!DOCTYPE html>
<html>
<head>
	<title>MedecInfo</title>
</head>
<body>
	<form action="../traitement/ajout_medecin.php" method="post"> 

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

    	</form> 

</body>
</html>