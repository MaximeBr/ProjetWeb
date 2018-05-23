<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="indexStyle.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-xs-4" ></div>
			<div class="col-lg-4 col-sm-4 col-xs-4 "   >
				<h1>Bienvenue</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-sm-4 col-xs-4 col-md-4" ></div>
			<form action="connection.php" method="post" id="form">
				<div class="form-group">
					<label for="email"> Login (email) :</label>
					<input type="email" name="mail" class="form-control">
					
				</div>
				<div class="form-group">
					<label for="pwd">Password :</label>
					<input type="password" name="pwd" class="form-control">
					
				</div>
				<button type="submit" class="btn btn-primary" > Connexion</button>
				<button type="button" class="btn btn-secondary" onclick="mdr()"> Creer Compte</button>
				
			</form>
			
		</div>

	</div>
	



</body>
</html>

<script type="text/javascript">
	function mdr(){
		 document.location.href="http://localhost/scan/ihmSaisie.php"
	}
</script>

