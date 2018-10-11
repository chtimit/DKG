<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
	<title>Connexion</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<a href="accueil.php"><img src="src/log12.png"> </a>

	<?php session_start();
		if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
		{?>
			<a href="connexion.php" class="button2"> Connexion	</a>
			<a href="inscription.php" class="button1"> Inscription</a>
		<?php } else { ?>
			<a href="deconexion.php" class="button2"> Déconexion</a>
	<?php } ?>


</header>
<body>
	<div class="formconnexion">
		<div class="titreevenement">Je me connecte :</div>
		<form method='POST' action='action_connexion.php'>
			<div>
				<label>Identifiant</label>
				<input type="text" name="pseudo" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "pseudo") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pseudo2") { echo ("placeholder='!identifiant incorect' style='border-style: solid; border-color: red;'"); } ?>>	
			</div><br>
			<div>
				<label>Mot de passe</label>
				<input type="password" name="pwd" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "pwd") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pwd2") { echo ("placeholder='!mot de passe incorect' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<button type="submit" class="formvalider">Connexion</button>
		</form>
	<div class="nonmembre">Pas encore membre ? <a href="inscription.php" class="lieninscris">Inscrivez vous</a></div>
	</div>
</body>
</html>