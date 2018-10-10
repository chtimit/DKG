<!DOCTYPE html>
<html>
<head>
	<title>inscription</title>
</head>
<body>

	<div>
		<form method='POST' action='creation_compte.php'>
			<div>
				<input type='text' name='nom' <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				<label>nom*</label>
			</div><br>
			<div>
				<input type='text' name='prenom' <?php if (isset($_GET['error']) && $_GET['error'] == "prenom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				<label>prenom*</label>
			</div><br>
			<div>
				<input type='text' name='pseudo' <?php if (isset($_GET['error']) && $_GET['error'] == "pseudo") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "pseudo2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
				<label>nom d'utilisateur*</label>
			</div><br>
			<div>
				<input type='password' name='mdp' <?php if (isset($_GET['error']) && $_GET['error'] == "mdp") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");}  if (isset($_GET['error']) && $_GET['error'] == "mdp3") { echo ("placeholder='!deux saisie non identique' style='border-style: solid; border-color: red;'");} ?>>
				<label>mot de passe*</label>
			</div><br>
			<div>
				<input type='password' name='mdp2' <?php if (isset($_GET['error']) && $_GET['error'] == "mdp2") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");}  if (isset($_GET['error']) && $_GET['error'] == "mdp3") { echo ("placeholder='!deux saisie non identique' style='border-style: solid; border-color: red;'");} ?>>
				<label>confirmer mot de passe*</label>
			</div><br>
			<div>
				<input type='text' name='mail' <?php if (isset($_GET['error']) && $_GET['error'] == "mail") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "mail2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
				<label>email*</label>
			</div><br>
			<div>
				<input type='text' name='telephone' <?php if (isset($_GET['error']) && $_GET['error'] == "tele") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} if (isset($_GET['error']) && $_GET['error'] == "tele2") { echo ("placeholder='!non disponible' style='border-style: solid; border-color: red;'");} ?>>
				<label>telephone*</label>
			</div><br>
			<div>
				<input type='text' name='cp' <?php if (isset($_GET['error']) && $_GET['error'] == "cp") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				<label>code postale*</label>
			</div><br>
			<div>
				<input type='text' name='ville' <?php if (isset($_GET['error']) && $_GET['error'] == "ville") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'");} ?>>
				<label>ville*</label>
			</div><br>
			<div>
				<input type='radio' id='f' name='sexe' value='F'><label for='f'>F</label>
				<input type='radio' id='m' name='sexe' value='M' checked><label for='m'>M</label>
				<input type='radio' id='a' name='sexe' value='A'><label for='a'>Autre</label>
				<label> | sexe</label>
			</div><br>
			<button type='submit'>Valider</button>
		</form>
	</div>

</body>
</html>