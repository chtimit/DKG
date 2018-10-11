<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style/style.css">
<header>
	<title>Créer un évenement</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<a href="accueil.php"><img src="src/log12.png"> </a>
	<?php session_start();
		if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
		{?>
			<a href="connexion.php" class="button2"> Connexion	</a>
			<a href="inscription.php" class="button1"> Inscription</a>
			<a href="profil.php" class="button3"> Profil </a>
		<?php } else { ?>
			<a href="deconexion.php" class="button2"> Déconexion</a>
			<a href='profil.php?id=<?php echo ($_SESSION['id_compte']."'"); ?> class="button3"> Profil </a>
	<?php } ?>
<body>
	<?php

	if (!isset($_SESSION['login']) || $_SESSION['login'] == "")
	{
		header('location: connexion.php');
		exit();
	}

	$host = "localhost";
	$dbname = "id7403838_workshop";
	$id_db = "id7403838_workshop";
	$mdp_db = "password";

	try 
	{
	    // create connexion
		$dbh = new PDO('mysql:host='.$host.';dbname='.$dbname, $id_db, $mdp_db);
	}

	catch (PDOException $e)
	{
	     print "Erreur !: " . $e->getMessage() . "<br/>";
	}

	?>
</header>

	<div class="formcreer">
		<div class="titreevenement">Publier votre évènement</div>
		<form method='POST' action='action_creer_evenement.php'>
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "nom") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<br>
			<div>
				<label>Ville :</label>
				<input type="text" name="ville" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "ville") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<br>
			<div>
				<label>Code Postal :</label>
				<input type="text" name="cp" class="champsblanc" <?php if (isset($_GET['error']) && $_GET['error'] == "cp") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>>
			</div>
			<br>
			<div>
				<label>Catégorie :</label>
				<SELECT name="categorie" class="champsblanc">
					<?php
						$sql = "SELECT * FROM categorie";
						$result = $dbh->query($sql);
						foreach ($result as $categorie) {?>
							<option value=<?php echo ("'".$categorie['id_categorie']."'"); ?>><?php echo ($categorie['categorie']); ?></option>
						<?php }?>
				</SELECT>
			</div>
			<br>
			<div>
				<label>Description :</label>
				<textarea name="desc" class="champsblanc" style='width: 70%;' <?php if (isset($_GET['error']) && $_GET['error'] == "desc") { echo ("placeholder='!erreur de saisie' style='border-style: solid; border-color: red;'"); } ?>></textarea>
			</div>
			<br>
			<div>
				<button type='submit' class="btncreereve">Créer</button>
			</div>
		</form>
	</div>
</body>
<?php $dbh = null; ?>
</html>
