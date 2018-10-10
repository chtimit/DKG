<!DOCTYPE html>
<html>
<head>
	<title>connexion</title>
</head>
<body>
	<div>
		<form method='POST' action='action_connexion.php'>
			<div>
				<input type="text" name="pseudo" <?php if (isset($_GET['error']) && $_GET['error'] == "pseudo") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pseudo2") { echo ("placeholder='!identifiant incorect' style='border-style: solid; border-color: red;'"); } ?>>
				<label>identifiant</label>
			</div><br>
			<div>
				<input type="password" name="pwd" <?php if (isset($_GET['error']) && $_GET['error'] == "pwd") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pwd2") { echo ("placeholder='!mot de passe incorect' style='border-style: solid; border-color: red;'"); } ?>>
				<label>mot de passe</label>
			</div>
			<button type="submit">valider</button>
		</form>
	</div>
</body>
</html>