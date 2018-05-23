



<!DOCTYPE html>
<html>
<head>
	<title>new Event</title>
	<link rel="stylesheet" type="text/css" href="newEvent.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="ihmSaisie.css">
	
</head>
<body>

	<div class="container-fluid" id="main">
		

		<div id="form">
			<form method="post" action="newEventTraitement.php" >
				<div class="centre">
		<div id="registration">
		<h2> Nouvel evenement </h2>
		<form action="newCompte.php" method="post">
			<fieldset>
		
			<label for="nom">Nom :   </label> <input type="text" name="nom" ><br />
			<label for="description">Description :   </label> <input type="text" name="description" ><br />
			<label for="adresse">Adresse :           </label>  <input type="text" name="adresse" ><br />
			<label for="ville">Ville :     </label>  <input type="text" name="ville" ><br />
			<label for="codeP">Code Postale :       </label>  <input type="text" name="codeP" ><br />
			<label for="date">Date :    </label>  <input type="date" name="date" ><br />
			<label for="time">Heure :       </label>  <input type="time" name="heure" ><br />
			
			
			<button id="enregistrer" name="enregistrer" type="submit" ">Valider</button>
			<button type="reset"> Reset </button>
			<button id="enregistrer" name="cancel" type="button" onclick="annuler()">Annuler</button>

			</fieldset>
		</form>
		</div>
	</div>
    		
  			</form>
		
		</div>
		
		
	</div>



</body>
</html>


<script type="text/javascript">
	function annuler(){
		document.location.href="http://localhost/scan/compteAdmin.php";
	}
</script>