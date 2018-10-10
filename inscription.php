<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>inscription</title>
	<a href="accueil.html"><img src="src/log12.png"></a>

</header>
<body>

	<div class="forminscription">
		<form method='POST' action='creation_compte.php'>
			<div>
				<label>Nom :</label><input type='text' name='nom' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				
			</div><br>
			<div>
			<label>Prenom :</label><input type='text' name='prenom' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "prenom") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				
			</div><br>
			<div>
			<label>Nom d'utilisateur :</label><input type='text' name='pseudo' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "pseudo") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pseudo2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
				
			</div><br>
			<div>
				<label>Mot de passe :</label>
				<input type='password' name='mdp' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "mdp") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");}  if (isset($_GET['error']) && $_GET['error'] == "mdp3") { echo ("placeholder='!deux saisie non identique' style='border-style: solid; border-color: red;'");} ?>>
			</div><br>
			<div>
				<label>Confirmer mot de <br> passe :</label>
				<input type='password' name='mdp2' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "mdp2") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");}  if (isset($_GET['error']) && $_GET['error'] == "mdp3") { echo ("placeholder='!deux saisie non identique' style='border-style: solid; border-color: red;'");} ?>>
				
			</div><br>
			<div>
				<label>Email :</label>
				<input type='text' name='mail' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "mail") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "mail2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
				
			</div><br>
			<div>
				<label>Telephone :</label>
				<input type='text' name='telephone' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "tele") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "tele2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
			</div><br>
			<div>
				<label>Code postal :</label>
				<input type='text' name='cp' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "cp") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
			</div><br>
			<div>
				<label>Ville :</label>
				<input type='text' name='ville' class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "ville") { echo ("placeholder='erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
			</div><br>
			<div class="sexe">
				<label>Sexe :</label>
				<label>F    </label><input type='radio' id='f' name='sexe' value='F'><for='f'>
				<label>M    </label><input type='radio' id='m' name='sexe' value='M' checked><for='m'>
				<label>Autre    </label><input type='radio' id='a' name='sexe' value='A'><for='a'>
			</div><br>
			<button type='submit' class="formvalider">Valider</button>
		</form>
	</div>

</body>
</html>